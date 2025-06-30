<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PresenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('presences')->insert([
            [
                'employee_id' => 3,
                'check_in' => '2025-04-05 08:00:00',
                'check_out' => '2025-04-05 17:00:00',
                'date' => '2025-04-05',
                'status' => 'present',
            ],
            [
                'employee_id' => 7,
                'check_in' => '2025-04-05 08:00:00',
                'check_out' => '2025-04-05 17:00:00',
                'date' => '2025-04-05',
                'status' => 'present',
            ],
            [
                'employee_id' => 11,
                'check_in' => '2025-04-05 08:00:00',
                'check_out' => '2025-04-05 17:00:00',
                'date' => '2025-04-05',
                'status' => 'present',
            ],
            [
                'employee_id' => 12,
                'check_in' => '2025-04-05 08:00:00',
                'check_out' => '2025-04-05 17:00:00',
                'date' => '2025-04-05',
                'status' => 'present',
            ],
            [
                'employee_id' => 13,
                'check_in' => '2025-04-05 08:00:00',
                'check_out' => '2025-04-05 17:00:00',
                'date' => '2025-04-05',
                'status' => 'present',
            ],
            [
                'employee_id' => 14,
                'check_in' => '2025-04-05 08:00:00',
                'check_out' => '2025-04-05 17:00:00',
                'date' => '2025-04-05',
                'status' => 'present',
            ],
            [
                'employee_id' => 3,
                'check_in' => '2025-05-15 08:00:00',
                'check_out' => '2025-05-15 17:00:00',
                'date' => '2025-05-15',
                'status' => 'present',
            ],
            [
                'employee_id' => 11,
                'check_in' => '2025-05-15 08:00:00',
                'check_out' => '2025-05-15 17:00:00',
                'date' => '2025-05-15',
                'status' => 'present',
            ],
            [
                'employee_id' => 12,
                'check_in' => '2025-05-15 08:00:00',
                'check_out' => '2025-05-15 17:00:00',
                'date' => '2025-05-15',
                'status' => 'present',
            ],
            [
                'employee_id' => 14,
                'check_in' => '2025-05-15 08:00:00',
                'check_out' => '2025-05-15 17:00:00',
                'date' => '2025-05-15',
                'status' => 'present',
            ],
            [
                'employee_id' => 3,
                'check_in' => '2025-05-17 08:00:00',
                'check_out' => '2025-05-17 17:00:00',
                'date' => '2025-05-17',
                'status' => 'present',
            ],
            [
                'employee_id' => 11,
                'check_in' => '2025-05-17 08:00:00',
                'check_out' => '2025-05-17 17:00:00',
                'date' => '2025-05-17',
                'status' => 'present',
            ],
            [
                'employee_id' => 13,
                'check_in' => '2025-05-17 08:00:00',
                'check_out' => '2025-05-17 17:00:00',
                'date' => '2025-05-17',
                'status' => 'present',
            ],
            [
                'employee_id' => 7,
                'check_in' => '2025-05-17 08:00:00',
                'check_out' => '2025-05-17 17:00:00',
                'date' => '2025-05-17',
                'status' => 'present',
            ],
            [
                'employee_id' => 7,
                'check_in' => '2025-06-27 08:00:00',
                'check_out' => '2025-06-27 17:00:00',
                'date' => '2025-06-27',
                'status' => 'present',
            ],
            [
                'employee_id' => 13,
                'check_in' => '2025-06-27 08:00:00',
                'check_out' => '2025-06-27 17:00:00',
                'date' => '2025-06-27',
                'status' => 'present',
            ],
            [
                'employee_id' => 14,
                'check_in' => '2025-06-27 08:00:00',
                'check_out' => '2025-06-27 17:00:00',
                'date' => '2025-06-27',
                'status' => 'present',
            ],
            [
                'employee_id' => 3,
                'check_in' => '2025-06-28 08:00:00',
                'check_out' => '2025-06-28 17:00:00',
                'date' => '2025-06-28',
                'status' => 'present',
            ],
            [
                'employee_id' => 13,
                'check_in' => '2025-06-28 08:00:00',
                'check_out' => '2025-06-28 17:00:00',
                'date' => '2025-06-28',
                'status' => 'present',
            ],
            [
                'employee_id' => 14,
                'check_in' => '2025-06-28 08:00:00',
                'check_out' => '2025-06-28 17:00:00',
                'date' => '2025-06-28',
                'status' => 'present',
            ],
            [
                'employee_id' => 3,
                'check_in' => '2025-07-18 08:00:00',
                'check_out' => '2025-07-18 17:00:00',
                'date' => '2025-07-18',
                'status' => 'present',
            ],
            [
                'employee_id' => 7,
                'check_in' => '2025-07-18 08:00:00',
                'check_out' => '2025-07-18 17:00:00',
                'date' => '2025-07-18',
                'status' => 'present',
            ],
            [
                'employee_id' => 11,
                'check_in' => '2025-07-18 08:00:00',
                'check_out' => '2025-07-18 17:00:00',
                'date' => '2025-07-18',
                'status' => 'present',
            ],
            [
                'employee_id' => 12,
                'check_in' => '2025-07-18 08:00:00',
                'check_out' => '2025-07-18 17:00:00',
                'date' => '2025-07-18',
                'status' => 'present',
            ],
            [
                'employee_id' => 14,
                'check_in' => '2025-07-18 08:00:00',
                'check_out' => '2025-07-18 17:00:00',
                'date' => '2025-07-18',
                'status' => 'present',
            ],
            [
                'employee_id' => 3,
                'check_in' => '2025-07-19 08:00:00',
                'check_out' => '2025-07-19 17:00:00',
                'date' => '2025-07-19',
                'status' => 'present',
            ],
            [
                'employee_id' => 13,
                'check_in' => '2025-07-19 08:00:00',
                'check_out' => '2025-07-19 17:00:00',
                'date' => '2025-07-19',
                'status' => 'present',
            ],
            [
                'employee_id' => 14,
                'check_in' => '2025-07-19 08:00:00',
                'check_out' => '2025-07-19 17:00:00',
                'date' => '2025-07-19',
                'status' => 'present',
            ],
            [
                'employee_id' => 3,
                'check_in' => '2025-07-20 08:00:00',
                'check_out' => '2025-07-20 17:00:00',
                'date' => '2025-07-20',
                'status' => 'present',
            ],
            [
                'employee_id' => 7,
                'check_in' => '2025-07-20 08:00:00',
                'check_out' => '2025-07-20 17:00:00',
                'date' => '2025-07-20',
                'status' => 'present',
            ],
            [
                'employee_id' => 11,
                'check_in' => '2025-07-20 08:00:00',
                'check_out' => '2025-07-20 17:00:00',
                'date' => '2025-07-20',
                'status' => 'present',
            ],
            [
                'employee_id' => 13,
                'check_in' => '2025-07-20 08:00:00',
                'check_out' => '2025-07-20 17:00:00',
                'date' => '2025-07-20',
                'status' => 'present',
            ],
            [
                'employee_id' => 14,
                'check_in' => '2025-07-20 08:00:00',
                'check_out' => '2025-07-20 17:00:00',
                'date' => '2025-07-20',
                'status' => 'present',
            ],
            [
                'employee_id' => 3,
                'check_in' => '2025-07-21 08:00:00',
                'check_out' => '2025-07-21 17:00:00',
                'date' => '2025-07-21',
                'status' => 'present',
            ],
            [
                'employee_id' => 12,
                'check_in' => '2025-07-21 08:00:00',
                'check_out' => '2025-07-21 17:00:00',
                'date' => '2025-07-21',
                'status' => 'present',
            ],
            [
                'employee_id' => 13,
                'check_in' => '2025-07-21 08:00:00',
                'check_out' => '2025-07-21 17:00:00',
                'date' => '2025-07-21',
                'status' => 'present',
            ],
            [
                'employee_id' => 14,
                'check_in' => '2025-07-21 08:00:00',
                'check_out' => '2025-07-21 17:00:00',
                'date' => '2025-07-21',
                'status' => 'present',
            ],
        ]);
    }
}
