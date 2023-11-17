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
    public $label, $type , $placeholder,$name,$idname , $classinput;
    public function __construct($label, $type , $placeholder,$name,$idname,$classinput = null)
    {
        $this->label = $label;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->name = $name;
        $this->idname = $idname;
        $this->classinput = $classinput;

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
