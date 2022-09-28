<?php

namespace App\View\Components;

use Illuminate\View\Component;


class badge extends Component
{
    public $type ;
    public $bgColor ;

    /**
     * Create a new component instance.
     *
     * @return void
     */


    public  function __construct($type="black",$bgColor=" ")
    {
        
          $this->type = $type;
          $this->bgColor = $bgColor;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.badge');
    }
}
