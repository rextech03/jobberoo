<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert(['name' => 'success', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('statuses')->insert(['name' => 'pending', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('statuses')->insert(['name' => 'failed', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('statuses')->insert(['name' => 'blocked', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('statuses')->insert(['name' => 'active', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('statuses')->insert(['name' => 'inactive', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('statuses')->insert(['name' => 'accepted', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('statuses')->insert(['name' => 'rejected', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('statuses')->insert(['name' => 'open', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('statuses')->insert(['name' => 'closed', 'created_at' => now(), 'updated_at' => now()]);
    }
}
