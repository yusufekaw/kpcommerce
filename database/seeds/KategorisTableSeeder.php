<?php
class KategoriTableSeeder extends Seeder {

    public function run()
    {
        // Truncate the table.
        DB::table('kategoris')->truncate();
    }
}