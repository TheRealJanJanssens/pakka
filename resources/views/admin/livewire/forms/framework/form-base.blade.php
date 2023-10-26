<div class="form-base">
    <div class="mb-3 bg-light p-3 rounded mt-5">
        This is the base form<br>

        Result: {{ print_r($result) }} <br>
        Current Step: {{ $this->currentStep }}<br>
        Step count: {{ $this->countSteps() }}<br>

    </div>

    <div class="form-wrapper">
        <form class="form" wire:submit="saveForm">
            @if ($this->hasSteps())
                @if ($this->hasConclusion && $this->currentStep == $this->countSteps())
                    <x-pakka::forms.conclusion :$result :parent="$this->getMeta()" />
                @else
                    @php($object = $this->filteredSchema()[$this->currentStep])

                    <livewire:is :component="$object->getComponent()" :$object :$result :parent="$this->getMeta()" :key="md5($this->currentStep)" />
                @endif
            @else
                @foreach ($this->schema() as $object)
                    <x-pakka::forms.fieldtype :key="md5($loop->index)" :$object :$result />
                @endforeach

                <button class="btn btn-primary" type="submit">{!! __('actions.submit') !!}</button>
            @endif
        </form>
    </div>
</div>
