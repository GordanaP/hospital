<?php

namespace App\Http\Controllers\User;

use App\ActivationToken;
use App\Http\Controllers\Controller;

class ActivationTokenController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\ActivationToken  $activationToken
     * @return \Illuminate\Http\Response
     */
    public function show(ActivationToken $activationToken)
    {
        $activationToken->user->verifiesEmail();

        return $this->verified();
    }

    /**
     * Get the response for a successfull email verification.
     *
     * @return mixed
     */
    protected function verified()
    {
        $response = message('Your account is now active. Please sign in to access the site content.');

        return redirect()->route('login')->with($response);
    }
}
