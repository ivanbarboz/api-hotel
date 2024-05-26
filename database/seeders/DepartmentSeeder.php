<?php

namespace Database\Seeders;

use App\Enums\DepartmentEnum;
use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(DepartmentEnum::cases() as $department)
        {
            Department::create(['name'=> $department]);
        }
    }
}
