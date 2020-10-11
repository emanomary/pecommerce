<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function updateShipping(ShippingRequest $request, $id)
    {
        try{
            $shipping_method = Setting::find($id);

            DB::beginTransaction();
            //save settings of delivery method
            $shipping_method -> update(['plain_value'=>$request->plain_value]);

            //save translations
            $shipping_method -> value = $request->value;
            $shipping_method->save();

            DB::commit();
            return redirect()->back()->with(['success' => __('messages.successUpdateDelivery')]);

        }catch(\Exception $ex)
        {
            DB::rollBack();
            return redirect()->back()->with(['error' => __('messages.errorUpdateDelivery')]);
        }

    }
}
