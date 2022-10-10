<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VsEmplox;
use App\Http\Resources\VsEmploxCollection;

class VsEmploxController extends Controller
{
    public $USU_ROL;
    public $USU_NO;



    public function index(){

      return view('Docente.Vsemplox.Vsemplox');
    }

    public function record($EMP_NO){

        $result = VsEmplox::find($EMP_NO);
        $this->USU_ROL =  session()->get('USU_ROL');

        if ($result) {
            
            return response()->json(['status' => 200,'result' => $result,'use_No'=> $this->USU_ROL]);   
        }
        else{
            return response()->json(['status' => 404]);
        }
    }
    public function store(Request $request){

        try
        {           
            $EMP_NO = $request->EMP_NO;            
            $obj = VsEmplox::firstOrNew(['EMP_NO' => $EMP_NO]);
            $obj->fill($request->all());
            $obj->save();
            $message =$request->EMP_NO==null?'Agregado con exito':'Actualizado con exito';

            return response()->json(['status' => 200,'result' => $obj,'message'=>$message]);
            
        } catch (\Exception $e){      

            return response()->json(['status' => 404,'message'=>$e->getMessage()]);
        }   

    }

   public function records(){

        $this->USU_ROL =  session()->get('USU_ROL');
        $this->USU_NO  =  session()->get('USU_NO'); 

        $data=array();
        switch($this->USU_ROL)
        {
            case 1:  // System Manager				
             
                $result = VsEmplox::orderBy('LAS_NM');
                $data   = new VsEmploxCollection($result->paginate(10));            
                break;
            case 5:  // Docente				
                $result = VsEmplox::where('EMP_NO',$this->USU_NO)->orderBy('LAS_NM');
                $data   = new VsEmploxCollection($result->paginate(10));

                break;
            default:					
              
                $result = VsEmplox::where('ESTATU',1)->orderBy('LAS_NM');
                $data   = new VsEmploxCollection($result->paginate(10));   
                break;
        }
        return response()->json(['status' => 200,'result' => $data,'use_No'=> $this->USU_ROL]);   
    }   
}
