<?php

namespace App\Http\Controllers;

use App\Models\VsAbsent;
use App\Traits\SelecUser;
use Maatwebsite\Excel\Excel;
use App\Exports\VsAbsentExport;
use App\Http\Resources\VsAbsentCollection;

use Illuminate\Http\Request;

class VsAbsentController extends Controller
{
    //

    public $USU_ROL;
    public $USU_NO;


    use SelecUser;


    public function index(){

      return view('Docente.Vsabsent.Vsabsent');
    }

    public function records(Request $request){

 
         $perPage = $request->input('limit'); 
         $data=$this->data();    
     
      
         return response()->json(['status' => 200,'result' => $data]);   
     }

     function data(){

        $data=array();
		
        switch($this->getSelecRol())
        {
            case 1:  // System Manager				
                $data=array();              
                break;
            case 5:  // Docente				
                $result=VsAbsent::where('EMP_NO',$this->getSelecUser());
                $data   = new VsAbsentCollection($result->paginate(10));
               // $data=VsAbsent::listAll($this->USU_NO);     
                break;
            default:				

                $result = VsAbsent::where('EMP_NO',$this->getSelecUser());
                $data   = new VsAbsentCollection($result->paginate(10));  
                break;
        }
        return $data;
    }  


    public function exportExcel(){       
		$data = $this->dataExport();
        return (new VsAbsentExport)->vsabsents($data)->download('vsabsents.xlsx', Excel::XLSX);

    }

    public function exportPdf(){    
		
		$data = $this->dataExport();
        return (new VsAbsentExport)->vsabsents($data)->download('vsabsents.pdf', Excel::DOMPDF);     
    }

    function dataExport(){

        $this->USU_ROL =   session()->get('USU_ROL');
        $this->USU_NO  =   session()->get('USU_NO'); 

        $data=array();

        switch($this->USU_ROL)
        {
            case 5:  // Docente		
              
                $data=VsAbsent::where('EMP_NO',$this->getSelecUser())->get();
           //     $data=  VsTudent::students($this->USU_NO)->get(); 
                break;
            case 1: // Estudiante		
                
                $data=VsAbsent::where('EMP_NO',$this->getSelecUser())->get();
                break;

            default:					
                
                 $data=VsAbsent::where('EMP_NO',$this->getSelecUser())->get();    
				
                break;
        }
        return $data;
    }  
}
