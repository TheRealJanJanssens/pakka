<div>
    <div class="d-flex">
        <p class="range-min">{{ $object->getMin() }}</p>

        <div class="w-100">
            <p class="range-value text-center font-weiht-bold">{{ $value }}</p>
            <input type="range" class="form-range" id="{{ $object->getName() }}" wire:model.live="value"
                    min="{{ $object->getMin() }}" max="{{ $object->getMax() }}" step="{{ $object->getStep() }}"
                    @if ($object->isRequired()) required @endif>

            <div class="d-flex justify-content-between">
                <p class="range-min text-muted small">{{ $object->getMin() }}</p>
                <p class="range-max text-muted small">{{ $object->getMax() }}</p>
            </div>
        </div>
    </div>
    <p class="range-value text-center">{{ $value }}</p>
</div>
