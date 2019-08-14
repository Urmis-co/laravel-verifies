<?php

namespace Urmis\Verifies\Generators;

use Urmis\Verifies\Contracts\CodeGenerator;

class NumericCodeGenerator implements CodeGenerator
{
    public $chars = '0123456789';
    public $chars_count = 10;

    public function generate(): string
    {
        $len = config('verifies.code.generators.numeric.length');

        $code = "";
        for ( $i=0 ; $i<$len ; $i++ ) {
            $code .= $this->chars[ rand(0, $this->chars_count-1) ];
        }

        return $code;
    }
}
