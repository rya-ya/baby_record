<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Home;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function index(){

        return view('register.index');

    }
    public function create(Request $request){

        $validated = $request->validate([
            'home' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ],[
            'home.required' => '家族の名字を入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => '有効なメールアドレスを入力してください',
            'email.unique' => 'このメールアドレスはすでに登録されています',
            'password.required' => 'パスワードを入力してください',
            'password.min' => 'パスワードは8文字以上で入力してください',
            'password.confirmed' => 'パスワードが一致していません',
        ]);

        DB::transaction(function () use ($validated){

            $user = User::create([
                'name' => $validated['home'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            $result = Home::create([
                'name' => $validated['home'],
                'user_id' => $user->id,
            ]);

        });

        session()->flash('success',"新規登録が完了しました。登録したメールアドレスでログインできます。");

        return redirect()->route('login.index');

    }
}
