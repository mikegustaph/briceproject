<?php

namespace App\Console\Commands;

use App\Models\Loan;
use Illuminate\Console\Command;

class UpdateLoanStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'loan:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update loan statuses to overdue automatically';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $loans = Loan::where('status', '!=', 'overdue')->get();

        foreach ($loans as $loan) {
            $dueDate = $loan->created_at->addDays($loan->days);

            if (now()->greaterThan($dueDate)) {
                $loan->status = 'overdue';
                $loan->save();
            }
        }

        $this->info('Loan statuses updated successfully.');
    }
}
