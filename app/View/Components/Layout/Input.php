<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $label, $type , $placeholder,$name,$idname;
    public function __construct($label, $type , $placeholder,$name,$idname)
    {
        $this->label = $label;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->name = $name;
        $this->idname = $idname;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layout.input');
    }
}
