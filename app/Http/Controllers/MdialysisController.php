<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mdialysis;
use App\Models\TPtDialysis;
use App\Models\MPatient;
use Illuminate\Console\Scheduling\Schedule;


class MdialysisController extends Controller
{
    //

    public function index($pt_id = null)
    {
        $patients = MPatient::with([
            'ptSchedules.dialysis.dialysisMaster',
            'ptSchedules.treatmentkind.treatmentkindMaster',
            'ptSchedules.carekind.carekindMaster',
            'ptSchedules.meal',
            'ptSchedules.meals',
            'ptSchedules.medicines.medicineMaster',
            'disease'
        ])->get()->groupBy('room_id');

        $m_dialysis = Mdialysis::all();

        $patient = null;
        if ($pt_id) {
            $patient = MPatient::with('ptSchedules.dialysis.dialysisMaster')->findOrFail($pt_id);
        }

        return view('dialysis.index', compact('patients', 'm_dialysis', 'patient'));
    }


    //登録画面表示
    public function register(){
    
        return view('dialysis.register');
    }

    
    public function store(Request $request)
    {
        
       
     //透析情報登録 
        Mdialysis::create([
            'dialysis_id' => $request->dialysis_id,
            'part' => $request->part,
            'dialysis_day' => $request->dialysis_day,
        ]);
        
        //登録完了後、透析一覧へ遷移
        return redirect()->route('dialysis.index', ['pt_id' => $request->pt_id]);


    }

    public function destroy($id)
    {
        $dialysis = PtDialysis::findOrFail($id);
        $dialysis->delete();
        return back()->with('message', '透析を削除しました');
    }

    public function dialysisPage($pt_id)
    {
        $patient = Patient::findOrFail($pt_id);
        
        // 透析情報などもロード
        $patient->load('ptSchedules.dialysis');

        return view('dialysis.index', [
            'patient' => $patient,
        ]);
    }

}
