<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\VsNotify;
use App\Traits\SelecUser;


use App\Http\Resources\VsNotifyCollection;


class VsNotifyController extends Controller
{
    
    use SelecUser;

    protected $USU_ROL;
    protected $USU_NO;

    public function index(){

        return view('Docente.VsNotify.VsNotify');
    }


    public function records(Request $request){      

        $this->USU_NO  =   $this->getSelecUser(); 
        $this->USU_ROL  =  $this->getSelecRol(); 
      
        $perPage = $request->input('limit'); // User input 
       // $data=array();
        $data=$this->data($perPage); 
    
        return response()->json(['status' => 200,'result' => $data,'perPage'=>$perPage]);   
    }

    function data($perPage){

        $data=array();
        switch($this->getSelecRol())
        {

            case 1:  // System Manager				
                $data=array();              
                break;
            case 5:  // Docente				
                $result = VsNotify::where('EMP_NO', $this->getSelecUser());
                $data   = new VsNotifyCollection($result->paginate($perPage));                
                break;
            default:				

                $result = VsNotify::where('EMP_NO',$this->getSelecUser());
                $data   = new VsNotifyCollection($result->paginate(10));  
                break;

        }
        return $data;
    } 

}
