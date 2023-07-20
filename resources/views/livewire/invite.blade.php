<main class="container">
    @section('title', $invite->event()->first()->name)
    <article>
        <header>
            <hgroup>
                <h1>{{ $invite->event()->first()->name }}</h1>
                <h2>
                    📅  {{ $invite->event()->first()->start_time->format('F j, Y') }},
                    {{ $invite->event()->first()->start_time->format('g:i a') }} -
                    {{ $invite->event()->first()->end_time->format('g:i a') }}
                    <br/>
                    📍  {{ $invite->event()->first()->location }}
                </h2>
{{--                    <h2>{{ $invite->event()->first()->start_time}} - {{$invite->event()->first()->end_time }}</h2>--}}
            </hgroup>

            <p>Heya, {{ $invite->name }}! 👋</p>

            <p>{!! nl2br(e($invite->event()->first()->description)) !!}</p>
        </header>
        <p>Let us know if you're able to attend!</p>

        <form wire:submit.prevent="save">
                <div class="grid">
                    <fieldset>
                        <legend>Attending?</legend>
                        <label for="yes">
                            <input type="radio" id="yes" name="attending" value="1" required wire:model="invite.is_attending">
                            Heck yeah!
                        </label>
                        <label for="no">
                            <input type="radio" id="no" name="attending" value="0" wire:model="invite.is_attending">
                            Sadly not...
                        </label>
                    </fieldset>

                    <label for="count">
                        How many people?
                        <select id="count" required wire:model="invite.number_attending">
                            <option value="0">No one 😢</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5+</option>
                        </select>
                    </label>
                </div>

                <label for="comments">
                    Any dietary restrictions or fun facts you'd like us to know about?
                    <input type="text" id="comments" name="comments" wire:model="invite.comments">
                </label>
                <button type="submit">
                    @if (session()->has('message'))
                        <div>{{session('message')}}</div>
                    @else
                        Submit
                    @endif
                </button>
        </form>
    </article>
</main>

