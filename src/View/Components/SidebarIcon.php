<?php

namespace TheRealJanJanssens\Pakka\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class SidebarIcon extends Component
{
    public function __construct(
        public string $icon
    ){}

    public function legacyMapping()
    {
        switch ($this->icon) {
            case 'ti-home':
                return 'phosphor-house';
            case 'ti-menu':
                return 'phosphor-list';
            case 'ti-user':
                return 'phosphor-users';
            case 'ti-pencil-alt':
                return 'phosphor-note-pencil';
            case 'ti-car':
                return 'phosphor-car';
            case 'ti-hummer':
                return 'phosphor-car';
            case 'ti-package':
                return 'phosphor-package';
            case 'ti-layout':
                return 'phosphor-layout';
            case 'ti-write':
                return 'phosphor-pencil-line                ';
            case 'ti-pie-chart':
                return 'phosphor-chart-pie';
            case 'ti-shopping-cart':
                return 'phosphor-shopping-cart-simple';
            case 'ti-comments':
                return 'phosphor-chat-circle-dots';
            case 'ti-truck':
                return 'phosphor-truck';
            case 'ti-receipt':
                return 'phosphor-receipt';
            case 'ti-dashboard':
                return 'phosphor-gauge';
            case 'ti-tag':
                return 'phosphor-tag';
            case 'ti-bar-chart':
                return 'phosphor-chart-bar';
            default:
                return $this->icon;
        }
    }

    public function render(): View
    {
        $this->icon = $this->legacyMapping();
        return view('pakka::admin.partials.menu.sidebar-icon');
    }
}
