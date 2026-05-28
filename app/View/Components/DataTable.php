<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DataTable extends Component
{
    public $title;
    public $headers;
    public $addButton;
    public $exportButton;
    public $exportRoute;
    public $addRoute;
    public $filterOptions;
    public $data; // <- INI KUNCI AGAR DATA TIDAK HILANG

    public function __construct(
        $title = 'Data Table', 
        $headers = [], 
        $addButton = true, 
        $exportButton = false, 
        $exportRoute = null, 
        $addRoute = '#',
        $filterOptions = [], 
        $data = null
    ) {
        $this->title = $title;
        $this->headers = $headers;
        $this->addButton = $addButton;
        $this->exportButton = $exportButton;
        $this->exportRoute = $exportRoute;
        $this->addRoute = $addRoute;
        $this->filterOptions = $filterOptions;
        $this->data = $data;
    }

    public function render()
    {
        return view('components.data-table');
    }
}