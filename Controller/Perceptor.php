<?php
require '../Model/perceptorsimple.php';

class Perceptor{


    function ValidarRespuesta($w1,$w2,$e,$tetha){
     $perceptorsimple= new  PerceptorSimple($w1,$w2,$e, $tetha);
     $validar=$perceptorsimple->Calcular();

     return $validar;
    /* if($validar=='diferente'){
       return 'no';
     }elseif($validar){
        return 'Se ha encontrado Solucion';
      
     }else{
        return 'No se encontro solucion en las 1000 iteraciones';
     }*/
    }
}




?>