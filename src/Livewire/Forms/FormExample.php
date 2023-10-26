<?php

namespace TheRealJanJanssens\Pakka\Livewire\Forms;

use Closure;
use TheRealJanJanssens\Pakka\Forms\Fieldtypes\Text;
use TheRealJanJanssens\Pakka\Forms\Fieldtypes\Select;
use TheRealJanJanssens\Pakka\Forms\Fieldtypes\Radio;
use TheRealJanJanssens\Pakka\Forms\Fieldtypes\Checkbox;
use TheRealJanJanssens\Pakka\Forms\Fieldtypes\Range;
use TheRealJanJanssens\Pakka\Forms\Layout\Step;
use TheRealJanJanssens\Pakka\Interfaces\FormInterface;
use TheRealJanJanssens\Pakka\Livewire\Forms\Framework\FormBase;

class FormExample extends FormBase implements FormInterface
{
    public bool $hasConclusion = true;
    public string $name = 'FormExample';

    public function schema()
    {
        return [
            Step::make([
                Text::make('first-name')
                    ->type('text')
                    ->label('First name')
                    ->required(),
                Text::make('last-name')
                    ->type('text')
                    ->label('Last name')
                    ->required(),
                Text::make('email')
                    ->type('email')
                    ->required(),
                Text::make('company')
                    ->type('text')
                    ->required(),
                 Range::make('budget')
                    ->label('What is your budget?')
                    ->min(1000)
                    ->max(100000)
                    ->step(1000),
            ])
                ->title('Please provide us with your contact details'),
            Step::make([
                Radio::make('service')
                    ->label('Select one of our services')
                    ->options([
                        "app" => [
                            "label" => "App",
                            "asset" => "https://media.giphy.com/media/9ohlKnRDAmotG/giphy.gif"
                        ],
                        "website" => [
                            "label" => "Website",
                            "asset" => "https://media.giphy.com/media/rGuYfsb6WlKyk/giphy.gif"
                        ],
                        "webshop" => [
                            "label" => "Webshop",
                            "asset" => "https://media.giphy.com/media/Lq0h93752f6J9tijrh/giphy.gif"
                        ],
                    ])
            ])->reactive(function () {
                return isset($this->result['company']) && $this->result['company'] == 'react' ? true : false;
            })
                ->title('What can we help you with?'),
            Step::make([
                Checkbox::make('objectives')
                    ->multiple()
                    ->label('Select all options you wish to select')
                    ->options([
                        "boost" => [
                            "label" => "Boost business growth and increase sales",
                            "asset" => "/assets/color-icon-automation-dark.svg"
                        ],
                        "digitize" => [
                            "label" => "Digitize my business to enhance efficiency and productivity",
                            "asset" => "/assets/color-icon-growbusiness-dark.svg"
                        ],
                        "scale" => [
                            "label" => "Scale and expand my offering",
                            "asset" => "/assets/color-icon-growth-dark-1687180023.svg"
                        ],
                    ]),
            ])
                ->title('What do you want to achieve?'),
            Step::make([
                Range::make('budget')
                    ->label('What is your budget?')
                    ->min(1000)
                    ->max(100000)
                    ->step(1000),
                Range::make('time')
                    ->label('What is your investment timeline? (in months)')
                    ->min(0)
                    ->max(36)
            ])
                ->title('Time for some numbers'),
        ];
    }
}
