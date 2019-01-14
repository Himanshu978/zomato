@component('mail::message')
# Introduction
<h3>Welcome to Zomato.</h3>

<p>Hi , you are registered to zomato.</p>

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>

@endcomponent
