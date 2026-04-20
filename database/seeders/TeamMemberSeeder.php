<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        TeamMember::updateOrCreate(
            ['name' => 'Ruba Kwaik'],
            [
                'job_title' => 'Project Manager',
                'image_path' => 'storage/images/team_member/1.jpg',
            ]
        );
        TeamMember::updateOrCreate(
            ['name' => 'Doaa Kwaik'],
            [
                'job_title' => 'Frontend Developer',
                'image_path' => 'storage/images/team_member/2.jpg',
            ]
        );

        TeamMember::updateOrCreate(
            ['name' => 'Sara Alsalout'],
            [
                'job_title' => 'Backend Developer',
                'image_path' => 'storage/images/team_member/3.png',
            ]
        );

        TeamMember::updateOrCreate(
            ['name' => 'Ahmed Ali'],
            [
                'job_title' => 'UI/UX Designer',
                'image_path' => 'storage/images/team_member/4.jpg',
            ]
        );


    }
}

