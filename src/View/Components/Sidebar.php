<?php

namespace TheRealJanJanssens\Pakka\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use TheRealJanJanssens\Pakka\Models\Menu;
use Illuminate\Database\Eloquent\Collection;

class Sidebar extends Component
{
    public Collection $menu;

    public function __construct()
    {
        $this->menu = Menu::find('1')->items()->primary()->get();
    }

    public function render(): View
    {
        return view('pakka::admin.partials.menu.sidebar');
    }
}
