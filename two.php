
<!DOCTYPE html>
<html>
<head>
    <title>Задание 2</title>
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
<form method="post" action="two.php">
    <p>Текст для задания 2<Br>
        <textarea name="text" cols="40" rows="3"></textarea></p>
    <p><input type="submit" value="Отправить">
</form>
<?php
header('Content-Type: text/html; charset=utf-8');

if (!empty($_POST)) {
   $text = $_POST["text"];
   // $textRev = strrev($text);
    $textRev = '';
    for ($i = mb_strlen($text);$i>=0;$i--) {
        $textRev.= mb_substr($text,$i,1);
    }
//    foreach (str_split($text) as $item){
//        $t = $item;
//        $t.=$textRev;
//        $textRev = $t;
//        echo $t;
//    }
   echo 'Текст наоборот <br>'. $textRev;

}
?>
</body>
</html>