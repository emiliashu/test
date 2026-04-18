<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
</head>
<body>
  <h5>Первое задание</h5>
<?php echo strtoupper('php'). "<br>";?>

<h5>Второе задание</h5>
<?php echo strtoupper('london'). "<br>";?>

<h5>Третье задание</h5>
<?php echo lcfirst('London'). "<br>";?>

<h5>Четвертое задание</h5>
<?php echo strlen('html css php'). "<br>";?>

<h5>Пятое задание</h5>
<?php 
$password = "parol";
$h=strlen($password);
if($h > 5 and $h<10){
  echo('Пароль подходит');
}
else{
  echo('Придумайте другой пароль');
} "<br>";
?>

<h5>Шестое задание</h5>
<?php $stroka="mon.png";
if (substr($stroka, -3) == 'png') {
    echo 'да';
} else {
    echo 'нет';
}
"<br>";?>

<h5>Седьмое задание</h5>
<?php echo str_replace('.', '-', '31.12.2013'). "<br>";?>

<h5>Восьмое задание</h5>
<?php 
$str = 'acdebccd';
echo str_replace(['a', 'b', 'c'], [1, 2, 3], $str). "<br>";?>

<h5>Девятое задание</h5>
<?php 
$stri ='fft6ggrd4ybuu866';
$num =[0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
echo str_replace($num, "", $stri). "<br>";?>

<h5>Десятое задание</h5>
<?php 
echo strpos ('abc abc abc', 'b'). "<br>";?>

<h5>Одиннадцатое задание</h5>
<?php echo strrpos('abc abc abc', 'b'). "<br>";?>
</body>
</html>
