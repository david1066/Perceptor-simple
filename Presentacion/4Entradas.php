<?php

require '../Llogica/perceptor4entradas.php';

$and = array();

$w1 = 7.63;
$w2 = 3.17;
$w3 = 0.4;
$w4 = 2.63;
$tetha = 0.7;
$e = 0.9;
$respuesta = '';


$perceptor = new Perceptor4($w1, $w2, $w3, $w4, $e, $tetha);

if (isset($_POST['BtnAprender'])) {
    //$w1=mt_rand(0.1*10, 0.9*10)/10;
    //$w2=mt_rand(0.1*10, 0.9*10)/10;
    //$tetha=mt_rand(0.1*10, 0.9*10)/10;

    $validar = $perceptor->Aprender();
    $i = 0;
/*

    while ($i != 15) {

        echo 'x1=' . $perceptor->andc[$i][0] . "x2=" . $perceptor->andc[$i][1] . "x3=" . $perceptor->andc[$i][2] . "x4=" . $perceptor->andc[$i][3] . "y=" . $perceptor->andc[$i][5] . "  #=" . $perceptor->andc[$i][6] . "<br>";
        $i++;
    }

*/

    if ($validar) {



        $display = "";
        $display2 = "display:none;";

        echo 'Si se encontro Solución con los Parametros';
        echo 'W1:' . $perceptor->w1 . ' W2:' . $perceptor->w2 . ' W3:' . $perceptor->w3 . ' W4:' . $perceptor->w4 . '  Tetha:' . $perceptor->tetha . ' e:' . $perceptor->e;
    } else {
        $display2 = "display:none;";
        $display = "display:none;";
        echo 'No se encontro solucion para W1:' . $w1 . ' W2:' . $w2 . ' W3:' . $w3 . '  W4:' . $w4 . ' Tetha:' . $tetha . ' e:' . $e;
    }
}

if (isset($_POST['BtnCalcular'])) {
    $i = 0;

    $respuesta = $y = tanh($w1 * $_POST['x1'] + $w2 * $_POST['x2'] + $w3 * $_POST['x3'] + $w4 * $_POST['x4'] - ($tetha));
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

        <form action="4Entradas.php" method="POST">
            <h1 class="text-center">Perceptor Simple</h1>
            <br>
            <br>
            <div class="row justify-content-md-center">

                <div class="row justify-content-md-center">
                    <input type="submit" styles="<?php echo $display2; ?>" name="BtnAprender" value="Aprender" class="btn btn-success">


                    <input type="submit" name="BtnCalcular" value="Calcular" class="btn btn-success">


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
                        <input type="text" value="<?php if (isset($_POST['x3'])) {
                                                        echo $_POST['x3'];
                                                    } ?>" name="x3">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" value="<?php if (isset($_POST['x4'])) {
                                                        echo $_POST['x4'];
                                                    } ?>" name="x4">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" name="and" value="<?= $respuesta ?>">
                    </div>





                </div>


        </form>

    </div>

</body>

</html>