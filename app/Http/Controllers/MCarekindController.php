<?php

namespace App\Http\Controllers;

use App\Models\MCarekind;
use App\Models\MPatient;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;


class MCarekindController extends Controller
{
    //
    public function index($pt_id = null)
    {
        $patients = MPatient::with([
            'ptSchedules.carekind.carekindMaster',
        ])->get()->groupBy('room_id');

        $m_care_kind = MCarekind::all();

        $patient = null;
        if ($pt_id) {
            // 単一患者を、ケア情報もロードして取得
            $patient = MPatient::with('ptSchedules.carekind.carekindMaster')->findOrFail($pt_id);
        }

        return view('carekind.index', compact('patients', 'm_care_kind', 'patient'));
    }


    //登録画面表示
    public function register()
    {

        return view('carekind.register');
    }


    public function store(Request $request)
    {

        //ケア情報登録 
        MCarekind::create([
            'care_kind_id' => $request->care_kind_id,
            'pt_schedule_id' => $request->pt_schedule_id,
            'category' => $request->category,
            'key' => $request->key,
            'value' => $request->value,

        ]);

        //登録完了後、ケア一覧へ遷移
        return redirect()->route('carekind.index');

    }

    public function destroy($id)
    {
        $care = PtCarekind::findOrFail($id);
        $care->delete();

        return redirect()->back()->with('success', 'ケアを削除しました');
    }

}
