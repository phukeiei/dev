<script>
  $(document).ready(function() {
    sm.initFormExtendedDatetimepickers();
  });
  $(document).ready(function() {
    $('#datatables').DataTable({
      "pagingType": "full_numbers",
      "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
      ],
      responsive: true,
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Search records",
      }
    });
  });
</script>
<html>

<head>

</head>

<body>
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header card-header-info card-header-text">
        <div class="card-text">
          <h4 class="card-title">ค้นหาข้อมูลการใช้บริการ</h4>
        </div>
      </div>
      <div class="card-body">
        <form method="get" action="/" class="form-horizontal">

          <div class="row">
            <label class="col-sm-2 col-form-label">ประเภท</label>
            <div class="dropdown bootstrap-select show-tick">
              <select class="selectpicker col-sm-9" data-style="select-with-transition" title="โปรดเลือก">
                <option value="1">สมาชิก </option>
                <option value="2">ไม่ใช่สมาขิก</option>
              </select>
            </div>
          </div>
          <div class="row">
            <label class="col-sm-2 col-form-label">อายุระหว่าง</label>
            <div class="col-sm-2">
              <div class="form-group has-default">
                <input type="number" class="form-control" min="0">
              </div>
            </div>
            <label class="col-sm-1 col-form-label">ถึง</label>
            <div class="col-sm-2">
              <div class="form-group has-default">
                <input type="number" class="form-control" min="0">
              </div>
            </div>
          </div>
          <div class="row">
            <label class="col-sm-2 col-form-label">วันที่</label>
            <div class="form-group has-default col-sm-2">
              <input type="text" class="form-control datepicker" value="11/06/2018">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="col-sm-12">
    <div class="card">
      <div class="card-header card-header-info card-header-text">
        <div class="card-text">
          <h4 class="card-title">ตารางข้อมูลการใช้บริการ</h4>
        </div>
      </div>
      <div class="card-body">
        <div class="material-datatables">
          <table id="datatables" class="table table-striped table-color-header table-hover table-border" cellspacing="0" width="100%" style="width:100%">
            <thead class="text-primary">
              <tr>
                <th>วัน เดือน ปี</th>
                <th>เวลาเข้าใช้งาน</th>
                <th>อายุ</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">1/1/2562</td>
                <td class="text-center">8.30</td>
                <td class="text-center">16</td>
              </tr>
              <tr>
                <td class="text-center">1/1/2562</td>
                <td class="text-center">9.30</td>
                <td class="text-center">18</td>
              </tr>
              <tr>
                <td class="text-center">1/1/2562</td>
                <td class="text-center">12.30</td>
                <td class="text-center">20</td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <th class="text-center">วัน เดือน ปี</th>
                <th class="text-center">เวลาเข้าใช้งาน</th>
                <th class="text-center">อายุ</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>

</body>


</html>