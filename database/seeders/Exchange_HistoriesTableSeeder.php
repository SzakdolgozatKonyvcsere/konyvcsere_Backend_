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
                'exchange_status' => 'a',
                'created_at' => '2025-04-25 23:44:22',
                'updated_at' => '2025-04-26 12:16:33'
            ],
            [
                'interested_user' => User::where('id', 3)->value('id'),
                'desired_item' => BookOffer::where('offer_id', 10)->value('offer_id'),
                'offered_item' => BookOffer::where('offer_id', 19)->value('offer_id'),
                'exchange_status' => 'a',
                'created_at' => '2025-04-25 22:33:17',
                'updated_at' => '2025-04-27 16:37:04'
            ],
            [
                'interested_user' => User::where('id', 3)->value('id'),
                'desired_item' => BookOffer::where('offer_id', 28)->value('offer_id'),
                'offered_item' => BookOffer::where('offer_id', 20)->value('offer_id'),
                'exchange_status' => 'a',
                'created_at' => '2025-04-26 23:44:22',
                'updated_at' => '2025-04-26 12:16:33'
            ],
            //
            [
                'interested_user' => User::where('id', 2)->value('id'),
                'desired_item' => BookOffer::where('offer_id', 28)->value('offer_id'),
                'offered_item' => BookOffer::where('offer_id', 20)->value('offer_id'),
                'exchange_status' => 'a',
                'created_at' => '2025-03-20 15:10:03',
                'updated_at' => '2025-03-22 13:52:44'
            ],
            [
                'interested_user' => User::where('id', 3)->value('id'),
                'desired_item' => BookOffer::where('offer_id', 33)->value('offer_id'),
                'offered_item' => BookOffer::where('offer_id', 11)->value('offer_id'),
                'exchange_status' => 'a',
                'created_at' => '2025-04-26 18:22:10',
                'updated_at' => '2025-04-27 12:06:03'
            ],
            [
                'interested_user' => User::where('id', 3)->value('id'),
                'desired_item' => BookOffer::where('offer_id', 34)->value('offer_id'),
                'offered_item' => BookOffer::where('offer_id', 21)->value('offer_id'),
                'exchange_status' => 'a',
                'created_at' => '2025-04-27 10:03:55',
                'updated_at' => '2025-04-27 19:39:24'
            ],

            //kezdeményezés, 
            [
                'interested_user' => User::where('id', 4)->value('id'),
                'desired_item' => BookOffer::where('offer_id', 5)->value('offer_id'),
                'offered_item' => null,
                'exchange_status' => 'k',
                'created_at' => '2025-04-26 20:26:11',
                'updated_at' => '2025-04-26 20:26:11'
            ],
            [
                'interested_user' => User::where('id', 2)->value('id'),
                'desired_item' => BookOffer::where('offer_id', 35)->value('offer_id'),
                'offered_item' => null,
                'exchange_status' => 'k',
                'created_at' => '2025-04-27 11:27:53',
                'updated_at' => '2025-04-27 11:27:53'
            ],

            //folyamatban, 
            [
                'interested_user' => User::where('id', 4)->value('id'),
                'desired_item' => BookOffer::where('offer_id', 29)->value('offer_id'),
                'offered_item' => BookOffer::where('offer_id', 36)->value('offer_id'),
                'exchange_status' => 'f',
                'created_at' => '2025-04-28 12:11:42',
                'updated_at' => '2025-04-28 12:11:42'
            ],
            

        ]);
    }
}
