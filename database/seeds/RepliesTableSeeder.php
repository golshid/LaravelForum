<?php

use Illuminate\Database\Seeder;
use App\Reply;

class RepliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $r1 = [
            'user_id' => 1,
            'discussion_id' => 1,
            'content' => 'It was degraded by Dark Magic.
Slytherincess is quite right to mention the meeting between Voldemort and Dumbledore as a midpoint between the youthful Riddle and the You-Know-Who that subsequently emerged.'
        ];

        $r2 = [
            'user_id' => 2,
            'discussion_id' => 2,
            'content' => 'It was degraded by Dark Magic.
Slytherincess is quite right to mention the meeting between Voldemort and Dumbledore as a midpoint between the youthful Riddle and the You-Know-Who that subsequently emerged.'
        ];

        $r3 = [
            'user_id' => 1,
            'discussion_id' => 3,
            'content' => 'It was degraded by Dark Magic.
Slytherincess is quite right to mention the meeting between Voldemort and Dumbledore as a midpoint between the youthful Riddle and the You-Know-Who that subsequently emerged.'
        ];

        $r4 = [
            'user_id' => 2,
            'discussion_id' => 4,
            'content' => 'It was degraded by Dark Magic.
Slytherincess is quite right to mention the meeting between Voldemort and Dumbledore as a midpoint between the youthful Riddle and the You-Know-Who that subsequently emerged.'
        ];

        Reply::create($r1);
        Reply::create($r2);
        Reply::create($r3);
        Reply::create($r4);
    }
}
