<?
if($_POST['pag']){
    if($_POST['pag'] > 0) $nach = ($_POST['pag']*10)+1;
    else $nach = ($_POST['pag']*10);
    if($_POST['pag'] > 0) $kon = ($_POST['pag']*10)+10;
    else $kon = ($_POST['pag']*10)+10;
}else{
    $nach = 1;
    $kon = 10;
}
if(!$_POST['partnerId']) $_POST['partnerId'] = $_SESSION['USER_ID'];
if($_POST['partnerId'] != $_SESSION['USER_ID']){
    $userLevelId = $_POST['partnerId'];
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
$infoLogin = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = $_POST[partnerId]"));
if($infoLogin['avatar']){
    $avatar = '/assets/img/avatar/'.$infoLogin['avatar'].'/'.$_SESSION['USER_ID'].'.'.$infoLogin['avatar_f'].'?'.rand(1,999);
}else{
    $avatar = '/assets/img/90x90.jpg';
}
$infoLastName = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[partnerId] AND `meta_key` = 'last_name'"));
$infoEmail = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[partnerId] AND `meta_key` = 'billing_email'"));
$infoPhone = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[partnerId] AND `meta_key` = 'ud_phone'"));
$infoWa = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[partnerId] AND `meta_key` = 'ud_wa'"));
$infoVk = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[partnerId] AND `meta_key` = 'ud_vk'"));
$infoTg = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[partnerId] AND `meta_key` = 'ud_tg'"));
$infoVb = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[partnerId] AND `meta_key` = 'ud_vb'"));
$secretEmail = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[partnerId] AND `meta_key` = 'secretEmail'"));
$secretPhone = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[partnerId] AND `meta_key` = 'secretPhone'"));
$secretWa = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[partnerId] AND `meta_key` = 'secretWa'"));
$secretVk = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[partnerId] AND `meta_key` = 'secretVk'"));
$secretTg = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[partnerId] AND `meta_key` = 'secretTg'"));
$secretVb = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[partnerId] AND `meta_key` = 'secretVb'"));
$infoSp2 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[partnerId] AND `meta_key` = 'ud_parent_partner'"));
$infoSp = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'ud_parent_partner'"));
$infoActive = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_wc_customer_lookup` WHERE `user_id` = $_POST[modal_id]"));
$infoCode = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'ud_code'"));
if($infoActive['customer_id']){
    $Active = 'Активен';
    $infoColor = 'success';
}else{
    $Active = 'Не активен';
    $infoColor = 'danger';
}
$Quantity = 0;
$QuantityOne = 0;
$partner_Total1 = mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `meta_key` = 'ud_parent_partner'  AND `meta_value` = '$_POST[partnerId]' AND  `user_id` != '$_SESSION[USER_ID]'");
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
    $QuantityOne++;
    $Quantity++;
}
?>
<input type="hidden" id="partnerId" value="<?= $_POST['partnerId'] ?>">
<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 layout-spacing">
                        <div class="w-100 d-flex">
                        <? if($_POST['partnerId'] != $_SESSION['USER_ID'] and $level > 1){ ?>  
                            <div class="mr-1 w-100">
                            <a href="javascript:void(0);"  class="btn btn-success position-relative btn-block mb-2" onclick="document.getElementById('partnerId').value='<?= $_SESSION['USER_ID'] ?>';post_button('partners','login','partnerId','local-block');">
                                <i class="fas fa-user-circle"></i> В начало</span>
                            </a>
                            </div>
                        <? } ?>
                        <? if($_POST['partnerId'] != $_SESSION['USER_ID']){ ?>   
                            <div class="mr-1 w-100">
                            <a href="javascript:void(0);" class="btn btn-warning position-relative btn-block mb-2" onclick="document.getElementById('partnerId').value='<?= $infoSp2['meta_value'] ?>';post_button('partners','login','partnerId','local-block');">
                                <i class="fas fa-angle-double-left"></i> Назад</span>
                            </a>
                            </div>
                        <? } ?>
                        </div>
                       <div class="widget widget-card-one" style="height:auto;">
                            <div class="widget-content">

                                <div class="media">
                                    <div class="w-img">
                                        <img src="<?= $avatar ?>" alt="avatar">
                                    </div>
                                    <div class="media-body">
                                        <h6><?= $infoLogin['user_nicename'] ?></h6>
                                        <p class="meta-date-time text-success"><? if($_POST['partnerId'] == $_SESSION['USER_ID']){ ?>Это Вы <? }else{ ?> Уровень <span class="badge badge-success counter" style="position:relative;top:0;"><?= $level ?></span><? } ?></p>
                                    </div>
                                    <div class="task-action">
                                        <span class="badge outline-badge-<?= $infoColor ?>"> <?= $Active ?> </span><br>
                                    </div>
                                    
                                </div>
                                        <div class="p-1 text-center">
            <div class="row">
                <? if(trim($infoEmail['meta_value']) != '' and !$secretEmail['meta_value']){ ?>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <p class="mb-0"><i class="fas fa-at"></i> <?= $infoEmail['meta_value'] ?></p>
                </div>
                <? } ?>
                <? if(trim($infoPhone['meta_value']) != '' and !$secretPhone['meta_value']){ ?>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <p class="mb-0"><i class="fas fa-phone"></i> <?= $infoPhone['meta_value'] ?></p>
                </div>
                <? } ?>
            </div>
        </div>
        <hr/>
        <div class="p-1 text-center">
        <? if(trim($infoVk['meta_value']) != '' and !$secretVk['meta_value']){ ?>    
        <a href="<?= $infoVk['meta_value'] ?>" target="_blank" class="btn btn-primary position-relative mt-1 mb-1">
            <span><i class="fab fa-vk"></i> Вконтакте</span>
        </a>
        <? } ?>
        <? if(trim($infoTg['meta_value']) != '' and !$secretTg['meta_value']){ ?>  
        <a href="https://t.me/<?= str_replace('@','',$infoTg['meta_value']); ?>" target="_blank" class="btn btn-info position-relative mt-1 mb-1">
            <span><i class="fab fa-telegram-plane"></i> Telegram</span>
        </a>
        <? } ?>
        <? if(trim($infoWa['meta_value']) != '' and !$secretWa['meta_value']){ ?> 
        <a href="https://wa.me/<?= $infoWa['meta_value'] ?>" target="_blank"class="btn btn-success position-relative mt-1 mb-1">
            <span><i class="fab fa-whatsapp"></i> Whatsapp</span>
        </a>
        <? } ?>
        <? if(trim($infoVb['meta_value']) != '' and !$secretVb['meta_value']){ ?> 
        <a href="https://viber.click/<?= $infoVb['meta_value'] ?>" target="_blank" class="btn btn-secondary position-relative mt-1 mb-1">
            <span><i class="fab fa-viber"></i> Viber</span>
        </a>
        <? } ?>
        </div>
                                <hr/>
                                <div class="w-action">
                                    <div class="card-like text-success">
                                        <span><i class="fas fa-user"></i> <?= $QuantityOne ?></span>
                                    </div>

                                    <div class="read-more text-success">
                                        <span><i class="fas fa-users"></i> <?= $Quantity ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#profileModal"  class="btn btn-primary position-relative btn-block mt-2 mb-2" onclick="document.getElementById('modal_id').value='<?= $infoSp['meta_value'] ?>';post_button('userModal','login','modal_id','userModal');">
                            <i class="fas fa-sitemap"></i> Мой пригласитель</span>
                        </a>
                        <div class="widget widget-card-one mt-1" style="height:auto;">
                            <div class="widget-content text-center">

                                <div class="media">
                                    <div class="media-body text-center">
                                        <h6>Ваш партнерский код:</h6>
                                    </div>
                                    
                                </div>
                                <button type="button" class="btn btn-primary position-relative mt-1 mb-1" onclick="message('Успешно','Код скопирован','success');copyText('copyCode');">
                                    <span><?= $infoCode['meta_value'] ?> <i class="fas fa-copy ml-2"></i></span>
                                </button>
                                <input type="text" id="copyCode" value="<?= $infoCode['meta_value'] ?>" style="position:absolute;bottom:0;opacity:0;left:0;">    
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive rounded">
                            <table id="multi-column-ordering" class="table table-hover rounded" style="width:100%">
                                <thead>
                                    <tr class="rounded">
                                        <th class="d-none d-md-table-cell">Номер</th>
                                        <th>Логин</th>
                                        <th class="d-none d-md-table-cell">Статус</th>
                                        <th>Команда</th>
                                        <th class="d-none d-md-table-cell">Дата регистрации</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?
                                    $kolTR = mysqli_num_rows(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `meta_key` = 'ud_parent_partner' AND `meta_value`  = '$_POST[partnerId]'"));
                                    $i = 1;
                                    $RefList1 = mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `meta_key` = 'ud_parent_partner' AND `meta_value`  = '$_POST[partnerId]' AND `user_id` != $_POST[partnerId]  ORDER BY `umeta_id` DESC");
                                    while($RefList = mysqli_fetch_assoc($RefList1)){
                                        $QuantityList = 0;
                                        $partner_Total1 = mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `meta_key` = 'ud_parent_partner'  AND `meta_value` = '$RefList[user_id]'");
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
                                                                        $QuantityList++;
                                                                    }
                                                                    $QuantityList++;
                                                                }
                                                                $QuantityList++;
                                                            }
                                                            $QuantityList++;
                                                        }
                                                        $QuantityList++;
                                                    }
                                                    $QuantityList++;
                                                }
                                                $QuantityList++;
                                            }
                                            $QuantityList++;
                                        }
                                        //$infoFirstName = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $RefList[user_id] AND `meta_key` = 'first_name'"));
                                        //$infoLastName = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $RefList[user_id] AND `meta_key` = 'last_name'"));
                                        $infoActive = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_wc_customer_lookup` WHERE `user_id` = $RefList[user_id]"));
                                        $infoDate = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = $RefList[user_id]"));
                                        if($i > $kon) break;
                                        if($i >= $nach and $i <= $kon){   
                                            
                                            if(!$infoActive['customer_id']){
                                                $textList = 'danger';
                                                $statusList = 'Не Активен';
                                            }else{
                                                $textList = 'success';
                                                $statusList = 'Активен';
                                            }
                                        if($infoDate['avatar']){
                                            $avatar = '/assets/img/avatar/'.$infoDate['avatar'].'/'.$infoDate['ID'].'.'.$infoDate['avatar_f'].'?'.rand(1,999);
                                        }else{
                                            $avatar = '/assets/img/90x90.jpg';
                                        }
                                    ?>
                                    <tr style="cursor:pointer;" onclick="document.getElementById('partnerId').value='<?= $RefList['user_id'] ?>';post_button('partners','login','partnerId','local-block');">
                                        <td class="text-white d-none d-md-table-cell">#<?= $kolTR ?></td>
                                        <td>
                                            <div class="d-flex">                                                        
                                                <div class="usr-img-frame mr-2 rounded-circle">
                                                    <img alt="avatar" class="img-fluid rounded-circle  w-100 h-100" src="<?= $avatar ?>">
                                                </div>
                                                <p class="align-self-center mb-0 admin-name text-white"> <?= $infoDate['user_nicename'] ?> </p>
                                            </div>
                                        </td>
                                        <td class="d-none d-md-table-cell"><span class="badge outline-badge-<?= $textList ?>"> <?= $statusList ?> </span></td>
                                        <td class="text-white"><i class="fas fa-users"></i> <?= $QuantityList ?></td>
                                        <td class="text-white d-none d-md-table-cell"><?= changeDateFormat($infoDate['user_registered'],'d.m.Y H:i'); ?></td>
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
                                        <th class="d-none d-md-table-cell">Номер</th>
                                        <th>Имя, Фамилия</th>
                                        <th class="d-none d-md-table-cell">Статус</th>
                                        <th>Команда</th>
                                        <th class="d-none d-md-table-cell">Дата регистрации</th>
                                    </tr>
                                </tfoot>
                            </table>
                            </div>
                        </div>
                        <div class="paginating-container pagination-default mt-1">
        <ul class="pagination">
<?
$kol_pag = mysqli_num_rows($RefList1);
if($kol_pag > 10){
$kol_s = ($kol_pag/10);
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
    <li class="prev"><a style="cursor:pointer;" onclick="document.getElementById('pag').value='<?= $num-1 ?>';post_button('partners','login','pag.partnerId','local-block');"><i class="fas fa-arrow-left"></i></a></li>
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
    <li class="<?= $active ?>"><a style="cursor:pointer;" onclick="document.getElementById('pag').value='<?= $i2_2-1 ?>';post_button('partners','login','pag.partnerId','local-block');"><?= $i2_2; ?></a></li>
<?
    if($i2 > $kol_s+4) break;
    $i2 = $i2+1;
    $i2_2 = $i2_2+1;
}
?>
<?
if($_POST['pag']+1 < $kol_s){
?>
    <li class="next"><a class="" style="cursor:pointer;" onclick="document.getElementById('pag').value='<?= $num ?>';post_button('partners','login','pag.partnerId','local-block');"><i class="fas fa-arrow-right"></i></a></li>
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