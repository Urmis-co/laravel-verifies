<?php

namespace Urmis\Verifies\SmsProviders;

use Urmis\Verifies\Contracts\SmsProvider as SmsProviderContract;

class Kavenegar extends SmsProviderContract
{
    public function getProviderName(): string
    {
        return 'kavenegar';
    }

    public function sendMessage($receiver, $message, $code)
    {
        $config = $this->getProviderConfig();
        $api = new \Kavenegar\KavenegarApi($config['key']);

        $sender = $config['sender'];
        $result = $api->Send($sender, $receiver, $message);

        return $result;
    }

    public function sendTemplate($receiver, $template, $code, $token2, $token3)
    {
        $config = $this->getProviderConfig();
        $api = new \Kavenegar\KavenegarApi($config['key']);

        $result = $api->VerifyLookup($receiver, $code, $token2, $token3, $template);

        return $result;
    }
}
