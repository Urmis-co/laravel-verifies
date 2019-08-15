<?php

namespace Urmis\Verifies;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Verify extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'verifies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'secret', 'code', 'via', 'receiver', 'for', 'data', 'verified', 'tries', 'max_tries',
        'expires_in', 'exception_code', 'exception',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
    ];


    /*
     *
     *
     *  Helpers
     */

    /**
     * Verify the given code
     *
     * @param string $code
     * @param string $error
     * @return bool
     */
    public function verifyCode(string $code, string &$error)
    {
        DB::beginTransaction();
        try {
            $error = null;

            if ($this->isVerified() == true)
                $error = "This code is verified before.";

            else if ($this->checkExpiration() == false)
                $error = "This code is expired. Please try again to get new code.";

            else if ($this->checkTries() == false)
                $error = "You have tried many times with wrong code. Please try again to get new code.";

            else if ($this->checkCode($code) == false) {
                $remained_tries = $this->max_tries - $this->tries;
                if ($remained_tries <= 0)
                    $error = "You have tried many times with wrong code. Please try again to get new code.";
                else
                    $error = "Code is wrong. You have {$remained_tries} remained tries.";
            }

            if ( is_null($error) == false ) {
                DB::commit();
                return false;
            }

            $this->setAsVerified();
            DB::commit();
            return true;
        }
        catch (\Exception $e) {
            DB::rollBack();
            $error = "Couldn't verify your code. Please try again.";
            return false;
        }
    }

    /**
     * Set as verified
     */
    public function setAsVerified()
    {
        $this->update(['verified' => true]);
    }

    /**
     * Check if is verified ?
     *
     * @return mixed
     */
    public function isVerified()
    {
        return $this->verified;
    }

    /**
     * Check is expired ?
     *
     * @return bool
     */
    public function checkExpiration()
    {
        /** @var Carbon $created_at */
        $created_at = $this->created_at;
        $expiration_time = $created_at->addSeconds($this->expires_in);
        return now()->lessThan($expiration_time);
    }

    /**
     * Check the number of tries
     *
     * @return bool
     */
    public function checkTries()
    {
        $this->increment('tries');
        return $this->tries <= $this->max_tries;
    }

    /**
     * Check code
     *
     * @param string $code
     * @return bool
     */
    public function checkCode(string $code)
    {
        return $this->code == $code;
    }
}
