<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Image extends Component
{
    public $name;
    public $label;
    public $value;
    // public $placeholder;
    public $src;


    /**
     * Create a new component instance.
     */
    public function __construct($label, $name, $src = null,$value = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        // $this->placeholder = $placeholder ?? $label;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.image');
    }
}
