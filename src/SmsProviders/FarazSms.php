<?php

namespace Urmis\Verifies\SmsProviders;

use Urmis\Verifies\Contracts\SmsProvider as SmsProviderContract;

class FarazSms extends SmsProviderContract
{
    public function getProviderName(): string
    {
        return 'farazsms';
    }

    public function sendMessage($receiver, $message, $code)
    {
        $config = $this->getProviderConfig();

        $url = "https://ippanel.com/services.jspd";
        if ( is_array($receiver) == false ) {
            $receiver = [$receiver];
        }

        $param = array
        (
            'uname' => $config['uname'],
            'pass' => $config['pass'],
            'from' => $config['from'],
            'message' => $message,
            'to' => json_encode($receiver),
            'op' => 'send'
        );

        $handler = curl_init($url);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($handler, CURLOPT_POSTFIELDS, $param);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($handler);

        $response = json_decode($response);
        return $response;
    }

    public function sendTemplate($receiver, $template, $code, $token2, $token3)
    {
        throw new \Exception("sendTemplate function is not implemented in FarazSms Provider!");
    }
}
