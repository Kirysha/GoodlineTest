
<!DOCTYPE html>
<html>
<head>
    <title>Задание 3</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <link href="https://fonts.googleapis.com/css?family=Karla:400" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-weight: 100;
            font-family: 'Karla';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 96px;
        }

        .opt {
            margin-top: 30px;
        }

        .opt a {
            text-decoration: none;
            font-size: 150%;
        }

        a:hover {
            color: red;
        }
    </style>
</head>
<body>
<?php
header('Content-Type: text/html; charset=utf-8');

$mass = [1,1,1,1,'5',1,1,1,1,1];

$sum = 0;
for ($i = 0; $i < count($mass); $i++) {
    if (is_string($mass[$i])){
        echo '<br>Achtung! Achtung!';
        return;
    } else {
        $sum+= $mass[$i];
    }
    if ($i == 2) {
        echo '<br>Первые 3 числа '.$sum;
    }
    if ($i == 5)
    {
        echo  '<br>Первые 6 числа '.$sum;
    }

    if ($i==7) {
        echo '<br>Первые 8 числа '.$sum;
    }
}
//if (!empty($_POST)) {
//    $text = $_POST["text"];
//    // $textRev = strrev($text);
//    $mass = mb_split(",", $text);
//    $sum = 0;
//    for ($i=0;$i<=count($mass);$i++)
//    {
//        echo ' sum 1=';
//    }
//
//}
?>
</body>
</html>