<?
if($Module == 'new'){
    mysqli_query($CONNECT, "INSERT INTO `contact` (`id`, `name`, `link`) VALUES (NULL, '$_POST[name]', '$_POST[link]')");
}
if($Module == 'save'){
    $name = 'name'.$_POST['modal_id'];
    $link = 'link'.$_POST['modal_id'];
    mysqli_query($CONNECT, "UPDATE `contact` SET `name` = '$_POST[$name]' WHERE `id` = $_POST[modal_id]");
    mysqli_query($CONNECT, "UPDATE `contact` SET `link` = '$_POST[$link]' WHERE `id` = $_POST[modal_id]");
}
if($Module == 'no'){
   mysqli_query($CONNECT, "DELETE FROM `contact` WHERE `id` = $_POST[modal_id]");
   ?>
   <script>message('Успешно','Продукт удален','error');</script>
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
                                        <th>Название</th>
                                        <th class="">Ссылка</th>
                                        <th class="">Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="cursor:pointer;">
                                        <td class="text-white">#auto</td>
                                        
                                        <td class="">
                                            <input type="text" id="name" class="form-control" value="" placeholder="Название">
                                        </td>
                                        <td class="">
                                            <input type="text" id="link" class="form-control" value="" placeholder="Ссылка">
                                        </td>
                                        <td class="text-white">
                                            <button class="btn btn-success" onclick="post_button('contactAdmin/new','login','modal_id.name.link','local-block');">Создать</button>
                                        </td>
                                    </tr>
                                    <?
                                    $i2 = 1;
                                    $RefList1 = mysqli_query($CONNECT, "SELECT * FROM `contact` ORDER BY `id` DESC");
                                    while($RefList = mysqli_fetch_assoc($RefList1)){
                                    ?>
                                    <tr style="cursor:pointer;">
                                        <td class="text-white d-none d-md-table-cell">#<?= $i2 ?></td>
                                        
                                        <td class="text-white">
                                            <input type="text" class="form-control" id="name<?= $RefList['id'] ?>" value="<?= $RefList['name'] ?>">
                                        </td>
                                        <td class="text-white">
                                            <input type="text" class="form-control" id="link<?= $RefList['id'] ?>" value="<?= $RefList['link'] ?>">
                                        </td>
                                        <td class="">
                                            <button class="btn btn-success"data-toggle="modal" data-target="#aboutModal" onclick="document.getElementById('modal_id').value=<?= $RefList['id'] ?>;post_button('contactAdmin/save','login','modal_id.link<?= $RefList['id'] ?>.name<?= $RefList['id'] ?>','productAbout');">Сохранить</button>
                                            <button class="btn btn-danger"  onclick="document.getElementById('modal_id').value='<?= $RefList['id'] ?>';post_button('contactAdmin/no','login','modal_id','local-block');">Удалить</button>
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
                                        <th>Название</th>
                                        <th class="">Ссылка</th>
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