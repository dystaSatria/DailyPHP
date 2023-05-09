<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practice_1</title>
</head>
<body>


Aradiginiz sey : <?php echo $_POST["ara"]; ?><br>
Metin : <br>
<?php echo $_POST["metin"]; ?><br>
Sonuc : <?php echo strpos( $_POST["metin"], $_POST["ara"]);?>

<?php
$pos = strpos( $_POST["metin"], $_POST["ara"]);
if ($pos < 3) {
    echo ("Tekrar deneyin");
} else {
    echo ("Sonuc :");
    echo strpos( $_POST["metin"], $_POST["ara"]);;
}
?>

</body>
</html>
........
