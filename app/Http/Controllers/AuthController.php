<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function postlogin(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            alert('Gagal', $validator->messages());
            return redirect()->back()->withInput();
        }

        $credentials = [
            "email" => $request->email,
            "password" => $request->password
        ];
        try {

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                Alert::success('Success', 'Login Berhasil di lakukan')->flash();
                return redirect()->route('dashboard');
            } else {
                Alert::error('Gagal', "email atau password salah");
                return back()->withInput();
            }
        } catch (\Throwable $th) {
            //throw $th;
            alert()->error('Gagal', $th->getMessage());
            return back();
            //     alert()->error('Gagal',"nis/nip atau password salah");
            // return back();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
Alert::success('Success', 'Logout Berhasil di lakukan')->flash();
        return redirect('/');
    }
}
