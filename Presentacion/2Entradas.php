<?php

require '../Llogica/perceptorsimple.php';

$and = array();

$w1 = 0.5;
$w2 = 0.2;
$tetha = 0.3;
$e = 0.2;
$respuesta = '';

$perceptor = new PerceptorSimple($w1, $w2, $e, $tetha);


if (isset($_POST['BtnAprender'])) {
    //$w1=mt_rand(0.1*10, 0.9*10)/10;
    //$w2=mt_rand(0.1*10, 0.9*10)/10;
    //$tetha=mt_rand(0.1*10, 0.9*10)/10;
    $validar = $perceptor->Aprender();


    if ($validar) {



        $display = "";
        $display2 = "display:none;";

        echo 'Si se encontro Solución con los Parametros';
        echo 'W1:' . $perceptor->w1 . ' W2:' . $perceptor->w2 . ' Tetha:' . $perceptor->tetha . ' e:' . $perceptor->e;
    } else {
        $display2 = "";
        $display = "display:none;";
        echo 'No se encontro solucion para W1:' . $w1 . ' W2:' . $w2 . ' Tetha:' . $tetha . ' e:' . $e;
    }
}

if (isset($_POST['BtnCalcular'])) {
    $i = 0;

    $validar = $perceptor->Aprender();

    $and = $perceptor->andc;


  
        //if ($and[$i][0] == $_POST['x1'] and  $and[$i][1] == $_POST['x2']) {
        

            $respuesta = $y=tanh($w1* $_POST['x1']+$w2* $_POST['x2']-($tetha));
            
       
        $i++;
    
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Perceptor Simple</title>

</head>

<body>


    <div class="container ">

        <form action="2Entradas.php" method="POST">
            <h1 class="text-center">Perceptor Simple</h1>
            <br>
            <br>
            <div class="row justify-content-md-center">

                <div class="row justify-content-md-center">
                    <input type="submit" styles="<?= $display2; ?>" name="BtnAprender" value="Aprender" class="btn btn-success">


                    <input type="submit" styles="<?=$display; ?>" name="BtnCalcular" value="Calcular" class="btn btn-success">


                </div>

                <div class="row justify-content-md-center">
                    <div class="col-sm-2">
                        <input type="text" value="<?php if (isset($_POST['x1'])) {
                                                        echo $_POST['x1'];
                                                    } ?>" name="x1">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" value="<?php if (isset($_POST['x2'])) {
                                                        echo $_POST['x2'];
                                                    } ?>" name="x2">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" name="and" value="<?= $respuesta ?>">
                    </div>





                </div>


        </form>

    </div>

</body>

</html>