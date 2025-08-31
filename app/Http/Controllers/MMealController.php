<?php

namespace App\Http\Controllers;

use App\Models\MMeal;
use App\Models\MPatient;
use Exception;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMealRequest;

class MMealController extends Controller
{
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

        $m_meal = MMeal::all();

        $patient = null;
        if ($pt_id) {
            $patient = MPatient::with('ptSchedules.dialysis.dialysisMaster')->findOrFail($pt_id);
        }


        return view('meal.index', compact('patients', 'm_meal', 'patient'));
    }

    //登録画面表示
    public function register()
    {

        return view('meal.register');
    }


    public function store(Request $request)
    {
        try {
            //食事情報登録 
            MMeal::create([
                'meal_id' => $request->meal_id,
                'food_name' => $request->food_name,
                'food_form' => $request->food_form,
                'food_time' => $request->food_time,
                'food_time_label' => $request->food_time_label,
            ]);

            //登録完了後、食事一覧へ遷移
            return redirect()->route('meal.index');
        } catch (Exception $e) {
            // ログ
        }
    }

    public function destroy($id)
    {
        $meal = PtMeal::findOrFail($id);
        $meal->delete();
        return back()->with('message', '食事を削除しました');
    }

}