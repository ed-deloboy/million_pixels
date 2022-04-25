<?
$modal =  mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `product` WHERE `id` = $_POST[modal_id]"));
if($modal['paymant'] == 1){
    $Active = 'Покупка';
    $infoColor = 'success';
}else if($modal['paymant'] == 2){
    $Active = 'Рассрочка';
    $infoColor = 'secondary';
}else{
    $Active = 'Аренда';
    $infoColor = 'warning';
}
$avatar = '/assets/img/product/'.$modal['id'].'.png';
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
                <h6><?= $modal['name'] ?></h6>
            </div>
            <div class="task-action">
                <span class="badge outline-badge-<?= $infoColor ?>"> <?= $Active ?> </span><br>
            </div>
        </div>
        <div class="p-1 text-left">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                    <?
                    if($modal['paymant'] == 1){
                    $Active = 'Покупка';
                        ?>
                        <span class=" shadow-none badge outline-badge-success" style="font-size:1.2rem;"><?= $modal['amount'] ?> <i class="fas fa-ruble-sign"></i></span>
                        <?
                    }else if($modal['paymant'] == 2){
                        ?>
                        <span class=" shadow-none badge outline-badge-success" style="font-size:1.2rem;">2 месяца - <?= $modal['amount']/2 ?> <i class="fas fa-ruble-sign"></i></span>
                        <span class=" shadow-none badge outline-badge-success" style="font-size:1.2rem;">4 месяца - <?= $modal['amount']/4 ?> <i class="fas fa-ruble-sign"></i></span>
                        <?
                    }else{
                        ?>
                        <span class=" shadow-none badge outline-badge-success" style="font-size:1.2rem;"><?= $modal['amount'] ?> <i class="fas fa-ruble-sign"></i></span>
                        <?
                    }
                    ?>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-2">
                    <form enctype="multipart/form-data" method="POST" action="/paymant/<?= $modal['id'] ?>">
                    <p class="mb-2">1.Переведите указанную сумму по одному из способов ниже 👇🏻</p>
                    <p class="mb-3">
                        <span class=" shadow-none badge outline-badge-warning"> <i class="fas fa-credit-card text-warning"></i> 4276 1609 9931 0361</span> &nbsp;Алексей Владимирович М.<br><br>
                        <span class=" shadow-none badge outline-badge-warning" >СПБ: +7 900 100 6156</span> &nbsp;(СБП) система быстрых платежей
                    </p>
                    <p class="mb-0">2.Укажите номер торгового счета</p>
                    <div class="form-group w-100 text-left pl-3 pr-3 pb-3 mt-0 pt-1">
                        <label for="fullName">Торговый счет</label>
                        <input type="text" class="form-control" name="torgAccount" placeholder="Номер счета" required>
                    </div>
                    <p class="mb-0">3.Прикрепите скрин перевода <? if($modal['paymant'] == 2){ ?> и укажите тип рассрочки. <? } ?></p>
                    <? if($modal['paymant'] == 2){ ?>
                    <div class="form-group w-100 text-left p-3 mb-0">
                        <label for="fullName">Тип рассрочки</label>
                        <select class="form-control" name="period" required>
                            <option value="1"> 2 месяца </option>
                            <option value="2"> 4 месяца </option>
                        </select>
                    </div>
                    <? } ?>
                    <div class="custom-file-container p-3 mt-0" data-upload-id="myFirstImage">
                        <label> <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                        <label class="custom-file-container__custom-file" >
                            <input type="file" name="order" class="custom-file-container__custom-file__custom-file-input" accept="image/*" required>
                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                        </label>
                        <div class="custom-file-container__image-preview"></div>
                    </div>
                    <p class="mb-0">4.Введите промокод при наличии</p>
                    <div class="form-group w-100 text-left p-3">
                        <label for="fullName">Промокод</label>
                        <input type="text" class="form-control" name="promoAccount" placeholder="Промокод">
                    </div>
                    <p class="mb-0">5.Нажмите кнопку "Я оплатил"</p>
                    <div class="form-group w-100 text-left p-3">
                        <button type="submit" class="btn btn-success">Я оплатил</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var firstUpload = new FileUploadWithPreview('myFirstImage');
</script>