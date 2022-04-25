<?
if($Module == 'new'){
    $kod = generate_password(8);
    mysqli_query($CONNECT, "INSERT INTO `promokod` (`id`, `amount`, `kod`) VALUES (NULL, '$_POST[amount]', '$kod')");
    ?>
    <script>message('Успешно','Промокод Создан','success');</script>
    <?
}

if($Module == 'no'){
   mysqli_query($CONNECT, "DELETE FROM `promokod` WHERE `id` = $_POST[modal_id]");
   ?>
   <script>message('Успешно','Продукт удален','success');</script>
   <?
}
?>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive rounded">
                            <table id="multi-column-ordering" class="table table-hover rounded" style="width:100%">
                                <thead>
                                    <tr class="rounded">
                                        <th class="">Номер</th>
                                        <th>Сумма</th>
                                        <th class="">Код</th>
                                        <th class="">Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="cursor:pointer;">
                                        <td class="text-white">#auto</td>
                                        
                                        <td class="">
                                            <input type="text" id="amount" class="form-control" value="" placeholder="Сумма">
                                        </td>
                                        <td class="">
                                           auto
                                        </td>
                                        <td class="text-white">
                                            <button class="btn btn-success" onclick="post_button('promoAdmin/new','login','modal_id.amount','local-block');">Создать</button>
                                        </td>
                                    </tr>
                                    <?
                                    $i2 = 1;
                                    $RefList1 = mysqli_query($CONNECT, "SELECT * FROM `promokod` ORDER BY `id` DESC");
                                    while($RefList = mysqli_fetch_assoc($RefList1)){
                                    ?>
                                    <tr style="cursor:pointer;">
                                        <td class="text-white d-none d-md-table-cell">#<?= $i2 ?></td>
                                        
                                        <td class="text-white">
                                            <?= $RefList['amount'] ?>
                                        </td>
                                        <td class="text-white">
                                            <?= $RefList['kod'] ?>
                                        </td>
                                        <td class="">
                                            <button class="btn btn-danger"  onclick="document.getElementById('modal_id').value='<?= $RefList['id'] ?>';post_button('promoAdmin/no','login','modal_id','local-block');">Удалить</button>
                                        </td>
                                    </tr>
                                    <?
                                    $i2++;
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr class="rounded">
                                        <th class="">Номер</th>
                                        <th>Сумма</th>
                                        <th class="">Код</th>
                                        <th class="">Действия</th>
                                    </tr>
                                </tfoot>
                            </table>
                            </div>
                        </div>
                    </div>
    <script>
        $("#local-load").addClass('d-none');
        $("#local-block").removeClass('d-none');
    </script>