<?php

namespace KPAPH\MSG4wrdIO\Traits;

use KPAPH\MSG4wrdIO\Enums\Country;

trait Helper
{
    public static function chechNumberCountryCode(string $number)
    {
        $mobile = "0";

        // 639171234567
        // 12026645435

        if (strlen($number) > 11 && strlen($number) == 12) {
            $mobile = substr($number, 0, 2);
            if ($mobile == "63") {
                return true;
            }
        } else if (strlen($number) > 10 && strlen($number) == 11) {
            $mobile = substr($number, 0, 1);
            if ($mobile == "1") {
                return true;
            }
        }

        return false;
    }

    public static function checkCountry(array $options): Country
    {
        switch ($options["country"]) {
            case "US":
                return Country::US;
            default:
                return Country::PH;
        }
    }
}
