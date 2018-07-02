<?php

use App\Role;
use Illuminate\Database\Seeder;

class TitlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dr_titles = ['MD', 'Consultant', 'Assistant Professor', 'Associate Professor', 'Professor'];
        $nurse_titles = ['Medical Assistant', 'Certified Nurse'];
        $admin_title = 'Admin';

        $dr = Role::whereName('doctor')->first();
        $nurse = Role::whereName('nurse')->first();
        $admin = Role::whereName('admin')->first();

        foreach ($dr_titles as $title) {

            $dr->titles()->create(['name' => $title]);
        }

        foreach ($nurse_titles as $title) {

            $nurse->titles()->create(['name' => $title]);
        }

        $admin->titles()->create(['name' => $admin_title]);
    }
}
