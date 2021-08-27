<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LikeDislike extends Component
{
    public $model;
    public $likeableType;

    /**
     * Create a new component instance.
     *
     * @param $model
     * @param $likeableType
     */
    public function __construct($model, $likeableType)
    {
        //
        $this->model = $model;
        $this->likeableType = $likeableType;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.like-dislike');
    }
}
