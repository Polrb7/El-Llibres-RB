<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Textarea extends Component
{
    public $name;
    public $id;
    public $rows;
    public $placeholder;

    /**
     * Create a new component instance.
     */
    public function __construct($name, $id = null, $rows = 4, $placeholder = '')
    {
        $this->name = $name;
        $this->id = $id ?? $name; // Fes que l'ID sigui igual al nom per defecte
        $this->rows = $rows;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.textarea');
    }
}
