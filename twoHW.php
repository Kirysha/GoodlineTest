<?php
$pdo = new PDO("mysql:host=localhost;dbname=my_db;charset=utf8;","test", "test");
function addToTable1 ()
{
        global $pdo;

    $arr_ru = ['а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ь', 'ы', 'ъ', 'э', 'ю', 'я'];
    $arr_RU = ['А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ь', 'Ы', 'Ъ', 'Э', 'Ю', 'Я'];

    $sql = "INSERT INTO users (name, age) VALUES (:name, :age)";
    $stmt = $pdo->prepare($sql);
    for ($i = 0; $i<1000; $i++) {
        $name=$arr_RU[rand(0, count($arr_RU)-1)];
        for ($j = 0; $j <= rand(5,10); $j++){
            $name.= $arr_ru[rand(0, count($arr_ru)-1)];
        }
        $age = rand(10, 100);
        $name = ucfirst($name);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':age', $age);
        $stmt->execute();
    }

};

function getWhereAge2 (){ // задание 2
    global $pdo;
    $arr = $pdo ->query('SELECT * FROM `users` WHERE `age` > 50') ->fetchAll();
    return $arr;
}

function getLike3 (){ // задание 3
    global $pdo;
    $arr = $pdo ->query("SELECT * FROM `users` WHERE `name` LIKE '%ав%' OR `name` LIKE '%аб%'")->fetchAll();
    return json_encode($arr);
}

function getWhereAgeAndUpdate4 (){ // задание 2
    global $pdo;
    $arr = [];
    $stmt = $pdo ->query('SELECT * FROM `users` WHERE `age` > 70');
    $sql = "UPDATE `users` SET `name` = :name WHERE `users`.`id` = :id ";
    $stmt2 = $pdo->prepare($sql);
    while ($row = $stmt->fetch())
    {
        array_push($arr,$row);
        $name = "Pepeto";
        $stmt2->bindParam(':name', $name);
        $stmt2->bindParam(':id', $row['id']);
        $stmt2->execute();
    }

    return $arr;
}

function getDistinct5(){ // задание 2
    global $pdo;
    $arr = $pdo ->query("SELECT DISTINCT name FROM `users`") ->fetchAll();
    return $arr;
}
function getDistinct5_2(){ // задание 2
    global $pdo;
    $arr = $pdo ->query("SELECT DISTINCT name FROM `users`") ->fetchAll();
    foreach ($arr as $res){
        echo $res[0] . "\n";
    }
    return $arr;
}
//addToTable1();
//print_r(getWhereAge2());
//print_r( getLike3());
//print_r(getWhereAgeAndUpdate4());
//print_r(getDistinct5());
getDistinct5_2();