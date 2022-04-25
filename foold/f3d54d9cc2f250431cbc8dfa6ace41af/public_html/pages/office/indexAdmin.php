<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title> Администрирование </title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png"/>
    <link href="assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="assets/js/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="assets/css/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="plugins/dropify/dropify.min.css">
    <link href="assets/css/users/account-setting.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/elements/miscellaneous.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/elements/avatar.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components/tabs-accordian/custom-tabs.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
    <link href="assets/css/tables/table-basic.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="assets/css/forms/switches.css">
    <link href="assets/css/components/cards/card.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css">
    <link href="assets/css/elements/custom-pagination.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">
    <link href="assets/css/elements/infobox.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components/custom-counter.css" rel="stylesheet" type="text/css">
     <link href="plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <script src="plugins/sweetalerts/promise-polyfill.js"></script>
    <link href="plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components/custom-modal.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/tables/table-basic.css" rel="stylesheet" type="text/css" />
    <link href="plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

</head>
<body>
    <input type="hidden" id="modal_id" value="">
    <input type="hidden" id="pag" value="">
    <!-- BEGIN LOADER -->
    <div id="load_screen"> 
        <div class="e-loadholder">
	        <div class="m-loader">
	        	<span class="e-text">Загрузка</span>
	        </div>
        </div>
    </div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <div class="header-container fixed-top">
        <header class="header navbar navbar-expand-sm">

            <ul class="navbar-item theme-brand text-center">
                <li class="nav-item theme-logo bg-logotype d-none d-md-block">
                    <a href="#">
                       
                    </a>
                </li>
            </ul>

            <ul class="navbar-item flex-row ml-md-0 ml-auto">
                <li class="nav-item align-self-center search-animated">
                    
                </li>
            </ul>

            <ul class="navbar-item flex-row ml-md-auto">
                <li class="nav-item dropdown message-dropdown">
                    
                

                <li class="nav-item dropdown user-profile-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                    </a>
                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                        <div class="">
                            <div class="dropdown-item">
                                <a class="" href="/account/logout"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> Выйти</a>
                            </div>
                        </div>
                    </div>
                    
                </li>

            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN NAVBAR  -->
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">

                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page"><span class="local-name">Пользователи</span></li>
                            </ol>
                        </nav>

                    </div>
                </li>
            </ul>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">
            
            <nav id="sidebar">
                <div class="shadow-bottom"></div>
                <ul class="list-unstyled menu-categories" id="accordionExample">
                    <li class="menu">
                        <a href="#" data-active="true"  aria-expanded="false" class="dropdown-toggle global-main local-main-6 active" onclick="myMain(6,'Пользователи','usersAdmin');">
                            <div class="">
                                <span>Пользователи</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu">
                        <a href="#" data-active="false"  aria-expanded="false" class="dropdown-toggle global-main local-main-7 global-main local-main-3" onclick="myMain(7,'Финансы','financeAdmin');">
                            <div class="">
                                <span>Финансы</span>
                            </div>

                        </a>
                    </li>
                    <li class="menu">
                        <a href="#" data-active="false"  aria-expanded="false" class="dropdown-toggle  global-main local-main-8" onclick="myMain(8,'Уведомления','notifyAdmin');">
                            <div class="">
                                <span>Уведомления</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="#" data-active="false" aria-expanded="false" class="dropdown-toggle global-main local-main-9" onclick="myMain(9,'Программы','programAdmin');">
                            <div class="">
                                <span>Программы</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="#" data-active="false" aria-expanded="false" class="dropdown-toggle global-main local-main-10" onclick="myMain(10,'Подтверждение пользователей','confirmAdmin');">
                            <div class="">
                                <span>Подтверждение</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="#" data-active="false" aria-expanded="false" class="dropdown-toggle global-main local-main-11" onclick="myMain(11,'Контакты','contactAdmin');">
                            <div class="">
                                <span>Контакты</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="#" data-active="false" aria-expanded="false" class="dropdown-toggle global-main local-main-12" onclick="myMain(12,'Промокоды','promoAdmin');">
                            <div class="">
                                <span>Промокоды</span>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- <div class="shadow-bottom"></div> -->
                
            </nav>

        </div>
        <!--  END SIDEBAR  -->
        
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="row layout-top-spacing global-block local-block-1 d-none" id="local-block">
                    
                </div>
                <div class="row layout-top-spacing global-block local-block-1 w-100 text-center" id="local-load">
	                 <div class="spinner-border spinner-border-reverse align-self-center text-white mt-5" style="position:absolute;left:47%;top:30%;"></div>
                </div>
            </div>
        </div>
        <div class="footer-wrapper">
            <div class="footer-section f-section-1">
                <p class="">Copyright В© 2022 <a target="_blank">FXmonster</a>, Все права защищены.</p>
            </div>
        </div>
    </div>
    
    <div class="modal fade profile-modal" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="userModal">
                
            </div>
        </div>
    </div>
    
    <div class="modal fade profile-modal" id="aboutModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content" id="productAbout">
                
            </div>
        </div>
    </div>
    
    <div class="modal fade profile-modal" id="statisticModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="productStatistic">
                
            </div>
        </div>
    </div>
    <!--  END CONTENT AREA  -->
    <!-- END MAIN CONTAINER -->
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="assets/js/custom.js"></script>
    <script src="plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="plugins/bootstrap-touchspin/custom-bootstrap-touchspin.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="plugins/apex/apexcharts.min.js"></script>
    <script src="assets/js/dashboard/dash_1.js"></script>
    <script src="plugins/dropify/dropify.min.js"></script>
    <script src="plugins/blockui/jquery.blockUI.min.js"></script>
    <!-- <script src="plugins/tagInput/tags-input.js"></script> -->
    <script src="assets/js/users/account-settings.js"></script>
    <script src="plugins/table/datatable/datatables.js"></script>
    <script src="plugins/counter/jquery.countTo.js"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
        
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <script src="assets/js/components/custom-counter.js"></script>
    <script src="plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="plugins/sweetalerts/custom-sweetalert.js"></script>
    <script src="assets/js/clipboard/clipboard.min.js"></script>
    <script src="plugins/file-upload/file-upload-with-preview.min.js"></script>
    <script>
    myMain(1,'Пользователи','usersAdmin');
    </script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script>
        function copyText(id) {
            var copyText = document.getElementById(""+id);
            copyText.select();
            document.execCommand("copy");
        }
    </script>
    <script>
        $('.notyCheck').change(function() {
            $(this).val($(this).prop('checked')?1:0);
            id = $(this).attr('id');
            no_result('redact_profile/notyInfo','login', ''+id);
        });
    </script>
    <script>
        function OnOf(p1,p2){
            $("."+p2).addClass('d-none');
            $("."+p1).removeClass('d-none');
        }
    </script>
    <? MessageShow(); ?>
    <? if($_SESSION['mainMessage2'] == ''){ ?>
    <script>myMain(6,'Пользователи','usersAdmin');</script>
    <? }else{ ?>
    <script><?= $_SESSION['mainMessage2'] ?></script>
    <? $_SESSION['mainMessage2'] = ''; ?>
    <? } ?>
</body>
</html>