@component('mail::message')
# Reply to "{{ $support->subject }}"

Hello,

{{ $reply->message }}

**This is in reply to an earlier message you sent to us:**
>{{ substr($lastMessage->message, 0, 50) }}...

Which we received on: {{ $lastMessage->created_at->format('Y-m-d h:i a')  }}.

{{--@component('mail::button', ['url' => ''])
Button Text
@endcomponent--}}

Feel free to message us again.
<br>
<br>
Thanks.
<br>
{{ $reply->user->name }} on behalf of **{{ config('app.name') }}**
@endcomponent
