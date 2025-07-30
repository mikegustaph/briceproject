<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CreditScoreRange;
use App\Models\LoanOffer;

class CreditScoreRangeSeeder extends Seeder
{
    public function run()
    {
        // Score range 0.0 – 0.99 with 7-day offers
        $range1 = CreditScoreRange::create([
            'min_score' => 0.0,
            'max_score' => 0.99,
        ]);

        foreach ([20000, 30000, 40000] as $amount) {
            LoanOffer::create([
                'credit_score_range_id' => $range1->id,
                'loan_amount' => $amount,
                'loan_term_days' => 7,
            ]);
        }

        // Score range 1.0 – 1.99 with 14 & 28 day offers
        $range2 = CreditScoreRange::create([
            'min_score' => 1.0,
            'max_score' => 1.99,
        ]);

        foreach ([60000, 80000, 100000] as $amount) {
            foreach ([14, 28] as $term) {
                LoanOffer::create([
                    'credit_score_range_id' => $range2->id,
                    'loan_amount' => $amount,
                    'loan_term_days' => $term,
                ]);
            }
        }

        // Score range 2.0 – 2.99 with 14 & 28 day offers
        $range3 = CreditScoreRange::create([
            'min_score' => 2.0,
            'max_score' => 2.99,
        ]);

        foreach ([60000, 80000, 100000] as $amount) {
            foreach ([14, 28] as $term) {
                LoanOffer::create([
                    'credit_score_range_id' => $range3->id,
                    'loan_amount' => $amount,
                    'loan_term_days' => $term,
                ]);
            }
        }
    }
}
