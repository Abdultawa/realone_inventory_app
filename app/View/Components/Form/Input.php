<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public $name;
    public $type;
    public $label;
    public $value;
    public $placeholder;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param string $label
     * @param string $type
     * @param string|null $value
     * @param string|null $placeholder
     */
    public function __construct($name, $label, $type = 'text', $value = null, $placeholder = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->value = $value;
        $this->placeholder = $placeholder ?? $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.form.input');
    }
}

