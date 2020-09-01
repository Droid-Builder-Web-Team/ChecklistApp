<?php

use App\Part;
use Illuminate\Database\Seeder;
use JeroenZwart\CsvSeeder\CsvSeeder;


class PartsSeeder extends CsvSeeder
{

    public function __construct()
    {
        $this->file = '/database/seeds/csvs/parts.csv';
        $this->delimiter = ',';
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        parent::run();
    }

}
