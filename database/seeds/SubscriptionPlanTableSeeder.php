<?php

use Illuminate\Database\Seeder;
use App\Models\Api\Admin\Language;

class SubscriptionPlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('subscription_plans')->truncate();

        $plans = 
        [
            [   
                'plan_id' =>  env('FREE_PLAN_ID'),
                'name' =>     'United Nations Basic',
                'price'=> 0.00,
                'words'=> 25,
                'show_words'=> 25,
                'team_type'=> 'unlimited',
                'teams'=> 3,
                'game_play_time'=> '00:01:00',
                'random_words'=> 'yes',
                'sound_effects'=> 'yes',
                'plan_type'=> 'free',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],
            [   
                'plan_id' =>  env('GOLD_PLAN_ID'),
                'name' =>     'United Nations Gold',
                'price'=> 0.99,
                'words'=> 25,
                'show_words'=> 25,
                'team_type'=> 'unlimited',
                'teams'=> 3,
                'game_play_time'=> '00:01:00',
                'random_words'=> 'yes',
                'sound_effects'=> 'yes',
                'plan_type'=> 'paid',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],
            [   
                'plan_id' =>  env('DIAMOND_PLAN_ID'),
                'name' =>     'United Nations Diamond',
                'price'=> 4.99,
                'words'=> 150,
                'show_words'=> 150,
                'team_type'=> 'unlimited',
                'teams'=> 3,
                'game_play_time'=> '00:01:00',
                'random_words'=> 'yes',
                'sound_effects'=> 'yes',
                'plan_type'=> 'paid',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],
            [   
                'plan_id' =>  env('PLATINUM_PLAN_ID'),
                'name' =>     'United Nations Platinum',
                'price'=> 9.99,
                'words'=> 200,
                'show_words'=> 200,
                'team_type'=> 'unlimited',
                'teams'=> 3,
                'game_play_time'=> '00:01:00',
                'random_words'=> 'yes',
                'sound_effects'=> 'yes',
                'plan_type'=> 'paid',
                'status'=> 'active',
                'created_at'   =>  date('Y-m-d H:i:s'),
            ],
        ];
        
        DB::table('subscription_plans')->insert($plans);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
    }
}
