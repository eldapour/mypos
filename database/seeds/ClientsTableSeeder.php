<?php

use App\Client;
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
        $clients = ['Ahmed','Mohamed','Mahmoud','Abdullah','Kareem'];
        foreach ($clients as $client) {

            Client::create([
                'name'=> $client,
                'phone'=> '21065652',
                'address'=> $client,
            ]); // end of create clients

        } // end of foreach

    } // end od run

} // end of seeder
