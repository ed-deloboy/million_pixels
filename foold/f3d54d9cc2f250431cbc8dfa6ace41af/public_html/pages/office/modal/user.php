<?
$infoLogin = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = $_POST[modal_id]"));
$infoLastName = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'last_name'"));
$infoEmail = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'billing_email'"));
$infoPhone = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'ud_phone'"));
$infoWa = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'ud_wa'"));
$infoVk = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'ud_vk'"));
$infoTg = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'ud_tg'"));
$infoVb = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'ud_vb'"));
$secretEmail = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'secretEmail'"));
$secretPhone = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'secretPhone'"));
$secretWa = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'secretWa'"));
$secretVk = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'secretVk'"));
$secretTg = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'secretTg'"));
$secretVb = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'secretVb'"));
$infoActive = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_wc_customer_lookup` WHERE `user_id` = $_POST[modal_id]"));
if($infoActive['customer_id']){
    $Active = 'Активен';
    $infoColor = 'success';
}else{
    $Active = 'Не активен';
    $infoColor = 'danger';
}
if($_POST['modal_id'] != $_SESSION['USER_ID'] and $_POST['modal_id'] > $_SESSION['USER_ID']){
    $userLevelId = $_POST['modal_id'];
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
                <p class="meta-date-time text-success"><? if($_POST['modal_id'] == $_SESSION['USER_ID']){ ?>Это Вы <? }else if($_POST['modal_id'] < $_SESSION['USER_ID']){ ?>Пригласитель <? }else{ ?> Уровень <span class="badge badge-success counter" style="position:relative;top:0;"><?= $level ?></span><? } ?></p>
            </div>
            <div class="task-action">
                <span class="badge outline-badge-<?= $infoColor ?>"> <?= $Active ?> </span><br>
            </div>
        </div>
        <div class="p-1 text-center">
            <div class="row">
                <? if($infoEmail['meta_value'] and !$secretEmail['meta_value']){ ?>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <p class="mb-0"><i class="fas fa-at"></i> <?= $infoEmail['meta_value'] ?></p>
                </div>
                <? } ?>
                <? if($infoPhone['meta_value'] and !$secretPhone['meta_value']){ ?>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <p class="mb-0"><i class="fas fa-phone"></i> <?= $infoPhone['meta_value'] ?></p>
                </div>
                <? } ?>
            </div>
        </div>
        <hr/>
        <div class="p-1 text-center">
        <? if($infoVk['meta_value'] and !$secretVk['meta_value']){ ?>    
        <a href="<?= $infoVk['meta_value'] ?>" target="_blank" class="btn btn-primary position-relative mt-1 mb-1">
            <span><i class="fab fa-vk"></i> Вконтакте</span>
        </a>
        <? } ?>
        <? if($infoTg['meta_value'] and !$secretTg['meta_value']){ ?>  
        <a href="https://t.me/<?= str_replace('@','',$infoTg['meta_value']); ?>" target="_blank" class="btn btn-info position-relative mt-1 mb-1">
            <span><i class="fab fa-telegram-plane"></i> Telegram</span>
        </a>
        <? } ?>
        <? if($infoWa['meta_value'] and !$secretWa['meta_value']){ ?> 
        <a href="https://wa.me/<?= $infoWa['meta_value'] ?>" target="_blank"class="btn btn-success position-relative mt-1 mb-1">
            <span><i class="fab fa-whatsapp"></i> Whatsapp</span>
        </a>
        <? } ?>
        <? if($infoVb['meta_value'] and !$secretVb['meta_value']){ ?> 
        <a href="https://viber.click/<?= $infoVb['meta_value'] ?>" target="_blank" class="btn btn-secondary position-relative mt-1 mb-1">
            <span><i class="fab fa-viber"></i> Viber</span>
        </a>
        <? } ?>
        </div>
    </div>
</div>