@component('mail::message')
# Introduction

Press the button bellow to activate your account. Once you activate your account you may sign in using the following credentials:

<p style="margin-bottom: 0;">username: {{ $token->user->email }}</p>
<p>password: {{ $password }}</p>

@component('mail::button',  ['url' =>  route('token.show', $token) ])
    Activate Account
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
