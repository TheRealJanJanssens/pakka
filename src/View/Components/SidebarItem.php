<?php

namespace TheRealJanJanssens\Pakka\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use TheRealJanJanssens\Pakka\Models\MenuItem;

class SidebarItem extends Component
{
    public string $route;

    public function __construct(
        public MenuItem $item
    ) {
    }

    public function getRoute()
    {
        switch ($this->item->link) {
            case 'items':
                return route('admin.'.$this->item->link.'.index', $this->item->id);

                break;
            default:
                return route('admin.'.$this->item->link.'.index');

                break;
        }
    }

    public function render(): View
    {
        $this->item = $this->item->localize();
        $this->route = $this->getRoute() ?? "/";

        return view('pakka::admin.partials.menu.sidebar-item');
    }
}
