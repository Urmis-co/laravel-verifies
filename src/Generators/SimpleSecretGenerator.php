<?php

namespace Urmis\Verifies\Generators;

use Urmis\Verifies\Contracts\SecretGenerator;

class SimpleSecretGenerator implements SecretGenerator
{
    public $chars = '0123456789abcdefghijklmnopqrstuvyxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    public $chars_count = 62;

    public function generate(): string
    {
        $len = config('verifies.secret.generators.simple.length');

        $code = "";
        for ( $i=0 ; $i<$len ; $i++ ) {
            $code .= $this->chars[ rand(0, $this->chars_count-1) ];
        }

        return $code;
    }
}
