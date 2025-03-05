<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProposalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schemes = ['K', 'KI', 'KC', 'PM', 'PI', 'RE', 'RSH', 'VGK', 'GFT', 'AI'];
        $data = [];
        $membersData = [];

        for ($i = 1; $i <= 10000; $i++) {
            $leaderId = rand(1, 7);
            $facultyId = DB::table('users')->where('id', $leaderId)->value('faculty_id');
            $proposalId = $i;

            $data[] = [
                'leader_id' => $leaderId,
                'title' => 'Proposal ' . $i,
                'team_name' => 'Team ke-' . $i,
                'file' => 'proposal-' . $i . '.pdf',
                'year' => '2025',
                'status' => 'reviewed',
                'faculty_id' => $facultyId,
                'scheme' => $schemes[array_rand($schemes)],
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Assign leader as a member
            $membersData[] = [
                'proposal_id' => $proposalId,
                'user_id' => $leaderId,
                'role_in_team' => 'leader',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Assign advisor
            $membersData[] = [
                'proposal_id' => $proposalId,
                'user_id' => 8,
                'role_in_team' => 'advisor',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Assign 4 members (excluding the leader)
            $availableMembers = array_diff(range(1, 7), [$leaderId]);
            shuffle($availableMembers);
            $selectedMembers = array_slice($availableMembers, 0, 4);

            foreach ($selectedMembers as $memberId) {
                $membersData[] = [
                    'proposal_id' => $proposalId,
                    'user_id' => $memberId,
                    'role_in_team' => 'member',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Batch insert every 1000 records
            if ($i % 1000 == 0) {
                DB::table('proposals')->insert($data);
                DB::table('proposal_members')->insert($membersData);
                $data = [];
                $membersData = [];
            }
        }

        // Insert remaining data
        if (!empty($data)) {
            DB::table('proposals')->insert($data);
            DB::table('proposal_members')->insert($membersData);
        }
    }
}
