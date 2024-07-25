<main class="container">
    @section('title', $event->name)
    <article>
        <header>
            <hgroup>
                <h1>{{ $event->name }}</h1>
                <h2>
                    📅  {{ $event->start_time->format('F j, Y') }},
                    {{ $event->start_time->format('g:i a') }} -
                    {{ $event->end_time->format('g:i a') }}
                    <br/>
                    📍  {{ $event->location }}
                </h2>
            </hgroup>

            <p>Heya 👋</p>

            <p>{!! nl2br(e($event->description)) !!}</p>
        </header>
        <p>ℹ️  This is an event preview.</p>
        <p>If this were an actual invite, the RSVP form would be here! 👇</p>
    </article>
</main>
