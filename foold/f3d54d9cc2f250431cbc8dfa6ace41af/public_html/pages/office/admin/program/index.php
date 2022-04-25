<?
if($Module == 'no'){
   mysqli_query($CONNECT, "DELETE FROM `product` WHERE `id` = $_POST[modal_id]");
   ?>
   <script>message('Успешно','Продукт удален','error');</script>
   <?
}
?>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <button class="btn btn-success"data-toggle="modal" data-target="#aboutModal" onclick="post_button('productRedModal/new','login','modal_id','productAbout');">Создать</button>
                            <div class="table-responsive rounded mt-2">
                            <table id="multi-column-ordering" class="table table-hover rounded" style="width:100%">
                                <thead>
                                    <tr class="rounded">
                                        <th class="">Номер</th>
                                        <th>Название</th>
                                        <th class="l">Тип</th>
                                        <th class="">Цена</th>
                                        <th class="">Индекс</th>
                                        <th class="">Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?
                                    $i2 = 1;
                                    $RefList1 = mysqli_query($CONNECT, "SELECT * FROM `product` ORDER BY `_index` DESC");
                                    while($RefList = mysqli_fetch_assoc($RefList1)){
                                        $avatar = '/assets/img/product/'.$RefList['id'].'.png?'.rand(1,999);
                                    ?>
                                    <tr style="cursor:pointer;">
                                        <td class="text-white">#<?= $i2 ?></td>
                                        <td>
                                            <div class="d-flex">                                                        
                                                <div class="usr-img-frame mr-2 rounded-circle">
                                                    <img alt="avatar" class="img-fluid rounded-circle" src="<?= $avatar ?>">
                                                </div>
                                                <p class="align-self-center mb-0 admin-name text-white"> <?= $RefList['name'] ?> </p>
                                            </div>
                                        </td>
                                        <td class="text-white">
                                            <? if($RefList['paymant'] == 1){ ?>
                                                Покупка
                                            <? } ?>
                                            <? if($RefList['paymant'] == 2){ ?>
                                                Рассрочка
                                            <? } ?>
                                            <? if($RefList['paymant'] == 3){ ?>
                                                Аренда
                                            <? } ?>
                                        </td>
                                        <td class="text-white">
                                            <?= $RefList['amount'] ?>
                                        </td>
                                        <td class="text-white">
                                            <?= $RefList['_index'] ?>
                                        </td>
                                        <td class="text-white">
                                            <button class="btn btn-success"data-toggle="modal" data-target="#aboutModal" onclick="document.getElementById('modal_id').value=<?= $RefList['id'] ?>;post_button('productRedModal/red','login','modal_id','productAbout');">Редактировать</button>
                                            <button class="btn btn-danger"  onclick="document.getElementById('modal_id').value='<?= $RefList['ID'] ?>';post_button('product/no','login','modal_id','local-block');">Удалить</button>
                                        </td>
                                    </tr>
                                    <?
                                    $i2++;
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr class="rounded">
                                        <th class="d-none d-md-table-cell">Номер</th>
                                        <th>Логин</th>
                                        <th class="d-none d-md-table-cell">Счет</th>
                                        <th class="d-none d-md-table-cell">Действия</th>
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