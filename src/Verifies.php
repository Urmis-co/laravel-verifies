<?php

namespace Urmis\Verifies;

use Urmis\Verifies\Contracts\CodeGenerator;
use Urmis\Verifies\Contracts\SecretGenerator;
use Urmis\Verifies\Contracts\SmsProvider;

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
     * @var SmsProvider $smsProvider
     */
    public $smsProvider;


    /**
     * Verifies constructor.
     *
     * @param SecretGenerator $secretGenerator
     * @param CodeGenerator $codeGenerator
     * @param SmsProvider $smsProvider
     */
    public function __construct(SecretGenerator $secretGenerator, CodeGenerator $codeGenerator, SmsProvider $smsProvider)
    {
        $this->secretGenerator = $secretGenerator;
        $this->codeGenerator = $codeGenerator;
        $this->smsProvider = $smsProvider;
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
