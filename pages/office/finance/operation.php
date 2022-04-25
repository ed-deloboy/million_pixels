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
    <div class="table-responsive rounded">
        <table class="table mb-4">
            <thead>
                <tr>
                    <th class="text-center d-none d-md-table-cell">#ID</th>
                    <th style="max-width:350px;">Название</th>
                    <th>Сумма</th>
                    <th class="d-none d-md-table-cell">Статус</th>
                    <th class="d-none d-md-table-cell">Дата</th>
                </tr>
            </thead>
            <tbody>
                        <?
                        $kolTR = mysqli_num_rows(mysqli_query($CONNECT, "SELECT * FROM `wp_woo_wallet_transactions` WHERE `user_id` = $_SESSION[USER_ID]"));
                        $i = 1;
                        $TwoOperation1 = mysqli_query($CONNECT, "SELECT * FROM `wp_woo_wallet_transactions` WHERE `user_id` = $_SESSION[USER_ID] ORDER BY `transaction_id` DESC");
                        while($TwoOperation = mysqli_fetch_assoc($TwoOperation1)){
                            if($i > $kon) break;
                            if($i >= $nach and $i <= $kon){   
                                if($TwoOperation['type'] == 'debit' or $TwoOperation['type'] == 'credit' or $TwoOperation['type'] == 'paymant'){
                                    $statusTr = 'danger';
                                    $userPaymant = "";
                                    
                                }else{
                                    $statusTr = 'success';
                                    $IdPaymant = $TwoOperation['deleted'];
                                    $LoginPaymant = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $IdPaymant AND `meta_key` = 'nickname'"));
                                    $userPaymant = "<span class='shadow-none badge outline-badge-success' data-toggle='modal' data-target='#profileModal' style='cursor:pointer;' onclick=document.getElementById('modal_id').value=".$IdPaymant.";post_button('userModal','login','modal_id','userModal');>".$LoginPaymant['meta_value']."</span>";
                                }
                        ?>
                        <tr>
                            <td class="d-none d-md-table-cell">#<?= $kolTR ?></td>
                            <td style="max-width:350px;white-space:normal;"><?= $TwoOperation['details'] ?> <?= $userPaymant ?></td>
                            <td class="text-<?= $statusTr ?>"><?= number_format($TwoOperation['amount'], 0, ',', ' '); ?> ₽</td>
                            <td class="d-none d-md-table-cell">
                                <? if($TwoOperation['blog_id'] == 1){ ?>
                                <span class=" shadow-none badge outline-badge-success">Выполнено</span>
                                <? }else if($TwoOperation['blog_id'] == 2){ ?>
                                <span class=" shadow-none badge outline-badge-primary">В обработке</span>
                                <? }else{ ?>
                                <span class=" shadow-none badge outline-badge-danger">Отказано</span>
                                <? } ?>
                            </td>
                            <td class="d-none d-md-table-cell"><?= changeDateFormat($TwoOperation['date'],'d.m.Y H:i'); ?></td>
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
                            <th class="text-center d-none d-md-table-cell">#ID</th>
                            <th>Название</th>
                            <th>Сумма</th>
                            <th class="d-none d-md-table-cell">Статус</th>
                            <th class="d-none d-md-table-cell">Дата</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
    
    <div class="paginating-container pagination-default">
        <ul class="pagination">
<?
$kol_pag = mysqli_num_rows($TwoOperation1);
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
    <li class="prev"><a style="cursor:pointer;" onclick="document.getElementById('pag').value='<?= $num-1 ?>';post_button('operation','login','pag','operation');"><i class="fas fa-arrow-left"></i></a></li>
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
    <li class="<?= $active ?>"><a style="cursor:pointer;" onclick="document.getElementById('pag').value='<?= $i2_2-1 ?>';post_button('operation','login','pag','operation');"><?= $i2_2; ?></a></li>
<?
    if($i2 > $kol_s+4) break;
    $i2 = $i2+1;
    $i2_2 = $i2_2+1;
}
?>
<?
if($_POST['pag']+1 < $kol_s){
?>
    <li class="next"><a class="" style="cursor:pointer;" onclick="document.getElementById('pag').value='<?= $num ?>';post_button('operation','login','pag','operation');"><i class="fas fa-arrow-right"></i></a></li>
<?
}
?>
    </ul>
<?
}
?>
</div>