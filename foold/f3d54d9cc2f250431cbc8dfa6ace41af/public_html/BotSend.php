<?
    require ('vendor/autoload.php'); //Подключаем библиотеку
    use Telegram\Bot\Api; 
    $telegram = new Api("TOKEN");
    $_SESSION['mainMessage'] = "myMain(4,'Уведомления','notifyAdmin');";
    if($_FILES['img']['tmp_name']) {
        $nameImg = strtotime(date("Y-m-d H:i:s"));
        if($_FILES['img']['type'] == 'image/png'){
            if($_FILES['img']['size'] > 30000000) MessageSend('Ошибка','Размер изображения слишком большой','error');
            $Image_2 = imagecreatefrompng($_FILES['img']['tmp_name']);
            $Size_2 = getimagesize($_FILES['img']['tmp_name']);
            $Tmp_2 = imagecreatetruecolor($Size_2[0], $Size_2[1]);
            imagealphablending($Tmp_2, false);
            imagesavealpha($Tmp_2, true);
            imagecopyresampled($Tmp_2, $Image_2, 0, 0, 0, 0, $Size_2[0], $Size_2[1], $Size_2[0], $Size_2[1]);
            header("Content-Type: image/png");
            $Download_2 = 'assets/img/bot/'.$nameImg;
            imagepng($Tmp_2, $Download_2.'.png');
            imagedestroy($Image_2);
            imagedestroy($Tmp_2);
        }else{
            MessageSend('Ошибка','Неверный формат изображения','error');
        }
    }
    $text = $_POST['text'];
    $rec1 = mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `tl_id` != ''");
    while($rec = mysqli_fetch_assoc($rec1)){
        $reply = $text;
        if($rec['ID']){
            if($_FILES['img']['tmp_name']){
                $url = "https://fxmonster.space/assets/img/bot/".$nameImg.".png";
                $telegram->sendPhoto([ 'chat_id' => $rec['tl_id'], 'photo' => $url, 'caption' => $reply]);
            }else{
                $telegram->sendMessage([ 'chat_id' => $rec['tl_id'], 'text' => $reply]);
            }
        }
    }
    echo 'ok';
    MessageSend('Успешно','Рассылка отправлена','success');
?>