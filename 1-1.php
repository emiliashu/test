<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
</head>
<body>
  <h5>Первое задание</h5>
<?php
$moon=20;
$sun="солнце";
$saturn=91.87;
$star=true;
$rain = [2, 4, 5];

echo "Тип первой переменной: " . gettype($moon) . "<br>";
echo "Тип второй переменной: " . gettype($sun) . "<br>";
echo"Тип первой переменной: " . gettype($saturn) . "<br>";
echo"Тип первой переменной: " . gettype($star) . "<br>";
echo"Тип первой переменной: " . gettype($rain) . "<br>";
?>

<h5>Второе задание</h5>
<?php
$ch1=77884;
$ch2=246;
$res1=$ch1+$ch2;
$res2=$ch1*$ch2;
echo "Сложение: " . $res1 . "<br>";
echo "Умножение: " . $res2 . "<br>";
?>

<h5>Третье задание</h5>
<?php
$a= "cat";
$b= "dog" ;
echo "Объединение слов: " . $a.$b . "<br>";
?>

<h5>Четвертое задание</h5>
<?php
$c= 17;
$g= 71;
$result= ($c == $g ? "да": "Нет");
echo "Значения " . $c . ' и '. $g. "<br>";
echo "Одинаковое значение: " . $result . "<br><br>\n";


$l= 71;
$p= 71;
$result2= ($l == $p ? "Да": "Нет");
echo "Значения " . $l . ' и '. $p. "<br>";
echo "Одинаковое значение: " . $result2 . "<br><br>\n";

$o= 71;
$m= "car";
$result3= ($o == $m ? "Да": "Нет");
echo "Значения " . $o . ' и '. $m. "<br>";
echo "Одинаковое значение: " . $result3 . "<br>";
?>
</body>
</html>
