@component('mail::message')

    @php
        use App\Models\Setting;
        $getSetting = Setting::getSingle();
        $logoUrl = $getSetting->getLogo();
    @endphp



    @if (isset($user))

        @if (isset($user))
            @if (!empty($user->last_name))
                <p>Hello {{ $user->last_name }}, {{ $user->name }}</p>
            @endif
            @if (!empty($user->send_message))
                <p>{!! $user->send_message !!}</p>
            @endif
        @endif



    @elseif (isset($message))
        <img src="{{ $logoUrl }}" alt="Company Logo" width="100px" height="auto" style="display: block; margin: auto;"/>
        <p>{!! $message !!}</p>
    @endif

    {{ config('app.name') }}
@endcomponent
