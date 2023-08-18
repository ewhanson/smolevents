<x-mail::message>
# Tomorrow's the big day!  🎉

## {{ $event->name }}

### 📅 {{ $event->start_time->format('F j, Y') }}, {{ $event->start_time->format('g:i a') }} - {{ $event->end_time->format('g:i a') }}

### 📍 {{ $event->location }}

Hey {{ $invite->name }}  👋

Just a quick note to remind you that *{{ $event->name }}* is happening tomorrow. We can't wait to see you there!

<x-mail::button :url="$url">
Review event details
</x-mail::button>

If you cannot access the link above, you may view the event details at {{ $url }}

Thanks,<br>
{{ $event->host }}
</x-mail::message>
