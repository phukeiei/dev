<script src="https://cdn.jsdelivr.net/jsbarcode/3.6.0/JsBarcode.all.min.js"></script>
<script>
    $(document).ready(function () {
        $('barcode').remove();
        $('.barcode').append(`<svg class="js_barcode" 
                                    jsbarcode-format="CODE39" 
                                    jsbarcode-value="${<?php echo $su_code; ?>}" 
                                    jsbarcode-textmargin="0" 
                                    jsbarcode-fontoptions="bold"
                                    jsbarcode-width="2"
                                    jsbarcode-height="50"
                                    jsbarcode-displayValue=false>
                               </svg>`);
        JsBarcode(".js_barcode").init();
    });
</script>
<div class="col-md-12">
    <div class="card card-nav-tabs">
        <div class="card-header card-header-primary">
            <center>
                <h2>เอกสาร</h2>
            </center>
        </div>
        <div class="card-body">
            <div class="card card-nav-tabs card-plain">
                <div class="card-header card-header-danger">
                    <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                    <div class="nav-tabs-navigation">
                        <div class="nav-tabs-wrapper">
                            <ul class="nav nav-tabs" data-tabs="tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#application" data-toggle="tab">ใบสมัครสมาชิก</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#member_card" data-toggle="tab">บัตรสมาชิก</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="tab-content text-center">
                        <div class="tab-pane active" id="application">
                            <?php echo $application_pdf;?>
                        </div>
                        <div class="tab-pane" id="member_card">
                            <?php echo $member_card_pdf;?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 d-flex justify-content-start" style="text-align:left">
                    <a class="btn btn-inverse" href="<?php echo base_url() . 'index.php/'; ?>">หน้าแรก</a>
                </div>
                
                <div class="d-flex justify-content-end" style="text-align:right">
                    <a target="_blank" href="<?php echo site_url("/swm/frontend/Swm_register/print_member_card_pdf"); ?>">
                        <button class="btn btn-success ">ดาวน์โหลดบัตรสมาชิก</button> 
                    </a>
                </div>

                <div class="d-flex justify-content-end" style="text-align:right">
                    <a target="_blank" href="<?php echo site_url("/swm/frontend/Swm_register/print_application_pdf"); ?>"> 
                        <button class="btn btn-success ">ดาวน์โหลดใบสมัครสมาชิก</button> 
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

