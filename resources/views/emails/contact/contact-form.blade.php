@component('mail::message')

Thank you for your message.

<strong>Name: </strong>
{{ $data['customer_Name'] }}

<strong>Email: </strong>
{{ $data['customer_Email'] }}

<strong>Message: </strong>
{{ $data['customer_Message'] }}
@endcomponent
