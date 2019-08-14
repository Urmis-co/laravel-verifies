<?php

namespace Urmis\Verifies\Contracts;

interface CodeGenerator
{
    /**
     * Generate new code
     *
     * @return string
     */
    public function generate(): string;
}
