<style>
  .text-avatar{
    position: absolute;
    top: 25%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-weight:bold;
    cursor: pointer;
  }
</style>
<div class="main main-raised">
    <div class="profile-content">
      <div class="container">
        <div class="row">
          <div class="col-md-6 ml-auto mr-auto">
            <div class="profile">
              <div class="avatar">
                <img src="<?php echo base_url();?>/frontend/assets/img/faces/christian.jpg" alt="Circle Image" class="img-avatar img-raised rounded-circle img-fluid" style="cursor:pointer">
                <div class="top-right text-avatar"><i class="fa fa-upload"></i></div>
              </div>
              <div class="name">
                <h3 class="title"><span id="name-string"><?php echo $arr_user['us_name'];?></span><br><button class="btn btn-primary btn-sm n-edit">Edit<div class="ripple-container"></div></button></h3>
                
  
                <!-- <h6>Designer</h6> -->
                <a href="#pablo" class="btn btn-just-icon btn-link btn-dribbble"><i class="fa fa-dribbble"></i></a>
                <a href="#pablo" class="btn btn-just-icon btn-link btn-twitter"><i class="fa fa-twitter"></i></a>
                <a href="#pablo" class="btn btn-just-icon btn-link btn-pinterest"><i class="fa fa-pinterest"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="row d-none">
          <div class="col-md-12 col-lg-12 col-sm-12">
            <a href="#pablo" class="btn btn-info btn-round float-right">
              <i class="material-icons">build</i>  Edit Profile
              <div class="ripple-container"></div>
            </a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 col-sm-12">
              <div class="card">
                  <div class="card-header card-header-text card-header-primary">
                    <div class="card-text">
                      <h3 class="card-title">Profile</h3>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="col-lg-10 col-md-10 ml-auto mr-auto">
                      <table class="table table-shopping" width="100%">
                        <tbody>
                          <tr data-type="us_email">
                            <td width="10%">
                              <i class="material-icons">email</i>
                            </td>
                            <td class="td-name" width="75%">
                              <a href="#jacket"><?php echo ($arr_user['us_email']==null)?'Unknow':$arr_user['us_email'];?></a>
                            </td>
                            <td class="td-actions text-center" width="15%">
                              <button type="button" rel="tooltip" data-placement="right" title="" class="btn btn-link btn-edit"  data-original-title="แก้ไข">
                                <i class="material-icons">edit</i>
                              </button>
                            </td>
                          </tr>
                          <tr data-type="us_birthdate">
                            <td width="10%">
                              <i class="material-icons">cake</i>
                            </td>
                            <td class="td-name" width="75%">
                              <a href="#jacket"><?php echo ($arr_user['us_birthdate']==null)?'0000-00-00':$arr_user['us_birthdate'];?></a>
                            </td>
                            <td class="td-actions text-center" width="15%">
                              <button type="button" rel="tooltip" data-placement="right" title="" class="btn btn-link btn-edit"  data-original-title="แก้ไข">
                                <i class="material-icons">edit</i>
                              </button>
                            </td>
                          </tr>
                          <tr data-type="us_gender">
                            <td width="10%">
                              <i class="material-icons">face</i>
                            </td>
                            <td class="td-name" width="75%">
                              <a href="#jacket"><?php echo ($arr_user['us_gender']==null)?'he or she':$arr_user['us_gender'];?></a>
                            </td>
                            <td class="td-actions text-center" width="15%">
                              <button type="button" rel="tooltip" data-placement="right" title="" class="btn btn-link btn-edit"  data-original-title="แก้ไข">
                                <i class="material-icons">edit</i>
                              </button>
                            </td>
                          </tr>
                          <tr data-type="us_password">
                            <td width="10%">
                              <i class="material-icons">vpn_key</i>
                            </td>
                            <td class="td-name" width="75%">
                              <a href="#jacket"><?php echo ($arr_user['us_gender']==null)?'*******':$arr_user['us_gender'];?></a>
                              <br>
                              <small>แก้ไขล่าสุดเมื่อ : วันวานเทศกาลผ่านมา</small>
                            </td>
                            <td class="td-actions text-center" width="15%">
                              <button type="button" rel="tooltip" data-placement="right" title="" class="btn btn-link btn-edit"  data-original-title="แก้ไข">
                                <i class="material-icons">edit</i>
                              </button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
              </div>
          </div>
          <div class="col-md-12 col-sm-12">
              <div class="card">
                  <div class="card-header card-header-text card-header-primary">
                    <div class="card-text">
                      <h3 class="card-title">Contact Info</h3>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="col-lg-10 col-md-10 ml-auto mr-auto">
                      <table class="table table-shopping">
                        <tbody>
                          <tr data-type="us_tel">
                            <td width="10%">
                              <i class="material-icons">phone</i>
                            </td>
                            <td class="td-name" width="75%">
                              <a href="#jacket"><?php echo ($arr_user['us_tel']==null)?'Unknow':$arr_user['us_tel'];?></a>
                            </td>
                            <td class="td-actions text-center" width="15%">
                              <button type="button" rel="tooltip" data-placement="right" title="" class="btn btn-link btn-edit"  data-original-title="แก้ไข">
                                <i class="material-icons">edit</i>
                              </button>
                            </td>
                          </tr>
                          <tr data-type="us_home">
                            <td width="10%">
                              <i class="material-icons">home</i>
                            </td>
                            <td class="td-name" width="75%">
                              <a href="#jacket"><?php echo ($arr_user['us_email']==null)?'Unknow':$arr_user['us_email'];?></a>
                            </td>
                            <td class="td-actions text-center" width="15%">
                              <button type="button" rel="tooltip" data-placement="right" title="" class="btn btn-link btn-edit"  data-original-title="แก้ไข">
                                <i class="material-icons">edit</i>
                              </button>
                            </td>
                          </tr>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
              </div>
          </div>
        </div>
        <pre>
            <?php //print_r($arr_user);?>
        </pre>
      </div>
    </div>
  </div>

  <input type="hidden" id="us_id" value="<?php echo $arr_user['us_id'];?>"/>
  <input type="hidden" id="us_fname" value="<?php echo $arr_user['us_fname'];?>"/>
  <input type="hidden" id="us_lname" value="<?php echo $arr_user['us_lname'];?>"/>
  <input type="hidden" id="us_email" value="<?php echo $arr_user['us_email'];?>"/>
  <input type="hidden" id="us_home" value="<?php echo '';?>"/>
  <input type="hidden" id="us_tel" value="<?php echo $arr_user['us_tel'];?>"/>
  <input type="hidden" id="us_gender" value="<?php echo $arr_user['us_gender'];?>"/>
  <input type="hidden" id="us_birthdate" value="<?php echo ($arr_user['us_birthdate']);?>"/>
  <div class="modal fade" id="my-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-small" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
        </div>
        <div class="modal-body text-center">
          <h5>กรุณากรอกข้อมูล </h5>
          <form id="fk-frm">
          <div class="form-row has-primary">
            <div class="col">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-static">ชื่อ</label>
                <input type="text" name="us_name" id="name" class="form-control" placeholder="ฮาจิคุจิ" required>
              </div>
            </div>
          </div>
          <div class="form-row has-primary">
            <div class="col">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-static">นามสกุล</label>
                <input type="text" name="us_lname" id="lname" class="form-control" placeholder="มาโยย" required>
              </div>
            </div>
          </div>
        </div>
        </form>
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-success btn-link n-save">Change!</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="img-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-small" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
        </div>
        <form id="frm-upload">
        <div class="modal-body text-center">
          <h5>เปลี่ยนรูปโปรไฟล์ </h5>
          <div class="form-row has-primary">
            <div class="fileinput fileinput-new text-center" data-provides="fileinput" style="width:100%">
              <div class="fileinput-new thumbnail img-raised" >
                <img src="<?php echo base_url();?>/frontend/assets/img/image_placeholder.jpg" alt="..." style="max-width:300px;">
              </div>
              <div class="fileinput-preview fileinput-exists thumbnail img-raised" id="preview"></div>
              <div>
                <span class="btn btn-raised btn-round btn-default btn-file btn-sm">
                  <span class="fileinput-new">Select image</span>
                  <span class="fileinput-exists">Change</span>
                  <input type="file" name="..." id="f-input"/>
                </span>
                <a href="#pablo" class="btn btn-danger btn-sm btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
              </div>
            </div><!-- file upload -->
          </div>
          <span class="badge badge-pill badge-danger" id="txt-err"></span>
        </div>
        </form>
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-success btn-link img-save" disabled>upload</button>
        </div>
      </div>
    </div>
  </div>