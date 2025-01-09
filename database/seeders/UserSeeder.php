<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
    	$user = New User();
    	$user -> name = 'Owner';
    	$user -> email = 'owner@gmail.com';
    	$user -> password = Hash::make('owner123');
    	$user -> level = 'Owner';
    	$user -> save();
    	DB::table('biodata')->insert([
    		'id_user'=>$user->id
    	]);
    }
}
