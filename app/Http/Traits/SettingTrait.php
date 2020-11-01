<?php

namespace App\Http\Traits;

use App\Http\Requests\Admin\LoginRequest;

trait SettingTrait
{
    public function login()
    {
        return view('dashboard.auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        //check remember me option
        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me))
        {
            //notify()->success('تم الدخول بنجاح  ');
            return redirect()->route('dashboard.index');
        }
        // notify()->error('خطا في البيانات  برجاء المجاولة مجدا ');
        return redirect()->back()->with(['error' => __('messages.error')]);
    }

    public function logout()
    {
        $gaurd = $this->getGaurd();
        $gaurd -> logout();
        return redirect()->route('admin.login');
    }

    private function getGaurd()
    {
        return auth('admin');
    }
}
