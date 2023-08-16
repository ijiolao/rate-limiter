<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ApiRateLimitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('api_rate_limits')->insert([
            'user_identifier' => Str::random(10),
            'endpoint' => 'api/register',
            'request_at' => date('Y-m-d H:i:s', now()),
        ]);
    }
}
