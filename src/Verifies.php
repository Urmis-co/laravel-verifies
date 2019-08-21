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

    /**
     * Send sms verification code
     *
     * @param string $for
     * @param string $receiver
     * @param string $message
     * @param array $data
     * @param int $user_id
     * @return Verify
     */
    public function sendSms(string $for, string $receiver, string $message, array $data, int $user_id=null)
    {
        $verify = $this->makeVerify($for, $receiver, $data, $user_id);
        $message = $this->prepareMessage($message, $verify);

        try {
            $sms = $this->smsProvider->sendMessage($receiver, $message, $verify->code);
        }
        catch (\Exception $e) {
            $verify->exception_code = -1;
            $verify->exception = $e->getMessage();
        }

        $verify->save();
        return $verify;
    }

    /**
     * Make new verify entry
     *
     * @param $for
     * @param $receiver
     * @param $data
     * @param $user_id
     * @return mixed
     */
    protected function makeVerify($for, $receiver, $data, $user_id)
    {
        $secret = $this->getSecret();
        $code = $this->getCode();

        $verify = Verify::make([
            'user_id' => $user_id,
            'secret' => (string)$secret,
            'code' => (string)$code,
            'via' => 'sms',
            'receiver' => (string)$receiver,
            'for' => $for,
            'data' => $data,
            'max_tries' => config('verifies.max_tries'),
            'expires_in' => config('verifies.expires_in'),
        ]);

        return $verify;
    }

    /**
     * Generate new secret
     *
     * @return string
     */
    protected function getSecret()
    {
        return $this->secretGenerator->generate();
    }

    /**
     * Generate new code
     *
     * @return string
     */
    protected function getCode()
    {
        return $this->codeGenerator->generate();
    }

    /**
     * This function replaces :code with generated code in message
     *
     * @param $message
     * @param $verify
     * @return mixed
     */
    protected function prepareMessage($message, $verify)
    {
        $message = str_replace(':code', $verify->code, $message);
        return $message;
    }
}
