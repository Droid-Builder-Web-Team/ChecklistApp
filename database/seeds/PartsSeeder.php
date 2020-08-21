<?php

use App\Part;
use Illuminate\Database\Seeder;

class PartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $domePart = Part::create([
            'droids_id' => '1',
            'droid_user_id' => '2',
            'droid_version' => 'MK3',
            'droid_section' => 'Dome',
            'sub_section' => '',
            'part_name' => 'single_print_r2',
            'file_path' => '/parts/file/path',
        ]);

        $bodyPart = Part::create([
            'droids_id' => '1',
            'droid_user_id' => '2',
            'droid_version' => 'MK3',
            'droid_section' => 'Body',
            'sub_section' => 'Main Body & Skirt',
            'part_name' => 'Mainbody_1',
            'file_path' => '/parts/file/path',
        ]);
        $bodyPart = Part::create([
            'droids_id' => '1',
            'droid_user_id' => '2',
            'droid_version' => 'MK3',
            'droid_section' => 'Body',
            'sub_section' => 'Main Body & Skirt',
            'part_name' => 'Mainbody_2',
            'file_path' => '/parts/file/path',
        ]);
        $domePart = Part::create([
            'droids_id' => '1',
            'droid_user_id' => '2',
            'droid_version' => 'MK3',
            'droid_section' => 'Dome',
            'sub_section' => '',
            'part_name' => 'InnerRing',
            'file_path' => '/parts/file/path',
        ]);
        $domePart = Part::create([
            'droids_id' => '4',
            'droid_user_id' => '2',
            'droid_version' => 'MK3',
            'droid_section' => 'Dome',
            'sub_section' => 'Greebles',
            'part_name' => 'Radar_Eye',
            'file_path' => '/parts/file/path',
        ]);
        $legPart = Part::create([
            'droids_id' => '4',
            'droid_user_id' => '2',
            'droid_version' => 'MK3',
            'droid_section' => 'Legs',
            'sub_section' => '',
            'part_name' => 'Ankle',
            'file_path' => '/parts/file/path',
        ]);

        $domePart = Part::create([
            'droids_id' => '3',
            'droid_user_id' => '2',
            'droid_version' => 'MK3',
            'droid_section' => 'Dome',
            'sub_section' => 'HoloProjectors',
            'part_name' => 'Holo_Projector1',
            'file_path' => '/parts/file/path',
        ]);
        $domePart = Part::create([
            'droids_id' => '1',
            'droid_user_id' => '2',
            'droid_version' => 'MK3',
            'droid_section' => 'Dome',
            'sub_section' => 'Greebles',
            'part_name' => 'LargeLogicLight.stl',
            'file_path' => '/parts/file/path',
        ]);

    }
}
