<?
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
if($Module == 'login_in'){
    $Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `user_login` = '$_GET[login]'"));
    if($_GET['salt'] == md5($Row['user_login'].$Row['user_email'])){
        $tgPod = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `meta_key` = 'tgPod' AND `user_id` = $Row[ID]"));
        $mailPod = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `meta_key` = 'mailPod' AND `user_id` = $Row[ID]"));
        if($tgPod['meta_value'] and $_SESSION['ADMIN_IN'] != 1 or $mailPod['meta_value'] and $_SESSION['ADMIN_IN'] != 1){
            $_SESSION['RES_USER_ID'] = $Row['ID'];
            $_SESSION['RES_USER_EMAIL'] = $Row['user_email'];
    $psv = generate_password(6);
    mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '', '$_SESSION[RES_USER_EMAIL]', '$psv')");
    if($tgPod['meta_value']){
        message_to_telegram("✅ Код подтверждения: ".$psv,$Row['tl_id']);
    }
    if($mailPod['meta_value']){
    $to1 = $Row['user_email']; // кому отправляем
    // содержание письма
    $subject1 = "Код Подтверждения";
    $message1 = "
    <html>
        <head>
       <meta http-equiv='Content-Type' content='text/html' charset='utf-8' />
            <title>Код подтверждения</title>
        </head>
        <body>
            <p style=width:100%;color:black;>✅ Код подтверждения: ".$psv."</p>
        </body>
    </html>";
    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'ssl://smtp.beget.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'info@fxmonster.pw';                     //SMTP username
        $mail->Password   = '6#$!bnGZUruMscb9kFhy1*eK';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        //Recipients
        $mail->setFrom('info@fxmonster.pw', 'info@fxmonster.pw');
        $mail->addAddress($to1, $to1); 
        //Attachments
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject1;
        $mail->Body    = $message1;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
        //echo 'Message has been sent';
    } catch (Exception $e) {
        //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    }
            exit(header('Location: /auth2'));
        }else{
            $tgReg1 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = '$Row[user_nicename]' AND `meta_key` = 'tgLogin'"));
            $mailReg1 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = '$Row[user_nicename]' AND `meta_key` = 'mailLogin'"));
            $provBalance = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `meta_key` = '_current_woo_wallet_balance' AND `user_id` = $Row[ID]"));
            if(!$provBalance['meta_key']) mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$Row[ID]', '_current_woo_wallet_balance', '0')");
            if($Row['ID'] == 1 or $_SESSION['ADMIN_IN'] == 1) $_SESSION['ADMIN_IN'] = 1;
            $_SESSION['USER_ID'] = $Row['ID'];
            $_SESSION['USER_EMAIL'] = $Row['user_email'];
            $_SESSION['USER_LOGIN_IN'] = 1;
            exit(header('Location: /office'));
        }
    }else{
        exit(header('Location: http://fxmonster.pw'));
    }
}
if($Module == "broker"){
    $user = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = $_SESSION[USER_ID]"));
    mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$_SESSION[USER_ID]', 'broker', '$_POST[broker]')");
    message_to_telegram("📛  Подтвердите регистрацию партнёра\r\n\r\n😎 логин: ".$user['user_nicename']."\r\n♻️ Номера счета: ".$_POST['broker'],'1265026852');
    MessageSend('Успешно','Торговый счет отправлен на проверку, по окончанию вам будет доступен личный кабинет','success');
}
if($Module == "auth2"){
    $prov = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `meta_key` = '$_SESSION[RES_USER_EMAIL]' AND `meta_value` = '$_POST[auth2]'"));
    if($prov['meta_value']){
        mysqli_query($CONNECT, "DELETE FROM `wp_usermeta` WHERE `meta_key` = '$_SESSION[RES_USER_EMAIL]' AND `meta_value` = $_POST[auth2]");
        $Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = $_SESSION[RES_USER_ID]"));
        $provBalance = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `meta_key` = '_current_woo_wallet_balance' AND `user_id` = $Row[ID]"));
        if(!$provBalance['meta_key']) mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '$Row[ID]', '_current_woo_wallet_balance', '0')");
        if($Row['ID'] == 1 or $_SESSION['ADMIN_IN'] == 1) $_SESSION['ADMIN_IN'] = 1;
        $_SESSION['USER_ID'] = $_SESSION['RES_USER_ID'];
        $_SESSION['USER_EMAIL'] = $_SESSION['RES_USER_EMAIL'];
        $_SESSION['USER_LOGIN_IN'] = 1;
        exit(header('Location: /office'));
    }else{
        $Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `user_email` = '$_SESSION[RES_USER_EMAIL]'"));
        $tgPod = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `meta_key` = 'tgPod' AND `user_id` = $Row[ID]"));
        $mailPod = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `meta_key` = 'mailPod' AND `user_id` = $Row[ID]"));
        $psv = generate_password(6);
        mysqli_query($CONNECT, "INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES (NULL, '', '$_SESSION[RES_USER_EMAIL]', '$psv')");
        if($tgPod['meta_value']){
            message_to_telegram("✅ Код подтверждения: ".$psv,$Row['tl_id']);
        }
        if($mailPod['meta_value']){
        $to1 = $Row['user_email']; // кому отправляем
        // содержание письма
        $subject1 = "Код Подтверждения";
        $message1 = "
        <html>
            <head>
           <meta http-equiv='Content-Type' content='text/html' charset='utf-8' />
                <title>Код подтверждения</title>
            </head>
            <body>
                <p style=width:100%;color:black;>✅ Код подтверждения: ".$psv."</p>
            </body>
        </html>";
    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'ssl://smtp.beget.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'info@fxmonster.pw';                     //SMTP username
        $mail->Password   = '6#$!bnGZUruMscb9kFhy1*eK';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        //Recipients
        $mail->setFrom('info@fxmonster.pw', 'info@fxmonster.pw');
        $mail->addAddress($to1, $to1); 
        //Attachments
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject1;
        $mail->Body    = $message1;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
        //echo 'Message has been sent';
    } catch (Exception $e) {
        //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    }
        MessageSend('Ошибка','Проверочный код введен неверно','error');
    }
}
if($Module == 'logout'){
if($_COOKIE['user']) {
    setcookie('user', '', strtotime('-30 days'), '/');
    unset($_COOKIE['user']);
}
session_unset();
exit(header('Location: https://fxmonster.pw'));
}