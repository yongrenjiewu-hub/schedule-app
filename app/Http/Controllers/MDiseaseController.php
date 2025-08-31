<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MDisease;

class MDiseaseController extends Controller
{
    public function index()
    {
        $m_disease = MDisease::all();
        return view('disease.index', compact('m_disease'));
    }

    // 登録画面表示
    public function register()
    {
        $diseases = MDisease::all(); // 疾患一覧を取得
        return view('patient.register', compact('diseases'));
    }

    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'disease_name' => 'required|string|max:255',
        ]);

        // 疾患情報登録
        MDisease::create([
            'disease_name' => $request->disease_name,
        ]);

        // 登録完了後、疾患一覧へ遷移
        return redirect()->route('disease.index');
    }
}
