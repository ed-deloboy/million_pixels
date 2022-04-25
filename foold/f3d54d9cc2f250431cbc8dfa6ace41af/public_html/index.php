<?php
session_start();
define('HOST', 'localhost');
define('USER', 'j90010g8_active');
define('PASS', '6#$!bnGZUruMscb9kFhy1*eK');
define('DB', 'j90010g8_active');
$CONNECT = mysqli_connect(HOST, USER, PASS, DB);
if($_SESSION['USER_ID']){
    $user = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = $_SESSION[USER_ID]"));
    if($user['avatar']){
        $avatar = 'assets/img/avatar/'.$user['avatar'].'/'.$_SESSION['USER_ID'].'.'.$user['avatar_f'];
    }else{
        $avatar = 'assets/img/200x200.jpg';
    }
    $dt = date('Y-m-d H:i:s');
}
if ($_SERVER['REQUEST_URI'] == '/') {
	$Page = 'index';
	$Module = 'index';
}else{
	$URL_Path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$URL_Parts = explode('/', trim($URL_Path, ' /'));
	$Page = array_shift($URL_Parts);
	$Module = array_shift($URL_Parts);
	if (!empty($Module)) {
		$Param = array();
		for ($i = 0; $i < count($URL_Parts); $i++) {
		$Param[$URL_Parts[$i]] = $URL_Parts[++$i];
	    }
    }
}

if($Page == 'index') exit(header("Location: /office"));
else if($Page == 'login_in') include('pages/office/login/login.php');
else if($Page == 'blocked') include('pages/blocked/index.php');
else if($Page == 'usersAdmin') include('pages/office/admin/users/index.php');
else if($Page == 'financeAdmin') include('pages/office/admin/finance/index.php');
else if($Page == 'programAdmin') include('pages/office/admin/program/index.php');
else if($Page == 'notifyAdmin') include('pages/office/admin/notify/index.php');
else if($Page == 'confirmAdmin') include('pages/office/admin/confirm/index.php');
else if($Page == 'contactAdmin') include('pages/office/admin/contact/index.php');
else if($Page == 'administration'){
    if($_SESSION['ADMIN_IN'] == 1){
        include('pages/office/indexAdmin.php');
    }else{
        exit(header("Location: /office"));
    }
}else if($Page == 'auth2') include('pages/auth2/index.php');
else if($Page == 'office'){
     Ulogin(1);
    if(!$user['broker']) exit(header("Location: /broker"));
    else if($user['blocked']) exit(header("Location: /blocked"));
    else{
        include('pages/office/index.php');
    }
}else if($Page == 'broker'){
    if(!$_SESSION['USER_ID']) exit(header('Location: https://fxmonster.pw/'));
    if($user['broker']) exit(header("Location: /office"));
    else{
        $Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'broker'"));
        if($Row['umeta_id']) $check = 1;
        include('pages/broker/index.php');
    }
}else if($Page == 'account') include('form/account.php');
else if($Page == 'redact_profile') include('form/profile.php');
else if($Page == 'paymant') include('form/paymant.php');
else if($Page == 'redProduct') include('form/redProduct.php');
else if($Page == 'step') include('form/step.php');
else if($Page == 'home'){
    $_SESSION['mainMessage'] = "myMain(1,'Главная','home');";
    $dateStart = strtotime($user['user_registered']);///Дата старта
    $dateNow = strtotime(date("Y-m-d H:i:s")); ///Текущая дата
    $balance = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = '_current_woo_wallet_balance'"));
    $first_name = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'first_name'"));
    $last_name = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'last_name'"));
    $partnerProfit = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT SUM(`amount`) `sum`  FROM `wp_woo_wallet_transactions` WHERE `user_id` = $_SESSION[USER_ID] AND `details` != ''  AND `type` = 'bonus'"));
    $profitDateDay = date("Y-m-d 00:00:00");
    $profitDateYesterday = date("Y-m-d H:i:s", strtotime(date("Y-m-d 00:00:00"))-86400);
    $profitDateWeek = date("Y-m-d H:i:s", strtotime(date("Y-m-d 00:00:00"))-604800);
    $profitDateMounth= date("Y-m-d H:i:s", strtotime(date("Y-m-d 00:00:00"))-2592000);
    $partnerDay = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT SUM(`amount`) `sum`  FROM `wp_woo_wallet_transactions` WHERE `user_id` = $_SESSION[USER_ID] AND `details` != '' AND `date` > '$profitDateDay' AND `type` = 'bonus'"));
    if(!$partnerDay['sum']) $partnerDay['sum'] = 0;
    $partnerYesterday = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT SUM(`amount`) `sum`  FROM `wp_woo_wallet_transactions` WHERE `user_id` = $_SESSION[USER_ID] AND `details` != '' AND `date` > '$profitDateYesterday' AND `date` < '$profitDateDay' AND `type` = 'bonus'"));
    if(!$partnerYesterday['sum']) $partnerYesterday['sum'] = 0;
    $partnerWeek = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT SUM(`amount`) `sum`  FROM `wp_woo_wallet_transactions` WHERE `user_id` = $_SESSION[USER_ID] AND `details` != '' AND `date` > '$profitDateWeek' AND `type` = 'bonus'"));
    if(!$partnerWeek['sum']) $partnerWeek['sum'] = 0;
    $partnerMounth = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT SUM(`amount`) `sum`  FROM `wp_woo_wallet_transactions` WHERE `user_id` = $_SESSION[USER_ID] AND `details` != '' AND `date` > '$profitDateMounth' AND `type` = 'bonus'"));
    if(!$partnerMounth['sum']) $partnerMounth['sum'] = 0;
    $profit = $partnerProfit['sum'];
    $dateDay = date("Y-m-d 00:00:00");
    $date = date(strtotime(date("Y-m-d 00:00:00")));
    $partnerProfitDay = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT SUM(`amount`) `sum`  FROM `wp_woo_wallet_transactions` WHERE `user_id` = $_SESSION[USER_ID] AND `details` != ''  AND `type` = 'bonus'"));
    
    ///Данные для графика регистраций
    $Quantity = 0;
    $partner_Total1 = mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `meta_key` = 'ud_parent_partner'  AND `meta_value` = '$_SESSION[USER_ID]' AND `user_id` != $_SESSION[USER_ID]");
    while($partnerTotal1 = mysqli_fetch_assoc($partner_Total1)){
        $partner_Total2 = mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `meta_key` = 'ud_parent_partner'  AND `meta_value` = '$partnerTotal1[user_id]'");
        while($partnerTotal2 = mysqli_fetch_assoc($partner_Total2)){
            $partner_Total3 = mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `meta_key` = 'ud_parent_partner'  AND `meta_value` = '$partnerTotal2[user_id]'");
            while($partnerTotal3 = mysqli_fetch_assoc($partner_Total3)){
                $partner_Total4 = mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `meta_key` = 'ud_parent_partner'  AND `meta_value` = '$partnerTotal3[user_id]'");
                while($partnerTotal4 = mysqli_fetch_assoc($partner_Total4)){
                    $partner_Total5 = mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `meta_key` = 'ud_parent_partner'  AND `meta_value` = '$partnerTotal4[user_id]'");
                    while($partnerTotal5 = mysqli_fetch_assoc($partner_Total5)){
                        $partner_Total6 = mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `meta_key` = 'ud_parent_partner'  AND `meta_value` = '$partnerTotal5[user_id]'");
                        while($partnerTotal6 = mysqli_fetch_assoc($partner_Total6)){
                            $partner_Total7 = mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE`meta_key` = 'ud_parent_partner'  AND `meta_value` = '$partnerTotal6[user_id]'");
                            while($partnerTotal7 = mysqli_fetch_assoc($partner_Total7)){
                                $partner_Total8 = mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `meta_key` = 'ud_parent_partner'  AND `meta_value` = '$partnerTotal7[user_id]'");
                                while($partnerTotal8 = mysqli_fetch_assoc($partner_Total8)){
                                    $Quantity++;
                                }
                                $Quantity++;
                            }
                            $Quantity++;
                        }
                        $Quantity++;
                    }
                    $Quantity++;
                }
                $Quantity++;
            }
            $Quantity++;
        }
        $Quantity++;
    }
    $i = 0;
    $dateNow = strtotime(date("Y-m-d 00:00:00"));
    while($i < 10){
        $QuantityDay[$i] = 0;
        
        $dateReg[$i] = date("Y-m-d H:i:s", $dateNow);
        $partner_day1[$i] = mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `meta_key` = 'ud_parent_partner'  AND `meta_value` = '$_SESSION[USER_ID]'");
        while($partnerday1[$i] = mysqli_fetch_assoc($partner_day1[$i])){
            echo mysqli_error($CONNECT);
            $partner_day2[$i] = mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `meta_key` = 'ud_parent_partner'  AND `meta_value` = '$partnerday1[$i][user_id]'");
            while($partnerday2[$i] = mysqli_fetch_assoc($partner_day2[$i])){
                $partner_day3[$i] = mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `meta_key` = 'ud_parent_partner'  AND `meta_value` = '$partnerday2[$i][user_id]'");
                while($partnerday3[$i] = mysqli_fetch_assoc($partner_day3[$i])){
                    $partner_day4[$i] = mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `meta_key` = 'ud_parent_partner'  AND `meta_value` = '$partnerday3[$i][user_id]'");
                    while($partnerday4[$i] = mysqli_fetch_assoc($partner_day4[$i])){
                        $partner_day5[$i] = mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `meta_key` = 'ud_parent_partner'  AND `meta_value` = '$partnerday4[$i][user_id]'");
                        while($partnerday5[$i] = mysqli_fetch_assoc($partner_day5[$i])){
                            $partner_day6[$i] = mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `meta_key` = 'ud_parent_partner'  AND `meta_value` = '$partnerday5[$i][user_id]'");
                            while($partnerday6[$i] = mysqli_fetch_assoc($$partner_day6[$i])){
                                $partner_day7[$i] = mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE`meta_key` = 'ud_parent_partner'  AND `meta_value` = '$partnerday6[$i][user_id]'");
                                while($partnerday7[$i] = mysqli_fetch_assoc($partner_day7[$i])){
                                    $partner_day8[$i]  = mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `meta_key` = 'ud_parent_partner'  AND `meta_value` = '$partnerday7[$i][user_id]'");
                                    while($partnerday8[$i]  = mysqli_fetch_assoc($partner_day8[$i])){
                                        $partnerday8ID[$i] = $partnerday8[$i]['user_id'];
                                        $mday = $i-1;
                                        if($mday < 0){
                                            $dateReg[$mday] = date("Y-m-d 23:59:59");
                                        }
                                        $day_reg8[$i] = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = $partnerday8ID[$i] AND `user_registered` > '$dateReg[$i]' AND `user_registered` < '$dateReg[$mday]'"));
                                        if($day_reg8[$i]['ID']){
                                            $QuantityDay[$i]++;
                                        }
                                    }
                                    $partnerday7ID[$i] = $partnerday7[$i]['user_id'];
                                    $mday = $i-1;
                                    if($mday < 0){
                                        $dateReg[$mday] = date("Y-m-d 23:59:59");
                                    }
                                    $day_reg7[$i] = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = $partnerday7ID[$i] AND `user_registered` > '$dateReg[$i]' AND `user_registered` < '$dateReg[$mday]'"));
                                    if($day_reg7[$i]['ID']){
                                        $QuantityDay[$i]++;
                                    }
                                }
                                $partnerday6ID[$i] = $partnerday6[$i]['user_id'];
                                $mday = $i-1;
                                if($mday < 0){
                                    $dateReg[$mday] = date("Y-m-d 23:59:59");
                                }
                                $day_reg6[$i] = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = $partnerday6ID[$i] AND `user_registered` > '$dateReg[$i]' AND `user_registered` < '$dateReg[$mday]'"));
                                if($day_reg6[$i]['ID']){
                                    $QuantityDay[$i]++;
                                }
                            }
                            $partnerday5ID[$i] = $partnerday5[$i]['user_id'];
                            $mday = $i-1;
                            if($mday < 0){
                                $dateReg[$mday] = date("Y-m-d 23:59:59");
                            }
                            $day_reg5[$i] = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = $partnerday5ID[$i] AND `user_registered` > '$dateReg[$i]' AND `user_registered` < '$dateReg[$mday]'"));
                            if($day_reg5[$i]['ID']){
                                $QuantityDay[$i]++;
                            }
                        }
                        $partnerday4ID[$i] = $partnerday4[$i]['user_id'];
                        $mday = $i-1;
                        if($mday < 0){
                            $dateReg[$mday] = date("Y-m-d 23:59:59");
                        }
                        $day_reg4[$i] = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = $partnerday4ID[$i] AND `user_registered` > '$dateReg[$i]' AND `user_registered` < '$dateReg[$mday]'"));
                        if($day_reg4[$i]['ID']){
                            $QuantityDay[$i]++;
                        }
                    }
                    $partnerday3ID[$i] = $partnerday3[$i]['user_id'];
                    $mday = $i-1;
                    if($mday < 0){
                        $dateReg[$mday] = date("Y-m-d 23:59:59");
                    }
                    $day_reg3[$i] = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = $partnerday3ID[$i] AND `user_registered` > '$dateReg[$i]' AND `user_registered` < '$dateReg[$mday]'"));
                    if($day_reg3[$i]['ID']){
                        $QuantityDay[$i]++;
                    }
                }
                $partnerday2ID[$i] = $partnerday2[$i]['user_id'];
                $mday = $i-1;
                if($mday < 0){
                    $dateReg[$mday] = date("Y-m-d 23:59:59");
                }
                $day_reg2[$i] = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = $partnerday2ID[$i] AND `user_registered` > '$dateReg[$i]' AND `user_registered` < '$dateReg[$mday]'"));
                if($day_reg2[$i]['ID']){
                    $QuantityDay[$i]++;
                }
            }
            $partnerday1ID[$i] = $partnerday1[$i]['user_id'];
            $mday = $i-1;
            if($mday < 0){
                $dateReg[$mday] = date("Y-m-d 23:59:59");
            }
            $day_reg1[$i] = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = $partnerday1ID[$i] AND `user_registered` > '$dateReg[$i]'  AND `user_registered` < '$dateReg[$mday]'"));
            if($day_reg1[$i]['ID']){
                $QuantityDay[$i]++;
            }
        }
        $i++;
        $dateNow -= 86400;
    }
    
    
    if(!$balance['umeta_id']) $myBalance = 0;
    else $myBalance = $balance['meta_value'];
    $dateNow = strtotime(date("Y-m-d H:i:s"));
    $youDate = (int)($dateNow-$dateStart)/86400;
    include('pages/office/home/index.php');
}else if($Page == 'profile'){
    $_SESSION['mainMessage'] = "myMain(2,'Профиль','profile');";
    include('pages/office/profile/index.php');
}else if($Page == 'finance'){
    $_SESSION['mainMessage'] = "myMain(4,'Финансы','finance');";  
    $first_name = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'first_name'"));
    $last_name = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'last_name'"));
    $balance = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = '_current_woo_wallet_balance'"));
    if(!$balance['umeta_id']) $myBalance = 0;
    else $myBalance = $balance['meta_value'];
    include('pages/office/finance/index.php');
}else if($Page == 'operation'){
    include('pages/office/finance/operation.php');
}else if($Page == 'programm'){
    $_SESSION['mainMessage'] = "myMain(3,'Программы','programm');";
    include('pages/office/programm/index.php');
}else if($Page == 'aboutModal'){
    $product = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `product` WHERE `id` = $_POST[modal_id]"));
    include('pages/office/programm/aboutModal.php');
}else if($Page == 'statisticModal'){
     $product = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `product` WHERE `id` = $_POST[modal_id]"));
    include('pages/office/programm/statisticModal.php');
}else if($Page == 'partners'){
    $_SESSION['mainMessage'] = "myMain(5,'Партнеры','partners');";  
    include('pages/office/partners/index.php');
}else if($Page == 'userModal'){
    include('pages/office/modal/user.php');
}else if($Page == 'paymantModal'){
    include('pages/office/modal/paymantModal.php');
}else if($Page == 'payModal'){
    include('pages/office/modal/payModal.php');
}else if($Page == 'checkModal'){
    include('pages/office/modal/checkModal.php');
}else if($Page == 'userAdminModal'){
    include('pages/office/modal/userAdmin.php');
}else if($Page == 'productRedModal'){
    $product = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `product` WHERE `id` = $_POST[modal_id]"));
    include('pages/office/modal/productRedModal.php');
}else if($Page == 'financeAdmin'){
    include('pages/office/admin/finance/index.php');
}else if($Page == 'confirm'){
    include('pages/office/admin/confirm/index.php');
}else if($Page == 'promoAdmin'){
    include('pages/office/admin/promokod/index.php');
}else if($Page == 'bot_fol') include('BotFol.php');
else if($Page == 'botSend') include('BotSend.php');

function Ulogin($p1){
    $url1 = 'https://your-site.space/office';
    $url2 = 'https://your-site.pw/';
    if ($p1 <= 0 and $_SESSION['USER_LOGIN_IN'] != $p1) exit(header('Location: '.$url1));
    else if ($_SESSION['USER_LOGIN_IN'] !=$p1) exit(header('Location: '.$url2));
}
function MessageSend($p1, $p2, $p3){
    $_SESSION['noty_header'] = $p1;
    $_SESSION['noty_text'] = $p2;
    $_SESSION['noty_type'] = $p3;
    exit(header('Location: '.$_SERVER['HTTP_REFERER']) );
}
function MessageShow(){
    if ($_SESSION['noty_header']) $Message = "<script>message('".$_SESSION['noty_header']."','".$_SESSION['noty_text']."','".$_SESSION['noty_type']."')</script>";
    echo $Message;
    $_SESSION['noty_header'] = '';
    $_SESSION['noty_text'] = '';
    $_SESSION['noty_type'] = '';
}
function FormChars($p1, $p2 = 0) {
    global $CONNECT;
    if($p2) return mysqli_real_escape_string($CONNECT, $p1);
    else return nl2br(htmlspecialchars(trim($p1), ENT_QUOTES), false);
}    
function GenPass($p1,$p2) {
    return md5('FXMNST'.md5('FX'.$p1.'MNST').md5('FX'.$p2.'MNST'));
}
function generate_password($number)
  {
    $arr = array('a','b','c','d','e','f',
                 'g','h','i','j','k','l',
                 'm','n','o','p','r','s',
                 't','u','v','x','y','z',
                 'A','B','C','D','E','F',
                 'G','H','I','J','K','L',
                 'M','N','O','P','R','S',
                 'T','U','V','X','Y','Z',
                 '1','2','3','4','5','6',
                 '7','8','9','0');
    // Генерируем пароль
    $pass = "";
    for($i = 0; $i < $number; $i++)
    {
      // Вычисляем случайный индекс массива
      $index = rand(0, count($arr) - 1);
      $pass .= $arr[$index];
    }
    return $pass;
  }
function changeDateFormat($sourceDate, $newFormat) {
    $r = date($newFormat, strtotime($sourceDate));
    return $r;
}
function can_upload($file){
	// если имя пустое, значит файл не выбран
    if($file['name'] == '')
		return 'Вы не выбрали файл.';
	
	/* если размер файла 0, значит его не пропустили настройки 
	сервера из-за того, что он слишком большой */
	if($file['size'] == 0)
		return 'Файл слишком большой.';
	
	// разбиваем имя файла по точке и получаем массив
	$getMime = explode('.', $file['name']);
	// нас интересует последний элемент массива - расширение
	$mime = strtolower(end($getMime));
	// объявим массив допустимых расширений
	$types = array('gif', 'bmp','mp4','mpeg','mp3');
	
	// если расширение не входит в список допустимых - return
	if(!in_array($mime, $types))
		return 'Недопустимый тип файла.';
	
	return true;
  }
function make_upload($file, $id){	
// формируем уникальное имя картинки: случайное число и name
	$name = $id.'.gif';
	copy($file['tmp_name'], $name);
}
define('TELEGRAM_TOKEN', '');
function message_to_telegram($text,$id)
{
    $ch = curl_init();
    curl_setopt_array(
        $ch,
        array(
            CURLOPT_URL => 'https://api.telegram.org/botTOKEN/sendMessage',
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_POSTFIELDS => array(
                'chat_id' => $id,
                'text' => $text,
            ),
        )
    );
    curl_exec($ch);
    curl_close($ch);
}

function getYoutubeEmbedUrl($url)
{
    $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
    $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

    if (preg_match($longUrlRegex, $url, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }

    if (preg_match($shortUrlRegex, $url, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }
    return 'https://www.youtube.com/embed/' . $youtube_id ;
}
function wp_hash_password($password) {
    global $wp_hasher;

    if ( empty($wp_hasher) ) {
        require_once('class-phpass.php');
        // By default, use the portable hash from phpass
        $wp_hasher = new PasswordHash(8, TRUE);
    }
    return $wp_hasher->HashPassword($password);
}
function wp_check_password( $password, $hash, $user_id = '' ) {
		global $wp_hasher;
		// If the hash is still md5...
		// If the stored hash is longer than an MD5,
		// presume the new style phpass portable hash.
		if ( empty( $wp_hasher ) ) {
		    require_once('class-phpass.php');
			// By default, use the portable hash from phpass.
			$wp_hasher = new PasswordHash( 8, true );
		}

		$check = $wp_hasher->CheckPassword( $password, $hash );

		/** This filter is documented in wp-includes/pluggable.php */
		return $check;
}
?>