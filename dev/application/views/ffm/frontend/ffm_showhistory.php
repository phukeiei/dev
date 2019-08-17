<script>
    $(document).ready(function() {
        $('#a').change(function() {

        })
    })
</script>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="<?php echo base_url('/backend/js/highcharts.js'); ?>"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>



</head>

<body>

    <div class="row">

        <div class="col-md-1"></div>

        <div class="col-md-10">

            <div class="card">

                <div class="card-heading">
                    <div class="row">
                        &emsp;
                        <h3>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;กราฟแท่งแสดงจำนวนชั่วโมงการใช้งานสนามฟุตบอลจำแนกตามเดือน ประจำปี </h3>
                        <h3 id="heading"></h3>
                    </div>

                </div>


                <div class="card-body">

                    <!--<form action="./searchyear()" method="POST">-->

                    <div class="btn-group bootstrap-select show ">

                        <div class="row">
                            เลือกปี พ.ศ :
                            <select id="year" name="year" class="selectpicker col-sm-7 " data-style="select-with-transition" title="Single Select" data-size="7" tabindex="-98">
                            <?php
                            foreach($year as $row){
                            ?>
                                    <option value="<?php echo $row->year ?>" selected><?php echo $row->year ?></option>
                                <?php
                            }
                            ?>
                            </select>
                        </div>
                    </div>

                    <!-- <button type="submit"> </button>
                    </form> -->




                    <div id="column-chart"></div> <!-- column chart -->



                    <!--<div id='column-data'> </div> -->
                    <!-- data column chart -->

                </div>

            </div> <!-- End card -->

        </div>

        <div class="col-md-1"></div>

    </div> <!--  สิ้นสุด row -->

    <script>
        $(document).ready(function() {


            var year = $('#year').val()
            var main = "<?php echo $this->session->userdata('UsPsCode'); ?>"
            document.getElementById("heading").innerHTML = year;

            get_column_chart(main, year)


            /* $(document).on('change','#year',function() {*/
            $('#year').change(function() {


                var year = $(this).val()
                document.getElementById("heading").innerHTML = year;
                var main = "<?php echo $this->session->userdata('UsPsCode'); ?>"
                get_column_chart(main, year)





            });
        });

        function get_column_chart(main, year) {
            $.ajax({
                type: 'POST',
                url: "./show",
                data: {
                    main: main,
                    year: year
                },
                success: function(data) {

                    res = JSON.parse(data)

                    $('#column-data').text(JSON.stringify(res))
                    console.log(res);


                    create_column_chart(res)
                }

            })
        }

        function create_column_chart(data) {
            var nametype = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"]
            var series_value = [{
                name: "ชั่วโมงการใช้สนามฟุตบอล",
                data: []
            }]
            nametype.forEach((type) => {
                var action = 0;

                data.forEach((row) => {
                    if (type == getMonthTh0(row.date)) {
                        series_value[0].data.push(parseInt(row.hours))
                        action = 1;
                    }
                })
                if (!action) {
                    series_value[0].data.push(0);
                }
            })
            Highcharts.chart('column-chart', { //tag id
                chart: {
                    type: 'column'
                },
                title: {
                    text: '',
                },
                subtitle: {
                    text: '',
                },
                xAxis: {
                    categories: nametype,
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'ชั่วโมง'
                    }
                },
                tooltip: {

                    /*headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> ครั้ง<br/>'*/


                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.f} ชั่วโมง</b></td></tr>',
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
                series: series_value
            });
        }

        function getMonthTh0($mm) {
            if ($mm == '1') {
                $mm = 'มกราคม';
            } else if ($mm == '2') {
                $mm = 'กุมภาพันธ์';
            } else if ($mm == '3') {
                $mm = 'มีนาคม';
            } else if ($mm == '4') {
                $mm = 'เมษายน';
            } else if ($mm == '5') {
                $mm = 'พฤษภาคม';
            } else if ($mm == '6') {
                $mm = 'มิถุนายน';
            } else if ($mm == '7') {
                $mm = 'กรกฎาคม';
            } else if ($mm == '8') {
                $mm = 'สิงหาคม';
            } else if ($mm == '9') {
                $mm = 'กันยายน';
            } else if ($mm == '10') {
                $mm = 'ตุลาคม';
            } else if ($mm == '11') {
                $mm = 'พฤศจิกายน';
            } else if ($mm == '12') {
                $mm = 'ธันวาคม';
            }
            return $mm;
        }
    </script>

</body>

</html>