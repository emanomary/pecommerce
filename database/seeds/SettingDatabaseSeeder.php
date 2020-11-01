<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::setMany([
            'default_locale'=>'ar',
            'default_timezone'=>'Asia/Jerusalem',
            'reviews_enabled'=> true,
            'auto_approve_reviews'=> true,
            'supported_currencies'=> ['USD','ILS','SAR'],
            'default_currency'=> 'USD',
            'store_email'=> 'amegromy@gmail.com',
            'search_engine'=> 'mysql',
            'local_shipping_cost'=> 0,
            'external_shipping_cost'=> 0,
            'free_shipping_cost'=> 0,
            'translatable'=>[
                'store_name'=> 'أميجرومي' ,
                'local_shipping_label'=> 'التوصيل الداخلي',
                'external_shipping_label'=> 'التوصيل الخارجي',
                'free_shipping_label'=> 'التوصيل المجاني',
            ],

        ]);
    }
}
