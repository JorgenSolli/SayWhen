<?php

namespace App\Models;

use App\Notifications\EmailVerification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class VerifiedEmail extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'token',
        'verified',
    ];

    public function sendVerificationCode(): void
    {
        $this->notify(new EmailVerification($this));
    }
}
