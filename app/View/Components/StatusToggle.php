<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StatusToggle extends Component
{
    /**
     * Create a new component instance.
     */
    /**
     * Create a new component instance.
     */
    public $model;

    public $id;

    public $status;

    public $permission;

    public function __construct($model, $id, $status, $permission = '')
    {
        $this->model = $model;
        $this->id = $id;
        $this->status = $status;
        $this->permission = $permission;
    }

    public function render()
    {
        return view('components.status-toggle');
    }
}
