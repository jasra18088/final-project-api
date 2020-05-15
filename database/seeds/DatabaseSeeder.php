<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(MachinesSeeder::class);
        $this->call(MaterialTypeSeeder::class);
        $this->call(JobsSeeder::class);
    }
}
