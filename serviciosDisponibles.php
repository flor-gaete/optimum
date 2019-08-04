<?php

include "db/conexion.php";

if (isset($_POST['origen']) && isset($_POST['destino'])){
    $origen=trim($_POST['origen']);
    $destino=trim($_POST['destino']);


    $sql="SELECT * FROM `servicios` WHERE Origen='".$origen."' and Destino='".$destino."'";
    $sentencia=$conn->prepare($sql);  //devuelve un array
    $sentencia->execute(array());
    $resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    $sentencia->closeCursor();
    
    if (count($resultado)>0){
        echo  "<table class='table' border='1'>
        <thead class='thead-dark'>
        <tr>
          <th scope='col'>ORIGEN</th>
          <th scope='col'>DESTINO</th>
          <th scope='col'>FECHA-HORA </th>
          <th scope='col'>EMPRESA</th>
          <th scope='col'>PRECIO</th>
        </tr>
      </thead>
      <tbody>";
        foreach ($resultado as $columna => $valor) {
        //foreach ($valor as $key ) {
           //print_r($valor);

            echo "<tr>";
            $fecha = date_create($valor['fecha_hora']);
            echo "
            <td>".$valor['Origen']."</td>
            <td>".$valor['Destino']."</td>
            <td>".date_format($fecha,'d/m/Y H:i')."</td>
            <td>".$valor['empresa']."</td>
            <td>".$valor['precio']."</td>
     
            
            
            ";
             
             
             echo "<tr/>";
        //}
        
        
        };
        echo  "<tbody/>";
        
        echo  "<table/>";
    }else{
        echo "No existen ofertas disponibles";
    }
   
}else{
    echo "Complete origen y destino";
}
 
?>