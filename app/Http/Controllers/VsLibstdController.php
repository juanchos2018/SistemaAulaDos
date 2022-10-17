<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\VStudentCollection;
use App\Models\VsTudent;
use App\Traits\SelecUser;

class VsLibstdController extends Controller
{
    //


    use SelecUser;

    protected $USU_ROL;
    protected $USU_NO;

    public function index(){

        return view('Aula.VsLibstd.VsLibstd');
    }

    public function records(Request $request){      

        $this->USU_NO  =   $this->getSelecUser(); 

      
        $perPage = $request->input('limit'); // User input 
       // $data=array();
        $data=$this->data($perPage); 
    
        return response()->json(['status' => 200,'result' => $data,'perPage'=>$perPage]);   
    }

    function data($perPage){

        $data=array();
		//$this->USU_NO="1";
        switch($this->getSelecRol())
        {
            case 5:  // Docente		
              
				$result=  VsTudent::students($this->getSelecUser());        
				$data   = new VStudentCollection($result->paginate($perPage));  			

                break;
            case 7: // Estudiante		
     
				$data=VsTudent::students($this->getSelecUser()); 
                break;

             case 8:  // Representante			
 
				$data=VsTudent::students($this->getSelecUser()); 
                    break;
            default:					
               
				 $result=VsTudent::students($this->getSelecUser());        
				 $data   = new VStudentCollection($result->paginate($perPage));              
                break;
        }
        return $data;      
    } 

}
