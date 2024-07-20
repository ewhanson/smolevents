<x-mail::message>
# Reminder — You're invited!  🎟️

## {{ $event->name }}

### 📅 {{ $event->start_time->format('F j, Y') }}, {{ $event->start_time->format('g:i a') }} - {{ $event->end_time->format('g:i a') }}

### 📍 {{ $event->location }}

Hey {{ $invite->name }}  👋

It's not too late to come (or let us know if you can't)!

{{ $event->description }}

<x-mail::button :url="$url">
RSVP
</x-mail::button>

If there is no RSVP button above, you may RSVP by pasting the following URL into your browser: {{ $url }}

Thanks,<br>
{{ $event->host }}
</x-mail::message>
