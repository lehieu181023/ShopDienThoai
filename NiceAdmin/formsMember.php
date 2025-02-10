<?php
  include ('DB/DBcontext.php');
  $id_modifi = $_POST['id']??0;
  $dataOne = [];
  if($id_modifi > 0){
    $sql = "SELECT * FROM `brand` WHERE id = $id_modifi";
    $dataOne = $db->OneSelect($sql);
    $db->closeConnection();
  }
?>
  <div class="modal" id="myModal">
    <div class="modal-dialog" >
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
              <h4 class="modal-title"><?php echo $id_modifi > 0?'Sửa':'Thêm'  ?></h4>
              <button type="button" class="close btn bg-transparent border-0" data-bs-dismiss="modal" onclick="closeModal()">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form action="../NiceAdmin/DB/account/<?php echo $id_modifi > 0?'modifi.php':'add.php' ?>"
                  class="form-horizontal"
                  data-ajax="true"
                  data-ajax-begin="BlockUI()"
                  data-ajax-failure="UnBlockUI()"
                  data-ajax-method="POST"
                  data-ajax-success="successAction"
                  id="basicForm"
                  method="post"
                  novalidate="">
              <?php 
                if($id_modifi > 0){
              ?>
                <input type="hidden" name="id" value="<?php echo $dataOne['id']??'' ?>">
              <?php } ?>
              <div class="form-horizontal">
                <div class="form-group">
                  <div class="row mb-3">
                    <label for="name" class="control-label col-md-2 text-right">Name</label>
                    <div class="col-md-10">
                      <input type="text" class="form-control" name="name" value="<?php echo $dataOne['Name']??'' ?>">
                    </div>
                  </div>
                </div>
                <?php 
                if($id_modifi <= 0){
                ?>
                <div class="form-group">
                  <div class="row mb-3">
                    <label for="pass" class="control-label col-md-2 text-right">Password</label>
                    <div class="col-md-10">
                      <input type="password" class="form-control" name="pass">
                    </div>
                  </div>
                </div>
                <?php } ?>
                <div class="form-group">
                  <div class="row mb-3">
                    <label for="email" class="control-label col-md-2 text-right">Email</label>
                    <div class="col-md-10">
                      <input type="email" name="email" class="form-control" value="<?php echo $dataOne['Email']??'' ?>">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row mb-3">
                    <label for="phone" class="control-label col-md-2 text-right">SDT</label>
                    <div class="col-md-10">
                      <input type="text" name="phone" class="form-control" value="<?php echo $dataOne['SDT']??'' ?>">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row mb-3">
                    <label for="status" class="control-label col-md-2 text-right">Status</label>
                    <br>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="status" value="1" <?php echo empty($dataOne['Status'])?'':(($dataOne['Status'])?'checked':'') ?>>
                        <label class="form-check-label" for="status">
                          Status
                        </label>
                      </div>
                    </div>
                  </div> 
                </div>
                <div class="form-group">
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Submit Button</label>
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">Submit Form</button>
                    </div>
                  </div>
                </div>
              </div>                     
            </form><!-- End General Form Elements -->                               
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
              <button type="button" class="btn btn-danger"  id="btnclosemodel" data-bs-dismiss="modal" >Close</button>
          </div>

        </div>
    </div>
  </div>