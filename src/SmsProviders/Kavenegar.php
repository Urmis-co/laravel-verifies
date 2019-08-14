<?php

namespace Urmis\Verifies\SmsProviders;

use Urmis\Verifies\Contracts\SmsProvider as SmsProviderContract;

class Kavenegar implements SmsProviderContract
{
    public function sendMessage($receiver, $for, $data, $user_id = null): bool
    {
        // TODO: Implement sendMessage() method.
    }
}
