<div class="step">
    <div class="bg-light p-3 rounded mb-3 debug">
        <p>Parent data: {{ print_r($this->parent) }}</p>
        <p>RESULT data: {{ print_r($this->result) }}</p>
        <p>Current Step: {{ $this->getCurrentStep() }}</p>
    </div>

    @if(!$this->hasReactiveSteps())
        <p>{{ $this->getCurrentStep() }}/{{ $this->getCountSteps() }}</p>
    @endif

    @if ($this->object->hasTitle())
        <h3 class="mb-4">{!! $this->object->getTitle() !!}</h3>
    @endif

    @if ($this->object->hasDescription())
        <p>{!! $this->object->getDescription() !!}</p>
    @endif

    @foreach ($this->object->getSchema() as $object)
        <x-fieldtype :key="md5($loop->index)" :$object :$result />
    @endforeach

    @if ($this->getCurrentStep() > 1)
        <button class="btn btn-primary" wire:click="previousStep" type="button">{!! __('actions.previous_step') !!}</button>
    @endif

    @if ($this->getCountSteps() !== $this->getCurrentStep())
        <button class="btn btn-primary" wire:click="nextStep" type="button">{!! __('actions.next_step') !!}</button>
    @endif

    @if ($this->getCountSteps() == $this->getCurrentStep() && $this->hasConclusion())
        <button class="btn btn-primary" wire:click="nextStep" type="button">{!! __('actions.finish') !!}</button>
    @endif
</div>
