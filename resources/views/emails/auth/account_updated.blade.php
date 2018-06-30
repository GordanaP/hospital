@component('mail::message')
# Introduction

Your account has been updated. These are your new access credentials:

<p style="margin-bottom: 0;">username: {{ $email }}</p>
<p>password: {{ $password ?: 'Your password has not been changed' }}</p>


Best Regards,<br>
{{ config('app.name') }}
@endcomponent
