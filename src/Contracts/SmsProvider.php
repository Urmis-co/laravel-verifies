<?php

namespace Urmis\Verifies\Contracts;

interface SmsProvider
{
    /**
     * Message sender function
     *
     * @return bool indicates that if the process was successful or not
     */
    public function sendMessage($receiver, $for, $data, $user_id=null): bool;
}
