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
            Forms\Components\TextInput::make('name')
                ->required()
                ->extraInputAttributes(['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'], false),
            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->extraInputAttributes(['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'], false),
            Forms\Components\Select::make('role')
                ->options(config('pakka.roles') + config('pakka.adminRoles')),
        ];
    }

    // protected function getFormModel(): User
    // {
    //     return $this->user;
    // }

    public function submit(): void
    {

    }

    public function render(): View
    {
        return view('pakka::livewire.admin.users.form');
    }
}
