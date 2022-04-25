<?
if($Module == 'save'){
    $date = date('Y-m-d H:i:s');
    $activeStatus =  mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_woo_wallet_transactions` WHERE `transaction_id` = $_POST[modal_id]"));
    if($activeStatus['type'] == 'debit'){
        $redStatus = 'redStatus'.$_POST['modal_id'];
        if($activeStatus['blog_id'] == 2 and $_POST[$redStatus] == 3 or $activeStatus['blog_id'] == 1 and $_POST[$redStatus] == 3){
            mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = `meta_value`+'$activeStatus[amount]' WHERE `user_id` = $activeStatus[user_id] AND `meta_key` = '_current_woo_wallet_balance'");
        }else if($activeStatus['blog_id'] == 3 and $_POST[$redStatus] == 1 or $activeStatus['blog_id'] == 3 and $_POST[$redStatus] == 2){
            mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = `meta_value`-'$activeStatus[amount]' WHERE `user_id` = $activeStatus[user_id] AND `meta_key` = '_current_woo_wallet_balance'");
        }
    }else if($activeStatus['type'] == 'paymant'){
        $redStatus = 'redStatus'.$_POST['modal_id'];
        if($activeStatus['blog_id'] == 2 and $_POST[$redStatus] == 1 or $activeStatus['blog_id'] == 3 and $_POST[$redStatus] == 1){
            if($activeStatus['konkurs'] == 1) $activeStatus['award'] = 0;
            $infoSp1 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $activeStatus[user_id] AND `meta_key` = 'ud_parent_partner'"));
            $poslPay = $infoSp1['meta_value'];
            $infoSp2 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $infoSp1[meta_value] AND `meta_key` = 'ud_parent_partner'"));
            if($infoSP2['meta_value'] == $infoSp1['meta_value']) $stopPay2 = 1;
            $poslPay = $infoSp2['meta_value'];
            $infoSp3 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $infoSp2[meta_value] AND `meta_key` = 'ud_parent_partner'"));
            if($infoSP3['meta_value'] == $infoSp2['meta_value']) $stopPay3 = 1;
            $poslPay = $infoSp3['meta_value'];
            $infoSp4 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $infoSp3[meta_value] AND `meta_key` = 'ud_parent_partner'"));
            if($infoSP4['meta_value'] == $infoSp3['meta_value']) $stopPay4 = 1;
            $poslPay = $infoSp4['meta_value'];
            $infoSp5 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $infoSp4[meta_value] AND `meta_key` = 'ud_parent_partner'"));
            if($infoSP5['meta_value'] == $infoSp4['meta_value']) $stopPay5 = 1;
            $poslPay = $infoSp5['meta_value'];
            $infoSp6 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $infoSp5[meta_value] AND `meta_key` = 'ud_parent_partner'"));
            if($infoSP6['meta_value'] == $infoSp5['meta_value']) $stopPay6 = 1;
            $poslPay = $infoSp6['meta_value'];
            $infoSp7 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $infoSp6[meta_value] AND `meta_key` = 'ud_parent_partner'"));
            if($infoSP7['meta_value'] == $infoSp6['meta_value']) $stopPay7 = 1;
            $poslPay = $infoSp7['meta_value'];
            $infoSp8 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $infoSp7[meta_value] AND `meta_key` = 'ud_parent_partner'"));
            if($infoSP8['meta_value'] == $infoSp7['meta_value']) $stopPay8 = 1;
            $poslPay = $infoSp8['meta_value'];
            $amount1 = $activeStatus['award']*0.7;
            $amount2 = $activeStatus['award']*0.1;
            $amount3 = $activeStatus['award']*0.06;
            $amount4 = $activeStatus['award']*0.01;
            mysqli_query($CONNECT, "INSERT INTO `wp_woo_wallet_transactions` (`transaction_id`, `blog_id`, `user_id`, `type`, `amount`, `balance`, `currency`, `details`, `created_by`, `deleted`, `date`, `account`) VALUES (NULL, '1', '$infoSp1[meta_value]', 'bonus', '$amount1', '', '', '$activeStatus[details]', '1', '$activeStatus[user_id]', '$date','')");
            mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = `meta_value`+'$amount1' WHERE `user_id` = $infoSp1[meta_value] AND `meta_key` = '_current_woo_wallet_balance'");
            $us1 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = '$infoSp1[meta_value]'"));
            $tgFin1 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = '$us1[user_nicename]' AND `meta_key` = 'tgFin'"));
            $mailFin1 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = '$us1[user_nicename]' AND `meta_key` = 'mailFin'"));
            if($tgFin1['meta_value']){
                message_to_telegram("🎉 Поздравляем!\r\n💰 Вам начислено вознаграждение\r\n\r\n😎 Логин: ".$activeStatus['user_id']."💼 Уровень: 1\r\n✅ Сумма: ".$amount1." рублей\r\n🤖 ".$activeStatus['details'],$us1['tl_id']);
            }
            if($mailFin1['meta_value']){
        $to1 = $us1['user_email']; // кому отправляем
        // содержание письма
        $subject1 = "Вознаграждение";
        $message1 = "
        <html>
            <head>
           <meta http-equiv='Content-Type' content='text/html' charset='utf-8' />
                <title>Вознаграждение</title>
            </head>
            <body>
                <p style=width:100%;color:black;>🎉 Поздравляем! </p>
                <p style=width:100%;color:black;>💰 Вам начислено вознаграждение</p>
                <p style=width:100%;color:black;>😎 Логин: ".$activeStatus['user_id']."</p>
                <p style=width:100%;color:black;>💼 Уровень: </p>
                <p style=width:100%;color:black;>✅ Сумма: $amount1 рублей</p>
                <p style=width:100%;color:black;>🤖 ".$activeStatus['details']."</p>
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
            mysqli_query($CONNECT, "INSERT INTO `wp_woo_wallet_transactions` (`transaction_id`, `blog_id`, `user_id`, `type`, `amount`, `balance`, `currency`, `details`, `created_by`, `deleted`, `date`, `account`) VALUES (NULL, '1', '$infoSp2[meta_value]', 'bonus', '$amount2', '', '', '$activeStatus[details]', '1', '$activeStatus[user_id]', '$date','')");
            mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = `meta_value`+'$amount2' WHERE `user_id` = $infoSp2[meta_value] AND `meta_key` = '_current_woo_wallet_balance'");
            $us2 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = '$infoSp2[meta_value]'"));
            $tgFin2 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = '$us2[user_nicename]' AND `meta_key` = 'tgFin'"));
            $mailFin2 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = '$us2[user_nicename]' AND `meta_key` = 'mailFin'"));
            if($tgFin2['meta_value'] and $stopPay2 != 1){
                message_to_telegram("🎉 Поздравляем!\r\n💰 Вам начислено вознаграждение\r\n\r\n😎 Логин: ".$activeStatus['user_id']."💼 Уровень: 2\r\n✅ Сумма: ".$amount2." рублей\r\n🤖 ".$activeStatus['details'],$us2['tl_id']);
            }
            if($mailFin2['meta_value'] and $stopPay2 != 1){
        $to1 = $us2['user_email']; // кому отправляем
        // содержание письма
        $subject1 = "Вознаграждение";
        $message1 = "
        <html>
            <head>
           <meta http-equiv='Content-Type' content='text/html' charset='utf-8' />
                <title>Вознаграждение</title>
            </head>
            <body>
                <p style=width:100%;color:black;>🎉 Поздравляем! </p>
                <p style=width:100%;color:black;>💰 Вам начислено вознаграждение</p>
                <p style=width:100%;color:black;>😎 Логин: ".$activeStatus['user_id']."</p>
                <p style=width:100%;color:black;>💼 Уровень: 2</p>
                <p style=width:100%;color:black;>✅ Сумма: $amount2 рублей</p>
                <p style=width:100%;color:black;>🤖 ".$activeStatus['details']."</p>
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
            mysqli_query($CONNECT, "INSERT INTO `wp_woo_wallet_transactions` (`transaction_id`, `blog_id`, `user_id`, `type`, `amount`, `balance`, `currency`, `details`, `created_by`, `deleted`, `date`, `account`) VALUES (NULL, '1', '$infoSp3[meta_value]', 'bonus', '$amount2', '', '', '$activeStatus[details]', '1', '$activeStatus[user_id]', '$date','')");
            mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = `meta_value`+'$amount2' WHERE `user_id` = $infoSp3[meta_value] AND `meta_key` = '_current_woo_wallet_balance'");
            $us3 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = '$infoSp3[meta_value]'"));
            $tgFin3 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = '$us3[user_nicename]' AND `meta_key` = 'tgFin'"));
            $mailFin3 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = '$us3[user_nicename]' AND `meta_key` = 'mailFin'"));
            if($tgFin3['meta_value'] and $stopPay3 != 1){
                message_to_telegram("🎉 Поздравляем!\r\n💰 Вам начислено вознаграждение\r\n\r\n😎 Логин: ".$activeStatus['user_id']."💼 Уровень: 3\r\n✅ Сумма: ".$amount2." рублей\r\n🤖 ".$activeStatus['details'],$us3['tl_id']);
            }
            if($mailFin3['meta_value'] and $stopPay3 != 1){
        $to1 = $us3['user_email']; // кому отправляем
        // содержание письма
        $subject1 = "Вознаграждение";
        $message1 = "
        <html>
            <head>
           <meta http-equiv='Content-Type' content='text/html' charset='utf-8' />
                <title>Вознаграждение</title>
            </head>
            <body>
                <p style=width:100%;color:black;>🎉 Поздравляем! </p>
                <p style=width:100%;color:black;>💰 Вам начислено вознаграждение</p>
                <p style=width:100%;color:black;>😎 Логин: ".$activeStatus['user_id']."</p>
                <p style=width:100%;color:black;>💼 Уровень: 3</p>
                <p style=width:100%;color:black;>✅ Сумма: $amount3 рублей</p>
                <p style=width:100%;color:black;>🤖 ".$activeStatus['details']."</p>
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
            mysqli_query($CONNECT, "INSERT INTO `wp_woo_wallet_transactions` (`transaction_id`, `blog_id`, `user_id`, `type`, `amount`, `balance`, `currency`, `details`, `created_by`, `deleted`, `date`, `account`) VALUES (NULL, '1', '$infoSp4[meta_value]', 'bonus', '$amount3', '', '', '$activeStatus[details]', '1', '$activeStatus[user_id]', '$date','')");
            mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = `meta_value`+'$amount3' WHERE `user_id` = $infoSp4[meta_value] AND `meta_key` = '_current_woo_wallet_balance'");
            $us4 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = '$infoS4[meta_value]'"));
            $tgFin4 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = '$us4[user_nicename]' AND `meta_key` = 'tgFin'"));
            $mailFin4 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = '$us4[user_nicename]' AND `meta_key` = 'mailFin'"));
            if($tgFin4['meta_value'] and $stopPay4 != 1){
                message_to_telegram("🎉 Поздравляем!\r\n💰 Вам начислено вознаграждение\r\n\r\n😎 Логин: ".$activeStatus['user_id']."💼 Уровень: 4\r\n✅ Сумма: ".$amount4." рублей\r\n🤖 ".$activeStatus['details'],$us4['tl_id']);
            }
            if($mailFin4['meta_value'] and $stopPay4 != 1){
        $to1 = $us4['user_email']; // кому отправляем
        // содержание письма
        $subject1 = "Вознаграждение";
        $message1 = "
        <html>
            <head>
           <meta http-equiv='Content-Type' content='text/html' charset='utf-8' />
                <title>Вознаграждение</title>
            </head>
            <body>
                <p style=width:100%;color:black;>🎉 Поздравляем! </p>
                <p style=width:100%;color:black;>💰 Вам начислено вознаграждение</p>
                <p style=width:100%;color:black;>😎 Логин: ".$activeStatus['user_id']."</p>
                <p style=width:100%;color:black;>💼 Уровень: 4</p>
                <p style=width:100%;color:black;>✅ Сумма: $amount4 рублей</p>
                <p style=width:100%;color:black;>🤖 ".$activeStatus['details']."</p>
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
            mysqli_query($CONNECT, "INSERT INTO `wp_woo_wallet_transactions` (`transaction_id`, `blog_id`, `user_id`, `type`, `amount`, `balance`, `currency`, `details`, `created_by`, `deleted`, `date`, `account`) VALUES (NULL, '1', '$infoSp5[meta_value]', 'bonus', '$amount4', '', '', '$activeStatus[details]', '1', '$activeStatus[user_id]', '$date','')");
            mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = `meta_value`+'$amount4' WHERE `user_id` = $infoSp5[meta_value] AND `meta_key` = '_current_woo_wallet_balance'");
            $us5 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = '$infoSp5[meta_value]'"));
            $tgFin5 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = '$us5[user_nicename]' AND `meta_key` = 'tgFin'"));
            $mailFin5 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = '$us5[user_nicename]' AND `meta_key` = 'mailFin'"));
            if($tgFin5['meta_value'] and $stopPay5 != 1){
                message_to_telegram("🎉 Поздравляем!\r\n💰 Вам начислено вознаграждение\r\n\r\n😎 Логин: ".$activeStatus['user_id']."💼 Уровень: 5\r\n✅ Сумма: ".$amount4." рублей\r\n🤖 ".$activeStatus['details'],$us5['tl_id']);
            }
            if($mailFin5['meta_value'] and $stopPay5 != 1){
        $to1 = $us5['user_email']; // кому отправляем
        // содержание письма
        $subject1 = "Вознаграждение";
        $message1 = "
        <html>
            <head>
           <meta http-equiv='Content-Type' content='text/html' charset='utf-8' />
                <title>Вознаграждение</title>
            </head>
            <body>
                <p style=width:100%;color:black;>🎉 Поздравляем! </p>
                <p style=width:100%;color:black;>💰 Вам начислено вознаграждение</p>
                <p style=width:100%;color:black;>😎 Логин: ".$activeStatus['user_id']."</p>
                <p style=width:100%;color:black;>💼 Уровень: 5</p>
                <p style=width:100%;color:black;>✅ Сумма: $amount4 рублей</p>
                <p style=width:100%;color:black;>🤖 ".$activeStatus['details']."</p>
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
            mysqli_query($CONNECT, "INSERT INTO `wp_woo_wallet_transactions` (`transaction_id`, `blog_id`, `user_id`, `type`, `amount`, `balance`, `currency`, `details`, `created_by`, `deleted`, `date`, `account`) VALUES (NULL, '1', '$infoSp6[meta_value]', 'bonus', '$amount4', '', '', '$activeStatus[details]', '1', '$activeStatus[user_id]', '$date','')");
            mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = `meta_value`+'$amount4' WHERE `user_id` = $infoSp6[meta_value] AND `meta_key` = '_current_woo_wallet_balance'");
            $us6 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = '$infoSp6[meta_value]'"));
            $tgFin6 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = '$us6[user_nicename]' AND `meta_key` = 'tgFin'"));
            $mailFin6 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = '$us6[user_nicename]' AND `meta_key` = 'mailFin'"));
            if($tgFin6['meta_value'] and $stopPay6 != 1){
                 message_to_telegram("🎉 Поздравляем!\r\n💰 Вам начислено вознаграждение\r\n\r\n😎 Логин: ".$activeStatus['user_id']."💼 Уровень: 6\r\n✅ Сумма: ".$amount4." рублей\r\n🤖 ".$activeStatus['details'],$us6['tl_id']);
            }
            if($mailFin6['meta_value'] and $stopPay6 != 1){
        $to1 = $us6['user_email']; // кому отправляем
        // содержание письма
        $subject1 = "Вознаграждение";
        $message1 = "
        <html>
            <head>
           <meta http-equiv='Content-Type' content='text/html' charset='utf-8' />
                <title>Вознаграждение</title>
            </head>
            <body>
                <p style=width:100%;color:black;>🎉 Поздравляем! </p>
                <p style=width:100%;color:black;>💰 Вам начислено вознаграждение</p>
                <p style=width:100%;color:black;>😎 Логин: ".$activeStatus['user_id']."</p>
                <p style=width:100%;color:black;>💼 Уровень: 7</p>
                <p style=width:100%;color:black;>✅ Сумма: $amount4 рублей</p>
                <p style=width:100%;color:black;>🤖 ".$activeStatus['details']."</p>
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
            mysqli_query($CONNECT, "INSERT INTO `wp_woo_wallet_transactions` (`transaction_id`, `blog_id`, `user_id`, `type`, `amount`, `balance`, `currency`, `details`, `created_by`, `deleted`, `date`, `account`) VALUES (NULL, '1', '$infoSp7[meta_value]', 'bonus', '$amount4', '', '', '$activeStatus[details]', '1', '$activeStatus[user_id]', '$date','')");
            mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = `meta_value`+'$amount4' WHERE `user_id` = $infoSp7[meta_value] AND `meta_key` = '_current_woo_wallet_balance'");
            $us7 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = '$infoSp7[meta_value]'"));
            $tgFin7 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = '$us7[user_nicename]' AND `meta_key` = 'tgFin'"));
            $mailFin7 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = '$us7[user_nicename]' AND `meta_key` = 'mailFin'"));
            if($tgFin7['meta_value'] and $stopPay7 != 1){
               message_to_telegram("🎉 Поздравляем!\r\n💰 Вам начислено вознаграждение\r\n\r\n😎 Логин: ".$activeStatus['user_id']."💼 Уровень: 7\r\n✅ Сумма: ".$amount4." рублей\r\n🤖 ".$activeStatus['details'],$us7['tl_id']);
            }
            if($mailFin7['meta_value'] and $stopPay7 != 1){
        $to1 = $us7['user_email']; // кому отправляем
        // содержание письма
        $subject1 = "Вознаграждение";
        $message1 = "
        <html>
            <head>
           <meta http-equiv='Content-Type' content='text/html' charset='utf-8' />
                <title>Вознаграждение</title>
            </head>
            <body>
                <p style=width:100%;color:black;>🎉 Поздравляем! </p>
                <p style=width:100%;color:black;>💰 Вам начислено вознаграждение</p>
                <p style=width:100%;color:black;>😎 Логин: ".$activeStatus['user_id']."</p>
                <p style=width:100%;color:black;>💼 Уровень: 7</p>
                <p style=width:100%;color:black;>✅ Сумма: $amount4 рублей</p>
                <p style=width:100%;color:black;>🤖 ".$activeStatus['details']."</p>
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
            mysqli_query($CONNECT, "INSERT INTO `wp_woo_wallet_transactions` (`transaction_id`, `blog_id`, `user_id`, `type`, `amount`, `balance`, `currency`, `details`, `created_by`, `deleted`, `date`, `account`) VALUES (NULL, '1', '$infoSp8[meta_value]', 'bonus', '$amount4', '', '', '$activeStatus[details]', '1', '$activeStatus[user_id]', '$date','')");
            mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = `meta_value`+'$amount4' WHERE `user_id` = $infoSp8[meta_value] AND `meta_key` = '_current_woo_wallet_balance'");
            $us8 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = '$infoSp8[meta_value]'"));
            $tgFin8 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = '$us8[user_nicename]' AND `meta_key` = 'tgFin'"));
            $mailFin8 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = '$us8[user_nicename]' AND `meta_key` = 'mailFin'"));
            if($tgFin8['meta_value'] and $stopPay8 != 1){
                message_to_telegram("🎉 Поздравляем!\r\n💰 Вам начислено вознаграждение\r\n\r\n😎 Логин: ".$activeStatus['user_id']."💼 Уровень: 8\r\n✅ Сумма: ".$amount4." рублей\r\n🤖 ".$activeStatus['details'],$us8['tl_id']);
            }
            if($mailFin8['meta_value'] and $stopPay8 != 1){
        $to1 = $us8['user_email']; // кому отправляем
        // содержание письма
        $subject1 = "Вознаграждение";
        $message1 = "
        <html>
            <head>
           <meta http-equiv='Content-Type' content='text/html' charset='utf-8' />
                <title>Вознаграждение</title>
            </head>
            <body>
                <p style=width:100%;color:black;>🎉 Поздравляем! </p>
                <p style=width:100%;color:black;>💰 Вам начислено вознаграждение</p>
                <p style=width:100%;color:black;>😎 Логин: ".$activeStatus['user_id']."</p>
                <p style=width:100%;color:black;>💼 Уровень: 8</p>
                <p style=width:100%;color:black;>✅ Сумма: $amount4 рублей</p>
                <p style=width:100%;color:black;>🤖 ".$activeStatus['details']."</p>
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
            mysqli_query($CONNECT, "INSERT INTO `wp_wc_customer_lookup` (`customer_id`, `user_id`, `username`, `first_name`, `last_name`, `email`, `date_last_active`, `date_registered`, `country`, `postcode`, `city`, `state`) VALUES (NULL, '$activeStatus[user_id]', '', '', '', '', '$date', '$date', '', '', '', '')");
        }
    }
    mysqli_query($CONNECT, "UPDATE `wp_woo_wallet_transactions` SET `blog_id` = '$_POST[$redStatus]' WHERE `transaction_id` = $_POST[modal_id]");
    
}
if($_POST['pag']){
    if($_POST['pag'] > 0) $nach = ($_POST['pag']*7)+1;
    else $nach = ($_POST['pag']*7);
    if($_POST['pag'] > 0) $kon = ($_POST['pag']*7)+7;
    else $kon = ($_POST['pag']*7)+7;
}else{
    $nach = 1;
    $kon = 7;
}
$kolVse = mysqli_num_rows(mysqli_query($CONNECT, "SELECT * FROM `wp_woo_wallet_transactions` WHERE `details` != ''"));
$kolSuccess = mysqli_num_rows(mysqli_query($CONNECT, "SELECT * FROM `wp_woo_wallet_transactions` WHERE `blog_id` = 1 AND `details` != ''"));
$kolPrimary = mysqli_num_rows(mysqli_query($CONNECT, "SELECT * FROM `wp_woo_wallet_transactions` WHERE `blog_id` = 2 AND `details` != ''"));
$kolDanger = mysqli_num_rows(mysqli_query($CONNECT, "SELECT * FROM `wp_woo_wallet_transactions` WHERE `blog_id` = 3 AND `details` != ''"));
?>   
<input type="hidden" id="status" value="<?= $_POST['status'] ?>">
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
    <button type="button" class="btn btn-secondary position-relative mt-3 mb-3 ml-2" onclick="document.getElementById('status').value='0';post_button('financeAdmin','login','status','local-block');">
        <span>Все</span>
        <span class="badge badge-warning counter" style="width:25px;height:25px;padding:5px 0px;" ><?= $kolVse ?></span>
    </button>
    <button type="button" class="btn btn-success position-relative mt-3 mb-3 ml-2" onclick="document.getElementById('status').value='1';post_button('financeAdmin','login','status','local-block');">
        <span>Выполнено</span>
        <span class="badge badge-warning counter" style="width:25px;height:25px;padding:5px 0px;"><?= $kolSuccess ?></span>
    </button>
    <button type="button" class="btn btn-primary position-relative mt-3 mb-3 ml-2" onclick="document.getElementById('status').value='2';post_button('financeAdmin','login','status','local-block');">
        <span>В обработке</span>
        <span class="badge badge-warning counter" style="width:25px;height:25px;padding:5px 0px;"><?= $kolPrimary ?></span>
    </button>
    <button type="button" class="btn btn-danger position-relative mt-3 mb-3 ml-2" onclick="document.getElementById('status').value='3';post_button('financeAdmin','login','status','local-block');">
        <span>Отказано</span>
        <span class="badge badge-warning counter" style="width:25px;height:25px;padding:5px 0px;"><?= $kolDanger ?></span>
    </button>
    <div class="table-responsive rounded">
        <table class="table mb-4">
            <thead>
                <tr>
                    <th class="text-center">#ID</th>
                    <th>Автор</th>
                    <th style="max-width:350px;">Название</th>
                    <th>Сумма</th>
                    <th class="">Статус</th>
                    <th class="">Дата</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                        <?
                        $i = 1;
                        if($_POST['status'] == 1){
                            $kolTR = mysqli_num_rows(mysqli_query($CONNECT, "SELECT * FROM `wp_woo_wallet_transactions` WHERE `details` != '' AND `blog_id` = 1"));
                            $TwoOperation1 = mysqli_query($CONNECT, "SELECT * FROM `wp_woo_wallet_transactions`  WHERE `details` != ''  AND `blog_id` = 1 ORDER BY `transaction_id` DESC");
                        }else if($_POST['status'] == 2){
                            $kolTR = mysqli_num_rows(mysqli_query($CONNECT, "SELECT * FROM `wp_woo_wallet_transactions` WHERE `details` != ''  AND `blog_id` = 2"));
                            $TwoOperation1 = mysqli_query($CONNECT, "SELECT * FROM `wp_woo_wallet_transactions`  WHERE `details` != ''  AND `blog_id` = 2 ORDER BY `transaction_id` DESC");
                        }else if($_POST['status'] == 3){
                            $kolTR = mysqli_num_rows(mysqli_query($CONNECT, "SELECT * FROM `wp_woo_wallet_transactions` WHERE `details` != ''  AND `blog_id` = 3"));
                            $TwoOperation1 = mysqli_query($CONNECT, "SELECT * FROM `wp_woo_wallet_transactions`  WHERE `details` != ''  AND `blog_id` = 3 ORDER BY `transaction_id` DESC");
                        }else{
                            $kolTR = mysqli_num_rows(mysqli_query($CONNECT, "SELECT * FROM `wp_woo_wallet_transactions` WHERE `details` != ''"));
                            $TwoOperation1 = mysqli_query($CONNECT, "SELECT * FROM `wp_woo_wallet_transactions`  WHERE `details` != '' ORDER BY `transaction_id` DESC");
                        }
                        while($TwoOperation = mysqli_fetch_assoc($TwoOperation1)){
                            if($i > $kon) break;
                            if($i >= $nach and $i <= $kon){   
                                if($TwoOperation['type'] == 'debit' or $TwoOperation['type'] == 'credit'){
                                    $statusTr = 'danger';
                                    $userPaymant = "";
                                    
                                }else{
                                    $statusTr = 'success';
                                    $IdPaymant = $TwoOperation['deleted'];
                                    $LoginPaymant = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $IdPaymant AND `meta_key` = 'nickname'"));
                                    $userPaymant = "<span class='shadow-none badge outline-badge-success' data-toggle='modal' data-target='#profileModal' style='cursor:pointer;' onclick=document.getElementById('modal_id').value=".$IdPaymant.";post_button('userModal','login','modal_id','userModal');>".$LoginPaymant['meta_value']."</span>";
                                }
                                $login = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $TwoOperation[user_id] AND `meta_key` = 'nickname'"));
                        ?>
                        <tr>
                            <td class="">#<?= $kolTR ?></td>
                            <td data-toggle='modal' data-target='#profileModal' style='cursor:pointer;' onclick="document.getElementById('modal_id').value='<?= $login['user_id'] ?>';post_button('userModal','login','modal_id','userModal');"><?= $login['meta_value'] ?></td>
                            <td style="max-width:350px;white-space:normal;"><?= $TwoOperation['details'] ?> <?= $userPaymant ?></td>
                            <td class="text-<?= $statusTr ?>"><?= number_format($TwoOperation['amount'], 0, ',', ' '); ?> ₽</td>
                            <td class="">
                                <select class="form-control" id="redStatus<?= $TwoOperation['transaction_id'] ?>">
                                    <? if($TwoOperation['blog_id'] == 1){ ?>
                                    <option value="1">Выполнено</option>
                                    <option value="2">В обработке</option>
                                    <option value="3">Отказано</option>
                                    <? }else if($TwoOperation['blog_id'] == 2){ ?>
                                    <option value="2">В обработке</option>
                                    <option value="1">Выполнено</option>
                                    <option value="3">Отказано</option>
                                    <? }else{ ?>
                                    <option value="3">Отказано</option>
                                    <option value="1">Выполнено</option>
                                    <option value="2">В обработке</option>
                                    <? } ?>
                                </select>
                            </td>
                            <td class=""><?= changeDateFormat($TwoOperation['date'],'d.m.Y H:i'); ?></td>
                            <td>
                                <button class="btn btn-success" onclick="document.getElementById('modal_id').value='<?= $TwoOperation['transaction_id'] ?>';post_button('financeAdmin/save','login','redStatus<?= $TwoOperation['transaction_id'] ?>.pag.modal_id.status','local-block');message('Успешно','Статус транзакции изменен','success');">Сохранить</button>
                                <? if($TwoOperation['type'] == 'debit'){ ?>
                                <button class="btn btn-primary" data-toggle='modal' data-target='#profileModal' onclick="document.getElementById('modal_id').value='<?= $TwoOperation['transaction_id'] ?>';post_button('payModal','login','modal_id','userModal')">Реквизиты</button>
                                <? } ?>
                                <? if($TwoOperation['type'] == 'paymant'){ ?>
                                <button class="btn btn-primary" data-toggle='modal' data-target='#profileModal' onclick="document.getElementById('modal_id').value='<?= $TwoOperation['transaction_id'] ?>';post_button('checkModal','login','modal_id','userModal')">Чек</button>
                                <? } ?>
                            </td>
                        </tr>
                        <?
                        }
                        $i++;
                        $kolTR--;
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center">#ID</th>
                            <th>Название</th>
                            <th>Сумма</th>
                            <th class="">Статус</th>
                            <th class="">Дата</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
    <div class="paginating-container pagination-default">
        <ul class="pagination">
<?
$kol_pag = mysqli_num_rows($TwoOperation1);
if($kol_pag > 7){
$kol_s = ($kol_pag/7);
if($kol_s > (int)$kol_s and $kol_s < (int)$kol_s+1) $kol_s = (int)$kol_s+1;
else $kol_s = (int)$kol_s;
if($_POST['pag']){
    $i2 = $_POST['pag']+1; 
    $num = $_POST['pag'];
}else{
    $num = 1;
    $i2 = 1;
}
$start = $i2-1;
if($start < 1) $start = 1;
$stop = $i2+1;
if($stop > $kol_s) $stop = $kol_s;
$i2_2 = $start;
if($_POST['pag'] > 0){
?>
    <li class="prev"><a style="cursor:pointer;" onclick="document.getElementById('pag').value='<?= $num-1 ?>';post_button('financeAdmin','login','pag.status','local-block');"><i class="fas fa-arrow-left"></i></a></li>
<?
}
while($i2_2 <= $stop){
    if($i2_2 == $_POST['pag']+1 or !$_POST['pag'] and $i2_2 == 1){
        $num = $i2_2;
    	 $active = 'active';
    }else{
    	$active = '';
    }
?>
    <li class="<?= $active ?>"><a style="cursor:pointer;" onclick="document.getElementById('pag').value='<?= $i2_2-1 ?>';post_button('financeAdmin','login','pag.status','local-block');"><?= $i2_2; ?></a></li>
<?
    if($i2 > $kol_s+4) break;
    $i2 = $i2+1;
    $i2_2 = $i2_2+1;
}
?>
<?
if($_POST['pag']+1 < $kol_s){
?>
    <li class="next"><a class="" style="cursor:pointer;" onclick="document.getElementById('pag').value='<?= $num ?>';post_button('financeAdmin','login','pag.status','local-block');"><i class="fas fa-arrow-right"></i></a></li>
<?
}
?>
    </ul>
<?
}
?>
</div>
</div>
<script>
        $("#local-load").addClass('d-none');
        $("#local-block").removeClass('d-none');
    </script>