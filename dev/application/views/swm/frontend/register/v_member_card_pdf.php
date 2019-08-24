<style>
    .margin_top {
        margin-top: 4rem;
    }

    .margin_bottom {
        margin-bottom: 4rem;
    }

    .textbox {
        margin-left: 5.5rem;
        margin-bottom: 1rem;
    }

    .member_card_display {
        margin: 5rem;
    }

    @media print {
        .border-dark {
            color: black;
            background-color: white;
            border: 1px solid black;
        }
        .arrange_textbox {
            padding-top: -14rem; 
            padding-left: 12rem;
        }
        .mem_id {
            padding-left: 5rem;
        }
        .style_date {
            padding-left: 1.5rem;
        }
        .barcode {
            padding-left: 9rem;
        }
    }
</style>
<div class="container">
    <div class="member_card_display border border-dark">
        <div class="row">
            <div class="col-md-3 d-flex justify-content-start">
                <div style="margin: 2rem;" width="144" height="144">
                    <img src="<?php echo base_url(); ?>application/views/swm/frontend/IMG/Profile/<?php echo $su_code; ?>.jpg" width="144" height="144">
                </div>
            </div>
            <div class="col-md-9 arrange_textbox">
                <div class="row d-flex justify-content-center mem_id" style="margin: 2rem;">
                    รหัสสมาชิก &nbsp; <?php echo $su_code; ?>
                </div>
                <div class="container" style="margin-left: 5rem;">
                    <div class="row d-flex justify-content-start">
                        ชื่อ &nbsp; <?php echo $full_name; ?>
                    </div>
                    <div class="row d-flex justify-content-start">
                        เกิด &nbsp; <?php echo $birthdate; ?>
                    </div>
                    <div class="row d-flex justify-content-start">
                        อายุ &nbsp; <?php echo $age; ?> &nbsp; ปี
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center style_date">
            วันออกบัตร &nbsp; <?php echo $create_date; ?> &emsp;&emsp;
            วันหมดอายุ &nbsp; <?php echo $expire_date; ?>
        </div>
        <div class="row d-flex justify-content-center barcode" style="margin-bottom: 1rem;">
            <barcode code="<?php echo $su_code; ?>" type="C39" height="0.70" size="1.2" text="0" />
        </div>
    </div>
</div>
