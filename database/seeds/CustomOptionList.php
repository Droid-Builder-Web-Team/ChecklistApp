<?php

use Illuminate\Database\Seeder;
use App\CustomOption;

class CustomOptionList extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $BT1 = CustomOption::create([
            'class' => 'BT1',
            'version'=> 'MK3',
            'section' => 'Dome',
            'image' => '/img/BT1Dome.png',
        ]);
        $R0 = CustomOption::create([
            'class' => 'R0',
            'version'=> 'MK3',
            'section' => 'Dome',
            'image' => '/img/R0Dome.png',
        ]);
        $R2MK2D = CustomOption::create([
            'class' => 'R2',
            'version'=> 'MK2',
            'section' => 'Dome',
            'image' => '/img/R2DomeSplit.png',
        ]);
        $R2MK2B = CustomOption::create([
            'class' => 'R2',
            'version'=> 'MK2',
            'section' => 'Body',
            'image' => '/img/R2Body.png',
        ]);
        $R2MK2L = CustomOption::create([
            'class' => 'R2',
            'version'=> 'MK2',
            'section' => 'Legs',
            'image' => '/img/legsmk2.png',
        ]);
        $R2MK2F = CustomOption::create([
            'class' => 'R2',
            'version'=> 'MK2',
            'section' => 'Feet',
            'image' => '/img/FootMK2.png',
        ]);
        $R2MK3D = CustomOption::create([
            'class' => 'R2',
            'version'=> 'MK3',
            'section' => 'Dome',
            'image' => '/img/R2DomeSingle.png',
        ]);
        $R2MK3B = CustomOption::create([
            'class' => 'R2',
            'version'=> 'MK3',
            'section' => 'Body',
            'image' => '/img/R2Body.png',
        ]);
        $R2MK3L = CustomOption::create([
            'class' => 'R2',
            'version'=> 'MK3',
            'section' => 'Legs',
            'image' => '/img/legsmk3.png',
        ]);
        $R2MK3F = CustomOption::create([
            'class' => 'R2',
            'version'=> 'MK3',
            'section' => 'Feet',
            'image' => '/img/FootMK3.png',
        ]);
        $R4MK2 = CustomOption::create([
            'class' => 'R4',
            'version'=> 'MK2',
            'section' => 'Dome',
            'image' => '/img/R4Dome.png',
        ]);
        $R4MK3 = CustomOption::create([
            'class' => 'R4',
            'version'=> 'MK3',
            'section' => 'Dome',
            'image' => '/img/R4Dome.png',
        ]);
        $R5MK2 = CustomOption::create([
            'class' => 'R5MK2',
            'version'=> 'MK2',
            'section' => 'Dome',
            'image' => '/img/R5Dome.png',
        ]);
        $R5MK3 = CustomOption::create([
            'class' => 'R5',
            'version'=> 'MK3',
            'section' => 'Dome',
            'image' => '/img/R5Dome.png',
        ]);
        $R6MK2 = CustomOption::create([
            'class' => 'R6',
            'version'=> 'MK2',
            'section' => 'Dome',
            'image' => '/img/R6Dome.png',
        ]);
        $R6MK3 = CustomOption::create([
            'class' => 'R6',
            'version'=> 'MK3',
            'section' => 'Dome',
            'image' => '/img/R6Dome.png',
        ]);
        $R7MK2D = CustomOption::create([
            'class' => 'R7',
            'version'=> 'MK2',
            'section' => 'Dome',
            'image' => '/img/R7Dome.png',
        ]);
        $R7MK3D = CustomOption::create([
            'class' => 'R7',
            'version'=> 'MK3',
            'section' => 'Dome',
            'image' => '/img/R7Dome.png',
        ]);
        $R7MK2B = CustomOption::create([
            'class' => 'R7',
            'version'=> 'MK2',
            'section' => 'Body',
            'image' => '/img/R7Body.png',
        ]);
        $R7MK3B = CustomOption::create([
            'class' => 'R7',
            'version'=> 'MK3',
            'section' => 'Body',
            'image' => '/img/R7Body.png',
        ]);
        $R9MK2 = CustomOption::create([
            'class' => 'R9',
            'version'=> 'MK2',
            'section' => 'Dome',
            'image' => '/img/R9Dome.png',
        ]);
        $R9MK3 = CustomOption::create([
            'class' => 'R9',
            'version'=> 'MK3',
            'section' => 'Dome',
            'image' => '/img/R9Dome.png',
        ]);
    }
}
