<?php

namespace App\Http\Controllers;

use App\Services\BeemService;
use Illuminate\Http\Request;

/*class BeemController extends Controller
{
    //
}*/

class BeemController extends Controller
{
    protected $beem;

    public function __construct(BeemService $beem)
    {
        $this->beem = $beem;
    }

    public function checkYourBalance()
    {
        return response()->json($this->beem->checkBalance());
    }

    public function sendTestSms(Request $request)
    {

        $validated = $request->validate([
            'message'   => 'required|string',
            'dest_addr' => 'required|string'
        ]);

        $response = $this->beem->sendSms(
            $validated['message'],
            $validated['dest_addr']
        );

        return response()->json($response);
        //$message = "Hello World";
        //$recipients = ['255700000001', '255700000011'];
        //return response()->json($this->beem->sendSms($message, $recipients));
    }
}
