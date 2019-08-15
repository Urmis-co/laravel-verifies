<?php

namespace Urmis\Verifies\SmsProviders;

use Urmis\Verifies\Contracts\SmsProvider as SmsProviderContract;

class Kavenegar extends SmsProviderContract
{
    public function getProviderName(): string
    {
        return 'kavenegar';
    }

    public function sendMessage($receiver, $message)
    {
        $config = $this->getConfig();

        $api = new \Kavenegar\KavenegarApi( $config['key'] );
        $sender = $config['sender'];

        $result = $api->Send($sender, $receiver, $message);
    }
}
