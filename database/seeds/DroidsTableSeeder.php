<?php

use Illuminate\Database\Seeder;
use App\UserBuild;
use App\User;
use App\Droid;



class DroidsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $R0 = Droid::create([
            'class' => 'R0',
            'description' => 'Dome Only',
            'image' => '/img/R0Dome.png'
        ]);
        $R2MK2 = Droid::create([
            'class' => 'R2 MK2',
            'description' => 'Full Droid',
            'image' => 'https://vignette.wikia.nocookie.net/starwars/images/e/eb/ArtooTFA2-Fathead.png/',
        ]);
        $R2MK3 = Droid::create([
            'class' => 'R2 MK3',
            'description' => 'Full Droid',
            'image' => 'https://vignette.wikia.nocookie.net/starwars/images/e/eb/ArtooTFA2-Fathead.png/',
        ]);
        $R4MK2 = Droid::create([
            'class' => 'R4 MK2',
            'description' => 'Dome Only',
            'image' => '/img/R4Dome.png',
        ]);
        $R4MK3 = Droid::create([
            'class' => 'R4 MK3',
            'description' => 'Dome Only',
            'image' => '/img/R4Dome.png'
        ]);
        $R5MK2 = Droid::create([
            'class' => 'R5 MK2',
            'description' => 'Dome Only',
            'image' => '/img/R5Dome.png'
        ]);
        $R5MK3 = Droid::create([
            'class' => 'R5 MK3',
            'description' => 'Dome Only',
            'image' => '/img/R5Dome.png'
        ]);
        $R6MK2 = Droid::create([
            'class' => 'R6 MK2',
            'description' => 'Dome Only',
            'image' => '/img/R6Dome.png'
        ]);
        $R6MK3 = Droid::create([
            'class' => 'R6 MK3',
            'description' => 'Dome Only',
            'image' => '/img/R6Dome.png'
        ]);
        $R7D = Droid::create([
            'class' => 'R7 MK3',
            'description' => 'Dome Only',
            'image' => '/img/R7Dome.png'
        ]);
        $R7B = Droid::create([
            'class' => 'R7 MK3',
            'description' => 'Body Only',
            'image' => '/img/R7Body.png'
        ]);
        $R9MK2 = Droid::create([
            'class' => 'R9 MK2',
            'description' => 'Dome Only',
            'image' => '/img/R9Dome.png'
        ]);
        $R9MK3 = Droid::create([
            'class' => 'R9 MK3',
            'description' => 'Dome Only',
            'image' => '/img/R9Dome.png'
        ]);
        $Chop = Droid::create([
            'class' => 'Chopper',
            'description' => 'WIP',
            'image' => 'https://vignette.wikia.nocookie.net/starwars/images/5/5d/Chopper1-Fathead.png'
        ]);
        $custom = Droid::create([
            'class' => 'Custom',
            'description' => 'Your Custom Droid',
            'image' => '/img/custom.png'
        ]);
        $BD1 = Droid::create([
            'class' => 'BD-1',
            'description' => 'Full Droid',
            'image' => 'https://vignette.wikia.nocookie.net/starwars/images/e/e7/BD-1_AG.png/'
        ]);
        $BT1 = Droid::create([
            'class' => 'BT-1',
            'description' => 'Dome Only',
            'image' => '/img/BT1Dome.png'
        ]);
        $DOV2 = Droid::create([
            'class' => 'D-O V2',
            'description' => 'Full Droid',
            'image' => '/img/DO.png'
        ]);
    }
}
