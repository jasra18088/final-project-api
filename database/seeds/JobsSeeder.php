<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Jobs;
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
            $machineID = $machines[array_rand($machines)]->id;
            $materialID = $materialType[array_rand($materialType)]->id;

            if (Jobs::get()->where('machine_id', $machineID)->count() >= 1) {
                $priority = Jobs::where('machine_id', '=', $machineID)->orderBy('priority', 'desc')->first()->priority + 1;
            } else {
                $priority = 1;
            }

            Jobs::create(
                [
                    'machine_id' => $machineID,
                    'material_type_id' => $materialID,
                    'priority' => $priority,
                    'job_status' => 'planned'
                ]
            );
        }
    }
}
