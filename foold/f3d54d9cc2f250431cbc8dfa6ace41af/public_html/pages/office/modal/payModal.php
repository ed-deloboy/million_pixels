<?
$trans = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_woo_wallet_transactions` WHERE `transaction_id` = $_POST[modal_id]"));
$infoLogin = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = $trans[user_id]"));
$infoActive = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_wc_customer_lookup` WHERE `user_id` = $trans[user_id]"));
if($infoActive['customer_id']){
    $Active = 'Активен';
    $infoColor = 'success';
}else{
    $Active = 'Не активен';
    $infoColor = 'danger';
}
if($trans['user_id'] != $_SESSION['USER_ID'] and $trans['modal_id'] != $infoSp['user_id']){
    $userLevelId = $trans['user_id'];
    $level = 1;
    while(true){
        $infoLastCode = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $userLevelId AND `meta_key` = 'ud_parent_partner'"));
        //echo $infoLastCode['meta_value'].'=='.$_POST['partnerId'].'<br>';
        if($infoLastCode['meta_value'] != $_SESSION['USER_ID']){
            $userLevelId = $infoLastCode['meta_value'];
            $level++;
        }else{
            
            break;
        }
    }
}
if($infoLogin['avatar']){
    $avatar = '/assets/img/avatar/'.$infoLogin['avatar'].'/'.$infoLogin['ID'].'.'.$infoLogin['avatar_f'].'?'.rand(1,999);
}else{
    $avatar = '/assets/img/90x90.jpg';
}
?>
<div class="widget widget-card-one w-100 pt-0" style="height:auto;">
    <div class="w-100 text-right mt-0 mb-1">
    <button type="button" class="close float-none" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="widget-content">
        <div class="media">
            <div class="w-img">
                <img src="<?= $avatar ?>" alt="avatar">
            </div>
            <div class="media-body">
                <h6><?= $infoLogin['user_nicename'] ?></h6>
                <p class="meta-date-time text-success"><? if($trans['user_id'] == $_SESSION['USER_ID']){ ?>Это Вы <? }else if($trans['user_id'] == $infoSp['meta_value']){ ?>Пригласитель <? }else{ ?> Уровень <span class="badge badge-success counter" style="position:relative;top:0;"><?= $level ?></span><? } ?></p>
            </div>
            <div class="task-action">
                <span class="badge outline-badge-<?= $infoColor ?>"> <?= $Active ?> </span><br>
            </div>
        </div>
        <div class="p-1 text-center">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <p class="mb-0"><?= $trans['Account'] ?></p>
                </div>
            </div>
        </div>
    </div>
</div>