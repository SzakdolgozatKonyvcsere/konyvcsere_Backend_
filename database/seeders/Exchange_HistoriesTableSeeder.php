<?php

namespace Database\Seeders;

use App\Models\BookOffer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Exchange_HistoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('exchange_histories')->insert([
            //átadva/visszautasítva
            [
                'interested_user' => User::where('id', 4)->value('id'),
                'desired_item' => BookOffer::where('offer_id', 32)->value('offer_id'),
                'offered_item' => BookOffer::where('offer_id', 27)->value('offer_id'),
                'exchange_status' => 'a'
            ],
            [
                'interested_user' => User::where('id', 3)->value('id'),
                'desired_item' => BookOffer::where('offer_id', 10)->value('offer_id'),
                'offered_item' => BookOffer::where('offer_id', 19)->value('offer_id'),
                'exchange_status' => 'a'
            ],
            [
                'interested_user' => User::where('id', 3)->value('id'),
                'desired_item' => BookOffer::where('offer_id', 28)->value('offer_id'),
                'offered_item' => BookOffer::where('offer_id', 20)->value('offer_id'),
                'exchange_status' => 'a'
            ],
            //
            [
                'interested_user' => User::where('id', 2)->value('id'),
                'desired_item' => BookOffer::where('offer_id', 28)->value('offer_id'),
                'offered_item' => BookOffer::where('offer_id', 20)->value('offer_id'),
                'exchange_status' => 'a'
            ],
            [
                'interested_user' => User::where('id', 3)->value('id'),
                'desired_item' => BookOffer::where('offer_id', 33)->value('offer_id'),
                'offered_item' => BookOffer::where('offer_id', 11)->value('offer_id'),
                'exchange_status' => 'a'
            ],
            [
                'interested_user' => User::where('id', 3)->value('id'),
                'desired_item' => BookOffer::where('offer_id', 34)->value('offer_id'),
                'offered_item' => BookOffer::where('offer_id', 21)->value('offer_id'),
                'exchange_status' => 'a'
            ],

            //kezdeményezés, 
            [
                'interested_user' => User::where('id', 4)->value('id'),
                'desired_item' => BookOffer::where('offer_id', 5)->value('offer_id'),
                'offered_item' => null,
                'exchange_status' => 'k'
            ],
            [
                'interested_user' => User::where('id', 2)->value('id'),
                'desired_item' => BookOffer::where('offer_id', 35)->value('offer_id'),
                'offered_item' => null,
                'exchange_status' => 'k'
            ],

            //folyamatban, 
            [
                'interested_user' => User::where('id', 4)->value('id'),
                'desired_item' => BookOffer::where('offer_id', 29)->value('offer_id'),
                'offered_item' => BookOffer::where('offer_id', 36)->value('offer_id'),
                'exchange_status' => 'f'
            ],
            

        ]);
    }
}
