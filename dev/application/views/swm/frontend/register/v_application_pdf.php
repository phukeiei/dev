<style>
    .margin_top {
        margin-top: 4rem;
    }

    .margin_bottom {
        margin-bottom: 4rem;
    }

    .textbox {
        /* margin-left: 5.5rem; */
        margin-bottom: 1rem;
    }
</style>
<div class="container border border-dark" style="margin-top: 2rem;">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center margin_top" style="text-align: center;">
            <b>ใบสมัครสมาชิกสระว่ายน้ำ</b>
        </div>
    </div>
    <div class="row">
        <div class="col-md-11 d-flex justify-content-end" >
            <div style="margin-top: -2rem; text-align: right;">
                <img src="<?php echo base_url(); ?>application/views/swm/frontend/IMG/Profile/<?php echo $su_code; ?>.jpg" width="144" height="144">
            </div>
        </div>
    </div>
    <div class="row margin_top">
        <div class="col-md-10 textbox d-flex justify-content-start">
            &emsp;&emsp;ข้าพเจ้า &nbsp; <?php echo $full_name; ?>
            &emsp;&emsp;เกิด &nbsp; <?php echo $birthdate; ?>
            &emsp;&emsp;อายุ &nbsp; <?php echo $age; ?> &nbsp; ปี
            &emsp;&emsp;อาชีพ &nbsp; <?php echo $career; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 textbox d-flex justify-content-start">
            ที่อยู่ &nbsp; <?php echo $addcur_no; ?> &emsp;
            ตำบล &nbsp; <?php echo $district; ?> &emsp;
            อำเภอ &nbsp; <?php echo $amphur; ?> &emsp;
            จังหวัด &nbsp; <?php echo $province; ?> &emsp;
            รหัสไปรษณีย์ &nbsp; <?php echo $zipcode; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 textbox d-flex justify-content-start">
            เบอร์โทรศัพท์ &nbsp; <?php echo $phone_no; ?> &emsp;
        </div>
    </div>
    <div class="row margin_top">
        <div class="col-md-10 textbox d-flex justify-content-start">
            บุคคลที่สามารถติดต่อได้
        </div>
    </div>
    <div class="row margin_bottom">
        <div class="col-md-10 textbox d-flex justify-content-start">
            <?php echo $contact_full_name; ?> &emsp;
            เบอร์โทรศัพท์ &nbsp; <?php echo $contact_phone_no; ?> &emsp;
        </div>
    </div>
</div>