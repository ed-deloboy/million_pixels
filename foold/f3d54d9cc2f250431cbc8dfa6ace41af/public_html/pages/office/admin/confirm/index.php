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
if($Module == 'ok'){
    $infoBroker = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'broker'"));
    mysqli_query($CONNECT, "UPDATE `wp_users` SET `broker` = '$infoBroker[meta_value]' WHERE `ID` = $_POST[modal_id]");
    mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = '$infoBroker[meta_value]' WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'broker'");
}
if($Module == 'no'){
   mysqli_query($CONNECT, "DELETE FROM `wp_usermeta` WHERE `user_id` = $_POST[modal_id] AND `meta_key` = 'broker'");
}
?>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive rounded">
                            <table id="multi-column-ordering" class="table table-hover rounded" style="width:100%">
                                <thead>
                                    <tr class="rounded">
                                        <th class="">Номер</th>
                                        <th>Логин</th>
                                        <th class="">Счет</th>
                                        <th class="">Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?
                                    $i = 1;
                                    $RefList1 = mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `broker` = '' ORDER BY `ID` DESC");
                                    while($RefList = mysqli_fetch_assoc($RefList1)){
                                        if($i > $kon) break;
                                        if($i >= $nach and $i <= $kon){  
                                        $infoBroker = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $RefList[ID] AND `meta_key` = 'broker'"));
                                        if($infoBroker['meta_key']){
                                        $infoActive = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_wc_customer_lookup` WHERE `user_id` = $RefList[ID]"));
                                        $infoDate = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `ID` = $RefList[ID]"));
                                          
                                        if($infoDate['avatar']){
                                            $avatar = '/assets/img/avatar/'.$infoDate['avatar'].'/'.$infoDate['ID'].'.'.$infoDate['avatar_f'].'?'.rand(1,999);
                                        }else{
                                            $avatar = '/assets/img/90x90.jpg';
                                        }
                                    ?>
                                    <tr style="cursor:pointer;">
                                        <td class="text-white">#<?= $i2 ?></td>
                                        <td>
                                            <div class="d-flex">                                                        
                                                <div class="usr-img-frame mr-2 rounded-circle">
                                                    <img alt="avatar" class="img-fluid rounded-circle" src="<?= $avatar ?>">
                                                </div>
                                                <p class="align-self-center mb-0 admin-name text-white"> <?= $infoDate['user_nicename'] ?> </p>
                                            </div>
                                        </td>
                                        <td class="text-white"><?= $infoBroker['meta_value'] ?></td>
                                        <td class="text-white">
                                            <button class="btn btn-success" onclick="document.getElementById('modal_id').value='<?= $RefList['ID'] ?>';post_button('confirm/ok','login','modal_id','local-block');">Подтвердить</button>
                                            <button class="btn btn-danger"  onclick="document.getElementById('modal_id').value='<?= $RefList['ID'] ?>';post_button('confirm/no','login','modal_id','local-block');">Удалить</button>
                                        </td>
                                    </tr>
                                    <?
                                        
                                    $i++;
                                        }
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr class="rounded">
                                        <th class="">Номер</th>
                                        <th>Логин</th>
                                        <th class="">Счет</th>
                                        <th class="">Действия</th>
                                    </tr>
                                </tfoot>
                            </table>
                            </div>
                        </div>
                    </div>
<div class="paginating-container pagination-default mt-1">
        <ul class="pagination">
<?
$kol_pag = 0;
$KRefList1 = mysqli_query($CONNECT, "SELECT * FROM `wp_users` WHERE `broker` = '' ORDER BY `ID` DESC");
while($KRefList = mysqli_fetch_assoc($KRefList1)){
    $KinfoBroker = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $KRefList[ID] AND `meta_key` = 'broker'"));
    if($KinfoBroker['meta_key']){
        $kol_pag++;
    }
                                        
}
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
    <script>
        $("#local-load").addClass('d-none');
        $("#local-block").removeClass('d-none');
    </script>