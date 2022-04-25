<?
$infoFirstName = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'first_name'"));
$infoLastName = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'last_name'"));
$infoPhone = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'ud_phone'"));
$infoEmail = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'billing_email'"));
$infoTg = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'ud_tg'"));
$infoVk = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'ud_vk'"));
$infoWa = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'ud_wa'"));
$infoVb = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'ud_vb'"));
$tgReg = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'tgReg'"));
$mailReg = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'mailReg'"));
$tgFin = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'tgFin'"));
$mailFin = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'mailFin'"));
$tgNews = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'tgNews'"));
$mailNews = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'mailNews'"));
$tgLogin = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'tgLogin'"));
$mailLogin = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'mailLogin'"));
$tgPromo = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'tgPromo'"));
$mailPromo = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'mailPromo'"));
$tgPod = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'tgPod'"));
$mailPod = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'mailPod'"));
$secretPhone = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'secretPhone'"));
$secretEmail = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'secretEmail'"));
$secretVk = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'secretVk'"));
$secretTg = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'secretTg'"));
$secretWa = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'secretWa'"));
$secretVb = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `wp_usermeta` WHERE `user_id` = $_SESSION[USER_ID] AND `meta_key` = 'secretVb'"));
?>
<div class="widget-content widget-content-area border-top-tab text-center bg-transparent pt-0 w-100">
                    <ul class="nav nav-tabs mb-0 mt-0 w-100 text-center" id="borderTop" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="border-top-home-tab" data-toggle="tab" href="#border-top-home" role="tab" aria-controls="border-top-home" aria-selected="true"> Общие</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="border-top-profile-tab" data-toggle="tab" href="#border-top-profile" role="tab" aria-controls="border-top-profile" aria-selected="false"> Оповещения</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="border-top-contact-tab" data-toggle="tab" href="#border-top-contact" role="tab" aria-controls="border-top-contact" aria-selected="false"> Безопасность</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="borderTopContent">
                        <div class="tab-pane fade show active" id="border-top-home" role="tabpanel" aria-labelledby="border-top-home-tab">
                             <div class="account-settings-container">
                                <div class="account-content">
                                    <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                                <div id="general-info" class="section general-info">
                                                    <div class="info">
                                                        <h6 class="">Общие данные</h6>
                                                        <div class="row">
                                                            <div class="col-lg-11 mx-auto">
                                                                <div class="row">
                                                                    <div class="col-xl-3 col-lg-12 col-md-5">
                                                                        <form action="/redact_profile/avatar" method="POST" enctype="multipart/form-data">
                                                                            <div class="upload mt-4 pr-md-4 pt-2 pb-2 ">
                                                                                <input type="file" id="input-file-max-fs" name="avatar" class="dropify" data-default-file="<?= $avatar ?>" data-max-file-size="2M" />
                                                                                <p class="mt-2 w-100 text-center"><i class="flaticon-cloud-upload mr-1"></i> Смена Аватара</p>
                                                                                <button type="submit" class="btn btn-success">Изменить</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="col-xl-9 col-lg-12 col-md-7 mt-md-0 mt-4">
                                                                        <div class="form">
                                                                            <div class="row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group">
                                                                                        <label for="fullName">Имя</label>
                                                                                        <input type="text" class="form-control mb-4" id="first_name" placeholder="Имя" value="<?= $infoFirstName['meta_value'] ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="form-group">
                                                                                        <label for="fullName">Фамилия</label>
                                                                                        <input type="text" class="form-control mb-4" id="last_name" placeholder="Фамилия" value="<?= $infoLastName['meta_value'] ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="phone">Телефон</label>
                                                                                        <input type="text" class="form-control mb-4" id="phone" placeholder="Введите номер телефона" value="<?= $infoPhone['meta_value'] ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="email">Email</label>
                                                                                        <input type="text" class="form-control mb-4" id="email" placeholder="Укажите Email" value="<?= $infoEmail['meta_value'] ?>" pattern="\S+@[a-z]+.[a-z]+">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 text-center">
                                                                                    <a href="javascript:void(0);" class="btn btn-success" onclick="post_button('redact_profile/baseInfo','login','email.phone.last_name.first_name','noResult');">Сохранить</a>
                                                                                </div>  
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="account-settings-container">
                                <div class="account-content">
                                    <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                                <form id="general-info" class="section general-info">
                                                    <div class="info">
                                                        <h6 class="">Социальные сети</h6>
                                                        <div class="row">
                                                            <div class="col-lg-11 mx-auto">
                                                                <div class="row">
                                                                    <div class="col-xl-3 col-lg-12 col-md-5 text-center">
                                                                            <i class="fab fa-telegram-plane text-info" style="font-size:2.5rem;"></i><br>  
                                                                            <? if($user['tl_id']){ ?>
                                                                            <a target="_blanc" href="https://t.me/ftxmonster_bot" class="btn btn-success btn-block mt-3">Перейти к Боту</a>
                                                                            <? }else{ ?>
                                                                            <a target="_blanc" href="https://t.me/ftxmonster_bot" class="btn btn-success btn-block mt-3">Привязать Бота</a>
                                                                            <? } ?>
                                                                    </div>
                                                                    <div class="col-xl-9 col-lg-12 col-md-7 mt-md-0 mt-4">
                                                                        <div class="form">
                                                                            <div class="row">
                                                                                <div class="col-md-6 mt-1">
                                                                                    <div class="input-group social-linkedin mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text bg-info" id="linkedin"><i class="fab fa-telegram-plane pt-1 text-white" style="width:24px;height:24px;color:#009688;"></i></span>
                                                                                        </div>
                                                                                        <input type="text" class="form-control" id="tg" placeholder="@login" aria-label="@login" aria-describedby="linkedin" value="<?= $infoTg['meta_value'] ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6  mt-1">
                                                                                    <div class="input-group social-linkedin mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text bg-primary" id="linkedin"><i class="fab fa-vk pt-1 text-white" style="width:24px;height:24px;color:#009688;"></i></span>
                                                                                        </div>
                                                                                        <input type="text" class="form-control" id="vk" placeholder="https://vk.com/" aria-label="" aria-describedby="linkedin" value="<?= $infoVk['meta_value'] ?>">
                                                                                    </div>
                                                                                </div>  
                                                                                <div class="col-md-6  mt-1">
                                                                                    <div class="input-group social-linkedin mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text bg-success" id="linkedin"><i class="fab fa-whatsapp pt-1 text-white" style="width:24px;height:24px;color:#009688;"></i></span>
                                                                                        </div>
                                                                                        <input type="text" class="form-control" id="wa" placeholder="79990000000" aria-label="@login" aria-describedby="linkedin" value="<?= $infoWa['meta_value'] ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6  mt-1">
                                                                                    <div class="input-group social-linkedin mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text bg-secondary" id="linkedin"><i class="fab fa-viber pt-1 text-white" style="width:24px;height:24px;color:#009688;"></i></span>
                                                                                        </div>
                                                                                        <input type="text" class="form-control" id="vb" placeholder="79990000000" aria-label="" aria-describedby="linkedin" value="<?= $infoVb['meta_value'] ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 text-center">
                                                                                    <a href="javascript:void(0);" class="btn btn-success" onclick="post_button('redact_profile/socialInfo','login','tg.vk.wa.vb','noResult');">Сохранить</a>
                                                                                </div>  
                                                                            </div>
                                                                        </div>
                                                                    </div>    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="border-top-profile" role="tabpanel" aria-labelledby="border-top-profile-tab">
                             <div class="account-settings-container">
                                <div class="account-content">
                                    <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                                <form id="general-info" class="section general-info">
                                                    <div class="info">
                                                        <h6 class="">Оповещения</h6>
                                                        <div class="row">
                                                            <div class="col-lg-11 mx-auto">
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered mb-4">
                                                                        <thead>
                                                                            <tr>
                                                                                <th >Действия</th>
                                                                                <? if($user['tl_id']){ ?>
                                                                                <th class="text-center">Телеграм </th>
                                                                                <? } ?>
                                                                                <th class="text-center">Эл.почта</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>Регистрации</td>
                                                                                <? if($user['tl_id']){ ?>
                                                                                <td>
                                                                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                                                                        <input id="tgReg" class="notyCheck" type="checkbox" <? if($tgReg['meta_value'] == 1){ ?> checked <? } ?>>
                                                                                        <span class="slider"></span>
                                                                                    </label>
                                                                                </td>
                                                                                <? } ?>
                                                                                <td>
                                                                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                                                                        <input id="mailReg" class="notyCheck" type="checkbox" <? if($mailReg['meta_value'] == 1){ ?> checked <? } ?>>
                                                                                        <span class="slider"></span>
                                                                                    </label>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Финансы</td>
                                                                                <? if($user['tl_id']){ ?>
                                                                                <td>
                                                                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                                                                        <input id="tgFin" class="notyCheck" type="checkbox" <? if($tgFin['meta_value'] == 1){ ?> checked <? } ?>>
                                                                                        <span class="slider"></span>
                                                                                    </label>
                                                                                </td>
                                                                                <? } ?>
                                                                                <td>
                                                                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                                                                        <input id="mailFin" class="notyCheck" type="checkbox" <? if($mailFin['meta_value'] == 1){ ?> checked <? } ?>>
                                                                                        <span class="slider"></span>
                                                                                    </label>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Новости</td>
                                                                                <? if($user['tl_id']){ ?>
                                                                                <td>
                                                                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                                                                        <input id="tgNews" class="notyCheck"class="notyCheck" type="checkbox" <? if($tgNews['meta_value'] == 1){ ?> checked <? } ?>>
                                                                                        <span class="slider"></span>
                                                                                    </label>
                                                                                </td>
                                                                                <? } ?>
                                                                                <td>
                                                                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                                                                        <input id="mailNews" class="notyCheck" type="checkbox" <? if($mailNews['meta_value'] == 1){ ?> checked <? } ?>>
                                                                                        <span class="slider"></span>
                                                                                    </label>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Вход</td>
                                                                                <? if($user['tl_id']){ ?>
                                                                                <td>
                                                                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                                                                        <input id="tgLogin" class="notyCheck" type="checkbox" <? if($tgLogin['meta_value'] == 1){ ?> checked <? } ?>>
                                                                                        <span class="slider"></span>
                                                                                    </label>
                                                                                </td>
                                                                                <? } ?>
                                                                                <td>
                                                                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                                                                        <input id="mailLogin" class="notyCheck" type="checkbox" <? if($mailLogin['meta_value'] == 1){ ?> checked <? } ?>>
                                                                                        <span class="slider"></span>
                                                                                    </label>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Промо Акции</td>
                                                                                <? if($user['tl_id']){ ?>
                                                                                <td>
                                                                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                                                                        <input id="tgPromo" class="notyCheck" type="checkbox" <? if($tgPromo['meta_value'] == 1){ ?> checked <? } ?>>
                                                                                        <span class="slider"></span>
                                                                                    </label>
                                                                                </td>
                                                                                <? } ?>
                                                                                <td>
                                                                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                                                                        <input id="mailPromo" class="notyCheck" type="checkbox" <? if($mailPromo['meta_value'] == 1){ ?> checked <? } ?> >
                                                                                        <span class="slider"></span>
                                                                                    </label>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                    
                        </div>
                        <div class="tab-pane fade show" id="border-top-contact" role="tabpanel" aria-labelledby="border-top-contact-tab">
                             <div class="account-settings-container">
                                <div class="account-content">
                                    <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                                <form id="general-info" class="section general-info">
                                                    <div class="info">
                                                        <h6 class="">Безопасность</h6>
                                                        <div class="row">
                                                            <div class="col-lg-11 mx-auto">
                                                                <div class="form">
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <div class="table-responsive">
                                                                                    <table class="table table-bordered mb-4">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>Действие</th>
                                                                                                <th class="text-center">Телеграм </th>
                                                                                                <th class="text-center">Эл.почта</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td class="p-0" style="width:auto;">Подтверждение входа</td>
                                                                                                <td class="p-0 pt-2">
                                                                                                    <label class="switch s-icons s-outline s-outline-success ml-2 mt-2 ">
                                                                                                        <input class="notyCheck" id="tgPod" type="checkbox" <? if($tgPod['meta_value'] == 1){ ?> checked <? } ?>>
                                                                                                        <span class="slider"></span>
                                                                                                    </label>
                                                                                                </td>
                                                                                                <td class="p-0 pt-2">
                                                                                                    <label class="switch s-icons s-outline s-outline-success ml-2 mt-2">
                                                                                                        <input class="notyCheck" id="mailPod" type="checkbox" <? if($mailPod['meta_value'] == 1){ ?> checked <? } ?>>
                                                                                                        <span class="slider"></span>
                                                                                                    </label>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                                <label for="fullName">Новый пароль</label>
                                                                                <input id="new_password" type="password" class="form-control mb-1" id="fullName" placeholder="Пароль" value="">
                                                                                <div class="col-12 text-center">
                                                                                    <a href="javascript:void(0);" class="btn btn-success mt-1" onclick="post_button('redact_profile/new_password','login','new_password','noResult');">Сохранить</a>
                                                                                </div>  
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <div class="table-responsive">
                                                                                    <table class="table table-bordered mb-4">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th >Информация</th>
                                                                                                <th class="text-center">Скрыть </th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td>Телефон</td>
                                                                                                <td>
                                                                                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                                                                                        <input class="notyCheck" id="secretPhone" type="checkbox" <? if($secretPhone['meta_value'] == 1){ ?> checked <? } ?>>
                                                                                                        <span class="slider"></span>
                                                                                                    </label>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Email</td>
                                                                                                <td>
                                                                                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                                                                                        <input class="notyCheck" id="secretEmail" type="checkbox" <? if($secretEmail['meta_value'] == 1){ ?> checked <? } ?>>
                                                                                                        <span class="slider"></span>
                                                                                                    </label>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>VK</td>
                                                                                                <td>
                                                                                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                                                                                        <input class="notyCheck" id="secretVk" type="checkbox" <? if($secretVk['meta_value'] == 1){ ?> checked <? } ?>>
                                                                                                        <span class="slider"></span>
                                                                                                    </label>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Telegram</td>
                                                                                                <td>
                                                                                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                                                                                        <input class="notyCheck" id="secretTg" type="checkbox" <? if($secretTg['meta_value'] == 1){ ?> checked <? } ?>>
                                                                                                        <span class="slider"></span>
                                                                                                    </label>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Whatsapp</td>
                                                                                                <td>
                                                                                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                                                                                        <input class="notyCheck" id="secretWa" type="checkbox" <? if($secretWa['meta_value'] == 1){ ?> checked <? } ?>>
                                                                                                        <span class="slider"></span>
                                                                                                    </label>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Viber</td>
                                                                                                <td>
                                                                                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                                                                                        <input class="notyCheck" id="secretVb" type="checkbox" <? if($secretVb['meta_value'] == 1){ ?> checked <? } ?>>
                                                                                                        <span class="slider"></span>
                                                                                                    </label>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>                       
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                    
                        </div>
                    </div>
                </div>