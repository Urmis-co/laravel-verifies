<?php

namespace Urmis\Verifies\Contracts;

interface SecretGenerator
{
    /**
     * Generate new secret
     *
     * @return string
     */
    public function generate(): string;
}
