<?php

namespace Database\Seeders;

use App\Models\Workflow;
use Illuminate\Database\Seeder;

class WorkFlowSeeder extends Seeder
{
    public function run(): void
    {
        $workflows = [
            [
                'document_type' => 'leave_application',
                'name' => 'Leave Application Workflow',
                'description' => 'Workflow for processing leave applications.',
            ],
            [
                'document_type' => 'expense_claim',
                'name' => 'Expense Claim Workflow',
                'description' => 'Workflow for handling expense claims.',
            ],
            [
                'document_type' => 'purchase_order',
                'name' => 'Purchase Order Workflow',
                'description' => 'Workflow for managing purchase orders.',
            ],
        ];

        foreach ($workflows as $workflow) {
            Workflow::updateOrCreate(
                ['document_type' => $workflow['document_type']],
                $workflow
            );
        }
    }
}
