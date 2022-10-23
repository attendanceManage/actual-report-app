<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
      $data = array(
        array(
            'id'      => 1,
            'name'    => 'adcash oü',
            'phone'   => '1111111',
            'email'   => 'contact@adcash.com',
            'address' => 'Kentmanni 4, 10116 Tallinn, Estonia',
            

        ),array(
            'id'    => 2,
            'name'  => 'Google oü',
            'phone' => '111111',
            'email' => 'google@gmail.com',
            'address' => 'Google Tallinn',
        ),
        array(
            'id'    => 3,
            'name'  => 'Tesia Inc',
            'phone' => '2222222',
            'email' => 'Tesia@gmail.com',
            'address' => 'Tesia Tallinn',
        )
    
    ); 

        foreach($data as $dataInsert)
        {
           \DB::table('company')->updateOrInsert(
                ['id'=>$dataInsert['id']],
                $dataInsert
            );
        }
 
    }
}
