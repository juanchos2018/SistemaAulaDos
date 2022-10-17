<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\VsChedul;
use App\Models\VsDefault;
use App\Http\Resources\VsChedulCollection;
use App\Exports\VsChedulExport;
use Maatwebsite\Excel\Excel;
use App\Traits\SelecUser;


class VsChedulController extends Controller
{
    //


    use SelecUser;


    public function index(){

        return view('Aula.VsChedul.VsChedul');
    }


    public function records(Request $request){      

     
      
        $perPage = $request->input('limit'); // User input 
       
        $data=$this->data($perPage); 
    
        return response()->json(['status' => 200,'result' => $data,'perPage'=>$perPage]);   
    }

    function data($perPage){

        $data=array();
        $default = VsDefault::first();
        switch($this->getSelecRol())
        {

            case 1:  // System Manager				
                $data=array();              
                break;
            case 5:  // Docente				
                //$result = VsNotify::where('EMP_NO', $this->getSelecUser());
                $result=VsChedul::where('EMP_NO',$this->getSelecUser())->where('PERIOS',$default->PERIOS);
                $data   = new VsChedulCollection($result->paginate($perPage));                
                break;
            default:				

                $result = VsChedul::where('EMP_NO',$this->getSelecUser());
                $data   = new VsChedulCollection($result->paginate($perPage));  
                break;

        }
        return $data;
    } 



    public function exportExcel(){       
		$data = $this->dataExport();
        return (new VsChedulExport)->vscheduls($data)->download('vscheduls.xlsx', Excel::XLSX);
     //   exit();
    }

    public function exportPdf(){    
		
		$data = $this->dataExport();
        return (new VsChedulExport)->vscheduls($data)->download('vscheduls.pdf', Excel::DOMPDF);     
    }
    function dataExport(){
        

        $data=array();
        $default =VsDefault::first();
        switch($this->getSelecRol())
        {
            case 5:  // Docente		
              
                $data=VsChedul::where('EMP_NO',$this->getSelecUser())->where('PERIOS',$default->PERIOS)->get();
           //     $data=  VsTudent::students($this->USU_NO)->get(); 
                break;
            case 1: // Estudiante		
                
                $data=VsChedul::where('EMP_NO',$this->getSelecUser())->where('PERIOS',$default->PERIOS)->get();
                break;

            default:					
                
                $data=VsChedul::where('EMP_NO',$this->getSelecUser())->where('PERIOS',$default->PERIOS)->get();
				
                break;
        }
        return $data;
    } 
}
