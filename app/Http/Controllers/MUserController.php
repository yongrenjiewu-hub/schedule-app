<?php

namespace App\Http\Controllers;

use App\Models\MUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class MUserController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'ns_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        MUser::create([
            'ns_name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // ← ここが大事
        ]);

        return redirect()->route('home')->with('success', 'ユーザー登録完了');
    }

}
