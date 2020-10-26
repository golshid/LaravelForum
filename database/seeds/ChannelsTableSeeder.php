<?php

use Illuminate\Database\Seeder;
use App\Channel;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channel1 = ['title' => 'Harry Potter', 'slug'=>str_slug('Harry Potter')];
        $channel2 = ['title' => 'Marvel', 'slug' => str_slug('Marvel')];
        $channel3 = ['title' => 'DC Universe', 'slug' => str_slug( 'DC Universe')];
        $channel4 = ['title' => 'Stranger Things', 'slug' => str_slug( 'Stranger Things')];

        Channel::create($channel1);
        Channel::create($channel2);
        Channel::create($channel3);
        Channel::create($channel4);
    }
}
