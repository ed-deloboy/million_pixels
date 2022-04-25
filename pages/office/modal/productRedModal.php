<? if($Module == 'red'){ ?>
<div class="widget widget-card-one w-100 pt-0" style="height:auto;">
    <div class="w-100 text-right mt-0 mb-1">
    <button type="button" class="close float-none" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <form action="/redProduct/red" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $product['id'] ?>">
            <div class="form-group w-100 mt-2">
                <label>Название</label>
                <textarea class="form-control" name="name"><?= $product['name']; ?></textarea>
            </div>
            <div class="form-group w-100 mt-2">
                <label>Описание</label>
                <textarea class="form-control" name="about"><?= $product['about']; ?></textarea>
            </div>
            <div class="form-group w-100 mt-2">
                <label>Статистика</label>
                <textarea class="form-control" name="statistik"><?= $product['statistik']; ?></textarea>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="form-group w-100 mt-2">
                        <label>Оплата</label>
                        <select class="form-control" name="paymant">
                            <? if($product['paymant'] == 1){ ?>
                            <option value="1">Покупка</option>
                            <option value="2">Рассрочка</option>
                            <option value="3">Аренда</option>
                            <? }else if($product['paymant'] == 2){ ?>
                            <option value="2">Рассрочка</option>
                            <option value="1">Покупка</option>
                            <option value="3">Аренда</option>
                            <? }else{ ?>
                            <option value="3">Аренда</option>
                            <option value="2">Рассрочка</option>
                            <option value="1">Покупка</option>
                            <? } ?>
                        </select>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="form-group w-100 mt-2">
                        <label>Тип</label>
                        <select class="form-control" name="type">
                             <? if($product['type'] == 1){ ?>
                            <option value="1">Программа</option>
                            <option value="2">Услуга</option>
                            <? }else if($product['type'] == 2){ ?>
                            <option value="2">Услуга</option>
                            <option value="1">Программа</option>
                            <? } ?>
                        </select>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="form-group w-100 mt-2">
                        <label>Цена</label>
                        <input type="number" class="form-control" name="amount" value="<?= $product['amount']; ?>">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="form-group w-100 mt-2">
                        <label>Распределение</label>
                        <input type="number" class="form-control"  name="award" value="<?= $product['award']; ?>">
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="form-group w-100 mt-2">
                        <label>Индекс</label>
                        <input type="number" class="form-control" name="index" value="<?= $product['_index']; ?>">
                    </div>
                </div>
            </div>
            <div class="custom-file-container p-3 mt-0" data-upload-id="myFirstImage">
                <label> <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                <label class="custom-file-container__custom-file" >
                    <input type="file" name="img" class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                </label>
                <div class="custom-file-container__image-preview"></div>
            </div>
            <div class="w-100 text-center"><button type="submit" class="btn btn-success">Сохранить</button></div>
        </form>
        </div>
    </div>
</div>
<script>
    var firstUpload = new FileUploadWithPreview('myFirstImage');
</script>
<? }else{ ?>
<div class="widget widget-card-one w-100" style="height:auto;">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <form action="/redProduct/new" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="">
            <div class="form-group w-100 mt-2">
                <label>Название</label>
                <textarea class="form-control" name="name"></textarea>
            </div>
            <div class="form-group w-100 mt-2">
                <label>Описание</label>
                <textarea class="form-control" name="about"></textarea>
            </div>
            <div class="form-group w-100 mt-2">
                <label>Статистика</label>
                <textarea class="form-control" name="statistik"></textarea>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="form-group w-100 mt-2">
                        <label>Оплата</label>
                        <select class="form-control" name="paymant">
                            <option value="1">Покупка</option>
                            <option value="2">Рассрочка</option>
                            <option value="3">Аренда</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="form-group w-100 mt-2">
                        <label>Тип</label>
                        <select class="form-control" name="type">
                            <option value="1">Программа</option>
                            <option value="2">Услуга</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="form-group w-100 mt-2">
                        <label>Цена</label>
                        <input type="number" class="form-control" name="amount"  value="0">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="form-group w-100 mt-2">
                        <label>Распределение</label>
                        <input type="number" class="form-control"  name="award" value="0">
                    </div>
                </div>
            </div>
            <div class="custom-file-container p-3 mt-0" data-upload-id="myFirstImage">
                <label> <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                <label class="custom-file-container__custom-file" >
                    <input type="file" name="img" class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                </label>
                <div class="custom-file-container__image-preview"></div>
            </div>
            <div class="w-100 text-center"><button type="submit" class="btn btn-success">Создать</button></div>
        </form>
        </div>
    </div>
</div>
<script>
    var firstUpload = new FileUploadWithPreview('myFirstImage');
</script>
<? } ?>