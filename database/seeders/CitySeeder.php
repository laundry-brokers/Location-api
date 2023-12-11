<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends CsvSeeder
{
    /**
     * Run the database seeds.
     */

     public function __construct()
    {
        $this->table         = 'cities';
        $this->filename      = base_path().'/database/seeders/csvs/CitySeeds.csv';
        $this->csv_delimiter = ',';
        $this->offset_rows   = 1;
        $this->mapping       = [
            0 => 'id',
            1 => 'name_city',
            2 => 'id_state',
        ];
        $this->should_trim = true;
    }

    public function run()
    {
        DB::disableQueryLog();
        DB::table($this->table)->truncate();
        //$this->insert_chunk_size = 700;
        parent::run();
    }
    
}