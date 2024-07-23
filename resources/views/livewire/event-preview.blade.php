<main class="container">
    @section('title', $event->first()->name)
    <article>
        <header>
            <hgroup>
                <h1>{{ $event->first()->name }}</h1>
                <h2>
                    📅  {{ $event->first()->start_time->format('F j, Y') }},
                    {{ $event->first()->start_time->format('g:i a') }} -
                    {{ $event->first()->end_time->format('g:i a') }}
                    <br/>
                    📍  {{ $event->first()->location }}
                </h2>
            </hgroup>

            <p>Heya 👋</p>

            <p>{!! nl2br(e($event->first()->description)) !!}</p>
        </header>
        <p>ℹ️  This is an event preview.</p>
        <p>If this were an actual invite, the RSVP form would be here! 👇</p>
    </article>
</main>
