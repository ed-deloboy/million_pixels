<?
if($Module == 'avatar'){
    if($_FILES['avatar']['tmp_name']) {
        if($_FILES['avatar']['type'] == 'image/jpeg'){
            if($_FILES['avatar']['size'] > 30000000) MessageSend('Ошибка','Размер изображения слишком большой','error');
            $Image = imagecreatefromjpeg($_FILES['avatar']['tmp_name']);
            $Size = getimagesize($_FILES['avatar']['tmp_name']);
            $Tmp = imagecreatetruecolor($Size[0], $Size[1]);
            imagecopyresampled($Tmp, $Image, 0, 0, 0, 0, $Size[0], $Size[1], $Size[0], $Size[1]);
            if($user['avatar'] == 0){
                $Files = glob ('assets/img/avatar/*', GLOB_ONLYDIR);
                foreach($Files as $Num => $Dir) {
                    $Num ++;
                    $Count = sizeof(glob($Dir.'/*.*'));
                    if ($Count < 250) {
                        $Download = $Dir.'/'.$_SESSION['USER_ID'];
                        $user['avatar'] = $Num;
                        mysqli_query($CONNECT, "UPDATE `wp_users` SET `avatar` = $Num WHERE `ID` = $_SESSION[USER_ID]");
                        break;
                    }
                }
            }else{
                $Del = 'assets/img/avatar/'.$user['avatar'].'/'.$_SESSION['USER_ID'].'.jpg';
                unlink($Del);
                $Download = 'assets/img/avatar/'.$user['avatar'].'/'.$_SESSION['USER_ID'];
            }
            mysqli_query($CONNECT, "UPDATE `wp_users` SET `avatar_f` = 'jpg' WHERE `ID` = $_SESSION[USER_ID]");
            imagejpeg($Tmp, $Download.'.jpg');
            imagedestroy($Image);
            imagedestroy($Tmp);
        }else if($_FILES['avatar']['type'] == 'image/png'){
            if($_FILES['avatar']['size'] > 30000000) MessageSend('Ошибка','Размер изображения слишком большой','error');
            $Image_2 = imagecreatefrompng($_FILES['avatar']['tmp_name']);
            $Size_2 = getimagesize($_FILES['avatar']['tmp_name']);
            $Tmp_2 = imagecreatetruecolor($Size_2[0], $Size_2[1]);
            imagealphablending($Tmp_2, false);
            imagesavealpha($Tmp_2, true);
            imagecopyresampled($Tmp_2, $Image_2, 0, 0, 0, 0, $Size_2[0], $Size_2[1], $Size_2[0], $Size_2[1]);
            header("Content-Type: image/png");
            if(!$user['avatar']){
                $Files_2 = glob ('assets/img/avatar/*', GLOB_ONLYDIR);
                foreach($Files_2 as $Num_2 => $Dir_2) {
                    $Num_2 ++;
                    $Count_2 = sizeof(glob($Dir_2.'/*.*'));
                    if ($Count < 250) {
                        $Download_2 = $Dir_2.'/'.$_SESSION['USER_ID'];
                        $user['avatar'] = $Num_2;
                        mysqli_query($CONNECT, "UPDATE `wp_users` SET `avatar` = $Num_2 WHERE `ID` = $_SESSION[USER_ID]");
                        break;
                    }
                }
            }else{
                $Del_2 = 'assets/img/avatar/'.$user['avatar'].'/'.$_SESSION['USER_ID'].'.png';
                unlink($Del_2);
                $Download_2 = 'assets/img/avatar/'.$user['avatar'].'/'.$_SESSION['USER_ID'];
            }
            mysqli_query($CONNECT, "UPDATE `wp_users` SET `avatar_f` = 'png' WHERE `ID` = $_SESSION[USER_ID]");
            imagepng($Tmp_2, $Download_2.'.png');
            imagedestroy($Image_2);
            imagedestroy($Tmp_2);
        }else{
            MessageSend('Ошибка','Неверный формат изображения','error');
        }
    }
    $_SESSION['mainMessage'] = "myMain(2,'Профиль','profile');";
    MessageSend('Успешно','Аватар загружен','success');
}
if($Module == 'baseInfo'){
    $infoFirstName = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'first_name'"));
    if($infoFirstName['user_id']){
        mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[first_name]' WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'first_name'");
    }else{
        mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$_SESSION[USER_ID]', 'first_name', '$_POST[first_name]')");
    }
    $infoLastName = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'last_name'"));
    if($infoLastName['user_id']){
        mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[last_name]' WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'last_name'");
    }else{
        mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$_SESSION[USER_ID]', 'last_name', '$_POST[last_name]')");
    }
    if($_POST['email'] != ''){
        $nalEmail = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'billing_email' AND `meta_value` = '$_POST[email]'"));
        if($nalEmail['meta_value'] and $nalEmail['user_id'] != $_SESSION['USER_ID']){
            echo "<script>message('Ошибка','Email уже используется','error');</script>";
            exit();
        }
        $infoEmail = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'billing_email'"));
        if($infoEmail['user_id']){
            mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[email]' WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'billing_email'");
        }else{
            mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$_SESSION[USER_ID]', 'billing_email', '$_POST[email]')");
        }
    }
    $nalPhone = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'ud_phone' AND `meta_value` = '$_POST[phone]'"));
    if($nalPhone['meta_value'] and $nalPhone['user_id'] != $_SESSION['USER_ID'] and $_POST['phone'] != ''){
        echo "<script>message('Ошибка','Телефон уже используется','error');</script>";
        exit();
    }
    $infoPhone = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'ud_phone'"));
    if($infoPhone['user_id']){
        mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[phone]' WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'ud_phone'");
    }else{
        mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$_SESSION[USER_ID]', 'ud_phone', '$_POST[phone]')");
    }
    echo "<script>message('Успешно','Данные изменены','success');</script>";
}
if($Module == 'socialInfo'){
    $_POST['tg'] = str_replace('@','',$_POST['tg']);
    $nalTg = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'ud_tg' AND `meta_value` = '$_POST[tg]'"));
    if($nalTg['meta_value'] and $nalTg['user_id'] != $_SESSION['USER_ID'] and $_POST['tg'] != ''){
        echo "<script>message('Ошибка','Логин телеграм уже используется','error');</script>";
        exit();
    }
    $infoTg = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'ud_tg'"));
    if($infoTg['user_id']){
        mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[tg]' WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'ud_tg'");
    }else{
        mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$_SESSION[USER_ID]', 'ud_tg', '$_POST[tg]')");
    }
    $nalVk = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'ud_vk' AND `meta_value` = '$_POST[vk]'"));
    if($nalVk['meta_value'] and $nalVk['user_id'] != $_SESSION['USER_ID'] and $_POST['vk'] != ''){
        echo "<script>message('Ошибка','Аккаунт ВК уже используется','error');</script>";
        exit();
    }
    $infoVk = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'ud_vk'"));
    if($infoVk['user_id']){
        mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[vk]' WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'ud_vk'");
    }else{
        mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$_SESSION[USER_ID]', 'ud_vk', '$_POST[vk]')");
    }
    $nalWa = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'ud_wa' AND `meta_value` = '$_POST[wa]'"));
    if($nalWa['meta_value'] and $nalWa['user_id'] != $_SESSION['USER_ID'] and $_POST['wa'] != ''){
        echo "<script>message('Ошибка','Аккаунт Whatsapp уже используется','error');</script>";
        exit();
    }
    $infoWa = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'ud_wa'"));
    if($infoWa['user_id']){
        mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[wa]' WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'ud_wa'");
    }else{
        mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$_SESSION[USER_ID]', 'ud_wa', '$_POST[wa]')");
    }
    $nalVb = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'ud_vb' AND `meta_value` = '$_POST[vb]'"));
    if($nalVb['meta_value'] and $nalVb['user_id'] != $_SESSION['USER_ID'] and $_POST['vb'] != ''){
        echo "<script>message('Ошибка','Аккаунт Viber уже используется','error');</script>";
        exit();
    }
    $infoVb = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'ud_vb'"));
    if($infoVb['user_id']){
        mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[vb]' WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'ud_vb'");
    }else{
        mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$_SESSION[USER_ID]', 'ud_vb', '$_POST[vb]')");
    }
    echo "<script>message('Успешно','Данные изменены','success');</script>";
}
if($Module == 'notyInfo'){
    if($_POST['tgReg'] != ''){
        $tgReg = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'tgReg'"));
        if($tgReg['user_id']){
            mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[tgReg]' WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'tgReg'");
        }else{
            mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$_SESSION[USER_ID]', 'tgReg', '$_POST[tgReg]')");
        }
    }
    if($_POST['mailReg'] != ''){
        $mailReg = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'mailReg'"));
        if($mailReg['user_id']){
            mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[mailReg]' WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'mailReg'");
        }else{
            mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$_SESSION[USER_ID]', 'mailReg', '$_POST[mailReg]')");
        }
    }
    if($_POST['tgFin'] != ''){
        $tgFin = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'tgFin'"));
        if($tgFin['user_id']){
            mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[tgFin]' WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'tgFin'");
        }else{
            mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$_SESSION[USER_ID]', 'tgFin', '$_POST[tgFin]')");
        }
    }
    if($_POST['mailFin'] != ''){
        $mailFin = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'mailFin'"));
        if($mailFin['user_id']){
            mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[mailFin]' WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'mailFin'");
        }else{
            mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$_SESSION[USER_ID]', 'mailFin', '$_POST[mailFin]')");
        }
    }
    if($_POST['tgNews'] != ''){
        $tgNews = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'tgNews'"));
        if($tgNews['user_id']){
            mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[tgNews]' WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'tgNews'");
        }else{
            mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$_SESSION[USER_ID]', 'tgNews', '$_POST[tgNews]')");
        }
    }
    if($_POST['mailNews'] != ''){
        $mailNews = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'mailNews'"));
        if($mailNews['user_id']){
            mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[mailNews]' WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'mailNews'");
        }else{
            mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$_SESSION[USER_ID]', 'mailNews', '$_POST[mailNews]')");
        }
    }
    if($_POST['tgLogin'] != ''){
        $tgLogin = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'tgLogin'"));
        if($tgLogin['user_id']){
            mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[tgLogin]' WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'tgLogin'");
        }else{
            mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$_SESSION[USER_ID]', 'tgLogin', '$_POST[tgLogin]')");
        }
    }
    if($_POST['mailLogin'] != ''){
        $mailLogin = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'mailLogin'"));
        if($mailLogin['user_id']){
            mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[mailLogin]' WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'mailLogin'");
        }else{
            mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$_SESSION[USER_ID]', 'mailLogin', '$_POST[mailLogin]')");
        }
    }
    if($_POST['tgPromo'] != ''){
        $tgPromo = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'tgPromo'"));
        if($tgPromo['user_id']){
            mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[tgPromo]' WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'tgPromo'");
        }else{
            mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$_SESSION[USER_ID]', 'tgPromo', '$_POST[tgPromo]')");
        }
    }
    if($_POST['mailPromo'] != ''){
        $mailPromo = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'mailPromo'"));
        if($mailPromo['user_id']){
            mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[mailPromo]' WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'mailPromo'");
        }else{
            mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$_SESSION[USER_ID]', 'mailPromo', '$_POST[mailPromo]')");
        }
    }
    if($_POST['tgPod'] != ''){
        $tgPod = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'tgPod'"));
        if($tgPod['user_id']){
            mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[tgPod]' WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'tgPod'");
        }else{
            mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$_SESSION[USER_ID]', 'tgPod', '$_POST[tgPod]')");
        }
    }
    if($_POST['mailPod'] != ''){
        $mailPod = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'mailPod'"));
        if($mailPod['user_id']){
            mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[mailPod]' WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'mailPod'");
        }else{
            mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$_SESSION[USER_ID]', 'mailPod', '$_POST[mailPod]')");
        }
    }
    if($_POST['secretPhone'] != ''){
        $secretPhone = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'secretPhone'"));
        if($secretPhone['user_id']){
            mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[secretPhone]' WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'secretPhone'");
        }else{
            mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$_SESSION[USER_ID]', 'secretPhone', '$_POST[secretPhone]')");
        }
    }
    if($_POST['secretEmail'] != ''){
        $secretEmail = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'secretEmail'"));
        if($secretEmail['user_id']){
            mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[secretEmail]' WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'secretEmail'");
        }else{
            mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$_SESSION[USER_ID]', 'secretEmail', '$_POST[secretEmail]')");
        }
    }
    if($_POST['secretTg'] != ''){
        $secretTg = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'secretTg'"));
        if($secretTg['user_id']){
            mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[secretTg]' WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'secretTg'");
        }else{
            mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$_SESSION[USER_ID]', 'secretTg', '$_POST[secretTg]')");
        }
    }
    if($_POST['secretVk'] != ''){
        $secretVk = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'secretVk'"));
        if($secretVk['user_id']){
            mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[secretVk]' WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'secretVk'");
        }else{
            mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$_SESSION[USER_ID]', 'secretVk', '$_POST[secretVk]')");
        }
    }
    if($_POST['secretWa'] != ''){
        $secretWa = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'secretWa'"));
        if($secretWa['user_id']){
            mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[secretWa]' WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'secretWa'");
        }else{
            mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$_SESSION[USER_ID]', 'secretWa', '$_POST[secretWa]')");
        }
    }
    if($_POST['secretVb'] != ''){
        $secretVb = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'secretVb'"));
        if($secretVb['user_id']){
            mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[secretVb]' WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'secretVb'");
        }else{
            mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$_SESSION[USER_ID]', 'secretVb', '$_POST[secretVb]')");
        }
    }
}
if($Module == 'new_password'){
    if($_POST['new_password'] != ''){
        $new_pass = wp_hash_password($_POST['new_password']);
        mysqli_query($CONNECT, "UPDATE `wp_users` SET `user_pass` = '$new_pass' WHERE `ID` = $_SESSION[USER_ID]");
        echo "<script>message('Успешно','Пароль обновлен','success');</script>";
    }else{
        echo "<script>message('Ошибка','Пароль не указан','error');</script>";
    }
}