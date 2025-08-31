<?php

namespace App\Http\Controllers;

use App\Models\MPatient;
use App\Models\MCarekind;
use App\Models\Mdialysis;
use App\Models\MDisease;
use App\Models\MMeal;
use App\Models\MTreatmentkind;
use App\Models\MMedicine;
use App\Models\TAssigned;
use App\Models\TCarekind;
use App\Models\TMedicalrecord;
use App\Models\TTreatmentkind;
use App\Models\TDialysis;
use App\Models\TPtDialysis;
use App\Models\TPtschedule;
use App\Models\TMedicine;
use App\Models\TMeal;
use Date;
use Exception;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use App\Http\Requests\StorePatientRequest;


use Carbon\Carbon;


class MPatientController extends Controller
{
    //Patient一覧表示
    public function index($id = null)
    {
        // 部屋ごとに患者をグループ化し、情報をネストで取得
        // 複数のディレクトリをコレクションとして取得
        $patients = MPatient::with([
            'ptSchedules.dialysis.dialysisMaster',
            'ptSchedules.treatmentkind.treatmentkindMaster',
            'ptSchedules.carekind.carekindMaster',
            'ptSchedules.meal',
            'ptSchedules.meals',  // ★食事の中間テーブル（t_meal）経由
            'ptSchedules.medicines.medicineMaster', // ★薬とそのマスター
            'disease'
        ])->get()->groupBy('room_id');

        // $idがnullなら最初の患者IDをセット（例）
        if (is_null($id)) {
            $firstPatient = MPatient::first();
            $id = $firstPatient ? $firstPatient->pt_id : null;
        }

        $m_patient = null;
        if ($id) {
            $m_patient = MPatient::with('ptSchedulesAll.medicines.medicineMaster')->find($id);
        }

        $today = Carbon::now('Asia/Tokyo')->startOfDay()->toDateString(); // ← これに統一

        return view('patient.index', compact('patients', 'm_patient', 'today'));
    }


    //登録画面表示
    public function register()
    {
        $diseases = MDisease::all();  // 疾患一覧を取得
        return view('patient.register', compact('diseases'));
    }

    //patient登録処理・バリデーション処理はRequestファイルに専用のクラス作成
    public function store(StorePatientRequest $request)
    {
        //患者情報更新が失敗したらログ出力
        try {
            // sex が 0〜3 以外の場合、一覧にリダイレクト
            if (!in_array($request->sex, [0, 1, 2, 3])) {
                return redirect()->route('patient.index')->with('error', '性別の値が不正です');
            }

            // 患者情報の登録
            $mp = MPatient::create([
                'room_id' => $request->room_id,
                'pt_name' => $request->pt_name,
                'sex' => $request->sex,
                'blood_type' => $request->blood_type,
                'birthday' => $request->birthday,
                'disease_id' => $request->disease_id,
                'tell_number' => $request->tell_number,
                'key_person' => $request->key_person,
                'Dr_name' => $request->Dr_name,
            ]);

            // T_PT_SCHEDULE の初期作成
            TPtschedule::create([
                'pt_id' => $mp->pt_id,
                'daily_schedule_date' => today(),
            ]);

            //登録完了後、患者一覧へ遷移
            return redirect()->route('patient.index');
        } catch (Exception $e) {
            // ログなど
            Log::error('患者情報更新エラーログです');
        }
    }


    //患者情報画面
    public function information(Request $request, $pt_id)
    {

        $patients = MPatient::get()->groupBy('room_id');

        $m_patient = MPatient::with([
            'ptSchedulesAll.dialysis.dialysisMaster',
            'ptSchedulesAll.treatmentkind.treatmentkindMaster',
            'ptSchedulesAll.carekind.carekindMaster',
            'ptSchedulesAll.meal',
            'ptSchedulesAll.medicines.medicineMaster',
            'disease',
            'records'
        ])->findOrFail($pt_id);

        $diseas = MDisease::where('disease_id', $pt_id)->get();

        $schedule = $m_patient->ptSchedulesAll->first();

        $documents = TMedicalrecord::where('pt_id', $pt_id)->latest()->get();

        // ここで treatmentkind をカテゴリごとにグルーピング（例）
        if ($schedule) {
            $treatmentkindsGrouped = $schedule->treatmentkind->groupBy(function ($item) {
                return optional($item->treatmentkindMaster)->category ?? 'その他';
            });
        } else {
            $treatmentkindsGrouped = collect();
        }

        // カテゴリの日本語ラベル
        $categoryLabels = [
            'treatment' => '治療',
            'check' => '検査',
            'rehabilitation' => 'リハビリ',
            'operation' => '手術',
            'check_data' => 'データ',
            'その他' => 'その他',
        ];

        return view('patient.information', compact(
            'patients',
            'm_patient',
            'documents',
            'request',
            'treatmentkindsGrouped',
            'categoryLabels',
        ));
    }


    //患者情報画面内のカルテ登録
    public function extra(Request $request)
    {
        $request->validate([
            'pt_id' => 'required|exists:m_patient,pt_id',
            'pt_record' => 'required|string|max:1000',
        ]);
        //取得した情報をテーブルに登録
        TMedicalrecord::create([
            'pt_id' => $request->pt_id,
            'pt_record' => $request->pt_record,
        ]);

        return redirect()->route('patient.information', ['pt_id' => $request->pt_id]);
    }

    //患者情報登録画面
    public function show(Request $request, $id)
    {
        $today = Carbon::now('Asia/Tokyo')->startOfDay()->toDateString();

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

        if (!$t_pt_schedule) {
            $t_pt_schedule = new TPtschedule();
            $t_pt_schedule->setRelation('medicines', collect());
        }

        $t_care_kind = TCarekind::where('pt_id', $id)->whereDate('daily_schedule_date', $today)->get();

        $t_treatment_kind = TTreatmentkind::where('pt_id', $id)
            ->whereDate('daily_schedule_date', $today)
            ->get()
            ->load('treatmentkindMaster');

        $t_pt_dialysis = TPtDialysis::where('pt_id', $id)->whereDate('daily_schedule_date', $today)->get();

        $m_care_kind = MCarekind::all()->groupBy('category');
        $m_dialysis = Mdialysis::all()->groupBy('dialysis_day');
        $m_disease = MDisease::all();
        $m_meal = MMeal::all();
        $m_patient = MPatient::all();
        $m_medicine = MMedicine::all();
        $m_treatment_kind = MTreatmentkind::all()->groupBy('category');

        $selectedMedicineIds = $t_pt_schedule->medicines->pluck('medicine_id')->toArray();



        // 既に選択されている治療をカテゴリごとにグループ化
        $treatmentkinds = $t_treatment_kind->groupBy(function ($item) {
            return optional($item->treatmentkindMaster)->category ?? 'その他';
        });

        $allTreatmentKinds = MTreatmentkind::all();

        $t_treatment_kind = TTreatmentkind::where('pt_id', $id)
            ->whereDate('daily_schedule_date', $today)
            ->get()
            ->load('treatmentkindMaster');

        // チェックボックス用：選択済み治療IDを配列で取得
        $selectedTreatmentKindIds = $t_treatment_kind->pluck('treatment_kind_id')->toArray();

        // 登録済みの薬の薬名配列をコントローラーで作成
        if ($request->isMethod('post')) {
            $medicineInput = $request->input('medicine', []);
            $selectedMedicineIds = is_array($medicineInput)
                ? array_unique(array_filter($medicineInput))
                : [$medicineInput];
        } else {
            // GET時はDBから取得 t_mdeicineテーブルに登録されているデータからpt_schedule_idの中のmedicine_idを取得
            $selectedMedicineIds = TMedicine::where('pt_schedule_id', $id)->pluck('medicine_id')->toArray();
        }

        // 薬名での選択済みはDBから取得
        $selectedMedicineDrugNames = $t_pt_schedule->medicines
            ->map(fn($med) => optional($med->medicineMaster)->drug_name)
            ->filter()
            ->unique()
            ->toArray();

        //食事pt_schedule_id取得
        $selectedMealIds = TMeal::where('pt_schedule_id', $id)
            ->pluck('meal_id')
            ->toArray();


        return view('patient.add', compact(
            't_pt_schedule',
            't_care_kind',
            't_treatment_kind',
            't_pt_dialysis',
            'm_care_kind',
            'm_dialysis',
            'm_disease',
            'm_meal',
            'm_medicine',
            'm_treatment_kind',
            'm_patient',
            'selectedMedicineIds',
            'selectedMealIds',
            'id',
            'today',
            'treatmentkinds',
            'allTreatmentKinds',
            'selectedTreatmentKindIds',
            'selectedMedicineDrugNames',
        ));
    }


    public function update(Request $request, $pt_id)
    {
        //バリデーション
        $request->validate([
            'care.*' => 'nullable|integer|exists:m_care_kind,care_kind_id',
            'dialysis.*' => 'nullable|string',
            'treatment.*.*' => 'nullable|integer|exists:m_treatment_kind,treatment_kind_id',
            'meal.*' => 'nullable|integer|exists:m_meal,meal_id',
            'medicine.*' => 'nullable|string|max:255', // drug_nameベースなら文字列バリデーション
        ]);

        //更新処理に失敗したらログ出力
        try {
            $today = Carbon::now('Asia/Tokyo')->startOfDay()->toDateString();

            // ===== スケジュール作成・更新 =====
            $ptSchedule = TPtschedule::updateOrCreate(
                ['pt_id' => $pt_id, 'daily_schedule_date' => $today],
                // ['meal_id' => $request->input('meal')]
            );
            $pt_schedule_id = $ptSchedule->pt_schedule_id;

            // ===== 透析の更新 =====
            TPtDialysis::where('pt_id', $pt_id)
                ->whereDate('daily_schedule_date', $today)
                ->delete();

            foreach ($request->input('dialysis', []) as $part) {
                if (!empty($part)) {
                    TPtDialysis::create([
                        'pt_id' => $pt_id,
                        't_pt_dialysis_part' => $part,
                        'daily_schedule_date' => $today,
                    ]);
                }
            }

            // ===== 看護ケアの更新 =====
            TCarekind::where('pt_id', $pt_id)
                ->whereDate('daily_schedule_date', $today)
                ->delete();

            foreach (array_filter($request->input('care', [])) as $care_id) {
                if (!empty($care_id)) {
                    TCarekind::create([
                        'pt_id' => $pt_id,
                        'care_kind_id' => $care_id,
                        'daily_schedule_date' => $today,
                        'pt_schedule_id' => $pt_schedule_id,
                    ]);
                }
            }

            // ===== 治療データの更新 =====
            TTreatmentkind::where('pt_id', $pt_id)
                ->whereDate('daily_schedule_date', $today)
                ->delete();

            $treatmentkindArray = $request->input('treatment', []); // ['treatment' => [id, id], ...]

            foreach ($treatmentkindArray as $category => $treatmentIds) {
                foreach ($treatmentIds as $treatment_id) {
                    if (!empty($treatment_id)) {
                        TTreatmentkind::create([
                            'pt_id' => $pt_id,
                            'treatment_kind_id' => $treatment_id,
                            'daily_schedule_date' => $today,
                            'pt_schedule_id' => $pt_schedule_id,
                        ]);
                    }
                }
            }

            // ===== 食事の更新 =====
            TMeal::where('pt_schedule_id', $pt_schedule_id)->delete();

            $selectedMealIds = array_filter($request->input('meal', []));

            if (!empty($selectedMealIds)) {
                foreach ($selectedMealIds as $mealId) {
                    $mealRecords = MMeal::where('meal_id', $mealId)->first();
                    $sameMealRecords = MMeal::where('food_name', $mealRecords->food_name)
                        ->where('food_form', $mealRecords->food_form)
                        ->get();

                    foreach ($sameMealRecords as $record) {
                        TMeal::create([
                            'pt_schedule_id' => $pt_schedule_id,
                            'meal_id' => $record->meal_id,
                            'pt_id' => $pt_id,
                            'daily_schedule_date' => $today,
                        ]);
                    }
                }

            }

            // ===== 薬データの更新 =====
            TMedicine::where('pt_schedule_id', $pt_schedule_id)->delete();
            $selectedMedicineIds = array_filter($request->input('medicine', []));

            if (!empty($selectedMedicineIds)) {
                foreach ($selectedMedicineIds as $medicineId) {

                    // 1. IDからレコード取得し、薬名を取得
                    $medicine = MMedicine::where('medicine_id', $medicineId)->first();

                    if (!$medicine) {
                        // レコードがなければ次へ
                        continue;
                    }

                    $targetDrugName = $medicine->drug_name;

                    // 2. 薬名が同じレコードをすべて取得
                    $sameDrugRecords = MMedicine::where('drug_name', $targetDrugName)->get();

                    // 3. 取得したレコードの medicine_id を使って登録などの処理
                    foreach ($sameDrugRecords as $record) {
                        TMedicine::create([
                            'pt_schedule_id' => $pt_schedule_id,
                            'medicine_id' => $record->medicine_id,  // ここはオブジェクトから取り出す
                            'daily_schedule_date' => $today,
                        ]);
                    }
                }
            }

            // ===== [6] 完了後リダイレクト =====
            return redirect()->route('patient.information', ['pt_id' => $pt_id]);

        } catch (Exception $erorr) {
            Log::error('透析、食事、薬、看護ケア、治療の更新エラーログです');
        }

    }
}
