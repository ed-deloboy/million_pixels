<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 layout-spacing">
                        <div class="widget-two height-auto" style="height:auto;">
                            <div class="widget-content">
                                <div class="w-numeric-value">
                                    <div class="w-content counter-content">
                                        <span class="w-value">ВЫ С НАМИ</span>
                                        <span class="w-numeric-title font-weight-bold text-success counter-container"><span class="s-counter2 s-counter d-inline"><?= $youDate ?></span> дней</span>
                                    </div>
                                    <div class="w-icon d-inline-block text-center">
                                        <i class="fas fa-calendar-day"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 layout-spacing">
                        <div class="widget-two height-auto " style="height:auto;">
                            <div class="widget-content">
                                <div class="w-numeric-value">
                                    <div class="w-content counter-content">
                                        <span class="w-value">ДОХОД С ПАРТНЕРКИ</span>
                                        <span class="w-numeric-title font-weight-bold text-success counter-container"><span class="s-counter3 s-counter d-inline"><?= $profit ?></span> <i class="fa fa-ruble-sign"></i></span>
                                    </div>
                                    <div class="w-icon d-inline-block text-center bg-success">
                                        <i class="fas fa-ruble-sign"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 layout-spacing">
                        <div class="widget-two height-auto" style="height:auto;">
                            <div class="widget-content">
                                <div class="w-numeric-value">
                                    <div class="w-content">
                                        <span class="w-value">ПАРТНЕРОВ</span>
                                        <span class="w-numeric-title font-weight-bold text-success"><i class="fa fa-user"></i> <span class="s-counter4 s-counter d-inline"><?= $Quantity ?></span></span>
                                    </div>
                                    <div class="w-icon d-inline-block text-center bg-primary">
                                        <i class="fas fa-user-plus"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12 layout-spacing">

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

                            <div class="widget-amount">

                                <div class="w-a-info funds-received">
                                    <span>Cегодня <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up"><polyline points="18 15 12 9 6 15"></polyline></svg></span>
                                    <p><?= number_format($partnerDay['sum'], 0, ',', ' '); ?> ₽</p>
                                </div>
                                <div class="w-a-info funds-received">
                                    <span>Вчера <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up"><polyline points="18 15 12 9 6 15"></polyline></svg></span>
                                    <p><?= number_format($partnerYesterday['sum'], 0, ',', ' '); ?> ₽</p>
                                </div>  
                                <div class="w-a-info funds-received mt-1">
                                    <span>Неделя <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up"><polyline points="18 15 12 9 6 15"></polyline></svg></span>
                                    <p><?= number_format($partnerWeek['sum'], 0, ',', ' '); ?> ₽</p>
                                </div>
                                <div class="w-a-info funds-received  mt-1">
                                    <span>Месяц <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up"><polyline points="18 15 12 9 6 15"></polyline></svg></span>
                                    <p><?= number_format($partnerMounth['sum'], 0, ',', ' '); ?> ₽</p>
                                </div>

                            </div>

                            <div class="widget-content">

                                <div class="bills-stats">
                                    <span>Последние операции</span>
                                </div>

                                <div class="invoice-list">

                                    <div class="inv-detail">
                                        <?
                                        $TwoOperation1 = mysqli_query($CONNECT, "SELECT * FROM `wp_woo_wallet_transactions` WHERE `user_id` = $_SESSION[USER_ID] ORDER BY `transaction_id` DESC LIMIT 2");
                                        while($TwoOperation = mysqli_fetch_assoc($TwoOperation1)){
                                        ?>
                                        <div class="info-detail-1">
                                            <p><?= $TwoOperation['details'] ?></p>
                                            <p><span class="bill-amount"><?= number_format($TwoOperation['amount'], 0, ',', ' '); ?></span> <span class="w-currency">₽</span></p>
                                        </div>
                                        <?
                                        }
                                        ?>
                                    </div>

                                    <div class="inv-action">
                                        <a href="javascript:void(0);" class="btn btn-outline-primary view-details" onclick="myMain(4,'Финансы','finance');">Управление</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-chart-one pt-2 pl-2 pr-2">
                            <div class="widget-heading">
                                <h5 class="">Партнеры</h5>
                                <div class="task-action">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="pendingTask" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="pendingTask" style="will-change: transform;">
                                            <a class="dropdown-item" href="javascript:void(0);">Смотреть все дерево</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="widget-content">
                                <div id="revenueMonthly"></div>
                            </div>
                        </div>
                    </div>
                    <script>
        var cSpeed = 2000;

// Simple Counter

var value = $('.s-counter2').text();
$('.s-counter2').countTo({
    from: 0,
    to: value,
    speed: cSpeed,
    formatter: function (value, options) {
        return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
    }
});
var value = $('.s-counter3').text();
$('.s-counter3').countTo({
    from: 0,
    to: value,
    speed: cSpeed,
    formatter: function (value, options) {
        return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
    }
});
var value = $('.s-counter4').text();
$('.s-counter4').countTo({
    from: 0,
    to: value,
    speed: cSpeed,
    formatter: function (value, options) {
        return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
    }
});
    </script>
    <script>
        var options1 = {
    chart: {
      fontFamily: 'Nunito, sans-serif',
      height: 365,
      type: 'area',
      zoom: {
          enabled: false
      },
      dropShadow: {
        enabled: true,
        opacity: 0.2,
        blur: 10,
        left: -7,
        top: 22
      },
      toolbar: {
        show: false
      },
      events: {
        mounted: function(ctx, config) {
          const highest1 = ctx.getHighestValueInSeries(0);
          const highest2 = ctx.getHighestValueInSeries(1);
  
          ctx.addPointAnnotation({
            x: new Date(ctx.w.globals.seriesX[0][ctx.w.globals.series[0].indexOf(highest1)]).getTime(),
            y: highest1,
            label: {
              style: {
                cssClass: 'd-none'
              }
            },
            customSVG: {
                SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#2196f3" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                cssClass: undefined,
                offsetX: -8,
                offsetY: 5
            }
          })
  
        },
      }
    },
    colors: ['#2196f3', '#e7515a'],
    dataLabels: {
        enabled: false
    },
    markers: {
      discrete: [{
      seriesIndex: 0,
      dataPointIndex: 7,
      fillColor: '#000',
      strokeColor: '#000',
      size: 5
    }, {
      seriesIndex: 2,
      dataPointIndex: 11,
      fillColor: '#000',
      strokeColor: '#000',
      size: 4
    }]
    },
    subtitle: {
      text: '',
      align: 'left',
      margin: 0,
      offsetX: 95,
      offsetY: 0,
      floating: false,
      style: {
        fontSize: '18px',
        color:  '#4361ee'
      }
    },
    title: {
      text: 'Всего приглашено: <?= $Quantity ?>',
      align: 'left',
      margin: 0,
      offsetX: -10,
      offsetY: 0,
      floating: false,
      style: {
        fontSize: '18px',
        color:  '#bfc9d4'
      },
    },
    stroke: {
        show: true,
        curve: 'smooth',
        width: 2,
        lineCap: 'square'
    },
    series: [{
        name: 'Партнеры',
        data: [<?= $QuantityDay[9] ?>, <?= $QuantityDay[8] ?>, <?= $QuantityDay[7] ?>, <?= $QuantityDay[6] ?>, <?= $QuantityDay[5] ?>, <?= $QuantityDay[4] ?>, <?= $QuantityDay[3] ?>, <?= $QuantityDay[2] ?>, <?= $QuantityDay[1] ?>, <?= $QuantityDay[0] ?>]
    }],
    labels: ['<?= changeDateFormat($dateReg[9], "d.m") ?>', '<?= changeDateFormat($dateReg[8], "d.m") ?>', '<?= changeDateFormat($dateReg[7], "d.m") ?>', '<?= changeDateFormat($dateReg[6], "d.m") ?>', '<?= changeDateFormat($dateReg[5], "d.m") ?>', '<?= changeDateFormat($dateReg[4], "d.m") ?>', '<?= changeDateFormat($dateReg[3], "d.m") ?>', '<?= changeDateFormat($dateReg[2], "d.m") ?>', '<?= changeDateFormat($dateReg[1], "d.m") ?>', '<?= changeDateFormat($dateReg[0], "d.m") ?>'],
    xaxis: {
      axisBorder: {
        show: false
      },
      axisTicks: {
        show: false
      },
      crosshairs: {
        show: true
      },
      labels: {
        offsetX: 0,
        offsetY: 5,
        style: {
            fontSize: '12px',
            fontFamily: 'Nunito, sans-serif',
            cssClass: 'apexcharts-xaxis-title',
        },
      }
    },
    yaxis: {
      labels: {
        formatter: function(value, index) {
          return (value)
        },
        offsetX: -22,
        offsetY: 0,
        style: {
            fontSize: '12px',
            fontFamily: 'Nunito, sans-serif',
            cssClass: 'apexcharts-yaxis-title',
        },
      }
    },
    grid: {
      borderColor: '#191e3a',
      strokeDashArray: 5,
      xaxis: {
          lines: {
              show: true
          }
      },   
      yaxis: {
          lines: {
              show: false,
          }
      },
      padding: {
        top: 0,
        right: 0,
        bottom: 0,
        left: -10
      }, 
    }, 
    legend: {
      position: 'top',
      horizontalAlign: 'right',
      offsetY: -50,
      fontSize: '16px',
      fontFamily: 'Quicksand, sans-serif',
      markers: {
        width: 10,
        height: 10,
        strokeWidth: 0,
        strokeColor: '#fff',
        fillColors: undefined,
        radius: 12,
        onClick: undefined,
        offsetX: 0,
        offsetY: 0
      },    
      itemMargin: {
        horizontal: 0,
        vertical: 20
      }
    },
    tooltip: {
      theme: 'dark',
      marker: {
        show: true,
      },
      x: {
        show: false,
      }
    },
    fill: {
        type:"gradient",
        gradient: {
            type: "vertical",
            shadeIntensity: 1,
            inverseColors: !1,
            opacityFrom: .19,
            opacityTo: .05,
            stops: [100, 100]
        }
    },
    responsive: [{
      breakpoint: 575,
      options: {
        legend: {
            offsetY: -30,
        },
      },
    }]
  }
  
    var chart1 = new ApexCharts(
      document.querySelector("#revenueMonthly"),
      options1
    );
  
    chart1.render();
    </script>
    <script>
        $("#local-load").addClass('d-none');
        $("#local-block").removeClass('d-none');
    </script>