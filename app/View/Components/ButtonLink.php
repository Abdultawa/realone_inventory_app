<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ButtonLink extends Component
{
    public $route;
    public $icon;
    public $label;
    public $bgColor;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($route, $icon, $label, $bgColor = 'btn-light-success')
    {
        $this->route = $route;
        $this->icon = $icon;
        $this->label = $label;
        $this->bgColor = $bgColor;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button-link');
    }
}
