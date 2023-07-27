<x-mail::message>
# You're invited!  🎟️

## {{ $event->name }}

### 📅 {{ $event->start_time->format('F j, Y') }}, {{ $event->start_time->format('g:i a') }} - {{ $event->end_time->format('g:i a') }}

### 📍 {{ $event->location }}

Hey {{ $invite->name }}  👋

{{ $event->description }}

<x-mail::button :url="$url">
RSVP
</x-mail::button>

If you cannot access the link above, you may RSVP at {{ $url }}

Thanks,<br>
{{ $event->host }}
</x-mail::message>
