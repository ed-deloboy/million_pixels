<div class="widget widget-card-one w-100 pt-0" style="height:auto;">
    <div class="w-100 text-right mt-0 mb-1">
    <button type="button" class="close float-none" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 layout-spacing">
            <img class="w-100 rounded" src="/assets/img/product/<?= $product['id'] ?>.png">
            <div class="widget widget-account-invoice-three">
                <div class="widget-content p-0">
                    <div class="bills-stats  mt-2">
                        <span>Распределение</span>
                    </div>
                    <div class="invoice-list">
                        <div class="inv-detail">
                            <div class="info-detail-1">
                                <p>Уровень</p>
                                <?
                                if($product['paymant'] == 2){
                                    $amount1 = (($product['award']*0.7)/2).'/'.(($product['award']*0.7)/4);
                                    $amount2 = (($product['award']*0.1)/2).'/'.(($product['award']*0.1)/4);
                                    $amount3 = (($product['award']*0.06)/2).'/'.(($product['award']*0.06)/4);
                                    $amount4 = (($product['award']*0.01)/2).'/'.(($product['award']*0.01)/4);
                                    $padding = 'p-0';
                                ?>
                                    <p>Сумма</p>
                                <?
                                }else{
                                    $amount1 = $product['award']*0.7;
                                    $amount2 = $product['award']*0.1;
                                    $amount3 = $product['award']*0.06;
                                    $amount4 = $product['award']*0.01;
                                ?>
                                    <p>Сумма</p>
                                <? } ?>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-list">
                        <div class="inv-detail">
                            <div class="info-detail-1">
                                <p>Уровень 1</p>
                                <p class="<?= $padding ?>"><span class="bill-amount"><?= $amount1 ?></span> <span class="w-currency"><i class="fa fa-ruble-sign"></i></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-list">
                        <div class="inv-detail">
                            <div class="info-detail-1">
                                <p>Уровень 2</p>
                                <p class="<?= $padding ?>"><span class="bill-amount"><?= $amount2 ?></span> <span class="w-currency"><i class="fa fa-ruble-sign"></i></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-list">
                        <div class="inv-detail">
                            <div class="info-detail-1">
                                <p>Уровень 3</p>
                                <p class="<?= $padding ?>"><span class="bill-amount"><?= $amount2 ?></span> <span class="w-currency"><i class="fa fa-ruble-sign"></i></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-list">
                        <div class="inv-detail">
                            <div class="info-detail-1">
                                <p>Уровень 4</p>
                                <p class="<?= $padding ?>"><span class="bill-amount"><?= $amount3 ?></span> <span class="w-currency"><i class="fa fa-ruble-sign"></i></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-list">
                        <div class="inv-detail">
                            <div class="info-detail-1">
                                <p>Уровень 5</p>
                                <p class="<?= $padding ?>"><span class="bill-amount"><?= $amount4 ?></span> <span class="w-currency"><i class="fa fa-ruble-sign"></i></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-list">
                        <div class="inv-detail">
                            <div class="info-detail-1">
                                <p>Уровень 6</p>
                                <p class="<?= $padding ?>"><span class="bill-amount"><?= $amount4 ?></span> <span class="w-currency"><i class="fa fa-ruble-sign"></i></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-list">
                        <div class="inv-detail">
                            <div class="info-detail-1">
                                <p>Уровень 7</p>
                                <p class="<?= $padding ?>"><span class="bill-amount"><?= $amount4 ?></span> <span class="w-currency"><i class="fa fa-ruble-sign"></i></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-list">
                        <div class="inv-detail">
                            <div class="info-detail-1">
                                <p>Уровень 8</p>
                                <p class="<?= $padding ?>"><span class="bill-amount"><?= $amount4 ?></span> <span class="w-currency"><i class="fa fa-ruble-sign"></i></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 layout-spacing">
            <p><?= nl2br($product['about']) ?></p>
        </div>
    </div>
</div>