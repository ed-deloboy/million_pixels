<?
if($_POST['amount'] > 0){
    if($_POST['cardPay'] == '' and $_POST['qiwiPay'] == ''){
        ?>
        <script>message('Ошибка','Не указаны реквизиты','error');</script>
        <?
    }else{
    if($balance['meta_value'] >= $_POST['amount']){
        if($_POST['typePay'] == 'Киви') $rekv = 'qiwiPay';
        else $rekv = 'cardPay';
        $itog = $_POST[typePay].' '.$_POST[$rekv];
        $date = date("Y-m-d H:i:s");
        mysqli_query($CONNECT, "UPDATE `wp_usermeta` SET `meta_value` = `meta_value`-'$_POST[amount]' WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = '_current_woo_wallet_balance'");
        mysqli_query($CONNECT, "INSERT INTO `wp_woo_wallet_transactions` (`transaction_id`, `blog_id`, `user_id`, `type`, `amount`, `balance`, `currency`, `details`, `created_by`, `deleted`, `date`, `account`) VALUES (NULL, '2', '$_SESSION[USER_ID]', 'debit', '$_POST[amount]', '', '', 'Вывод средств', '1', '0', '$date','$itog')");
        $balance = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = '_current_woo_wallet_balance'"));
        message_to_telegram("📛  Подтвердите запрос на вывод денег\r\n\r\n😎 Логин: ".$user['user_nicename']."\r\n✅ Сумма: ".$_POST['amount']."рублей",'1265026852');
        ?>
        <script>message('Успешно','Вывод запрошен, после обработки средства поступят на указанный счет','success');</script>
        <?
    }else{
        ?>
        <script>message('Ошибка','Недостаточно средств','error');</script>
        <?
    }
    }
}else if($Module == 'viv'){
    ?>
    <script>message('Ошибка','Укажите сумму вывода','error');</script>
    <?
}
?>
<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-account-invoice-three">

                            <div class="widget-heading">
                                <div class="wallet-usr-info">
                                    <div class="usr-name">
                                        <span><img src="<?= $avatar ?>?<?= rand(1,999); ?>" alt="admin-profile" class="img-fluid"> <?= $first_name['meta_value'].' '.$last_name['meta_value'] ?></span>
                                    </div>
                                    <div class="add">
                                        <i class="fas fa-credit-card text-white" style="font-size:1.2rem;"></i>
                                    </div>
                                </div>
                                <div class="wallet-balance">
                                    <p>Баланс</p>
                                    <h5 class=""><?= number_format($myBalance, 0, ',', ' '); ?> <span class="w-currency">₽</span></h5>
                                </div>
                            </div>
                            <div class="widget-content">

                                <div class="bills-stats mb-1">
                                    <span>Вывод средств</span>
                                </div>

                                <div class="invoice-list">
                                    <div id="fbtPrefix" class="col-lg-12 layout-spacing p-0">
                                        <div class="statbox widget box box-shadow p-0">
                                            <div class="widget-header p-0">
                                                <div class="row">
                                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                                        <h4 class="pl-0">Сумма вывода</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-content widget-content-area p-0">
                                                <form class="form-horizontal">
                                                    <div class="form-group mb-4">
                                                        <input id="amount" type="text" value="0" name="amount" class="form-control">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="statbox widget box box-shadow p-0">
                                            <div class="widget-header p-0">
                                                <div class="row">
                                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                                        <h4 class="pl-0">Реквизиты</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-content widget-content-area p-0">
                                                <select class="form-control" id="typePay">
                                                    <option value="Сбербанк">Сбербанк</option>
                                                    <option value="Другой банк">Другой банк</option>
                                                    <option value="Киви">Киви</option>
                                                </select>
                                                <input type="text" id="cardPay" class="form-control cardPay mt-2" placeholder="Номер карты">
                                                <input type="text" id="qiwiPay" class="form-control qiwiPay d-none mt-2" placeholder="Номер Телефона">
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" class="btn btn-success btn-block mt-2" onclick="post_button('finance/viv','login','cardPay.qiwiPay.typePay.amount','local-block');">Запросить</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 layout-spacing" id="operation">
                        <div class="table-responsive d-none">
                            <table class="table mb-4">
                                    <thead>
                                        <tr>
                                        <th class="text-center">#ID</th>
                                        <th>Название</th>
                                        <th>Сумма</th>
                                        <th class="">Статус</th>
                                        <th>Дата</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="">
                                        <td class="text-center">#123</td>
                                        <td class="">Покупка программы</td>
                                        <td class="text-danger">4 500₽</td>
                                        <td class=""><span class=" shadow-none badge outline-badge-success">Выполнено</span></td>
                                        <td>22.12.2022</td>
                                    </tr>
                                    <tr class="">
                                        <td class="text-center">#123</td>
                                        <td class="">Партнерское начисление <span class=" shadow-none badge outline-badge-warning"> login </span></td>
                                        <td class="text-success">₽450</td>
                                        <td class=""><span class=" shadow-none badge outline-badge-success">Выполнено</span></td>
                                        <td>22.12.2022</td>
                                    </tr>
                                    <tr class="">
                                        <td class="text-center">#123</td>
                                        <td class="">Вывод средств</td>
                                        <td class="text-danger">750₽</td>
                                        <td class=""><span class=" shadow-none badge outline-badge-danger">Отказано</span></td>
                                        <td>22.12.2022</td>
                                    </tr>
                                    <tr class="">
                                        <td class="text-center">#123</td>
                                        <td class="">Вывод средств</td>
                                        <td class="text-danger">750₽</td>
                                        <td class=""><span class=" shadow-none badge outline-badge-primary">В обработке</span></td>
                                        <td>22.12.2022</td>
                                    </tr>
                                    <tr class="">
                                        <td class="text-center">#123</td>
                                        <td class="">Вывод средств</td>
                                        <td class="text-danger">750₽</td>
                                        <td class=""><span class=" shadow-none badge outline-badge-success">Выполнено</span></td>
                                        <td>22.12.2022</td>
                                    </tr>
                                    <tr class="">
                                        <td class="text-center">#123</td>
                                        <td class="">Партнерское начисление</td>
                                        <td class="text-success">1 350₽</td>
                                        <td class=""><span class=" shadow-none badge outline-badge-success">Выполнено</span></td>
                                        <td>22.12.2022</td>
                                    </tr>
                                    <tr class="">
                                        <td class="text-center">#123</td>
                                        <td class="">Партнерское начисление</td>
                                        <td class="text-success">1 350₽</td>
                                        <td class=""><span class=" shadow-none badge outline-badge-success">Выполнено</span></td>
                                        <td>22.12.2022</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="paginating-container pagination-default">
                            <ul class="pagination">
                                <li class="prev"><a href="javascript:void(0);">Назад</a></li>
                                <li><a href="javascript:void(0);">1</a></li>
                                <li class="active"><a href="javascript:void(0);">2</a></li>
                                <li><a href="javascript:void(0);">3</a></li>
                                <li class="next"><a href="javascript:void(0);">Вперед</a></li>
                            </ul>
                        </div>
                    </div>
                    <script>loadBlock('operation','operation');</script>
                    <script>
$("input[name='amount']").TouchSpin({
    min: 0,
    max: <?= $myBalance ?>,
    step: 1,
    decimals: 0,
    boostat: 5,
    maxboostedstep: 10,
    postfix: '₽',
    buttondown_class: "btn btn-classic btn-primary",
    buttonup_class: "btn btn-classic btn-primary"
});
    </script>
    <script>
        $('#typePay').change(function() {
            if($(this).val() == 'Киви'){
                $(".cardPay").addClass('d-none');
                $(".qiwiPay").removeClass('d-none');
            }else{
                $(".qiwiPay").addClass('d-none');
                $(".cardPay").removeClass('d-none');
            }
            id = $(this).attr('id');
            no_result('redact_profile/notyInfo','login', ''+id);
        });
    </script>
    <script>
        $("#local-load").addClass('d-none');
        $("#local-block").removeClass('d-none');
    </script>