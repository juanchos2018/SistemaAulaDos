<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Traits\SelecUser;
use App\Models\VsEcmat;
use Maatwebsite\Excel\Excel;
use App\Http\Resources\VsActmatCollection;


class VsActmatController extends Controller
{
    //
    use SelecUser;

    public function index(){

        return view('Aula.VsActmat.VsActmat');
      }
  
    public function records(Request $request){
  
   
           $perPage = $request->input('limit'); 
           $data=$this->data($perPage);    
       
        
           return response()->json(['status' => 200,'result' => $data]);   
       }
  
    function data($perPage){
  
          $data=array();
          
          switch($this->getSelecRol())
          {
              
              case 5:  // Docente				
                  $result = VsEcmat::selectVsactmat($this->getSelecUser());
                  $data   = new VsActmatCollection($result->paginate(10));
                 // $data=VsAbsent::listAll($this->USU_NO);     
                  break;
              default:				
  
                  $result = VsEcmat::selectVsactmat($this->getSelecUser());
                  $data   = new VsActmatCollection($result->paginate(10));  
                  break;
          }
          return $data;
     }  
  
}
