<?php

namespace App\View\Components;

use Illuminate\View\Component;
use phpDocumentor\Reflection\Types\This;

class Info extends Component
{
    public $model;

    /**
     * Create a new component instance.
     *
     * @param $model
     */
    public function __construct($model)
    {
        //
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.info');
    }

}
