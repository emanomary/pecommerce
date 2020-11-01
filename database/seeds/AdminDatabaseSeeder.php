<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'=> 'Eman Kullab',
            'email'=> 'emankullab@gmail.com',
            'password'=> bcrypt('mohammed/87')
        ]);
    }
}
