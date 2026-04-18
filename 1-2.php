<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
</head>
<body>
  <h5>Первое задание</h5>
<?php
$age=18;
if ( 18 <= $age &&  $age <= 35){
    echo "Счастливчик!";
}
elseif (1 <= $age &&  $age <= 37){
    echo "Слишком молод";
}
else{
    echo "Не повезло(";
}
?>

<h5>Второе задание</h5>
<?php
$num = [];
for ($i = 2; $i <= 100; $i += 2) {
    $num[] = $i;
}
echo "Массив без чисел, не делящихся на 5:<br>";
for ($i = 0; $i < count($num); $i++) {
    if ($num[$i] % 5 == 0) {
        echo $num[$i] . "<br>";
    }
}
?>

<h5>Третье задание</h5>
<?php
$mas=[ "Name" => "мила", "Address" => "набержная мойки", "Phone" => "+7 (999) 999-00-00", "Mail" => "mila@mail.com"
];
foreach ($mas as $key => $value) {
    echo "$key: $value<br>";
}
?>
</body>
</html>
