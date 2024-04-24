<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\PhoneVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpKernel\Attribute\Cache as AttributeCache;
use Vonage\Insights\Basic;
use Vonage\SMS\Client;

class AppAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function verifyphone2(Request $request)
    {
        $phone = $request->input('phone');

        if (empty($country_code)) {
            return response()->json(['code' => -1, 'data' => '', 'msg' => 'country_code not empty']);
        }
        if (empty($phone)) {
            return response()->json(['code' => -1, 'data' => '', 'msg' => 'phone not empty']);
        }
        $sid      = '';
        $token    = '';
        $customer = new PhoneVerification();
        $otp      = rand(1111, 9999);
        $to_number = "0" . $phone;
        Cache::put("to_number_" . $country_code . $phone . $otp);
        $body = "SMS  Verification Code: " . $otp;
        $message = $customer->messages->create(
            $to_number,
            [
                'messagingServiceSid' => "",
                'body' => $body,
                'phone' => $to_number
            ]
        );

        return response()->json(['code' => 0, 'data' => $message->sid, 'msg' => ''], 200);
    }
    public function verifyphone(Request $request)
    {
        $phone = $request->validate([
            'phoneNumber' => 'required|numeric',
        ]);
        $otp      = rand(1111, 9999);
        return response()->json(['otp' => $otp, 'phone' => $phone], 200);
    }
    public function customerregister(Request $request)
    {
        $customer = $request->validate([
            "first_name"    => ["required", "string"],
            "middle_name"   => ["required", "string"],
            "last_name"     => ["required", "string"],
            "date_of_birth" => ["required", "string"],
            "gender"        => ["required", "string"],
            "nida"          => ["required", "string"],
            "email"         => ["required", "string", "unique"],
            "Education"     => ["required", "string"],
            "MaritalStatus" => ["nullable"],
            "Address"       => ["required", "string"],
            "district"      => ["required", "string"],
            "Region"        => ["required", "string"],
            "Exist_loan"    => ["required", "string"],
            "Occupation"    => ["required", "string"],
            "Work_status"   => ["required", "string"],
            "Company_name"  => ["required", "string"],
            "Work_years"    => ["required", "string"],
            "Frequency of salary payment"    => ["required", "string"],
            "Monthly income"    => ["required", "string"],
            "customer_image"    => ["required"],
            "customer_id_card"  => ['required', 'string']
        ]);
        $newCust = new Customer();


        if (!empty($customer)) {
            return response()->json($customer, 200);
        }
    }
    public function customerregisterstep2(Request $request)
    {
    }
    public function customerregisterstep3(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
