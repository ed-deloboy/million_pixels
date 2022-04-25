<?
$product1 = mysqli_query($CONNECT, "SELECT * FROM `product` ORDER BY `_index`");
while($product = mysqli_fetch_assoc($product1)){
    if($product['paymant'] == 3) $paymant = 'Аренда';
    else if($product['paymant'] == 2) $paymant = 'Рассрочка';
    else $paymant = 'Покупка';
    ?>
    <div class="card component-card_9 mb-2">
        <img src="assets/img/product/<?= $product['id'] ?>.png" class="card-img-top" alt="widget-card-2">
        <div class="card-body">
            <h5 class="card-title"><?= $product['name'] ?> - <?= $paymant ?></h5>
            <div class="row w-100 text-center m-0">
                <? if($product['type'] == 1){ ?>
                <div class="col-xl-6 col-lg-6 col-md-12 p-1">
                    <button class="btn btn-warning btn-block mt-0 mr-0" data-toggle="modal" data-target="#statisticModal" onclick="document.getElementById('modal_id').value=<?= $product['id'] ?>;post_button('statisticModal','login','modal_id','productStatistic');">Статистика</button>
                </div>
                 <? } ?>
                <div class="col-xl-6 col-lg-6 col-md-12 p-1">
                    <button class="btn btn-secondary btn-block mt-0 mr-0" data-toggle="modal" data-target="#aboutModal" onclick="document.getElementById('modal_id').value=<?= $product['id'] ?>;post_button('aboutModal','login','modal_id','productAbout');">Описание</button>
                </div>
            </div>
            <div class="meta-info">
                <div class="meta-user">
                    <div class="avatar avatar-sm">
                        <button class="btn btn-success" data-toggle="modal" data-target="#profileModal" onclick="document.getElementById('modal_id').value=<?= $product['id'] ?>;post_button('paymantModal','login','modal_id','userModal');">Приобрести</button>
                    </div>
                </div>
                <div class="meta-action">
                    <div class="meta-view">
                        <?= number_format($product['amount'], 0, ',', ' '); ?> <i class="fas fa-ruble-sign"></i> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?
}
?>
<script>
    $("#local-load").addClass('d-none');
    $("#local-block").removeClass('d-none');
</script>