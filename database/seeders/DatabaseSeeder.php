<?php

namespace Database\Seeders;

use App\Models\StatusCode;
use App\Models\Transaction;
use App\Models\User;
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
        //read users from json file
        $users = json_decode(file_get_contents(base_path() . "/jsons/users.json"), true);
        //insert users to db
        foreach($users as $user){
            User::create($user);
        }
        

        
        StatusCode::insert([
            [
                "status_code" => 1,
                "status_code_name" => "authorized"
            ],
            [
                "status_code" => 2,
                "status_code_name" => "decline"
            ],
            [
                "status_code" => 3,
                "status_code_name" => "refunded"
            ],

        ]);

        //read transactions from json file
        $transactions = json_decode(file_get_contents(base_path() . "/jsons/transactions.json"), true);
        //insert transactions to db
        foreach($transactions as $transaction){
            Transaction::create($transaction);
        }
    }
}
