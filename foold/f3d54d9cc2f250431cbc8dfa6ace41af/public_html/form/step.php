<?
if($Module == 1){
    $_SESSION['mainMessage'] = "myMain(1,'Главная','home');";
}else if($Module == 2){
    $_SESSION['mainMessage'] = "myMain(2,'Профиль','profile');";
}else if($Module == 3){
    $_SESSION['mainMessage'] = "myMain(3,'Программы','programm');";   
}else if($Module == 4){
    $_SESSION['mainMessage'] = "myMain(4,'Финансы','finance');";    
}else if($Module == 5){
    $_SESSION['mainMessage'] = "myMain(5,'Партнеры','partners');";    
}else if($Module == 6){
    $_SESSION['mainMessage2'] = "myMain(6,'Пользователи','usersAdmin');";    
}else if($Module == 7){
    $_SESSION['mainMessage2'] = "myMain(7,'Финансы','financeAdmin');";    
}else if($Module == 8){
    $_SESSION['mainMessage2'] = "myMain(8,'Уведомления','notifyAdmin');";   
}else if($Module == 9){
    $_SESSION['mainMessage2'] = "myMain(9,'Программы','programAdmin');";    
}else if($Module == 10){
    $_SESSION['mainMessage2'] = "myMain(10,'Подтверждение пользователей','confirmAdmin');";    
}else if($Module == 11){
    $_SESSION['mainMessage2'] = "myMain(11,'Контакты','contactAdmin');";    
}