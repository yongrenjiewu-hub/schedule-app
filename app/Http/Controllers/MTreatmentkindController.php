<?php

namespace App\Http\Controllers;

use App\Models\MTreatmentkind;
use App\Models\MPatient;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;

class MTreatmentkindController extends Controller
{
    //
    public function index($pt_id = null){

        $patients = MPatient::with([
            'ptSchedules.dialysis.dialysisMaster',
            'ptSchedules.treatmentkind.treatmentkindMaster',
            'ptSchedules.carekind.carekindMaster',
            'ptSchedules.meal',
            'ptSchedules.meals',
            'ptSchedules.medicines.medicineMaster',
            'disease'
        ])->get()->groupBy('room_id');

        $m_treatment_kind = MTreatmentkind::all();

        $patient = null;
        if ($pt_id) {
            $patient = MPatient::with('ptSchedules.dialysis.dialysisMaster')->findOrFail($pt_id);
        }

        return view('treatmentkind.index', compact('patients','m_treatment_kind','patient'));
    }

    //登録画面表示
    public function register(){
    
        return view('treatmentkind.register');
    }

    
    public function store(Request $request)
    {
       
     //治療情報登録 
        MTreatmentkind::create([
            'care_kind_id' => $request->care_kind_id,
            'category' => $request->category,
            'key' => $request->key,
            'value' => $request->value,
            
        ]);
        
        //登録完了後、治療一覧へ遷移
        return redirect()->route('treatmentkind.index');

    }

    public function destroy($id)
    {
        $treatment = PtTreatmentkind::findOrFail($id);
        $treatment->delete();
        return back()->with('message', '治療を削除しました');
    }

}
