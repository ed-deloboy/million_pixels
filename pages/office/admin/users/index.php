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
?>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="input-group mb-1">
                              <input type="text" class="form-control" id="user_search" placeholder="Введите логин или email" value="<?= $_POST['user_search'] ?>">
                              <div class="input-group-append">
                                <button class="btn btn-primary" onclick="post_button('usersAdmin','login','user_search','local-block');">Найти</button>
                              </div>
                            </div>
                            <div class="table-responsive rounded">
                            <table id="multi-column-ordering" class="table table-hover rounded" style="width:100%">
                                <thead>
                                    <tr class="rounded">
                                        <th class="">Номер</th>
                                        <th>Логин</th>
                                        <th class="">Статус</th>
                                        <th>Команда</th>
                                        <th class="">Баланс</th>
                                        <th class="">Дата регистрации</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?
                                    $i = 1;
                                    if($_POST['user_search'] != ''){
                                        $kolTR = mysqli_num_rows(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `user_nicename` = '$_POST[user_search]' OR `user_email` = '$_POST[user_search]'"));
                                        $RefList1 = mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `user_nicename` = '$_POST[user_search]' OR `user_email` = '$_POST[user_search]' ORDER BY `ID` DESC");
                                    }else{
                                        $kolTR = mysqli_num_rows(mysqli_query($CONNECT, "SELECT * FROM `wp_users`"));
                                        $RefList1 = mysqli_query($CONNECT, "SELECT * FROM `wp_users` ORDER BY `ID` DESC");
                                    }
                                    while($RefList = mysqli_fetch_assoc($RefList1)){
                                        $QuantityList = 0;
                                        $partner_Total1 = mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `meta_key` = 'ud_parent_partner'  AND `meta_value` = '$RefList[ID]' AND `user_id` != 1");
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
                                        //$infoFirstName = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $RefList[ID] AND `meta_key` = 'first_name'"));
                                        //$infoLastName = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $RefList[ID] AND `meta_key` = 'last_name'"));
                                        $infoBalance = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `meta_key` = '_current_woo_wallet_balance' AND `user_id` = $RefList[ID]"));
                                        if(!$infoBalance['meta_value']) $infoBalance['meta_value'] = 0;
                                        $infoActive = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_wc_customer_lookup` WHERE `user_id` = $RefList[ID]"));
                                        $infoDate = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = $RefList[ID]"));
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
                                    <tr style="cursor:pointer;" data-toggle='modal' data-target='#profileModal' onclick="document.getElementById('modal_id').value=<?= $RefList['ID'] ?>;post_button('userAdminModal','login','modal_id','userModal');">
                                        <td class="text-white">#<?= $kolTR ?></td>
                                        <td>
                                            <div class="d-flex">                                                        
                                                <div class="usr-img-frame mr-2 rounded-circle">
                                                    <img alt="avatar" class="img-fluid rounded-circle w-100 h-100" src="<?= $avatar ?>">
                                                </div>
                                                <p class="align-self-center mb-0 admin-name text-white"> <?= $infoDate['user_nicename'] ?> </p>
                                            </div>
                                        </td>
                                        <td class=""><span class="badge outline-badge-<?= $textList ?>"> <?= $statusList ?> </span></td>
                                        <td class="text-white"><i class="fas fa-users"></i> <?= $QuantityList ?></td>
                                        <td class="text-white"><?= $infoBalance['meta_value'] ?> <i class="fa fa-ruble-sign"></i></td>
                                        <td class="text-white"><?= changeDateFormat($infoDate['user_registered'],'d.m.Y H:i'); ?></td>
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
                                        <th class="">Номер</th>
                                        <th>Имя, Фамилия</th>
                                        <th class="">Статус</th>
                                        <th>Команда</th>
                                        <th class="">Баланс</th>
                                        <th class="">Дата регистрации</th>
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
    <li class="prev"><a style="cursor:pointer;" onclick="document.getElementById('pag').value='<?= $num-1 ?>';post_button('usersAdmin','login','pag','local-block');"><i class="fas fa-arrow-left"></i></a></li>
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
    <li class="<?= $active ?>"><a style="cursor:pointer;" onclick="document.getElementById('pag').value='<?= $i2_2-1 ?>';post_button('usersAdmin','login','pag','local-block');"><?= $i2_2; ?></a></li>
<?
    if($i2 > $kol_s+4) break;
    $i2 = $i2+1;
    $i2_2 = $i2_2+1;
}
?>
<?
if($_POST['pag']+1 < $kol_s){
?>
    <li class="next"><a class="" style="cursor:pointer;" onclick="document.getElementById('pag').value='<?= $num ?>';post_button('usersAdmin','login','pag','local-block');"><i class="fas fa-arrow-right"></i></a></li>
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