<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;



class VsActsavExport implements FromView,ShouldAutoSize
{
    use Exportable;

    public function view():View
    {
        return view('Aula.VsActsav.export',
        [
            'vsactsavs'=> $this->vsactsavs            
        ]);
    }

    public function vsactsavs($vsactsavs) {
        $this->vsactsavs = $vsactsavs;
        
        return $this;
    }
}
