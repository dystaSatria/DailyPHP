<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Number Guessing Game</title>
</head>
<body>
    
Your Guess : <?php echo $_POST["tahmin"]; ?>
<br><br>

<br><br>
<?php
$sayi= rand(1,100);
$tahmin= $_POST["tahmin"];

do {
    if ($tahmin < $sayi) {
    echo "Try Again. You must guess number more bigger " ;
    $content = file_get_contents('tahmin_oyunu.html');
    echo $content;
    break;
  } elseif ($tahmin > $sayi) {
    echo "Try Again. You must guess number smaller " ;
    $content = file_get_contents('tahmin_oyunu.html');
    echo $content;
    break;
  } else {
    echo "Bildiniz, TEBRİKLER!!" ;
    $content = file_get_contents('tahmin_oyunu.html');
    echo $content;
    break;
  }
} while ($tahmin != $sayi);


  

?>

</body>
</html>