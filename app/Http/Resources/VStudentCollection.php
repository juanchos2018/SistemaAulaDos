<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VStudentCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data'=>  $this->collection->transform(function($row, $key) {         
                return [
    
                    'STD_NO' => $row->STD_NO,
                    'SEC_NO' => $row->SEC_NO,
                    'PERIOS' => $row->PERIOS,
                    'LAS_NM' => $row->LAS_NM.' '. $row->FIR_NM,            
                    'IDTYPE' => $row->IDTYPE,
                    'IDE_NO' => $row->IDE_NO,
                    'ESTATU' => $row->ESTATU,
                    'SEC_NM' => $row->SEC_NM."-".$row->PARALE,             
                    'PARALE' => $row->PARALE             
                ];              
            }),
            'pagination'=>[
                'total' => $this->total(),
                'count' => $this->count(),
                'per_page' => $this->perPage(),
                'current_page' => $this->currentPage(),
                'total_pages' => $this->lastPage()
            ]
       ];  
    }
}
