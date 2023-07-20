<x-mail::message>
# You're invited!  🎟️

## {{ $event->name }}

### 📅 {{ $event->start_time->format('F j, Y') }}, {{ $event->start_time->format('g:i a') }} - {{ $event->end_time->format('g:i a') }}

### 📍 {{ $event->location }}

Hey {{ $invite->name }}  👋

{{ $event->description }}

<x-mail::button :url="'http://events.test/invites/' . $invite->id">
RSVP
</x-mail::button>

Thanks,<br>
{{ $event->host }}
</x-mail::message>
