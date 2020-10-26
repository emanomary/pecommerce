<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;
use App\Models\Admin;

class ProfileController extends Controller
{
    public function edit()
    {
        //get id of admin
        $id = auth('admin')->user()->id;
        $admin = Admin::find($id);
        return view('dashboard.profile.edit',compact('admin'));
    }

    public function update(ProfileRequest $request)
    {
        try
        {
            $admin = Admin::find(auth('admin')->user()->id);

            //return $request;
            //if enter password
            if ($request->filled('password')) {
                $request->merge(['password' => bcrypt($request->password)]);
                //to not save id and password_confirmation
                unset($request['id']);
                unset($request['password_confirmation']);

                $admin->update($request->all());
            }
            else
                $admin->update($request->only(['name','email']));

           return redirect()->back()->with(['success' => __('messages.successUpdateProfile')]);

        }
        catch(\Exception $ex)
        {
            return redirect()->back()->with(['error' => __('messages.errorUpdateProfile')]);

        }
    }
}
