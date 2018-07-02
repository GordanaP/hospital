<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Database tables.
     *
     * @var array
     */
    protected $tables = [ 'users', 'roles', 'role_user', 'profiles', 'titles'];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->cleanDatabase();

        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
        $this->call(ProfilesTableSeeder::class);
        $this->call(TitlesTableSeeder::class);
    }

    /**
     * Truncate the tables.
     *
     * @return void
     */
    protected function cleanDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ($this->tables as $table)
        {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
