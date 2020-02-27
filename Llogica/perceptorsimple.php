<?php
require_once '../Ldatos/datafactory.php';

class PerceptorSimple
{
    private $w1;
    private $w2;
    private $e;
    private $tetha;



    function __construct($w1, $w2, $e, $tetha)
    {
        $this->w1 = $w1;
        $this->w2 = $w2;
        $this->e = $e;
        $this->tetha = $tetha;
    }

    function Calcular()
    {

        $validar = true;
        //conexion base de datos
        $db = new DatabaseFactory();
        $conexion = $db->getDatabase();
        //consulta a la base de datos
        $query = $conexion->executeQuery('SELECT * FROM Entrenamiento ');


        $iteraciones = 0;
        
        $and = array();
        while ($entre = $conexion->fetchArray($query)) {

            //   $and = array( array( -1,-1, -1 ), array( -1, 1, -1 ), array( 1, -1, -1 ), array( 1, 1, 1 ));

            array_push($and, array($entre['x1'], $entre['x2'], $entre['Cand']));
        }

       // return var_dump($and);


        $nfil = count($and);


        $i = 0;


        $iteraciones = 0;

        while ($i < $nfil) {
            $y = 0;
            $j = 0;
         
        
            $y=tanh($this->w1*$and[$i][$j]+$this->w2*$and[$i][$j+1]-($this->tetha));
          
            if($y>=$this->tetha){
                $y=1;
            }else{
                $y=-1;
            }
        
            if($y!=$and[$i][$j+2]){
        
           
            $w1=$this->W0($this->w1, $this->e,$y, $and[$i][$j]);
            $w2=$this->W0($this->w2, $this->e,$y, $and[$i][$j+1]);
            $tetha=$this->Tetha0($this->tetha,$this->e, $y);
        
            $i=0;
            }
        
            if($iteraciones==1000){
              $validar=false;
            break;
            }
        

            $iteraciones++;
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
