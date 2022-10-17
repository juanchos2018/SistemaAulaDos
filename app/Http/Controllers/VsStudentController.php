<?php

namespace App\Http\Controllers;

use App\Models\VsTudent;
use App\Traits\SelecUser;
use Illuminate\Http\Request;


use App\Http\Resources\VStudentCollection;

class VsStudentController extends Controller
{
    public $USU_ROL;
    public $USU_NO;

    use SelecUser;

    public function index(){

        return view('Docente.Vstudent.Vstudent');
    }

    public function records(Request $request){

       // $this->USU_NO  =   $this->getSelecUser(); 
        //$this->USU_ROL  =  $this->getSelecRol(); 
        $perPage = $request->input('limit'); // User input 
        $data=$this->data();    
       // $data=array(); 
     
        return response()->json(['status' => 200,'result' => $data]);   
    }

    function data(){

        $data=array();
		
        switch($this->getSelecRol())
        {
            case 5:  // Docente		
              
				$result=  VsTudent::students($this->getSelecUser());        
				$data   = new VStudentCollection($result->paginate(15));  	

                break;
            case 7: // Estudiante		
               
				$data=VsTudent::students($this->getSelecUser()); 
                break;

             case 8:  // Representante			
          
				$data=VsTudent::students($this->getSelecUser()); 
                break;
            default:					
                
				 $result=VsTudent::students($this->getSelecUser());        
				 $data   = new VStudentCollection($result->paginate(15));             
                break;
        }
        return $data;
    }  


}
