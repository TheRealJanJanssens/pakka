<div>
    <div class="options @if ($object->hasAssets()) has-assets @endif">
        @foreach ($object->getOptions() as $key => $value)
            <div class="form-check">
                <label class="form-check-label @if ($value['asset'] ?? null) has-asset @endif"
                    for="{{ $key }}">
                    <input class="form-check-input" type="radio" wire:model.live="value"
                        value="{{ $key }}" id="{{ $key }}">

                    @if ($value['asset'] ?? null)
                        <div class="asset">
                            <img src="{{ $value['asset'] }}" alt="{{ $value['label'] }}">
                        </div>
                    @endif
                    <p class="label">{{ $value['label'] }}</p>
                </label>
            </div>
        @endforeach
    </div>
</div>
