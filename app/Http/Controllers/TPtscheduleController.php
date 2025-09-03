<?php

namespace App\Http\Controllers;

use App\Models\TPtschedule;
use App\Models\TAssigned;
use App\Models\MPatient;
use App\Models\MMedicine;
use App\Models\MMeal;
use App\Models\TMeal;
use App\Models\TCarekind;
use App\Models\TMedicine;
use App\Models\TPtDialysis;
use App\Models\TTreatmentkind;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use Carbon\Carbon;


class TPtscheduleController extends Controller
{
    //

    //スケジュールに患者のケア治療等を時系列順に表示するため、情報を取得
    public function index(Request $request, $id = null)
    {
        $userId = auth()->id();

        $today = Carbon::now('Asia/Tokyo')->startOfDay()->toDateString();

        // リレーションのみ取得
        $assignedPatients = TAssigned::with([
            'patient.ptSchedules' => function ($query) {
                $query->with([
                    'carekind.carekindMaster',
                    'treatmentkind.treatmentkindMaster',
                    'dialysis.dialysisMaster',
                    'meal',
                    'meals',
                    'medicines.medicineMaster',
                ]);
            }
        ])
            ->where('user_id', $userId)
            ->get()
            ->unique('pt_id'); // ← 重複患者を排除

        $patients = $assignedPatients
        ->pluck('patient')
        ->filter()
        ->unique('pt_id')
        ->groupBy('room_id');
        

        // TAssigned ではなく patient を groupBy
        $groupedPatients = $assignedPatients
            ->pluck('patient')
            ->filter()
            ->groupBy('room_id');

        // $idがnullなら最初の患者IDをセット
        if (is_null($id)) {
            $firstPatient = $assignedPatients->first();
            $id = $firstPatient ? $firstPatient->patient->pt_id : null;
        }

        //patient情報
        $m_patient = null;
        if ($id) {
            $m_patient = MPatient::with('ptSchedulesAll.medicines.medicineMaster')->find($id);
        }

        $t_pt_schedule = TPtschedule::with([
            'medicines' => function ($query) use ($today) {
                $query->whereDate('daily_schedule_date', $today);
            },
            'meals' => function ($query) use ($today) {
                $query->whereDate('daily_schedule_date', $today);
            }
        ])
            ->where('pt_id', $id)
            ->whereDate('daily_schedule_date', $today)
            ->first();
        //薬マスタ情報取得
        $m_medicine = MMedicine::all();

        if ($request->isMethod('post')) {
            $medicineInput = $request->input('medicine', []);
            $selectedMedicineIds = is_array($medicineInput)
                ? array_unique(array_filter($medicineInput))
                : [$medicineInput];
        } else {
            // GET時はDBから取得、ただし $t_pt_schedule が null なら空配列にする
            $selectedMedicineIds = $t_pt_schedule && $t_pt_schedule->medicines
                ? $t_pt_schedule->medicines->pluck('medicine_id')->toArray()
                : [];
        }
        


        // 1つの共通配列に変換して sortBy する
        foreach ($assignedPatients as $assigned) {
            foreach ($assigned->patient->ptSchedules as $schedule) {
                $allItems = collect();

                // === ケア
                foreach ($schedule->carekind as $item) {
                    $master = $item->carekindMaster;
                    if ($master) {
                        foreach (['Fcare_date', 'Scare_date', 'Tcare_date'] as $field) {
                            $time = $master->$field;
                            if ($time) {
                                $allItems->push([
                                    'type' => 'care',
                                    'label' => '看護ケア',
                                    'time' => $time,
                                    'value' => $master->value ?? '',
                                    'deleteRoute' => route('schedule.carekind.destroy', ['id' => $item->t_care_kind_id]),
                                ]);
                            }
                        }
                    }
                }

                // === 治療
                foreach ($schedule->treatmentkind as $item) {
                    $master = $item->treatmentkindMaster;
                    if ($master) {
                        foreach (['Ftreatment_date', 'Streatment_date', 'Ttreatment_date'] as $field) {
                            $time = $master->$field;
                            if ($time) {
                                $allItems->push([
                                    'type' => 'treatment',
                                    'label' => '治療',
                                    'time' => $time,
                                    'value' => $master->value ?? '',
                                    'deleteRoute' => route('schedule.treatmentkind.destroy', ['id' => $item->t_treatment_kind_id]),
                                ]);
                            }
                        }
                    }
                }

                // === 透析
                foreach ($schedule->dialysis as $item) {
                    $master = $item->dialysisMaster;
                    if ($master && $master->dialysis_date) {
                        $allItems->push([
                            'type' => 'dialysis',
                            'label' => '透析',
                            'time' => $master->dialysis_date,
                            'value' => $master->part . ' ' . $master->dialysis_day,
                            'deleteRoute' => route('schedule.dialysis.destroy', ['id' => $item->pt_dialysis_id]),
                        ]);
                    }
                }

                // === 食事
                $meals = $schedule->meals ?? collect();
                foreach ($meals as $meal) {
                    $time = $meal->food_time;
                    if ($time) {
                        $allItems->push([
                            'type' => 'meal',
                            'label' => '食事',
                            'time' => $time,
                            'value' => $meal->food_name . ' ' . $meal->food_form,
                            'deleteRoute' => route('schedule.meal.destroy', ['id' => $meal->pivot->t_meal_id]),
                        ]);
                    }
                }

                // === 薬
                foreach ($schedule->medicines as $medicine) {
                    $master = $medicine->medicineMaster;
                    if ($master && $master->medicine_time) {
                        $allItems->push([
                            'type' => 'medicine',
                            'label' => '薬',
                            'time' => $master->medicine_time,
                            'value' => $master->drug_name,
                            'deleteRoute' => route('schedule.medicine.destroy', ['id' => $medicine->t_medicine_id]),
                        ]);
                    }
                }

                // === 時間でソート
                $schedule->sortedItems = $allItems->sortBy('time')->values();
            }
        }



        return view('schedule.index', compact(
            'assignedPatients',
            'm_patient',
            'today',
            'patients',
            'groupedPatients',
            'm_medicine',
            'selectedMedicineIds'
        ));
    }

    public function getSchedulesFiltered($pt_id, $date)
    {
        // まず患者のスケジュール取得（日付で絞り込み）
        $schedules = TPtschedule::where('pt_id', $pt_id)
            ->where('daily_schedule_date', $date)
            ->get();

        // 透析（TPtDialysis）は pt_id と日付で絞る
        $dialysis = TPtDialysis::where('pt_id', $pt_id)
            ->where('daily_schedule_date', $date)
            ->get();

        // 薬（TMedicine）は pt_schedule_id で紐づくけど、
        // まず該当スケジュールIDを取得してそれで絞り込み
        $scheduleIds = $schedules->pluck('pt_schedule_id');
        $medicines = TMedicine::whereIn('pt_schedule_id', $scheduleIds)->get();

        // 食事（MMeal）はTPtscheduleのmeal_idから取得
        // mealは一つのスケジュールに紐づく(患者一覧、MY患者一覧は１件の食事情報を参照できればいい)
        $mealIds = $schedules->pluck('meal_id')->filter();
        //食事は pt_idで絞る（複数の食事情報（朝昼晩）を表示し管理必要がある）
        $meals = MMeal::whereIn('meal_id', $mealIds)->get();

        // 治療（TTreatmentkind）は pt_id と日付で絞る
        $treatmentKinds = TTreatmentkind::where('pt_id', $pt_id)
            ->where('daily_schedule_date', $date)
            ->get();

        // ケア（TCarekind）も pt_id と日付で絞る
        $careKinds = TCarekind::where('pt_id', $pt_id)
            ->where('daily_schedule_date', $date)
            ->get();


        return compact('schedules', 'dialysis', 'medicines', 'meals', 'treatmentKinds', 'careKinds');
    }

    public function destroyMeal($id)
    {
        $meal = TMeal::findOrFail($id);
        $meal->delete();
        return redirect()->route('schedule.index');
        //return back()->with('message', '食事を削除しました');
    }

    public function destroyCarekind($id)
    {
        $care = TCarekind::findOrFail($id);
        $care->delete();
        return back()->with('message', 'ケアを削除しました');
    }

    public function destroyTreatmentkind($id)
    {
        $treatment = TTreatmentkind::findOrFail($id);
        $treatment->delete();
        return back()->with('message', '治療を削除しました');
    }

    public function destroyDialysis($id)
    {
        $dialysis = TPtDialysis::findOrFail($id);
        $dialysis->delete();
        return back()->with('message', '透析を削除しました');
    }

    public function destroyMedicine($id)
    {
        $medicine = TMedicine::findOrFail($id);
        $medicine->delete();
        return back()->with('message', '薬を削除しました');
    }



}
