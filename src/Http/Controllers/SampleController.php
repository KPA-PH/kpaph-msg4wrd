<?php


namespace KPAPH\MSG4wrdIO\Http\Controllers;

use Illuminate\Http\Request;
use KPAPH\MSG4wrdIO\Enums\Country;
use App\Http\Controllers\Controller;
use KPAPH\MSG4wrdIO\Enums\SenderName;
use KPAPH\MSG4wrdIO\Services\MSG4wrd;

class SampleController extends Controller
{
    public function ShowStatus(Request $request)
    {
        return view('msg4wrd-io::status');
    }

    public function DemoNormal(Request $request) {

        $res = MSG4wrd::Send($request->number, "Hello this is a test message.");

        return $res;
    }

    public function DemoWithOptions(Request $request)
    {

        // for country
        // Country::PH
        // Country::US

        // for sendername
        // SenderName::Default - It will use a standard Philippines mobile number or a SIM Card based SMS.
        // SenderName::MSG4wrd - It will use a sender name instead of a standard mobile number.

        // $options = [
        //     "priority" => 0,
        //     "country" => Country::PH,
        //     "sendername" => SenderName::Default
        // ];

        $options = [
            "priority" => 0,
            "country" => Country::PH,
            "sendername" => SenderName::MSG4wrd
        ];

        $res = MSG4wrd::Send($request->number, "Hello this is a test message.", $options);

        return $res;
    }
}
