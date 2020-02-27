<?php

require '../Llogica/perceptorsimple.php';
$w1=0;
$w2=0;
$tetha=0;



if(isset($_POST['BtnCalcular'])){
    $w1=mt_rand(0.1*10, 0.9*10)/10;
    $w2=mt_rand(0.1*10, 0.9*10)/10;
    $tetha=mt_rand(0.1*10, 0.9*10)/10;
   
    $e=0.1;

    $perceptor= new PerceptorSimple($w1,$w2,$e,$tetha);
    $validar= $perceptor->Calcular();
    

   if($validar){
        echo 'Si se encontro Solución con los Parametros';
        echo 'W1:'.$w1.' W2:'.$w2.' Tetha:'.$tetha.' e:'.$e; 
    }else{
        echo 'W1:'.$w1.' W2:'.$w2.' Tetha:'.$tetha.' e:'.$e; 
    }


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