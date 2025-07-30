<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Disclosure;
use App\Models\Faq;
use App\Models\PrivacyPolicy;
use App\Models\Support;
use App\Models\WhyChooseUs;
use Illuminate\Http\Request;

class AppManageApiController extends Controller
{
    public function privacyPolicy()
    {
        try {
            $privacy = PrivacyPolicy::first();
            return response()->json([
                'status' => 200,
                'data' => $privacy
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function Disclosure()
    {
        try {
            $disclosure = Disclosure::first();
            return response()->json([
                'status' => 200,
                'data' => $disclosure
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function whyChooseus()
    {
        try {
            $whychoose = WhyChooseUs::first();
            return response()->json([
                'status' => 200,
                'data' => $whychoose
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function Faq()
    {
        try {
            $faq = Faq::first();
            return response()->json([
                'status' => 200,
                'data' => $faq
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function AboutUs()
    {
        try {
            $about = AboutUs::first();
            return response()->json([
                'status' => 200,
                'data' => $about
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function Support()
    {
        try {
            $support = Support::all();
            return response()->json([
                'status' => 200,
                'data' => $support
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
