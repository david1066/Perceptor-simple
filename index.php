<?php

if($_POST['BtnCalcular']){
    $w1=$_POST['w1'];
    $w2=$_POST['w2'];
    $tetha=$_POST['tetha'];
    $e=$_POST['e'];
    $y=Y($w1,$w2,$tetha);

}

function Y($w1,$w2,$tetha){

return tanh($w1*$x1+$w2*$x2-($tetha));


}



?>
