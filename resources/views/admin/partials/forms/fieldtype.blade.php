@if ($object->getReactive() || !$object->isReactive())
    <div class="fieldtype {{ $object->getClasses() }}">
        <div class="form-group">
            <label for="{{ $object->getName() }}"
                class="form-label  @if ($object->isRequired()) required @endif>">{{ $object->getLabel() }}</label>

            <livewire:is :component="$object->getView()" :$key :$object :defaultValue="$result" />
        </div>
    </div>
@endif
