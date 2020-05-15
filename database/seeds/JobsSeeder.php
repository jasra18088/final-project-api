<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Machines;
use App\MaterialType;

class JobsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $machines = Machines::get()->all();
        $materialType = MaterialType::get()->all();

        for ($i = 0; $i < 25; $i++) {
            DB::table('jobs')->insert(
                [
                    'machine_id' => $machines[array_rand($machines)]->id,
                    'material_type_id' => $machines[array_rand($materialType)]->id,
                ]
            );
        }
    }
}
