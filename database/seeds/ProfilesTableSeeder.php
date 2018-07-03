<?php

use App\User;
use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $titles = [];

        foreach ($users as $user)
        {
            foreach ($user->roles as $role)
            {
                foreach ($role->titles as $title)
                {
                    array_push($titles, $title->id);
                }
            }

            factory(App\Profile::class)->create([
                'user_id' => $user->id,
                'title' => 1
            ]);
        }
    }
}
