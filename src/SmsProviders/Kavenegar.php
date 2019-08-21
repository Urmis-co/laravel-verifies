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

        if ( $config['verify_lookup']['enabled'] == false ) {
            $sender = $config['sender'];
            $result = $api->Send($sender, $receiver, $message);
        }
        else {
            $template = $config['verify_lookup']['template'];
            $result = $api->VerifyLookup($receiver, $code, null, null, $template);
        }
    }
}
