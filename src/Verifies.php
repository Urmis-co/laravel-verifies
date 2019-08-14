<?php

namespace Urmis\Verifies;

use Urmis\Verifies\Contracts\CodeGenerator;
use Urmis\Verifies\Contracts\SecretGenerator;

class Verifies
{
    /**
     * @var SecretGenerator $secretGenerator
     */
    public $secretGenerator;

    /**
     * @var CodeGenerator $codeGenerator
     */
    public $codeGenerator;


    /**
     * Verifies constructor.
     *
     * @param $secretGenerator
     * @param $codeGenerator
     */
    public function __construct($secretGenerator, $codeGenerator)
    {
        $this->secretGenerator = $secretGenerator;
        $this->codeGenerator = $codeGenerator;
    }

    public function getSecret()
    {
        return $this->secretGenerator->generate();
    }

    public function getCode()
    {
        return $this->codeGenerator->generate();
    }
}
