<?php

use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert(['title' => 'Full Time', 'status_id' => Status::where('name', 'active')->first()->id, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('types')->insert(['title' => 'Part Time', 'status_id' => Status::where('name', 'active')->first()->id, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('types')->insert(['title' => 'Freelance', 'status_id' => Status::where('name', 'active')->first()->id, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('types')->insert(['title' => 'Internship', 'status_id' => Status::where('name', 'active')->first()->id, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('types')->insert(['title' => 'Temporary', 'status_id' => Status::where('name', 'active')->first()->id, 'created_at' => now(), 'updated_at' => now()]);
    }
}
