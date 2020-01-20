<?php

namespace Urmis\Verifies\Contracts;

abstract class SmsProvider
{
    /**
     * Get provider name
     *
     * @return string
     */
    abstract public function getProviderName(): string;

    /**
     * Message sender function
     *
     * @throws \Exception
     */
    abstract public function sendMessage($receiver, $message, $code);

    /**
     * Template sender function
     *
     * @throws \Exception
     */
    abstract public function sendTemplate($receiver, $template, $code, $token2, $token3);

    /**
     * Get provider config
     *
     * @return array
     */
    public function getProviderConfig(): array
    {
        $provider = $this->getProviderName();
        $config = config("verifies.providers.{$provider}");
        return $config;
    }
}
