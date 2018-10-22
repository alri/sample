<?php

namespace Alri\Test\Seeds;

use Illuminate\Database\Seeder;

use Faker\Generator as Faker;
use DB;
use Alri\Test\Models\Test as Test;

class AlriTestPackageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

       $test= Test::create(array(
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
