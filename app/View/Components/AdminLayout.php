<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdminLayout extends Component
{
    public string $title;
    public string $active;

    public function __construct(string $title = 'Admin Panel', string $active = 'dashboard')
    {
        $this->title = $title;
        $this->active = $active;
    }

    public function render()
    {
        return view('components.admin-layout');
    }
}
