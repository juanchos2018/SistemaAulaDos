<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;



class VsAbsentExport implements FromView,ShouldAutoSize
{


    use Exportable;

    public function view():View
    {       
        return view('Docente.Vsabsent.export',
        [
            'vsabsents'=> $this->vsabsents            
        ]);
    }

    public function vsabsents($vsabsents) {
        $this->vsabsents = $vsabsents;
        
        return $this;
    }

}
