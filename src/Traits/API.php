<?php

namespace KPAPH\MSG4wrdIO\Traits;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Guzzle\Http\Exception\BadResponseException;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Guzzle\Http\Exception\ServerErrorResponseException;

trait API
{
    public static function PostAPI($data)
    {
        $version = (int)phpversion();

        if( $version < 8 ) {
            return self::postRequestPHPCurl($data);
        }

        return self::postRequestGuzzleHttp($data);
    }

    public static function postRequestGuzzleHttp($data)
    {
        $client = new Client();
        $errMessage = "Sending failed.";

        $url = config('msg4wrdio.domain');
        $token = config('msg4wrdio.token');

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => ' Bearer ' . $token,
        ];

        try {
            $postResponse = $client->post($url . '/api/v2/sms', [
                'headers' => $headers,
                'json' => $data,
            ]);

            if ($postResponse->getStatusCode() == 200) {
                return json_decode($postResponse->getBody(), true);
            }
        } catch (Exception $e) {
            $errMessage = $e->getMessage();
        }

        return [
            'status' => 500,
            'message' => $errMessage
        ];
    }

    public static function postRequestPHPCurl($data)
    {
        $ch = curl_init();

        $url = config('msg4wrdio.domain');
        $token = config('msg4wrdio.token');

        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        );

        $postdata = json_encode($data);
        curl_setopt($ch, CURLOPT_URL, $url . '/api/v2/sms');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output, true);
    }
}
