<?
if($Module == 'red'){
    mysqli_query($CONNECT, "UPDATE `product` SET `name` = '$_POST[name]' WHERE `id` = $_POST[id]");
    mysqli_query($CONNECT, "UPDATE `product` SET `about` = '$_POST[about]' WHERE `id` = $_POST[id]");
    mysqli_query($CONNECT, "UPDATE `product` SET `statistik` = '$_POST[statistik]' WHERE `id` = $_POST[id]");
    mysqli_query($CONNECT, "UPDATE `product` SET `paymant` = $_POST[paymant] WHERE `id` = $_POST[id]");
    mysqli_query($CONNECT, "UPDATE `product` SET `type` = $_POST[type] WHERE `id` = $_POST[id]");
    mysqli_query($CONNECT, "UPDATE `product` SET `_index` = $_POST[index] WHERE `id` = $_POST[id]");
    mysqli_query($CONNECT, "UPDATE `product` SET `amount` = '$_POST[amount]' WHERE `id` = $_POST[id]");
    mysqli_query($CONNECT, "UPDATE `product` SET `award` = '$_POST[award]' WHERE `id` = $_POST[id]");
    if($_FILES['img']['tmp_name']) {
        if($_FILES['img']['type'] == 'image/png'){
            if($_FILES['img']['size'] > 30000000) MessageSend('Ошибка','Размер изображения слишком большой','error');
            $Image_2 = imagecreatefrompng($_FILES['img']['tmp_name']);
            $Size_2 = getimagesize($_FILES['img']['tmp_name']);
            $Tmp_2 = imagecreatetruecolor($Size_2[0], $Size_2[1]);
            imagealphablending($Tmp_2, false);
            imagesavealpha($Tmp_2, true);
            imagecopyresampled($Tmp_2, $Image_2, 0, 0, 0, 0, $Size_2[0], $Size_2[1], $Size_2[0], $Size_2[1]);
            header("Content-Type: image/png");
            $Del_2 = 'assets/img/product/'.$_POST['id'].'.png';
            unlink($Del_2);
            $Download_2 = 'assets/img/product/'.$_POST['id'];
            imagepng($Tmp_2, $Download_2.'.png');
            imagedestroy($Image_2);
            imagedestroy($Tmp_2);
        }else{
            MessageSend('Ошибка','Неверный формат изображения','error');
        }
    }
    $_SESSION['mainMessage'] = "myMain(5,'Программы','programAdmin');";
    MessageSend('Успешно','Изменения сохранены','success');
}else if($Module == 'new'){
    mysqli_query($CONNECT, "INSERT INTO `product` (`id`, `name`, `about`, `paymant`, `amount`, `award`, `_index`, `type`, `konkurs`, `statistik`) VALUES (NULL, '$_POST[name]', '$_POST[about]', '$_POST[paymant]', '$_POST[amount]', '$_POST[award]', '$_POST[index]', '$_POST[type]','','$_POST[statistik]')");
    $pos = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `product` ORDER BY `id` DESC LIMIT 1"));
    if($_FILES['img']['tmp_name']) {
        if($_FILES['img']['type'] == 'image/png'){
            if($_FILES['img']['size'] > 30000000) MessageSend('Ошибка','Размер изображения слишком большой','error');
            $Image_2 = imagecreatefrompng($_FILES['img']['tmp_name']);
            $Size_2 = getimagesize($_FILES['img']['tmp_name']);
            $Tmp_2 = imagecreatetruecolor($Size_2[0], $Size_2[1]);
            imagealphablending($Tmp_2, false);
            imagesavealpha($Tmp_2, true);
            imagecopyresampled($Tmp_2, $Image_2, 0, 0, 0, 0, $Size_2[0], $Size_2[1], $Size_2[0], $Size_2[1]);
            header("Content-Type: image/png");
            $Del_2 = 'assets/img/product/'.$pos['id'].'.png';
            unlink($Del_2);
            $Download_2 = 'assets/img/product/'.$pos['id'];
            imagepng($Tmp_2, $Download_2.'.png');
            imagedestroy($Image_2);
            imagedestroy($Tmp_2);
        }else{
            MessageSend('Ошибка','Неверный формат изображения','error');
        }
    }
    $_SESSION['mainMessage'] = "myMain(5,'Программы','programAdmin');";
    MessageSend('Успешно','Продукт создан','success');
}