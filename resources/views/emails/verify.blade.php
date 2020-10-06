@component('mail::message')
<h1>Dziękujemy za rejestrację,</h1>
<h3>Teraz tylko zweryfikuj swój e-mail.</h3>

@component('mail::button', ['url' => env('APP_URL').'verify/'.$email.'/'.$token])
Zweryfikuj
@endcomponent

@endcomponent
