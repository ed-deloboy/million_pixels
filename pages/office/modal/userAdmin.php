<?
if($Module == 'delYea'){
    $infoLogin = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = $_POST[modal_id]"));
    $infoSp = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'ud_parent_partner'"));
    $partner_Total1 = mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `meta_key` = 'ud_parent_partner'  AND `meta_value` = '$_POST[modal_id]'");
    while($partnerTotal1 = mysqli_fetch_assoc($partner_Total1)){
        mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$infoSp[meta_value]' WHERE `user_id` = $partner_Total1[user_id] AND `meta_key` = 'ud_parent_partner'");
    }
    mysqli_query($CONNECT, "DELETE FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id]");
    mysqli_query($CONNECT, "DELETE FROM `wp_users` WHERE `ID` = $_POST[modal_id]");
}
if($Module == 'DELETED'){
    $infoLogin = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = $_POST[modal_id]"));
$infoFirstName = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'first_name'"));
$infoLastName = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'last_name'"));
$infoEmail = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'billing_email'"));
$infoPhone = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'ud_phone'"));
$infoWa = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'ud_wa'"));
$infoVk = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'ud_vk'"));
$infoTg = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'ud_tg'"));
$infoVb = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'ud_vb'"));
$infoPartnerCode = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'ud_code'"));
$infoSp = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'ud_parent_partner'"));
$infoSpLogin = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = $infoSp[meta_value]"));
$infoActive = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_wc_customer_lookup` WHERE `user_id` = $_POST[modal_id]"));
if($infoActive['customer_id']){
    $Active = 'Активен';
    $infoColor = 'success';
}else{
    $Active = 'Не активен';
    $infoColor = 'danger';
}
if($_POST['modal_id'] != 1 and $_POST['modal_id'] != $infoSp['meta_value']){
    $userLevelId = $_POST['modal_id'];
    $level = 1;
    while(true){
        $infoLastCode = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $userLevelId AND `meta_key` = 'ud_parent_partner'"));
        //echo $infoLastCode['meta_value'].'=='.$_POST['partnerId'].'<br>';
        if($infoLastCode['meta_value'] != 1){
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
                <p class="meta-date-time text-success"><? if($_POST['modal_id'] == 1){ ?>Это Вы <? }else if($_POST['modal_id'] == $infoSp['meta_value']){ ?>Пригласитель <? }else{ ?> Уровень <span class="badge badge-success counter" style="position:relative;top:0;"><?= $level ?></span><? } ?></p>
            </div>
            <div class="task-action">
                <span class="badge outline-badge-<?= $infoColor ?>"> <?= $Active ?> </span><br>
            </div>
        </div>
        <div class="p-2 text-center">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 modalView">
                    <p class="mb-0"> Точно хотите удалить данного пользователя?</p>
                </div>

            </div>
        </div>
        <hr>
        <button class="btn btn-success float-right mr-2 modalRed" onclick="post_button('userAdminModal/delYea','login','modal_id','userModal');message('Успешно','Аккаунт удален','success');"  data-dismiss="modal" >Да</button>
        <button class="btn btn-warning float-right mr-2 modalView" onclick="post_button('userAdminModal','login','modal_id','userModal');">Нет</button>
    </div>
</div>
<?
}else{
if($Module == 'block_on'){
    mysqli_query($CONNECT, "UPDATE `wp_users` SET `blocked` = 1 WHERE `ID` = $_POST[modal_id]");
}
if($Module == 'block_of'){
    mysqli_query($CONNECT, "UPDATE `wp_users` SET `blocked` = 0 WHERE `ID` = $_POST[modal_id]");
}
if($Module == 'save'){
    mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[first_name]' WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'first_name'");
    mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[last_name]' WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'last_name'");
    mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[email]' WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'billing_email'");
    mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[phone]' WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'ud_phone'");
    mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[wa]' WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'ud_wa'");
    mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[vk]' WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'ud_vk'");
    mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[tg]' WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'ud_tg'");
    mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[vb]' WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'ud_vb'");
    mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$_POST[ud_code]' WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'ud_code'");
    if($_POST['new_password'] != ''){
        $new_pass = wp_hash_password($_POST['new_password']);
        mysqli_query($CONNECT, "UPDATE `wp_users` SET `user_pass` = '$new_pass' WHERE `ID` = $_POST[modal_id]");
    }
}
$infoLogin = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = $_POST[modal_id]"));
$infoFirstName = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'first_name'"));
$infoLastName = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'last_name'"));
$infoEmail = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'billing_email'"));
$infoPhone = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'ud_phone'"));
$infoWa = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'ud_wa'"));
$infoVk = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'ud_vk'"));
$infoTg = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'ud_tg'"));
$infoVb = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'ud_vb'"));
$infoPartnerCode = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'ud_code'"));
$infoSp = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'ud_parent_partner'"));
$infoSpLogin = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = $infoSp[meta_value]"));
$infoActive = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_wc_customer_lookup` WHERE `user_id` = $_POST[modal_id]"));
if($infoActive['customer_id']){
    $Active = 'Активен';
    $infoColor = 'success';
}else{
    $Active = 'Не активен';
    $infoColor = 'danger';
}
if($_POST['modal_id'] != 1 and $_POST['modal_id'] != $infoSp['meta_value']){
    $userLevelId = $_POST['modal_id'];
    $level = 1;
    while(true){
        $infoLastCode = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $userLevelId AND `meta_key` = 'ud_parent_partner'"));
        //echo $infoLastCode['meta_value'].'=='.$_POST['partnerId'].'<br>';
        if($infoLastCode['meta_value'] != 1){
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
                <p class="meta-date-time text-success"><? if($_POST['modal_id'] == 1){ ?>Это Вы <? }else if($_POST['modal_id'] == $infoSp['meta_value']){ ?>Пригласитель <? }else{ ?> Уровень <span class="badge badge-success counter" style="position:relative;top:0;"><?= $level ?></span><? } ?></p>
            </div>
            <div class="task-action">
                <span class="badge outline-badge-<?= $infoColor ?>"> <?= $Active ?> </span><br>
            </div>
        </div>
        <div class="p-2 text-center">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 modalView">
                    <span class="badge outline-badge-success" style="cursor:pointer;" onclick="document.getElementById('modal_id').value=<?= $infoSpLogin['ID'] ?>;post_button('userAdminModal','login','modal_id','userModal');"> <?= $infoSpLogin['user_nicename'] ?></span>
                </div>
                <? if($infoFirstName['meta_value'] or $infoLastName['meta_value']){ ?>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 modalView">
                    <p class="mb-0"> <?= $infoFirstName['meta_value'].' '.$infoLastName['meta_value'] ?></p>
                </div>
                <? } ?>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-none modalRed">
                    <div class="form-group">
                        <label for="fullName">Имя</label>
                        <input type="text" class="form-control mb-4" id="first_name" placeholder="Имя" value="<?= $infoFirstName['meta_value'] ?>">
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-none modalRed">
                    <div class="form-group">
                        <label for="fullName">Фамилия</label>
                        <input type="text" class="form-control mb-4" id="last_name" placeholder="Фамилия" value="<?= $infoLastName['meta_value'] ?>">
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-none modalRed">
                    <div class="form-group">
                        <label for="fullName">Партнерский код</label>
                        <input type="text" class="form-control mb-4" id="ud_code" placeholder="Код" value="<?= $infoPartnerCode['meta_value'] ?>">
                    </div>
                </div>
                <? if($infoEmail['meta_value']){ ?>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 modalView">
                    <p class="mb-0"><i class="fas fa-at"></i> <?= $infoEmail['meta_value'] ?></p>
                </div>
                <? } ?>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-none modalRed">
                    <div class="form-group">
                        <label for="fullName">Email</label>
                        <input type="text" class="form-control mb-4" id="email" placeholder="email" value="<?= $infoEmail['meta_value'] ?>">
                    </div>
                </div>
                <? if($infoPhone['meta_value']){ ?>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12  modalView">
                    <p class="mb-0"><i class="fas fa-phone"></i> <?= $infoPhone['meta_value'] ?></p>
                </div>
                <? } ?>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-none modalRed">
                    <div class="form-group">
                        <label for="fullName">Телефон</label>
                        <input type="text" class="form-control mb-4" id="phone" placeholder="79990000000" value="<?= $infoPhone['meta_value'] ?>">
                    </div>
                </div>
            </div>
        </div>
        <hr/>
        <div class="p-1 text-center">
        <? if($infoVk['meta_value']){ ?>    
        <a href="<?= $infoVk['meta_value'] ?>" target="_blank" class="btn btn-primary position-relative mt-1 mb-1 modalView">
            <span><i class="fab fa-vk"></i> Вконтакте</span>
        </a>
        <? } ?>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-none modalRed">
            <div class="form-group">
                <label for="fullName">Вконтакте</label>
                <input type="text" class="form-control mb-4" id="vk" placeholder="https://vk.com/" value="<?= $infoPhone['meta_value'] ?>">
            </div>
        </div>
        <? if($infoTg['meta_value']){ ?>  
        <a href="https://t.me/<?= str_replace('@','',$infoTg['meta_value']); ?>" target="_blank" class="btn btn-info position-relative mt-1 mb-1 modalView">
            <span><i class="fab fa-telegram-plane"></i> Telegram</span>
        </a>
        <? } ?>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-none modalRed">
            <div class="form-group">
                <label for="fullName">Telegram</label>
                <input type="text" class="form-control mb-4" id="tg" placeholder="@login" value="<?= $infoTg['meta_value'] ?>">
            </div>
        </div>
        <? if($infoWa['meta_value']){ ?> 
        <a href="https://wa.me/<?= $infoWa['meta_value'] ?>" target="_blank" class="btn btn-success position-relative mt-1 mb-1 modalView">
            <span><i class="fab fa-whatsapp"></i> Whatsapp</span>
        </a>
        <? } ?>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-none modalRed">
            <div class="form-group">
                <label for="fullName">Whatsapp</label>
                <input type="text" class="form-control mb-4" id="wa" placeholder="79990000000" value="<?= $infoWa['meta_value'] ?>">
            </div>
        </div>
        <? if($infoVb['meta_value']){ ?> 
        <a href="https://viber.click/<?= $infoVb['meta_value'] ?>" target="_blank" class="btn btn-secondary position-relative mt-1 mb-1 modalView">
            <span><i class="fab fa-viber"></i> Viber</span>
        </a>
        <? } ?>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-none modalRed">
            <div class="form-group">
                <label for="fullName">Viber</label>
                <input type="text" class="form-control mb-4" id="vb" placeholder="79990000000" value="<?= $infoVb['meta_value'] ?>">
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-none modalRed">
            <div class="form-group">
                <label for="fullName">Новый пароль</label>
                <input type="text" class="form-control mb-4" id="new_password" placeholder="Новый пароль" value="">
            </div>
        </div>
        </div>
        <hr>
        <button class="btn btn-success d-none float-right mr-2 modalRed" onclick="OnOf('modalView','modalRed');post_button('userAdminModal/save','login','new_password.vb.wa.tg.vk.phone.email.first_name.last_name.modal_id.ud_code','userModal');">Сохранить</button>
        <button class="btn btn-warning float-right mr-2 modalView" onclick="OnOf('modalRed','modalView');">Редактировать</button>
        <? if($infoLogin['ID'] != 1){ ?>
            <? if($infoLogin['blocked']){ ?>
            <button class="btn btn-danger float-right mr-2 modalView" onclick="post_button('userAdminModal/block_of','login','modal_id','userModal');">Разблокировать</button>
            <? }else{ ?>
            <button class="btn btn-secondary float-right mr-2 modalView" onclick="post_button('userAdminModal/block_on','login','modal_id','userModal');">Заблокировать</button>
            <? } ?>
        <? } ?>
        <a class="btn btn-secondary float-right mr-2 modalView" href="https://fxmonster.space/account/login_in?login=<?= $infoLogin['user_nicename'] ?>&salt=<?= md5($infoLogin['user_login'].$infoLogin['user_email']); ?>" target="_blank">Войти в кабинет</a>
        <? if($infoLogin['ID'] != 1){ ?>
        <button class="btn btn-danger float-right mr-2 mt-2 modalView" onclick="post_button('userAdminModal/DELETED','login','modal_id','userModal');">Удалить</button>
        <? } ?>
    </div>
</div>
<? } ?>