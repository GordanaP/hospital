<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::whereName('admin')->first();
        $superadmin = Role::whereName('superadmin')->first();
        $doctor = Role::whereName('doctor')->first();
        $patient = Role::whereName('patient')->first();

        $doctors = User::whereIn('id', [3,4,5])->get();
        $patients = User::whereIn('id', [6,7])->get();

        User::first()->roles()->attach($admin);
        User::find(2)->roles()->attach($superadmin);

        foreach ($doctors as $dr) {

            $dr->roles()->attach($doctor);
        }

        foreach ($patients as $pt) {

            $pt->roles()->attach($patient);
        }
    }
}
