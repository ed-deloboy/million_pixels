<?
$product = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `product` WHERE `id` = $_POST[modal_id]"));
if($product['paymant'] == 1){
    $Active = 'Покупка';
    $infoColor = 'success';
}else if($product['paymant'] == 1){
    $Active = 'Рассрочка';
    $infoColor = 'primary';
}else{
    $Active = 'Аренда';
    $infoColor = 'warning';
}
$avatar = '/assets/img/product/'.$product['id'].'.png';
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
                <h6></h6>
                <p class="meta-date-time text-success"></p>
            </div>
            <div class="task-action">
                <span class="badge outline-badge-<?= $infoColor ?>"> <?= $Active ?> </span><br>
            </div>
        </div>
        <div class="p-1 text-center">
            <div class="row">
                <? if($infoEmail['meta_value']){ ?>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <p class="mb-0"><i class="fas fa-at"></i> <?= $infoEmail['meta_value'] ?></p>
                </div>
                <? } ?>
                <? if($infoPhone['meta_value']){ ?>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <p class="mb-0"><i class="fas fa-phone"></i> <?= $infoPhone['meta_value'] ?></p>
                </div>
                <? } ?>
            </div>
        </div>
        <hr/>
        <div class="p-1 text-center">
        <? if($infoVk['meta_value']){ ?>    
        <a href="<?= $infoVk['meta_value'] ?>" target="_blank" class="btn btn-primary position-relative mt-1 mb-1">
            <span><i class="fab fa-vk"></i> Вконтакте</span>
        </a>
        <? } ?>
        <? if($infoTg['meta_value']){ ?>  
        <a href="https://t.me/<?= $infoTg['meta_value'] ?>" target="_blank" class="btn btn-info position-relative mt-1 mb-1">
            <span><i class="fab fa-telegram-plane"></i> Telegram</span>
        </a>
        <? } ?>
        <? if($infoWa['meta_value']){ ?> 
        <a href="https://wa.me/<?= $infoWa['meta_value'] ?>" target="_blank"class="btn btn-success position-relative mt-1 mb-1">
            <span><i class="fab fa-whatsapp"></i> Whatsapp</span>
        </a>
        <? } ?>
        <? if($infoVb['meta_value']){ ?> 
        <a href="https://viber.click/<?= $infoVb['meta_value'] ?>" target="_blank" class="btn btn-secondary position-relative mt-1 mb-1">
            <span><i class="fab fa-viber"></i> Viber</span>
        </a>
        <? } ?>
        </div>
    </div>
</div>