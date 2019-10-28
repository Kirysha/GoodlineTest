<?php
$mas = [];
for ($i = 0; $i<= 100000; $i++){
    $str = '';
    for ($j = 0; $j <= rand(1,20); $j++){
        if (rand(0,1)==0){
            $str.= '3';
        } else
        {
            $str.= '7';
        }
    }
    array_push($mas, $str);
}
$mas2 = [];

foreach ($mas as $res){
    $number = (int)$res;
    if ($number%3 ==0 && $number%7==0){
        $digits = preg_split('//', $number, -1, PREG_SPLIT_NO_EMPTY);
        if (in_array(3, $digits) && in_array(7, $digits)){
            if (array_sum($digits)%3==0 && array_sum($digits)%7==0){
                array_push($mas2, $number);
            }
        }
    }
}

$m = min($mas2);
echo 'Минимальное число '.$m.'<br>';
echo  $m.'/3='.$m/3 .'<br>';
echo  $m.'/7='.$m/7 .'<br>';
$d = preg_split('//', $m, -1, PREG_SPLIT_NO_EMPTY);
echo  array_sum($d).'/3='.array_sum($d)/3 .'<br>';
echo  array_sum($d).'/7='.array_sum($d)/7 .'<br>';


//print_r($mas);