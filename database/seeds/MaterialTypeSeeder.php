<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $materialType = ['Type 1', 'Type 2', 'Type 3', 'Type 4'];

        foreach ($materialType as $value) {
            DB::table('material_types')->insert(
                [
                    'name' => $value
                ]
                );
        }
    }
}
