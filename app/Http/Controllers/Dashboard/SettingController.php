<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function editShipping($type)
    {
        if($type == 'free')
            $shippingMethod = Setting::where('key','free_shipping_label')->first();
        elseif($type == 'internal')
            $shippingMethod = Setting::where('key','local_shipping_label')->first();
        elseif($type == 'external')
            $shippingMethod = Setting::where('key','external_shipping_label')->first();
        else
            $shippingMethod = Setting::where('key','free_shipping_label')->first();
        //return $shippingMethod;
        return view('dashboard.settings.shippings.edit',compact('shippingMethod'));
    }

    public function updateShipping(Request $request, $id)
    {

    }
}
