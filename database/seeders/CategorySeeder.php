<?php

use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(['title' => 'Web Development', 'status_id' => Status::where('name', 'active')->first()->id, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('categories')->insert(['title' => 'Graphics Designer', 'status_id' => Status::where('name', 'active')->first()->id, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('categories')->insert(['title' => 'Multimedia', 'status_id' => Status::where('name', 'active')->first()->id, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('categories')->insert(['title' => 'Advertising', 'status_id' => Status::where('name', 'active')->first()->id, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('categories')->insert(['title' => 'Education & Training', 'status_id' => Status::where('name', 'active')->first()->id, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('categories')->insert(['title' => 'English', 'status_id' => Status::where('name', 'active')->first()->id, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('categories')->insert(['title' => 'Social Media', 'status_id' => Status::where('name', 'active')->first()->id, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('categories')->insert(['title' => 'Writing', 'status_id' => Status::where('name', 'active')->first()->id, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('categories')->insert(['title' => 'PHP Programming', 'status_id' => Status::where('name', 'active')->first()->id, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('categories')->insert(['title' => 'Project Management', 'status_id' => Status::where('name', 'active')->first()->id, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('categories')->insert(['title' => 'Finance Management', 'status_id' => Status::where('name', 'active')->first()->id, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('categories')->insert(['title' => 'Office & Admin', 'status_id' => Status::where('name', 'active')->first()->id, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('categories')->insert(['title' => 'Web Designer', 'status_id' => Status::where('name', 'active')->first()->id, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('categories')->insert(['title' => 'Customer Service', 'status_id' => Status::where('name', 'active')->first()->id, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('categories')->insert(['title' => 'Marketing & Sales', 'status_id' => Status::where('name', 'active')->first()->id, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('categories')->insert(['title' => 'Software Development', 'status_id' => Status::where('name', 'active')->first()->id, 'created_at' => now(), 'updated_at' => now()]);

    }
}
