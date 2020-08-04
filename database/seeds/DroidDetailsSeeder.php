<?php


use Illuminate\Database\Seeder;

class DroidDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //     $droidOne = DroidDetail::create([
        //     'droid_user_id' => '4',
        //     'builder_name' => 'Rob Howdle',
        //     'description' => 'R2-R2 is a test droid. Built to test out new software applications for the Droid Building Community.',
        //     'colors' => '4f4f4f',
        //     'mobility' => 'Static',
        //     'electronics' => 'Dome lights, Sounds',
        //     'control_system' => 'RC',
        //     'drive_system' => 'Q85 Motor',
        //     'power' => 'x2 9V Lipos',
        // ]);
        $droidTwo = DroidDetail::create([
            'droid_user_id' => '1',
            'builder_name' => 'Tosin Onafowokan',
            'description' => 'R2-D2',
            'colors' => '4f4f4f',
            'mobility' => 'Moving',
            'electronics' => 'Dome lights, Sounds, Movement',
            'control_system' => 'Stealth',
            'drive_system' => 'Scooter Motors',
            'power' => 'Drill Battery 9V 18A',
        ]);
    }
}
