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
        // $r2Class = Droid::where('class', 'r2')->first();
        // $r4Class = Droid::where('class', 'r4')->first();
        // $r5Class = Droid::where('class', 'r5')->first();
        // $r6Class = Droid::where('class', 'r6')->first();
        // $r7Class = Droid::where('class', 'r7')->first();
        // $r9Class = Droid::where('class', 'r9')->first();
        // $customClass = Droid::where('class', 'custom')->first();
        $bt1Class = Droid::where('class', 'bt1')->first();
        $r0 = Droid::where('class', 'r0')->first();

        // $r2 = Droid::create([
        //     'class' => 'R2',
        //     'description' => 'Full Droid',
        //     'image' => 'https://vignette.wikia.nocookie.net/starwars/images/e/eb/ArtooTFA2-Fathead.png/revision/latest?cb=20161108040914',
        // ]);

        // $r4 = Droid::create([
        //     'class' => 'R4',
        //     'description' => 'Dome Only',
        //     'image' => 'https://vignette.wikia.nocookie.net/starwars/images/d/dd/R4_negtd.jpg/revision/latest?cb=20100810061713',
        // ]);
        // $r5 = Droid::create([
        //     'class' => 'R5',
        //     'description' => 'Dome Only',
        //     'image' => 'https://vignette.wikia.nocookie.net/starwars/images/c/cb/R5-D4_Sideshow.png/revision/latest?cb=20160809033145',
        // ]);
        // $r6 = Droid::create([
        //     'class' => 'R6',
        //     'description' => 'Dome Only',
        //     'image' => 'https://vignette.wikia.nocookie.net/starwars/images/9/95/R6-LE5-SWTROS-VD.jpg/revision/latest?cb=20191229213055',
        // ]);
        // $r7 = Droid::create([
        //     'class' => 'R7',
        //     'description' => 'Full Droid',
        //     'image' => 'https://vignette.wikia.nocookie.net/starwars/images/4/4f/R7-F5.jpg/revision/latest/top-crop/width/360/height/450?cb=20090310054647',
        // ]);
        // $r9 = Droid::create([
        //     'class' => 'R9',
        //     'description' => 'Dome Only',
        //     'image' => 'https://vignette.wikia.nocookie.net/starwars/images/8/85/R9Pic.jpg/revision/latest/top-crop/width/360/height/450?cb=20091223205649',
        // ]);
        // $bd1 = Droid::create([
        //     'class' => 'BD-1',
        //     'description' => 'Full Droid',
        //     'image' =>   'https://vignette.wikia.nocookie.net/starwars/images/e/e7/BD-1_AG.png/revision/latest?cb=20200406023031',
        // ]);
        // $chopper = Droid::create([
        //     'class' => 'Chopper',
        //     'description' => 'WIP',
        //     'image' => 'https://vignette.wikia.nocookie.net/starwars/images/e/e5/Chopper2-Fathead.png/revision/latest?cb=20161108054908',
        // ]);
        // $custom = Droid::create([
        //     'class' => 'Custom',
        //     'description' => 'Your custom droid',
        //     'image' => 'https://wompampsupport.azureedge.net/fetchimage?siteId=7575&v=2&jpgQuality=100&width=700&url=https%3A%2F%2Fi.kym-cdn.com%2Fentries%2Ficons%2Ffacebook%2F000%2F023%2F967%2Fobiwan.jpg',
        // ]);
        $bt1 = Droid::create([
            'class' => 'BT1',
            'description' => 'Dome Only',
            'image' => 'https://vignette.wikia.nocookie.net/starwars/images/2/2f/BT-1_IA.png/revision/latest?cb=20170407211034',
        ]);
        $r0 = Droid::create([
            'class' => 'R0',
            'description' => 'Dome Only',
            'image' => 'https://vignette.wikia.nocookie.net/starwars/images/e/e0/R0-4L0_-_Droid_Factory_Toy.png/revision/latest/scale-to-width-down/499?cb=20161005052252',
        ]);


        // $r2->droids()->attach($r2Class);
        // $r4->droids()->attach($r4Class);
        // $r5->droids()->attach($r5Class);
        // $r6->droids()->attach($r6Class);
        // $r7->droids()->attach($r7Class);
        // $r9->droids()->attach($r9Class);
        // $custom->droids()->attach($customClass);
        $bt1->droid()->attach($bt1Class);
        $r0->droid()->attach($r0Class);
    }
}
