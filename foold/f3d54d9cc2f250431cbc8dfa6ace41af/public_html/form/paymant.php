<?
$product = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `product` WHERE `id` = $Module"));

$date = date('Y-m-d H:i:s');
if($product['paymant'] == 1){
    $type = 'Покупка';
    $amount = $product['amount'];
}else if($product['paymant'] == 2){
    $type = 'Рассрочка';
    if($_POST['period'] == 1) $amount = $product['amount']/2;
    else $amount = $product['amount']/4;
}else{
    $type = 'Аренда';
    $amount = $product['amount'];
}
if($_POST['promoAccount']){
    $promo = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `promokod` WHERE `kod` = '$_POST[promoAccount]'"));
    if(!$promo['id']) MessageSend('Ошибка','Такой промокод не существует','error');
    else{
        $amount = $amount-$promo['amount'];
        $award = 0;
        $konkurs = 1;
        $det = ' (Конкурсный)';
        mysqli_query($CONNECT, " DELETE FROM `promokod` WHERE `kod` = '$_POST[promoAccount]'");
    } 
}else{
    $award = $amount*($product['award']/$product['amount']);
    $konkurs = 0;
    $det = '';
}
$details = $type.' '.$product['name'].$det;
mysqli_query($CONNECT, "INSERT INTO `wp_woo_wallet_transactions` (`transaction_id`, `blog_id`, `user_id`, `type`, `amount`, `balance`, `currency`, `details`, `created_by`, `deleted`, `date`, `Account`, `award`, `konkurs`) VALUES (NULL, '2', '$_SESSION[USER_ID]', 'paymant', '$amount', '', '', '$details', '1', '0', '$date', '$_POST[torgAccount]', '$award', '$konkurs')");
$lastOrder = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_woo_wallet_transactions` ORDER BY `transaction_id` DESC LIMIT 1"));
    if($_FILES['order']['tmp_name']) {
        if($_FILES['order']['type'] == 'image/jpeg'){
            if($_FILES['order']['size'] > 30000000) MessageSend('Ошибка','Размер изображения слишком большой','error');
            $Image = imagecreatefromjpeg($_FILES['order']['tmp_name']);
            $Size = getimagesize($_FILES['order']['tmp_name']);
            $Tmp = imagecreatetruecolor($Size[0], $Size[1]);
            imagecopyresampled($Tmp, $Image, 0, 0, 0, 0, $Size[0], $Size[1], $Size[0], $Size[1]);
            $Del = 'assets/img/order/'.$lastOrder['transaction_id'].'.jpg';
            unlink($Del);
            $Download = 'assets/img/order/'.$lastOrder['transaction_id'];
            imagejpeg($Tmp, $Download.'.jpg');
            imagedestroy($Image);
            imagedestroy($Tmp);
            mysqli_query($CONNECT, "UPDATE `wp_woo_wallet_transactions` SET `created_by` = 1 WHERE `transaction_id` = $lastOrder[transaction_id]");
        }else if($_FILES['order']['type'] == 'image/png'){
            if($_FILES['order']['size'] > 30000000) MessageSend('Ошибка','Размер изображения слишком большой','error');
            $Image_2 = imagecreatefrompng($_FILES['order']['tmp_name']);
            $Size_2 = getimagesize($_FILES['order']['tmp_name']);
            $Tmp_2 = imagecreatetruecolor($Size_2[0], $Size_2[1]);
            imagealphablending($Tmp_2, false);
            imagesavealpha($Tmp_2, true);
            imagecopyresampled($Tmp_2, $Image_2, 0, 0, 0, 0, $Size_2[0], $Size_2[1], $Size_2[0], $Size_2[1]);
            header("Content-Type: image/png");
            $Del_2 = 'assets/img/order/'.$lastOrder['transaction_id'].'.png';
            unlink($Del_2);
            $Download_2 = 'assets/img/order/'.$lastOrder['transaction_id'];
            imagepng($Tmp_2, $Download_2.'.png');
            imagedestroy($Image_2);
            imagedestroy($Tmp_2);
            mysqli_query($CONNECT, "UPDATE `wp_woo_wallet_transactions` SET `created_by` = 2 WHERE `transaction_id` = $lastOrder[transaction_id]");
                        
        }else{
            MessageSend('Ошибка','Неверный формат изображения','error');
        }
    }
    $error = mysqli_error($CONNECT);
    $us = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = $_SESSION[USER_ID]"));

    message_to_telegram("📛 Подтвердите оплату\r\n\r\n😎 Логин: ".$us['user_nicename']."\r\n✅ Сумма: ".$amount."рублей\r\n🤖 Покупка товара: ".$details,'1265026852');
    MessageSend('Успешно','Операция отправлена на подтверждение, за ее статусом можно посмотреть в разделе Финансы','success');
?>