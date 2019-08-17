    <script type="text/javascript" src="<?php echo base_url();?>backend/js/highcharts.js"></script>
<?php 	$amount_user = 0;
        $amount_find =0;  
        $amount_cp =0;  
        $amount_price =0;  
        $sum = 0 ;
			// foreach( $fr_all as $row ) {
			// 	if($row->fr_status == 2     &&   $row->fr_ps_id!=NULL	){
			// 		$amount_user++; 
			// 	}
            // }
            foreach( $ff_all as $row2 ) {
                if($row2->ff_status =="y"||$row2->ff_status =="Y" ){
					 $amount_find++; 
				}
                	
				
            } 
            foreach( $cp_all as $row3 ) {
                if($row3->cp_id != 0){
					 $amount_cp++; 
				}
                	
				
            }
            foreach( $fr_all as $row4 ) {
                if($row4->fr_cost != 0){
					 $amount_price+=$row4->fr_cost; 
				}
                	
				
            }
            foreach( $fr_a as $row5 ) {
             
                $amount_user++ ;
				
            }
         
	?>
<script type="text/javascript" src="<?php echo base_url();?>backend/js/highcharts.js"></script>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading panel_heading_iserl"> 
                <h2><i class="ti ti-bar-chart"></i>รายงานผล Dashboard</h2> 
            </div>
            <div class="panel-body">
                <div class="col-md-3">
                    <div class="info-tile tile-orange">
                        <div class="tile-icon"><i class="fa fa-money"></i></i></div>
                        <div class="tile-heading"><span><h4>รายได้รวมในปี พ.ศ.&nbsp2562</h4></span></div>
                        <div class="tile-body"><span><?php  echo number_format($amount_price,2); ?></span></div>
                        <div class="tile-footer"><span class="text-success">บาท</span></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-tile tile-danger">
                        <div class="tile-icon"><i class="ti ti-dribbble"></i></i></div>
                        <div class="tile-heading"><span><h4>สนามที่พร้อมใช้งาน</h4></span></div>
                        <div class="tile-body"><span><?php  echo $amount_find ; ?></span></div>
                        <div class="tile-footer"><span class="text-success">สนาม</span></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-tile tile-gray">
                        <div class="tile-icon"><i class="ti ti-user"></i></i></div>
                        <div class="tile-heading"><span><h4>ผู้ใช้สนามในวันที่   <?php   echo abbreDate(date("d/m/Y")) ; ?></h4></span></div>
                        <div class="tile-body"><span><?php    echo $amount_user  ; ?> </span></div>
                        <div class="tile-footer"><span class="text-success">คน</span></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-tile tile-primary">
                        <div class="tile-icon"><i class="fa fa-comments"></i></i></div>
                        <div class="tile-heading"><span><h4>ความคิดเห็นของผู้ใช้ในวันที่  <?php   echo abbreDate(date("d/m/Y")) ; ?></h4></span></div>
                        <div class="tile-body"><span><?php  echo $amount_cp ; ?></span></div>
                        <div class="tile-footer"><span class="text-success">รายการ</span></div>
                    </div>
                </div>
            

                <!-- Panel กราฟ -->
                <div class="col-md-6">
                    <div class="panel panel-default" data-widget='{"draggable": "false"}'>
                        <div class="panel-heading panel_heading_iserl"> 
                            <h2>กราฟเส้นแสดงรายงานจำนวนผู้เข้าใช้สนามทั้งหมดต่อเดือน ในปี พ.ศ. 2562</h2>
                            
                        </div>
                        <div class="panel-body">
                            <div id='line-chart1'>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4"></div>

                <div class="col-md-6">
                    <div class="panel panel-default" data-widget='{"draggable": "false"}'>
                        <div class="panel-heading panel_heading_iserl"> 
                            <h2>กราฟเส้นแสดงรายงานรายได้ทั้งหมดต่อเดือน ในปี พ.ศ. 2562</h2>
                            
                        </div>
                        <div class="panel-body">
                            <div id='line-chart2'>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="col-md-3">
                    <button class="btn btn-inverse btn_iserl tooltips" title="คลิกปุ่มเพื่อย้อนกลับ" onclick="window.location='<?php echo site_url('/'.$dir.'/Home/');?>'"><span>ย้อนกลับ</span></button>
                </div>
        </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(()=>{
         //get_bar_chart();
        //get_pie_chart();
         get_line_chart1();
         get_line_chart2();
    });

    function get_bar_chart() {
        $.ajax({
             type: 'POST',
                url: "<?php site_url('/'.$dir.'/Dashboard2/get_total_of_customer'); ?>",
                // s59160018/R/R_controller/get_behavioral_report
             data: {
             },
             success: function(data) {
                
                 res = JSON.parse(data);
                  console.log(res);
                  $('#bar-data').text(JSON.stringify(res));
                 create_bar_chart(res)
             }
         })
    }
    function create_bar_chart(data) {
        let series_value = []

        // transform data

        data.forEach((row) => {
            series_value.push({
                name: row.iprd_name,
                data: [parseInt(row.iprs_quantity)],
            })
        })

        // Highcharts.chart('bar-chart', {
        //     chart: {
        //         type: 'column'
        //     },
        //     title: {
        //         text: 'จำนวนวัสดุคงเหลือ'
        //     },
        //     subtitle: {
        //         text: 'ข้อมูลจากระบบวัสดุคงคลัง'
        //     },
        //     xAxis: {
        //         categories: [
        //             'วัสดุ/อุปกรณ์',
        //         ],
        //         crosshair: true
        //     },
        //     yAxis: {
        //         min: 0,
        //         title: {
        //             text: 'จำนวนวัสดุคงเหลือ'
        //         }
        //     },
        //     tooltip: {
        //         headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        //         pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
        //             '<td style="padding:0"><b>{point.y:.f} </b></td></tr>',
        //         footerFormat: '</table>',
        //         shared: true,
        //         useHTML: true
        //     },
        //     plotOptions: {
        //         column: {
        //             pointPadding: 0.2,
        //             borderWidth: 0
        //         }
        //     },
        //     series: series_value
        // });
        Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Monthly Average Rainfall'
        },
        subtitle: {
            text: 'Source: WorldClimate.com'
        },
        xAxis: {
            categories: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
            text: 'Rainfall (mm)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
            pointPadding: 0.2,
            borderWidth: 0
            }
        },
        series: [{
            name: 'Tokyo',
            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

        }, {
            name: 'New York',
            data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

        }, {
            name: 'London',
            data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

        }, {
            name: 'Berlin',
            data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

        }]
});

    }
    function get_pie_chart() {
        $.ajax({
             type: 'POST',
             url: '<?php echo base_url() ?>index.php/<?php echo $this->config->item("inven_folder");?>88832559/S59160414/get_payment_all',
             data: {
             },
             success: function(data) {
                 res = JSON.parse(data)
                    $('#pie-data').text(JSON.stringify(res))
                    create_pie_chart(res)
             }
         })
    }
    function create_pie_chart(data) {
        let series_value = []

        // transform data

        data.forEach((row) => {
            series_value.push({
                name: row.name,
                y: parseInt(row.total),
            })
        })

        Highcharts.chart('pie-chart', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'รายงานสัดส่วนยอดขายวัสดุทั้งหมด'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                name: 'คิดเป็น',
                colorByPoint: true,
                data : series_value
            }]
        });

    }
    function get_line_chart1() {
        $.ajax({
             type: 'POST',
             url: '<?php echo site_url('/'.$dir.'/Dashboard/get_total_of_customer/2019') ?>',
             data: {
             },
             success: function(data) {
                 res = JSON.parse(data)
                    //$('#line-data').text(JSON.stringify(res))
                    console.log(res);
                    create_line_chart1(res)
             }
         })
    }
    function create_line_chart1(data) {
        let series_value = []

        // transform data
        let temp = []
        for(var i = 0 ; i < 12 ; i++){
            console.log(data[i+1][0]["total"]);
            temp.push(parseInt(data[i+1][0]["total"]));
        }
        // data.forEach((row) => {
        //     temp.push(parseInt(row.total))
        // })
        series_value.push({
            name: 'จำนวนผู้เข้าใช้สนามทั้งหมดต่อเดือน',
            data: temp
        })
        console.log(series_value)
        Highcharts.chart('line-chart1', {

            title: {
                text: ''
            },

            subtitle: {
                text: ''
            },

            yAxis: {
                allowDecimals: false,
                title: {
                    text: 'คน'
                }
            },
            xAxis: {
                categories: [
                'มกราคม',
                'กุมภาพันธ์ ',
                'มีนาคม',
                'เมษายน',
                'พฤษภาคม',
                'มิถุนายน',
                'กรกฎาคม',
                'สิงหาคม',
                'กันยายน',
                'ตุลาคม',
                'พฤศจิกายน',
                'ธันวาคม'
                ],
                 crosshair: true
             },
            legend: {
                layout: 'horizontal',
                // align: 'bottom',
                // verticalAlign: 'middle'
            },

            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                    pointStart: 0
                }
            },

            series: series_value,

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            },
            tooltip:{
                formatter: function(){
                    return 'จำนวน ' + this.y + ' คน';
                }
            }

            });
    }

    function get_line_chart2() {
        $.ajax({
             type: 'POST',
             url: '<?php echo site_url('/'.$dir.'/Dashboard/get_total_of_income/2019') ?>',
             data: {
             },
             success: function(data) {
                 res = JSON.parse(data)
                    //$('#line-data').text(JSON.stringify(res))
                    console.log(res);
                    create_line_chart2(res)
             }
         })
    }
    function create_line_chart2(data) {
        let series_value = []

        // transform data
        let temp = []
        for(var i = 0 ; i < 12 ; i++){
            if(data[i+1][0]["total"] == null){
                data[i+1][0]["total"] = 0;
            }
            console.log(data[i+1][0]["total"]);
            temp.push(parseInt(data[i+1][0]["total"]));
        }
        // data.forEach((row) => {
        //     temp.push(parseInt(row.total))
        // })
        series_value.push({
            name: 'รายได้รวมทั้งหมดต่อเดือน',
            data: temp
        })
        console.log(series_value)
        Highcharts.chart('line-chart2', {

            title: {
                text: ''
            },

            subtitle: {
                text: ''
            },

            yAxis: {
                title: {
                    text: 'บาท'
                }
            },
            xAxis: {
                categories: [
                'มกราคม',
                'กุมภาพันธ์ ',
                'มีนาคม',
                'เมษายน',
                'พฤษภาคม',
                'มิถุนายน',
                'กรกฎาคม',
                'สิงหาคม',
                'กันยายน',
                'ตุลาคม',
                'พฤศจิกายน',
                'ธันวาคม'
                ],
                 crosshair: true
             },
            legend: {
                layout: 'horizontal'
                // align: 'right',
                // verticalAlign: 'middle'
            },

            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                    pointStart: 0
                }
            },

            series: series_value,

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            },
            tooltip:{
                formatter: function(){
                    return 'รายได้รวม ' + this.y + ' บาท';
                }
            }

            });
    }
</script>
