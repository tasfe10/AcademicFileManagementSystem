<?php

namespace Database\Seeders;

use App\Models\Roles;
use App\Models\Users; // ← Corrected to match your model name
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        // Get the first user or create one if no user exists
        $user = Users::first();

        if (!$user) {
            $user = Users::create([
                'id' => Str::uuid(),
                'firstName' => 'Admin',
                'lastName' => 'Seeder',
                'userName' => 'admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'isDeleted' => 0,
                'emailConfirmed' => 1,
                'phoneNumberConfirmed' => 1,
                'twoFactorEnabled' => 0,
                'lockoutEnabled' => 0,
                'accessFailedCount' => 0,
                'phoneNumber' => '0000000000'
            ]);
        }

        $roles = [
            [
                'id' => 'ff635a8f-4bb3-4d70-a3ed-c7749030696c',
                'isDeleted' => 0,
                'name' => 'Employee',
                'createdBy' => $user->id,
                'modifiedBy' => $user->id,
                'createdDate' => Carbon::now(),
                'modifiedDate' => Carbon::now()
            ],
            [
                'id' => 'f8b6ace9-a625-4397-bdf8-f34060dbd8e4',
                'isDeleted' => 0,
                'name' => 'Super Admin',
                'createdBy' => $user->id,
                'modifiedBy' => $user->id,
                'createdDate' => Carbon::now(),
                'modifiedDate' => Carbon::now()
            ]
        ];

        Roles::insert($roles);
    }
}
