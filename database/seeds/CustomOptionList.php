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
            'frontImage' => '/img/DroidParts/BT-1/Front_Dome.png',
            'sideImageFore' => '/img/DroidParts/BT-1/Side_Dome.png',
            'sideImageBack' => NULL,
        ]);
        $R0 = CustomOption::create([
            'class' => 'R0',
            'version'=> 'MK3',
            'section' => 'Dome',
            'frontImage' => '/img/DroidParts/R0/Front_Dome.png',
            'sideImageFore' => '/img/DroidParts/R0/Side_Dome.png',
            'sideImageBack' => NULL,
        ]);
        $R2MK2D = CustomOption::create([
            'class' => 'R2',
            'version'=> 'MK2',
            'section' => 'Dome',
            'frontImage' => '/img/DroidParts/R2/Front_Dome.png',
            'sideImageFore' => '/img/DroidParts/R2/Side_Dome.png',
            'sideImageBack' => NULL,
        ]);
        $R2MK2B = CustomOption::create([
            'class' => 'R2',
            'version'=> 'MK2',
            'section' => 'Body',
            'frontImage' => '/img/DroidParts/R2/Front_Body.png',
            'sideImageFore' => '/img/DroidParts/R2/Side_Body.png',
            'sideImageBack' => NULL,
        ]);
        $R2MK2L = CustomOption::create([
            'class' => 'R2',
            'version'=> 'MK2',
            'section' => 'Legs',
            'frontImage' => '/img/DroidParts/R2/Front_Legs.png',
            'sideImageFore' => '/img/DroidParts/R2/Side_Legs.png',
            'sideImageBack' => '/img/DroidParts/R2/Side_Legs_Back.png',
        ]);
        $R2MK2F = CustomOption::create([
            'class' => 'R2',
            'version'=> 'MK2',
            'section' => 'Feet',
            'frontImage' => '/img/DroidParts/R2/Front_Feet.png',
            'sideImageFore' => '/img/DroidParts/R2/Side_Feet.png',
            'sideImageBack' => '/img/DroidParts/R2/Side_Feet_Back.png',
        ]);
        $R2MK3D = CustomOption::create([
            'class' => 'R2',
            'version'=> 'MK3',
            'section' => 'Dome',
            'frontImage' => '/img/DroidParts/R2/Front_Dome.png',
            'sideImageFore' => '/img/DroidParts/R2/Side_Dome.png',
            'sideImageBack' => NULL,
        ]);
        $R2MK3B = CustomOption::create([
            'class' => 'R2',
            'version'=> 'MK3',
            'section' => 'Body',
            'frontImage' => '/img/DroidParts/R2/Front_Body.png',
            'sideImageFore' => '/img/DroidParts/R2/Side_Body.png',
            'sideImageBack' => NULL,
        ]);
        $R2MK3L = CustomOption::create([
            'class' => 'R2',
            'version'=> 'MK3',
            'section' => 'Legs',
            'frontImage' => '/img/DroidParts/R2/Front_Legs.png',
            'sideImageFore' => '/img/DroidParts/R2/Side_Legs.png',
            'sideImageBack' => '/img/DroidParts/R2/Side_Legs_Back.png',
        ]);
        $R2MK3F = CustomOption::create([
            'class' => 'R2',
            'version'=> 'MK3',
            'section' => 'Feet',
            'frontImage' => '/img/DroidParts/R2/Front_Feet.png',
            'sideImageFore' => '/img/DroidParts/R2/Side_Feet.png',
            'sideImageBack' => '/img/DroidParts/R2/Side_Feet_Back.png',
        ]);
        $R4MK2 = CustomOption::create([
            'class' => 'R4',
            'version'=> 'MK2',
            'section' => 'Dome',
            'frontImage' => '/img/R4Dome.png',
            'sideImageFore' => NULL,
            'sideImageBack' => NULL,
        ]);
        $R4MK3 = CustomOption::create([
            'class' => 'R4',
            'version'=> 'MK3',
            'section' => 'Dome',
            'frontImage' => '/img/R4Dome.png',
            'sideImageFore' => NULL,
            'sideImageBack' => NULL,
        ]);
        $R5MK2 = CustomOption::create([
            'class' => 'R5MK2',
            'version'=> 'MK2',
            'section' => 'Dome',
            'frontImage' => '/img/DroidParts/R5/Front_Dome.png',
            'sideImageFore' => '/img/DroidParts/R5/Side_Dome.png',
            'sideImageBack' => NULL,
        ]);
        $R5MK3 = CustomOption::create([
            'class' => 'R5',
            'version'=> 'MK3',
            'section' => 'Dome',
            'frontImage' => '/img/DroidParts/R5/Front_Dome.png',
            'sideImageFore' => '/img/DroidParts/R5/Side_Dome.png',
            'sideImageBack' => NULL,
        ]);
        $R6MK2 = CustomOption::create([
            'class' => 'R6',
            'version'=> 'MK2',
            'section' => 'Dome',
            'frontImage' => '/img/DroidParts/R6/Front_Dome.png',
            'sideImageFore' => '/img/DroidParts/R6/Side_Dome.png',
            'sideImageBack' => NULL,
        ]);
        $R6MK3 = CustomOption::create([
            'class' => 'R6',
            'version'=> 'MK3',
            'section' => 'Dome',
            'frontImage' => '/img/DroidParts/R6/Front_Dome.png',
            'sideImageFore' => '/img/DroidParts/R6/Side_Dome.png',
            'sideImageBack' => NULL,
        ]);
        $R7MK2D = CustomOption::create([
            'class' => 'R7',
            'version'=> 'MK2',
            'section' => 'Dome',
            'frontImage' => '/img/DroidParts/R7/Front_Dome.png',
            'sideImageFore' => '/img/DroidParts/R7/Side_Dome.png',
            'sideImageBack' => NULL,
        ]);
        $R7MK3D = CustomOption::create([
            'class' => 'R7',
            'version'=> 'MK3',
            'section' => 'Dome',
            'frontImage' => '/img/DroidParts/R7/Front_Dome.png',
            'sideImageFore' => '/img/DroidParts/R7/Side_Dome.png',
            'sideImageBack' => NULL,
        ]);
        $R7MK2B = CustomOption::create([
            'class' => 'R7',
            'version'=> 'MK2',
            'section' => 'Body',
            'frontImage' => '/img/DroidParts/R7/Front_Body.png',
            'sideImageFore' => '/img/DroidParts/R7/Side_Body.png',
            'sideImageBack' => NULL,
        ]);
        $R7MK3B = CustomOption::create([
            'class' => 'R7',
            'version'=> 'MK3',
            'section' => 'Body',
            'frontImage' => '/img/DroidParts/R7/Front_Body.png',
            'sideImageFore' => '/img/DroidParts/R7/Side_Body.png',
            'sideImageBack' => NULL,
        ]);
        $R9MK2 = CustomOption::create([
            'class' => 'R9',
            'version'=> 'MK2',
            'section' => 'Dome',
            'frontImage' => '/img/DroidParts/R9/Front_Dome.png',
            'sideImageFore' => '/img/DroidParts/R9/Side_Dome.png',
            'sideImageBack' => NULL,
        ]);
        $R9MK3 = CustomOption::create([
            'class' => 'R9',
            'version'=> 'MK3',
            'section' => 'Dome',
            'frontImage' => '/img/DroidParts/R9/Front_Dome.png',
            'sideImageFore' => '/img/DroidParts/R9/Side_Dome.png',
            'sideImageBack' => NULL,
        ]);
    }
}
