<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\VsEcmat;
use App\Traits\SelecUser;
use Maatwebsite\Excel\Excel;
use App\Exports\VsActsavExport;
use App\Http\Resources\VsActsavCollection;


class VsActsavController extends Controller
{
    use SelecUser;

    protected $USU_ROL;
    protected $USU_NO;

    public function index(){

        return view('Aula.VsActsav.VsActsav');
    }

    public function records(Request $request){      
           
        $perPage = $request->input('limit'); // User input 
       
        $data=$this->data($perPage); 
    
        return response()->json(['status' => 200,'result' => $data,'perPage'=>$perPage]);   
    }

    function data($perPage){

        $data=array();
     
        switch($this->getSelecRol())
        {         
            case 5:  // Docente				
    
                $result = VsEcmat::selectVsactsav($this->getSelecUser());
                $data   = new VsActsavCollection($result->paginate($perPage));                
                break;
            default:				

                $result = VsEcmat::selectVsactsav($this->getSelecUser());
                $data   = new VsActsavCollection($result->paginate($perPage));  
                break;

        }
        return $data;
    } 


    public function exportExcel(){       
		$data = $this->dataExport();
        return (new VsActsavExport)->vsactsavs($data)->download('vsaactsavs.xlsx', Excel::XLSX);
     //   exit();
    }

    public function exportPdf(){    
		
		$data = $this->dataExport();
        return (new VsActsavExport)->vsactsavs($data)->download('vsaactsavs.pdf', Excel::DOMPDF);     
    }


    function dataExport(){
    

        $data=array();

        switch($this->getSelecRol())
        {
            case 5:  // Docente		
              
                $data=VsEcmat::selectVsactsav($this->getSelecUser())->get();           
                break;        

            default:					
                
              $data=VsEcmat::selectVsactsav($this->getSelecUser())->get();
			 	
              break;
        }
        return $data;
    }  

}
