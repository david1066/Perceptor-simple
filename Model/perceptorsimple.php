<?php
require '../datafactory.php';

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

      $validar='';
        //conexion base de datos
        $db = new DatabaseFactory();
        $conexion = $db->getDatabase();
        //consulta a la base de datos
        $query = $conexion->executeQuery('SELECT * FROM Entrenamiento ');

          
        $iteraciones = 0;

        
     
        while ($Entrenamiento = $conexion->fetchArray($query)) {
            
            $y = 0;
            $y = tanh($this->w1 * $Entrenamiento['x1'] + $this->w2 * $Entrenamiento['x2'] - ($this->tetha));
          


            if ($y >= $this->tetha) {
                $y = 1;
            } else {
                $y = -1;
            }
            $validar.=$y.' ::: '.$Entrenamiento['Cand'].',';
            if ($y != $Entrenamiento['Cand']) {

                $this->w1 =$this-> W0($this->w1, $this->e, $y, $Entrenamiento['x1']);
                $this->w2 = $this->W0($this->w2, $this->e, $y, $Entrenamiento['x2']);
                $this->tetha = $this->Tetha0($this->tetha, $this->e, $y);
                $validar.='diferente';
                
                

            }
      
            if ($iteraciones == 1000) {

               $validar.= 'NO SE ENCONTR 1000';

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
