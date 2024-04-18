## About MSG4wrd
MSG4wrd is an SMS Gateway and Message Forwarder API formerly known as PTXT4wrd. 

From 2005 to 2012, in the Philippines, some networks only allowed text messaging within the same network. Promos were available for unlimited texting to the same network, such as SMART to SMART or GLOBE to GLOBE only. 

To address this issue, PTXT4wrd was invented, which allows users to send messages to other networks by forwarding their texts from their own network.

Example command for sending a message to other networks:

> PTXT{space}OtherNetworkNumber{space}YourMessage then send to Gateway.

> PTXT 09171234567 Hello world! Then, send to gateway number.

Gateways - SMART / GLOBE / SUN
If you are smart, you will use SMART Gateway, identical to the other networks.

## Installtion

> composer require kpaph/msg4wrdio

After updating composer, add the ServiceProvider to the providers array in `config/app.php`

> KPAPH\MSG4wrdIO\MSG4wrdIOServiceProvider::class,

Then, it would be best if you published the vendor to generate a config file `config/msg4wrdio.php`

> php artisan vendor:publish

Almost there, you need to add your token to `.env`, to get token [MSG4wrd.io](https://doorway.msg4wrd.io/)

> MSG4wrdIO_TOKEN=YOUR-TOKEN-HERE

To see if the MSG4wrd.io was installed successfully, open your browser, then access this:

> http://your-hostname/msg4wrd or http://localhost:8000/msg4wrd

To check if the MSG4wrd.io will send an SMS message, do this

> http://localhost:8000/msg4wrd/send?number=your-ph-mobile-here 

Note: The mobile number should include the country code. I.e., 63 or 1

## Usage

Create controller, let say `SMSController`

```php
<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use KPAPH\MSG4wrdIO\Enums\SenderName;
use KPAPH\MSG4wrdIO\Enums\Country;
use KPAPH\MSG4wrdIO\Services\MSG4wrd;

class SMSController extends Controller
{
    // $option = [
    //     "sendername" => "Default|MSG4wrd|YourBrandID", 
    //     "priority" => 0|1, 
    //     "local" => 0|1
    // ]

    // sendername => Default = Typical Number or Simbased or What is available
    // sendername => MSG4wrd = This will charge you more from your credits
    // sendername => YourBrandID = You can have your own brand id, i.e.: GOOGLESMS, YAHOOMSG

    // priority => 0 = Normal
    // priority => 1 = High - This will charge you more

    // local => 0 = Philippines Only
    // local => 1 = US, Canada, and Philippines Only - This will charge you more

    public function SMSSendNormal() {

        $res = MSG4wrd::Send("US-PH-Number-Here", "Your-Message-Here");

        return $res;
    }

    public function SMSSendWithOptions() {
        
        $options = [
            "sendername" => SenderName::Default, // SenderName::MSG4wrd
            "priority" => 0, 
            "country" => Country::PH // Country::US
        ];

        $res = MSG4wrd::Send("US-PH-Number-Here", "Your-Message-Here", $options);

        return $res;
    }
}
```