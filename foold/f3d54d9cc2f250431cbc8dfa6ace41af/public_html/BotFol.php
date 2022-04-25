<?
require ('vendor/autoload.php'); //Подключаем библиотеку
    use Telegram\Bot\Api; 
    $telegram = new Api('TOEKN');
    /*$response = $telegram->getMe();
    $botId = $response->getId();
    $firstName = $response->getFirstName();
    $username = $response->getUsername();
    print_r($response);*/
    //Устанавливаем токен, полученный у BotFather
    $result = $telegram -> getWebhookUpdates(); //Передаем в переменную $result полную информацию о сообщении пользователя
    $text = $result["message"]["text"]; //Текст сообщения
    $chat_id = $result["message"]["chat"]["id"]; //Уникальный идентификатор пользователя
    $name = str_replace('@','',$result["message"]["from"]["username"]);//Юзернейм пользователя
    $name2 = '@'.$name;
    $first_name = $result["message"]["new_chat_member"]['first_name'];
    $last_name = $result["message"]["new_chat_member"]['last_name'];
    if($text and $chat_id > 0){
        if ($text == "/start") {
            $reply = "Чтобы привязать Ваш аккаунт на сайте к телеграм-боту, нажмите кнопку ПРИВЯЗАТЬ в открывшемся меню.\r\nВнимание!\r\nВаш логин Телеграм, с которого делаете привязку Телеграм бота должен совпадать с логином Телеграм, указанным на сайте FXmonster!";
            $keyboard = [["Привязать"]];
            $reply_markup = $telegram->replyKeyboardMarkup([ 'keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => true ]);
            $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => $reply, 'parse_mode'=> 'HTML', 'reply_markup' => $reply_markup ]);  
            //$telegram->sendPhoto([ 'chat_id' => $chat_id, 'photo' => $url, 'caption' => $reply, 'reply_markup' => $reply_markup]);
        }else if ($text == "Привязать") {
            $name = str_replace('@','',$name);
            $priv = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `meta_key` = 'ud_tg' AND `meta_value` = '$name'"));
            if($priv['umeta_id']){
                mysqli_query($CONNECT, "UPDATE `wp_users` SET `tl_id` = '$chat_id' WHERE `ID` = $priv[user_id]");
                $reply = "🎉 Поздравляем теперь ваш аккаунт привязан к боту FXmonster";
                $keyboard = [["Отвязать"]];
            }else{
                $keyboard = [["Привязать"]];
                $reply = "❌ Данный аккаунт не найден на платформе FXmonster";
            }
            $reply_markup = $telegram->replyKeyboardMarkup([ 'keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false ]);
            $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => $reply, 'parse_mode'=> 'HTML', 'reply_markup' => $reply_markup ]);  
        }else if ($text == "Отвязать") {
            $name = str_replace('@','',$name);
            mysqli_query($CONNECT, "UPDATE `wp_users` SET `tl_id` = '' WHERE `tl_id` = '$chat_id'");
            $reply = "😱 Аккаунт отвязан от бота FXmonster";
            $keyboard = [["Привязать"]];
            $reply_markup = $telegram->replyKeyboardMarkup([ 'keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false ]);
            $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => $reply, 'parse_mode'=> 'HTML', 'reply_markup' => $reply_markup ]);  
        }else{
            $name = str_replace('@','',$name);
            $priv = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `meta_key` = 'ud_tg' AND `meta_value` = '$name'"));
            if($priv['umeta_id']){
                $reply = "Чтобы отвязать Ваш аккаунт от телеграм-бота, нажмите кнопку 'Отвязать' в открывшемся меню.\r\n";
                $keyboard = [["Отвязать"]];
                $reply_markup = $telegram->replyKeyboardMarkup([ 'keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => true ]);
                $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => $reply, 'parse_mode'=> 'HTML', 'reply_markup' => $reply_markup ]); 
            }else{
                $reply = "Чтобы привязать Ваш аккаунт на сайте к телеграм-боту, нажмите кнопку ПРИВЯЗАТЬ в открывшемся меню.\r\nВнимание!\r\nВаш логин Телеграм, с которого делаете привязку Телеграм бота должен совпадать с логином Телеграм, указанным на сайте FXmonster!";
                $keyboard = [["Привязать"]];
                $reply_markup = $telegram->replyKeyboardMarkup([ 'keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => true ]);
                $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => $reply, 'parse_mode'=> 'HTML', 'reply_markup' => $reply_markup ]); 
            }
        }
    }
    echo 'ok';
?>