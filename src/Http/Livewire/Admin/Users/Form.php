<?php

namespace TheRealJanJanssens\Pakka\Http\Livewire\Admin\Users;

use Filament\Forms;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use TheRealJanJanssens\Pakka\Models\User;

class Form extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public User $user;

    public $name;
    public $email;
    public $role;

    public function mount(): void
    {
        $this->form->fill([
            'name' => $this->user->name,
            'email' => $this->user->email,
            'role' => $this->user->role,
        ]);
    }

    protected function getFormSchema(): array
    {
        //TODO: Refactor roles
        return [
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\TextInput::make('email')->email()->required(),
            Forms\Components\Select::make('role')
            ->options(array_merge(config('pakka.roles'), config('pakka.adminRoles'))),
        ];
    }

    public function submit(): void
    {

    }

    public function render(): View
    {
        return view('pakka::livewire.admin.users.form');
    }
}
