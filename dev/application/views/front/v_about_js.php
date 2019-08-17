$(function () {
  $('body').addClass('profile-page sidebar-collapse',5000);
  $('.page-header.header-small').animate({'min-height':'40vh'},1000)
  $('.n-edit').hide()
  $('.text-avatar').hide()
  // $('#us_email').val(chance.email())
  // $('#us_birthdate').val(chance.date())
  $('#us_gender').val(chance.gender())
  $('#us_password').val(chance.sentence())
  $('#us_tel').val(chance.sentence())
  $('#us_us_home').val(chance.sentence())
  
  $(document).on('click','.btn-edit', function (e) {
    $('.btn-edit').tooltip('hide');
    let _target = e.target
    let _parent = $(_target).closest('tr')
    target_backup = _parent.html()
    let _target_type = $(_parent).data('type')
    let td_target = _parent.find('.td-name')
    let td_action = _parent.find('.td-actions')
    let txt = '';

    localStorage.setItem("bk_"+_target_type, _parent.html());
    switch(_target_type){
      case 'us_email':
        let current_email = $('#us_email').val()
        txt += `<div class="form-row">
                <div class="col">
                  <input type="email" name="us_email" class="form-control" placeholder="a@a.a" value="`+current_email+`">
                </div>
              </div>`
      break;
      case 'us_birthdate':
        let current_bd = $('#us_birthdate').val()
        txt += `<div class="form-row">
                <div class="col">
                  <input type="text" name="us_birthdate" class="form-control my-datepicker" placeholder="" value="`+current_bd+`">
                </div>
              </div>`
      break;
      case 'us_gender':
        let current_gd = $('#us_gender').val()
        txt += `<div class="form-row">
                <div class="col">
                  <select class="selectpicker" name="us_gender" data-style="select-with-transition" title="เพศ/คำนำหน้า" data-width="100%">
                    <option disabled>เพศ/คำนำหน้า</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                  </select>
                </div>
              </div>`
      break;
      case 'us_password':
        txt += `<div class="form-row">
                <div class="col">
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-static">รหัสผ่านเดิม</label>
                    <input type="password" name="old_password" class="form-control" placeholder="Your old password here">
                  </div>
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-static">รหัสผ่านใหม่</label>
                    <input type="password" name="new_password" class="form-control" placeholder="Your new password here">
                  </div>
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-static">ยืนยันรหัสผ่านอีกครั้ง</label>
                    <input type="password" name="con_password" class="form-control" placeholder="Confirm your password here">
                  </div>
                </div>
              </div>`
      break;
      case 'us_tel':
        let current_tel = $('#us_tel').val()
        txt += `<div class="form-row">
                <div class="col">
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-static">หมายเลขโทรศัพท์</label>
                    <input type="text" name="us_tel" class="form-control" placeholder="084xxxxxxxx">
                  </div>
                </div>
              </div>`
      break;
      case 'us_home':
        let current_hm = $('#us_home').val()
        txt += `<div class="form-row">
                <div class="col">
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-static">ที่อยู่ที่สามารถติดต่อได้</label>
                    <input type="text" name="us_home" class="form-control" placeholder="">
                  </div>
                </div>
              </div>`
      break;
      default:
    }
    $(td_target).html(`<form action="" method="post">`+txt+`</form>`)
    let action = `<button type="button" rel="tooltip" data-placement="left" title="" class="btn btn-success btn-sm btn-update"  data-original-title="แก้ไข">
                    <i class="material-icons">check</i>
                  </button>
                  <button type="button" rel="tooltip" data-placement="left" title="" class="btn btn-danger btn-sm btn-cancel"  data-original-title="แก้ไข">
                    <i class="material-icons">close</i>
                  </button>`
    $(td_action).html(action)
    if ($(".selectpicker").length != 0) {
      $(".selectpicker").selectpicker();
    }
    if ($(".my-datepicker").length != 0) {
      $('.my-datepicker').datetimepicker({
        format: 'YYYY-MM-DD',
        locale: 'th-TH',  // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-remove'
        }
      })
    }

  })
  $(document).on('click','.btn-cancel', function(e){
    let _parent = $(e.target).closest('tr')
    let _target_type = $(_parent).data('type')
    let bk = localStorage.getItem("bk_"+_target_type);
    $(_parent).animate({'opacity': 0}, 400, function(){
      $(_parent).html(bk).animate({'opacity': 1}, 500)
      $(_parent).find('.td-actions').html(`<button type="button" rel="tooltip" data-placement="right" title="" class="btn btn-link btn-edit"  data-original-title="แก้ไข"><i class="material-icons">edit</i></button>`)
    })
    $('.btn-edit').tooltip();
    localStorage.removeItem("bk_"+_target_type);
  })
  $( "#name-string" ).hover(
    function() {
      $('.n-edit').fadeIn('')
    }, function() {
      $('.n-edit').delay(500).fadeOut('') 
    }
  );
  $( ".img-avatar" ).hover( 
    function() {
      $('.text-avatar').fadeIn('slow');
      $(".img-avatar").css({
          WebkitFilter: 'grayscale(20%) invert(0) blur(1px)'
      })
    }, function() {
      $(".img-avatar").css({
          WebkitFilter: ''
      })
      $('.text-avatar').fadeOut('slow');
    }
  );
  $(document).on('click','.btn-update', function(e){
    let _parent = $(e.target).closest('tr')
    let _target_type = $(_parent).data('type')
    let url = '<?php echo site_url("Gear/update_profile_json");?>'
    let inputs = $(_parent).find('input,select');
    let arr = []
    let bk = localStorage.getItem("bk_"+_target_type);
    
    $.each(inputs, function (indexInArray, valueOfElement) { 
        arr.push({name:$(valueOfElement).attr('name'),value:$(valueOfElement).val()})
    });
    arr.push({name:'us_id',value:$('#us_id').val()})

    if(arr.length){
      $.ajax({
        type: "POST",
        url: url,
        data: arr,
        dataType: "json",
        success: function (response) {
          if(response.status){
            switch(_target_type){
              case 'us_email':
                  $('#us_email').val(response.detail)
                  $(_parent).animate({'opacity': 0}, 400, function(){
                    $(_parent).html(bk).animate({'opacity': 1}, 500)
                    $(_parent).find('.td-name').html('<a href="#">'+response.detail+'</a>')
                    $(_parent).find('.td-actions').html(`<button type="button" rel="tooltip" data-placement="right" title="" class="btn btn-link btn-edit"  data-original-title="แก้ไข"><i class="material-icons">edit</i></button>`)
                  })
                  
              break;
              case 'us_birthdate':
                  $('#us_birthdate').val(response.detail)
                  $(_parent).animate({'opacity': 0}, 400, function(){
                    $(_parent).html(bk).animate({'opacity': 1}, 500)
                    $(_parent).find('.td-name').html('<a href="#">'+response.detail+'</a>')
                    $(_parent).find('.td-actions').html(`<button type="button" rel="tooltip" data-placement="right" title="" class="btn btn-link btn-edit"  data-original-title="แก้ไข"><i class="material-icons">edit</i></button>`)
                  })
              break;
              case 'us_gender':
                let current_gd = $('#us_gender').val()
                
              break;
              case 'us_password':
                
              break;
              case 'us_tel':
                $('#us_tel').val(response.detail)
                $(_parent).animate({'opacity': 0}, 400, function(){
                  $(_parent).html(bk).animate({'opacity': 1}, 500)
                  $(_parent).find('.td-name').html('<a href="#">'+response.detail+'</a>')
                  $(_parent).find('.td-actions').html(`<button type="button" rel="tooltip" data-placement="right" title="" class="btn btn-link btn-edit"  data-original-title="แก้ไข"><i class="material-icons">edit</i></button>`)
                })
                
              break;
              case 'us_home':
                let current_hm = $('#us_home').val()
                
              break;
              default:
            }
          }
        }
      });
    }
    $('.btn-edit').tooltip();
    localStorage.removeItem("bk_"+_target_type);
    
  })
  $(document).on('click','.n-edit',function(e){
    $('#my-modal').modal('show')
  })
  $(document).on('click','.n-save',function(e){
    let url = '<?php echo site_url("Gear/update_profile_json");?>'
    let data = [{name:'us_id',value:$('#us_id').val()},{name:'us_name',value:$('#name').val()},{name:'us_lname',value:$('#lname').val()}]
    if($('#fk-frm')[0].checkValidity()){
      $.ajax({
        type: "POST",
        url: url,
        data: data,
        dataType: "json",
        success: function (response) {
          if(response.status){
            $('#my-modal').modal('hide')
            $('#name-string').animate({'opacity': 0}, 400, function(){
              $('#name-string').html(response.detail).animate({'opacity': 1}, 500)
              $('#name,#lname').val('');
            })
  
          }
        }
      });
    }
  })

  $( ".img-avatar,.text-avatar").on('click',function(){
    $('#img-modal').modal('show')    
  })

  $('.fileinput').on('change.bs.fileinput',function(e){
    // $('.img-save').attr('disabled',false)
    fileSelected($(e.target).find('#f-input')[0])
  })

  $('.fileinput').on('clear.bs.fileinput',function(e){
    $('#txt-err').html('');
    $('.img-save').attr('disabled',true)
  })

  $('.img-save').on('click',function(e){
    event.preventDefault();
    let stdCode = $('#us_id').val();
    var vFD = new FormData(document.getElementById('frm-upload'));
    $.ajax({
        type:'POST',
        url: '<?php echo site_url()."Gear/update_profile_json";?>',
        data:vFD,
        cache:false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(data){
          if(data.status){
          }
        },
        error: function(data){
            console.log("error");
            console.log(data);
        }
    });
  })

  
});
function fileSelected(){
  self = document.getElementById('f-input')
  let iMaxFilesize = 1048576; //1mb
  var oFile = self.files[0];
  let dimensionStrict = 500;
  
  // var rFilter = /^(image\/bmp|image\/gif|image\/jpeg|image\/png|image\/tiff)$/i;
  var rFilter = /^(image\/jpg|image\/jpeg)$/i;
  if (! rFilter.test(oFile.type)) {
      // document.getElementById('error').style.display = 'block';
      $('#txt-err').html('รูปแบบไฟล์ไม่ถูกต้อง');
      $('#btn-upload').prop('disabled', true);
      console.log('รูปแบบไฟล์ไม่ถูกต้อง');
      return;
  }
  if (oFile.size > iMaxFilesize) {
      //document.getElementById('warnsize').style.display = 'block';
      // console.log(oFile.size);
      // console.log('err file size');
      $('#txt-err').html('ขนาดไฟล์ไม่ถูกต้อง');
      $('#btn-upload').prop('disabled', true);
      console.log('ขนาดไฟล์ไม่ถูกต้อง');

      return;
  }
 
  var oImage = document.getElementById('preview');
  var oReader = new FileReader();
  oReader.onload = function(e){
    var oImage = new Image();
    oImage.src = oReader.result;
    oImage.onload = function () {
      console.log(oImage.width);
      console.log(oImage.height);
      if (oImage.width > dimensionStrict || oImage.height > dimensionStrict) {
          //document.getElementById('warnsize').style.display = 'block';
          $('#txt-err').html('ความกว้าง หรือความยาวของรูปภาพไม่ถูกต้อง');
          $('.img-save').attr('disabled',true)
          return;
      }else{
        $('#txt-err').html('');
        $('.img-save').attr('disabled',false)
      }
      // let scale = 'Dimension: ' + oImage.naturalWidth + ' x ' + oImage.naturalHeight;
    }
  }
  oReader.readAsDataURL(oFile);
}