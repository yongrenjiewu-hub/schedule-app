<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MMedicine;
use App\Models\MPatient;
use Illuminate\Console\Scheduling\Schedule;
use Carbon\Carbon;

class MMedicineController extends Controller
{
    //
    public function index($pt_id = null)
    {
        // 変数名を単数形に変更
        $patient = MPatient::with([
            'ptSchedules.medicines.medicineMaster',
            'ptSchedules.dialysis.dialysisMaster',
        ])->findOrFail($pt_id);

        $today = Carbon::now('Asia/Tokyo')->toDateString();

        $m_medicine = MMedicine::all();

        return view('medicine.index', compact('patient', 'm_medicine', 'today'));
    }


    //登録画面表示
    public function register(){
    
        return view('medicine.register');
    }

    
    public function store(Request $request)
    {
        //バリデーション
        $request->validate([
            'kinds' => 'required|string|max:255',
            'drug_name' => 'required|string|max:255',
            'usage' => 'required|string|max:255',
            'dose' => 'required|string|max:255',
        ]);
     
        //薬情報登録 
        $medicineMaster = MMedicine::create([
        'kinds' => $request->kinds,
        'drug_name' => $request->drug_name,
        'usage' => $request->usage,
        'dose' => $request->dose,
        'medicine_time' => $request->medicine_time, // 時間帯など
        'medicine_time_label' => $request->medicine_time_label, // 朝昼夜

        ]);
    
        
        //登録完了後、薬一覧へ遷移
        return redirect()->route('medicine.index');

    }


    // MedicineController.php
    public function destroy($id)
    {
        $medicine = MMedicine::findOrFail($id);
        $medicine->delete();

        return back()->with('success', '薬の情報を削除しました。');
    }


}
