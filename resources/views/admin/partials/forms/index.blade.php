@foreach($form->fields as $field)
    <x-pakka::forms.components.field :field="$field" />
@endforeach
