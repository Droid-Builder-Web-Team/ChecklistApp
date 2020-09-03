<?php

use Illuminate\Database\Seeder;
use JeroenZwart\CsvSeeder\CsvSeeder;

class DroidsTableSeeder extends CsvSeeder
{
  public function __construct()
  {
      $this->file = '/database/seeds/csvs/droids.csv';
      $this->delimiter = ',';
      $this->truncate = false;
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
