<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class VsChedulExport implements FromView,ShouldAutoSize
{
    use Exportable;
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view():View
    {
        return view('Aula.VsChedul.export',
        [
            'vscheduls'=> $this->vscheduls            
        ]);
    }

    public function vscheduls($vscheduls) {
        $this->vscheduls = $vscheduls;
        
        return $this;
    }
}
