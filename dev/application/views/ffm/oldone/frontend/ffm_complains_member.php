<script>
$(document).ready(function() {
    $("#submit").click(function() {

        var x = document.getElementById("choose").value
        if (x == "") {
            alert("กรุนาเลือกประเภท");
            return false;
        }
    });
});
</script>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <form method="POST" action="./insert">
            <div class="card">
                <div class="card-content">
                    <h2 class="card-title" style="text-align: center;"></h2>
                </div>
                <center>
                    <h1>แสดงความคิดเห็น</h1>
                </center>
                <br>
                <div class="from-group-control row">
                    <label class="col-sm-3 control-label" style="text-align: right;">ระบุประเภท : </label>
                    <select name="type" id="choose" class="selectpicker" data-style="select-with-transition"
                        title="โปรดเลือก" data-size="8" tabindex="-100">
                        <?php   foreach($qu_Mc as $row){  ?>
                        <option value="<?php echo $row->tp_id;?>">
                            <?php echo $row->tp_complain;?>
                        </option>
                        <?php   } ?>
                    </select>
                    <br>
                </div>
                <div class="from-group-control row">
                    <label class="col-sm-3" style="text-align: right;">แสดงความคิดเห็น : </label>
                    <TEXTAREA class="form-control" style="width:500px; height: 150px;"
                        placeholder="กรุณาระบุความคิดเห็น" name="cp_complain"></TEXTAREA>
                    <br>
                </div>
                <br>
                <div class="group ">
                    <label class="col-sm-3" style="text-align: right;">แนบหลักฐาน :</label>
                    <input type="file" name="fileToUpload" id="fileToUpload">
                </div>
                <br>
                <br>
                <div class="form" style="text-align: center;">
                    <input class="btn btn-danger btn-sm" type="submit" value="ยกเลิก" name="data">
                    <input class="btn btn-success btn-sm" id="submit" type="submit" value="ส่ง" name="data">
                </div>
                <br>
                <br>
                <br>
                <br>
            </div>
    </div>
    <!--CARD -->
    </form>
    <!--FORM -->
    <div class="col-md-1"></div>