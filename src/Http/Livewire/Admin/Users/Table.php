<?php

namespace TheRealJanJanssens\Pakka\Http\Livewire\Admin\Users;

use App\Models\User;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Table extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setConfigurableAreas([
            'toolbar-left-start' => 'pakka::admin.users.tableActions',
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make(trans('pakka::app.name'), 'name')
                ->sortable()
                ->searchable(),
            Column::make(trans('pakka::app.email'), 'email')
                ->sortable()
                ->searchable(),
            Column::make('Actions')
                ->label(
                    function ($row, Column $column) {
                        return view('pakka::admin.users.rowActions');
                    }
                ),
        ];
    }
}
