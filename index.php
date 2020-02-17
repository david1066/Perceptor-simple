<?php
$w1=0;
$w2=0;
$tetha=0;


if(isset($_POST['BtnCalcular'])){
    $w1=$_POST['w1'];
    $w2=$_POST['w2'];
    $tetha=$_POST['tetha'];
    $e=$_POST['e'];
    $validar=Y($w1,$w2,$tetha,$e);

    if($validar){
        echo 'Si se encontro Solución con los Parametros';
        echo 'W1:'.$w1.' W2:'.$w2.' Tetha:'.$tetha.' e:'.$e; 
    }

}

function Y($w1,$w2,$tetha,$e){

    $matriz = array( array( -1,-1, -1 ), array( -1, 1, -1 ), array( 1, -1, -1 ), array( 1, 1, 1 ));

$nfil = count($matriz);


$i = 0;

$iteraciones=0;

$validar =true;
while ( $i < $nfil ) {
    $j = 0;
    $y=0;

    $y=tanh($w1*$matriz[$i][$j]+$w2*$matriz[$i][$j+1]-($tetha));
   /* echo $y;*/
    if($y>=$tetha){
        $y=1;
    }else{
        $y=-1;
    }

    if($y!=$matriz[$i][$j+2]){
       
  /*  echo 'diferente';*/
    $w1=w0($w1, $e,$y, $matriz[$i][$j]);
    $w2=w0($w2, $e,$y, $matriz[$i][$j+1]);
    $tetha=tetha0($tetha,$e, $y);
   
    $i=0;
    }

    if($iteraciones==1000){
        echo 'No se encontro Solucion en la 1000 iteraciones';
        $validar=false;
    break;
    }

    $iteraciones++;

    /*echo 'y'.$y;
	echo "<br />";*/
	$i++;
}

return $validar;


}

function w0($w, $e,$y, $x){
$wi=$w+2*$e*$y*$x;
return $wi;
}
function tetha0($tetha,$e, $y){
    $tethai=$tetha+2*$e*$y*(-1);
    return $tethai;
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


<div class="container " >

<form action="index.php" method="POST">
    <h1 class="text-center">Perceptor Simple</h1>
    <br>
    <br>
<div class="row justify-content-md-center"> 

<label class="col-sm-2 label">W1</label>
<div class="col-sm-2">
    <input name="w1" value="<?php if(isset($_POST['w1'])){
        echo $_POST['w1'];
    } ?>" type="Text" class="form-control">
</div>
<label class="col-sm-2 label">W2</label>
<div class="col-sm-2">
    <input  value="<?php if(isset($_POST['w2'])){
        echo $_POST['w2'];
    } ?>" name="w2" type="Text" class="form-control">
</div>

</div>
<br>
<div class="row justify-content-md-center">
<label class="col-sm-2 label">ERROR &theta;</label>
<div class="col-sm-2">
    <input name="tetha"  value="<?php if(isset($_POST['tetha'])){
        echo $_POST['tetha'];
    } ?>" type="Text" class="form-control">
</div>
<label class="col-sm-2 label">Factor de Aprendizaje </label>
<div class="col-sm-2">
    <input name="e" value="<?php if(isset($_POST['e'])){
        echo $_POST['e'];
    } ?>" type="Text" class="form-control">
</div>
</div>
<br>
<div class="row justify-content-md-center">
<input type="submit" name="BtnCalcular" value="Calcular" class="btn btn-success" >


</div>


</form>

</div>
    
</body>
</html>