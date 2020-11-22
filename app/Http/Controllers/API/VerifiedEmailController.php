<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\VerifiedEmail;
use App\Http\Controllers\Controller;

class VerifiedEmailController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendVerification(Request $request)
    {
        $email = $request->get('email');

        $isVerified = VerifiedEmail::where([
            'email' => $email,
            'verified' => 1,
        ])->first();

        if ($isVerified) {
            return [
                'success' => false,
                'message' => 'This email is already verified',
            ];
        }

        $verifiedEmail = VerifiedEmail::create([
            'email' => $email,
            'token' => Str::random(32),
            'verified' => 0,
        ]);

        $verifiedEmail->sendVerificationCode();

        return [
            'success' => true,
            'message' => 'An email has been sent to ' . $email . ' with a verification link',
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VerifiedEmail  $verifiedEmail
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkVerification(Request $request)
    {
        if (!$request->has('email')) {
            return [
                'success' => false,
                'message' => 'Missing email',
            ];
        }

        if (!$request->has('token')) {
            return [
                'success' => false,
                'message' => 'Missing token',
            ];
        }

        $verifiedEmail = VerifiedEmail::where([
            'email' => $request->get('email'),
            'token' => $request->get('token'),
        ])->first();

        if (!$verifiedEmail) {
            return [
                'success' => false,
                'message' => 'Invalid email or token',
            ];
        }

        if ($verifiedEmail->verified) {
            return [
                'success' => true,
                'message' => 'This email is already verified',
            ];
        }

        $verifiedEmail->verified = 1;
        $verifiedEmail->save();

        return [
            'success' => true,
            'message' => 'Email successfully verified',
        ];
    }
}
