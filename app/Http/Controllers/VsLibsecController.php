<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\VsLibsecCollection;
use App\Traits\SelecUser;
use App\Models\VsTudent;
use App\Models\VsEcmat;


class VsLibsecController extends Controller
{
    use SelecUser;

    protected $USU_ROL;
    protected $USU_NO;

    public function index(){

        return view('Aula.VsLibsec.VsLibsec');
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
              
				$result=  VsEcmat::selectVslibsec($this->getSelecUser());        
				//$data   = new VStudentCollection($result->paginate($perPage));  
                $data   = new VsLibsecCollection($result->paginate($perPage));  					

                break;
            
            default:					
               
				 $result=VsEcmat::selectVslibsec($this->getSelecUser());        
				 $data   = new VsLibsecCollection($result->paginate($perPage));              
                break;
        }
        return $data;      
    } 
}
