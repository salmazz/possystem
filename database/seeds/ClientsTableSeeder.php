<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $clients=[
            'ahmed','mohamed','salma'
        ];
        foreach($clients as $client){
            \App\Client::create([
                'name'=>$client,
                'phone'=>'5465454',
                'address'=>'haram'
            ]);
        }
    }
}
