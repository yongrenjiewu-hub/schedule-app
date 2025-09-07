<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\TAssigned;
use App\Models\MPatient;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;


class TAssignedController extends Controller
{
    //
    public function index($id = null)
    {
        $userId = Auth::id();

        // 割り当てられた患者情報を取得し、room_idでグループ化
        $assignedPatients = TAssigned::with([
            'patient.ptSchedules.dialysis.dialysisMaster',
            'patient.ptSchedules.treatmentkind.treatmentkindMaster',
            'patient.ptSchedules.carekind.carekindMaster',
            'patient.ptSchedules.meal',
            'patient.ptSchedules.meals',
            'patient.ptSchedules.medicines.medicineMaster',
        ])
        ->where('user_id', $userId)
        ->get()
        ->pluck('patient')
        ->groupBy('room_id');

        // $idがnullなら最初の患者IDをセット
        if (is_null($id)) {
            // 最初のグループ（room_idごとの患者コレクション）を取得
            $firstGroup = $assignedPatients->first();

            // そのグループの最初の患者を取得
            $firstPatient = $firstGroup ? $firstGroup->first() : null;

            $id = $firstPatient ? $firstPatient->pt_id : null;
        }

        if ($id) {
            $m_patient = MPatient::with([
                'ptSchedulesAll.dialysis.dialysisMaster',
                'ptSchedulesAll.treatmentkind.treatmentkindMaster',
                'ptSchedulesAll.carekind.carekindMaster',
                'ptSchedulesAll.meal',
                'ptSchedulesAll.medicines.medicineMaster',
                'disease',
            ])->findOrFail($id);
        } else {
            $m_patient = null; // 患者がいないケース
        }
        


        $today = Carbon::now('Asia/Tokyo')->startOfDay()->toDateString();

        $reminderSchedules = collect();

        foreach ($assignedPatients as $roomPatients) {
            foreach ($roomPatients as $patient) {
                // nullチェックを追加！
                if (!$patient) {
                    continue;
                }

                // スケジュールを今日だけにフィルター
                $patient->ptSchedules = $patient->ptSchedules->filter(function ($schedule) use ($today) {
                    return Carbon::parse($schedule->daily_schedule_date)->isSameDay($today);
                });
        
                foreach ($patient->ptSchedules as $schedule) {
                    $times = [];
        
                    foreach ($schedule->carekind as $care) {
                        $times[] = optional($care->carekindMaster)->Fcare_date;
                        $times[] = optional($care->carekindMaster)->Scare_date;
                        $times[] = optional($care->carekindMaster)->Tcare_date;
                    }
        
                    foreach ($schedule->treatmentkind as $treat) {
                        $times[] = optional($treat->treatmentkindMaster)->Ftreatment_date;
                        $times[] = optional($treat->treatmentkindMaster)->Streatment_date;
                        $times[] = optional($treat->treatmentkindMaster)->Ttreatment_date;
                    }
        
                    foreach ($schedule->dialysis as $dia) {
                        $times[] = optional($dia->dialysisMaster)->dialysis_date;
                    }
        
                    if ($schedule->meal) {
                        $times[] = optional($schedule->meal)->Mfood_date;
                        $times[] = optional($schedule->meal)->Lfood_date;
                        $times[] = optional($schedule->meal)->Dfood_date;
                    }
        
                    foreach ($schedule->medicines as $med) {
                        $times[] = $med->Mmedicine_date;
                        $times[] = $med->Dmedicine_date;
                        $times[] = $med->Nmedicine_date;
                    }
        
                    $times = array_filter($times);
        
                    foreach ($times as $time) {
                        $datetime = Carbon::parse($schedule->daily_schedule_date . ' ' . $time)->toDateTimeString();
                        $reminderSchedules->push([
                            'id' => $schedule->id,
                            'datetime' => $datetime,
                            'pt_name' => $patient->pt_name,
                        ]);
                    }
                }
            }
        }
        

        return view('assigned.index', [
            'patients' => $assignedPatients,
            'm_patient' => $m_patient,
            'today' => $today, 
            'reminderSchedules' => $reminderSchedules, 
        ]);
    }

    public function add($pt_id)
    {
        $userId = Auth::id();

        TAssigned::firstOrCreate([
            'user_id' => $userId,
            'pt_id' => $pt_id,
        ]);

        return redirect()->route('assigned.index')->with('message', '患者を追加しました');
    }

    public function remove($pt_id)
    {
        $userId = Auth::id();

        TAssigned::where('user_id', $userId)->where('pt_id', $pt_id)->delete();

        return redirect()->route('assigned.index')->with('message', '患者を削除しました');
    }
}
