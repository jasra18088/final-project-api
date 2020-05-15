<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MachinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $machines = ['Machine One', 'Machine Two', 'Machine Three', 'Machine Four'];

        foreach ($machines as $name) {
            DB::table('machines')->insert(
                [
                    'name' => $name
                ]
                );
        }
    }
}
