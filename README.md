## About MSG4wrd-io
MSG4wrd is an SMS Gateway and SMS Message Forwarder API, formerly PTXT4wrd.

Back from 2005 to 2012, in the Philippines, we don't have text to all networks. Our promos available back then is unlimited text to the same networks. (SMART to SMART or GLOBE to GLOBE Only)

PTXT4wrd was invented to solve the text to all networks. You can text to the same network and forward your message to other networks.

Example command for sending a message to other networks:

> PTXT{space}OtherNetworkNumber{space}YourMessage then send to Gateway.

Gateways - SMART / GLOBE / SUN
If you are smart, you will use SMART Gateway, identical to the other networks.

> PTXT 09171234567 Hello world! Then, send to gateway number.

## Installtion

> composer require kpawork/msg4wrd-io

After updating composer, add the ServiceProvider to the providers array in `config/app.php`

> KPAWork\MSG4wrdIO\MSG4wrdIOServiceProvider::class,

Then, it would be best if you published the vendor to generate a config file `config/msg4wrdio.php`

> php artisan vendor:publish

Almost there, you need to add your token to `.env`, to get token [MSG4wrd.io](https://msg4wrd.io/)

> MSG4wrdIO_TOKEN=YOUR-TOKEN-HERE

To see if the MSG4wrd.io was installed successfully, open your browser, then access this:

> http://your-hostname/msg4wrd-io or http://localhost:8000/msg4wrd-io

To check if the MSG4wrd.io will send an SMS message, do this

> http://localhost:8000/msg4wrd-io/send-message?mobile=your-mobile-here 

Note: The mobile number should include the country code. I.e., +63 or +1


## Usage

Create controller, let say `SMSController`

```php
<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use KPAWork\MSG4wrdIO\Http\Controllers\MSG4wrdIOController;

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

    public function SMSSendToPhilippines() {
        $msg4wrd = new MSG4wrdIOController();

        $options = ["sendername" => "Default", "priority" => 0, "local" => 0]

        $res = $msg4wrd->SendMessage("US-PH-Number-Here", "Your-Message-Here", $options);
        return $res;
    }

    public function SMSSendToUSCAPH() {
        $msg4wrd = new MSG4wrdIOController();

        $options = ["sendername" => "Default", "priority" => 0, "local" => 1]

        $res = $msg4wrd->SendMessage("US-CA-Number-Here", "Your-Message-Here", $options);
        return $res;
    }
}
```