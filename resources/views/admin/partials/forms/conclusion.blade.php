<div class="conclusion">
    <h2 class="title">{!! __('conclusion.title') !!}</h2>
    <p class="description">{!! __('conclusion.description') !!}</p>

    @if ($result)
        <div class="results">
            @foreach ($result as $key => $value)
                <div class="item">
                    <p>{{ ucfirst($key) }}: {{ is_array($value) ? implode(', ', $value) : $value }}</p>
                </div>
            @endforeach
        </div>
    @else
        <p>{!! __('conclusion.no_input') !!}</p>
    @endif

    {{-- <button class="btn btn-primary" wire:click="previousStep" type="button">{!! __('actions.previous_step') !!}</button> --}}
</div>
