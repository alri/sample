<?php

namespace Alri\Sample\Seeds;

use Illuminate\Database\Seeder;

use Faker\Generator as Faker;
use DB;
use Alri\Sample\Models\Sample as Sample;

class AlriSamplePackageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

       $sanple= Sample::create(array(
           'id'                 => 1,
           'name'              =>'alireza',
       ));

      /*
      DB::table('tests')->insert([
            'id' => 2,
            'name' => 'Test2',
        ]);

        */
    }

}
