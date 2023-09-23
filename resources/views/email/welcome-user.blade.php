@component('mail::message')

    Welcome to {{ config('app.name') }}

    Name: {{ $mailData['name'] }}
    Email: {{ $mailData['email'] }}

    Visit Site Here :  {{env('APP_URL')}}

    Thanks

    Team {{ config('app.name') }}

   {{-- @component('mail::button', ['url' => "http://phplaravel-1098145-3891736.cloudwaysapps.com/"])
        Visit Site Here
    @endcomponent--}}


@endcomponent
