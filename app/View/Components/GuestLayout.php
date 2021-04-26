<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $actions = ['walk', 'run', 'eat', 'sleep',];
        foreach ($actions as $action) {
            $this->{$action}();
        }

        return view('layouts.guest');
    }
}
