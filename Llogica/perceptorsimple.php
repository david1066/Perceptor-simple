<?php
require_once '../Ldatos/datafactory.php';

class PerceptorSimple
{
    public $w1;
    public $w2;
    public $andc;
    public $e;
    public $tetha;



    function __construct($w1, $w2, $e, $tetha)
    {
        $this->w1 = $w1;
        $this->w2 = $w2;
        $this->e = $e;
        $this->tetha = $tetha;
    }

    
    function Aprender()
    {

       
        //conexion base de datos
        $db = new DatabaseFactory();
        $conexion = $db->getDatabase();
        //consulta a la base de datos
        $query = $conexion->executeQuery('SELECT x1, x2,Cand FROM Entrenamiento ');

        $and = array();
        $iteraciones = 0;
        
    
        while ($entre = $conexion->fetchArray($query)) {

            //   $and = array( array( -1,-1, -1 ), array( -1, 1, -1 ), array( 1, -1, -1 ), array( 1, 1, 1 ));

            array_push($and, array($entre['x1'], $entre['x2'], $entre['Cand']));
        }
         $and2=array();
        
       // return var_dump($and);
     
        $nfil = count($and);


        $i = 0;


        $iteraciones = 0;
        $validar = true;


        while ($i < $nfil) {
            $y = 0;
            $j = 0;
         
        //calculo y
            $y=tanh($this->w1*$and[$i][$j]+$this->w2*$and[$i][$j+1]-($this->tetha));
            array_push($and2, array($and[$i][$j],$and[$i][$j+1], $y));
            if($y>=$this->tetha){
                
                $y=1;
                array_push($and2, array($and[$i][$j],$and[$i][$j+1], $y));
            }else{
                $y=-1;
                array_push($and2, array($and[$i][$j],$and[$i][$j+1], $y));
            }
            
        
            if($y!=$and[$i][$j+2]){
        
           //recalculo si es diferente and
             $and2=array();
            $this->w1=$this->W0($this->w1, $this->e,$y, $and[$i][$j]);
            $this->w2=$this->W0($this->w2, $this->e,$y, $and[$i][$j+1]);
            $this->tetha=$this->Tetha0($this->tetha,$this->e, $y);
        
            $i=0;
            }else{
                $i++;
            }
        
            if($iteraciones==1000){
              $validar=false;
              //rompo el while
            break;
            }
        

            $iteraciones++;
        }

        if($validar){
          
            $this->andc=$and2;

         

        }

        return $validar;
    }

    function W0($w, $e, $y, $x)
    {
        $wi = $w + 2 * $e * $y * $x;
        return $wi;
    }
    function Tetha0($tetha, $e, $y)
    {
        $tethai = $tetha + 2 * $e * $y * (-1);
        return $tethai;
    }
}
