<?php

use Illuminate\Database\Seeder;
use App\Discussion;

class DiscussionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $t1 = 'How did Voldemort face get disfigured?';
        $t2 = 'Is this JK Rowling “pocketeded” story true?';
        $t3 = 'Why did Harry Potter get a bedroom?';
        $t4 = 'Why did the Marauders not find the room of requirement?';
        $t5 = 'Are there any individual aliens that have gained superpowers in the Marvel universe?';
        $t6 = 'Is The Amazing Spider-Man part of the Marvel Cinematic Universe?';
        $t7 = 'What are the differences between Hawkeye and Green Arrow?';
        $t8 = 'What are the differences between Ant-Man and The Atom?';
        $t9 = 'Can the Demogorgon open gates?';
        $t10 = 'Why was the “Demogorgon” not attracted to Elevens blood?';

        $d1 = [
            'title'=> $t1,
            'content'=> 'The nose of Tom Riddle (as a student) was fine, as I have seen in the movies. But, Voldemorts nose doesnt look like a normal human nose. What really happened?',
            'channel_id'=> 1,
            'user_id' => 2,
            'slug'=> str_slug($t1)
        ];

        $d2 = [
            'title' => $t2,
            'content' => 'The nose of Tom Riddle (as a student) was fine, as I have seen in the movies. But, Voldemorts nose doesnt look like a normal human nose. What really happened?',
            'channel_id' => 1,
            'user_id' => 1,
            'slug' => str_slug($t2)
        ];

        $d3 = [
            'title' => $t3,
            'content' => 'The nose of Tom Riddle (as a student) was fine, as I have seen in the movies. But, Voldemorts nose doesnt look like a normal human nose. What really happened?',
            'channel_id' => 1,
            'user_id' => 1,
            'slug' => str_slug($t3)
        ];

        $d4 = [
            'title' => $t4,
            'content' => 'The nose of Tom Riddle (as a student) was fine, as I have seen in the movies. But, Voldemorts nose doesnt look like a normal human nose. What really happened?',
            'channel_id' => 1,
            'user_id' => 1,
            'slug' => str_slug($t4)
        ];

        $d5 = [
            'title' => $t5,
            'content' => 'Have there been any aliens who have obtained superpowers via similar means? Im not talking about aliens like Asgardians, Kree, Skrulls, etc who are naturally stronger and more resilien t t han Humans. Im referring to any extra-terrestrial beings of commensurate composition with Humans that have been exposed to anything that left them with powers that others of their race would consider super.',
            'channel_id' => 2,
            'user_id' => 1,
            'slug' => str_slug($t5)
        ];

        $d6 = [
            'title' => $t6,
            'content' => 'Spider-Man is a Marvel franchise, just like Avengers and X-Men. When they rebooted the Hulk in 2008 it was to incorporate the character into the Marvel Cinematic Universe. The Amazing Spider-Man opens on July 3, 2012 in the USA and is a reboot of the character. Spider-Man 3 was released in 2007. Its only been five years since the last movie for this character!',
            'channel_id' => 2,
            'user_id' => 2,
            'slug' => str_slug($t6)
        ];

        $d7 = [
            'title' => $t7,
            'content' => 'When I first started reading Green Arrow, not caring about the Marvel vs DC thing, I thought he was the only bowman superhero - and he looked like Robin Hood. Then I found Hawkeye, who was more like a Native American type of hero. Nevertheless, I though that it was the same character brought up in a different time and place.',
            'channel_id' => 3,
            'user_id' => 1,
            'slug' => str_slug($t7)
        ];

        $d8 = [
            'title' => $t8,
            'content' => 'I recently saw "Ant-Man" and was able to get a general understanding of Ant-Mans powers and limitations.Ive also read DC comics for years, and while I know about the Atom and have a general understanding of his abilities, he is rarely featured.',
            'channel_id' => 3,
            'user_id' => 2,
            'slug' => str_slug($t8)
        ];

        $d9 = [
            'title' => $t9,
            'content' => 'Is the Demogorgon opening these gates or are they natural phenomena?',
            'channel_id' => 4,
            'user_id' => 1,
            'slug' => str_slug($t9)
        ];

        $d10 = [
            'title' => $t10,
            'content' => 'The "Demogorgon" in Stranger Things is very attracted to even small amounts of blood. Eleven is frequently bleeding from the nose at several points in the show. Why does this not attract the "Demogorgon"?',
            'channel_id' => 4,
            'user_id' => 2,
            'slug' => str_slug($t10)
        ];

        



        Discussion::create($d1);
        Discussion::create($d2);
        Discussion::create($d3);
        Discussion::create($d4);
        Discussion::create($d5);
        Discussion::create($d6);
        Discussion::create($d7);
        Discussion::create($d8);
        Discussion::create($d9);
        Discussion::create($d10);
    }
}
