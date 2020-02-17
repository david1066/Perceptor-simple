<?php
$w1=0;
$w2=0;
$tetha=0;


if(isset($_POST['BtnCalcular'])){
    $w1=$_POST['w1'];
    $w2=$_POST['w2'];
    $tetha=$_POST['tetha'];
    $e=$_POST['e'];
    $y=Y($w1,$w2,$tetha,$e);

}
Y(0.4,0.1,0.1,0);
function Y($w1,$w2,$tetha,$e){

    $matriz = array( array( -1,-1, -1 ), array( -1, 1, -1 ), array( 1, -1, -1 ), array( 1, 1, 1 ));

$nfil = count($matriz);


$i = 0;

$iteraciones=0;
while ( $i < $nfil ) {
    $j = 0;
    $y=0;

    $y=tanh($w1*$matriz[$i][$j]+$w2*$matriz[$i][$j+1]-($tetha));
    echo $y;
    if($y>=$tetha){
        $y=1;
    }else{
        $y=-1;
    }

    if($y!=$matriz[$i][$j+2]){
       
    echo 'diferente';
    $w1=w0($w1, $e,$y, $matriz[$i][$j]);
    $w2=w0($w2, $e,$y, $matriz[$i][$j+1]);
    $tetha=tetha0($tetha,$e, $y);
   
    $i=0;
    }

    if($iteraciones==1000){
        
    break;
    }

    $iteraciones++;

    echo 'y'.$y;
	echo "<br />";
	$i++;
}

return ;


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
