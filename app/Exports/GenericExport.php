<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class GenericExport implements FromView
{
    protected $data;
    protected $view;

    public function __construct($data, $view = null)
    {
        $this->data = $data;
        $this->view = $view ?? 'admin.laporan.export_default';
    }

    public function view(): View
    {
        return view($this->view, ['data' => $this->data]);
    }
}
