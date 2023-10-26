<div>
    <select id="{{ $object->getName() }}" class="form-select" wire:model.live="value"
        @if ($object->isMultiple()) multiple @endif @if ($object->isRequired()) required @endif>

        @foreach ($object->getOptions() as $key => $value)
            <option value="{{ $key }}">{{ $value['label'] }}</option>
        @endforeach
    </select>
</div>
