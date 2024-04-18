<?php

namespace KPAPH\MSG4wrdIO\Services;

use KPAPH\MSG4wrdIO\Traits\API;
use KPAPH\MSG4wrdIO\Enums\Country;
use KPAPH\MSG4wrdIO\Traits\Helper;
use KPAPH\MSG4wrdIO\Enums\SenderName;

class MSG4wrd
{
    use API, Helper;

    public static function Send(string $number, string $message, array $options = ["sendername" => SenderName::Default, "priority" => 0, "country" => Country::PH]) {

        $validate = self::chechNumberCountryCode((string)$number);

        if (!$validate) {
            return [
                "status" => 400,
                "message" => "Invalid number"
            ];
        }

        $data = [
            "mobile" => $number,
            "message" => $message,
            "local" => self::checkCountry($options),
            "sendername" => $options["sendername"],
            "priority" => $options["priority"],
        ];

        return self::PostAPI($data);
    }
}
