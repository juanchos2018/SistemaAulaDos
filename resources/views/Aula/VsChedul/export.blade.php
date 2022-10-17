

<table>
    <thead>
        <tr>
            <th>Empresa</th>
           
        </tr>
    </thead>
    <tbody>
       
            <tr>
                <td>Colegio de la salle</td>               
            </tr>
      
    </tbody>
  
</table>
<table>
    <thead>
        <tr>
            <th>SEC_ID</th>
            <th>PERIOS</th>
            <th>FECREG</th>
            <th>HORREG</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vscheduls as $item)
            <tr>
                <td>{{$item->SEC_ID}}</td>
                <td>{{$item->PERIOS}}</td>
                <td>{{$item->FECREG}}</td>
                <td>{{$item->HORREG}}</td>
            </tr>
         @endforeach 
    </tbody>
</table>