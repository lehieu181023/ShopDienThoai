<?php
  include ('DB/DBcontext.php');
  $id_modifi = $_POST['id']??0;
  $dataOne = [];
  $dataEnum = $db->ArrayEnum('product','status');
  $dataBrands = $db->ArraySelect('SELECT * FROM `brand` WHERE `Status` = 1');
  if($id_modifi > 0){
    $sql = "SELECT * FROM `product` WHERE id = $id_modifi";
    $dataOne = $db->OneSelect($sql);
    $db->closeConnection();
  }
?>

  <div class="modal" id="myModal">
    <div class="modal-dialog" >
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
              <h4 class="modal-title">
                <?php echo $id_modifi > 0?'Edit Product':'Add Product' ?>
              </h4>
              <button type="button" class="close btn bg-transparent border-0" data-bs-dismiss="modal" onclick="closeModal()">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
          <form action="../NiceAdmin/DB/product/<?php echo $id_modifi > 0?'modifi.php':'add.php' ?>"
                  class="form-horizontal"
                  data-ajax="true"
                  data-ajax-begin="BlockUI()"
                  data-ajax-failure="UnBlockUI()"
                  data-ajax-method="POST"
                  data-ajax-success="successAction"
                  id="basicForm"
                  method="post"
                  novalidate="">
                  <?php if($id_modifi > 0){ ?>
                    <input type="hidden" name="id" value="<?php echo $id_modifi ?>">
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
                <div class="form-group">
                  <div class="row mb-3">
                    <label class="control-label col-md-2 text-right">Status</label>
                    <div class="col-sm-10">
                      <select class="form-select" aria-label="Default select example" name="status">
                        <?php foreach($dataEnum as $item){ ?>                        
                          <option value="<?php echo $item ?>" <?php echo $dataOne ? (($item === $dataOne['Status'])?' selected':''):'' ?>><?php echo $item ?></option>
                        <?php }?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row mb-3">
                    <label class="control-label col-md-2 text-right">Brands</label>
                    <div class="col-sm-10">
                      <select class="form-select" aria-label="Default select example" name="brands">
                        <?php foreach($dataBrands as $item){ ?>
                          <option value="<?php echo $item['id'] ?>" <?php echo $dataOne ? (($item['id'] == $dataOne['Brands'])?' selected':''):'' ?>><?php echo $item['Name'] ?></option>
                        <?php }?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row mb-3">
                    <label for="quanity" class="control-label col-md-2 text-right">Quantity</label>
                    <div class="col-md-10">
                      <input type="number" class="form-control" name="quanity" value="<?php echo $dataOne['quantity']??'' ?>">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row mb-3">
                    <label for="price" class="control-label col-md-2 text-right">Price</label>
                    <div class="col-md-10">
                      <input type="number" class="form-control" name="price" value="<?php echo $dataOne['Price']??'' ?>">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row mb-3">
                    <label for="" class="control-label col-md-2 text-right">Ảnh</label>
                    <div class="col-md-10">
                        <?php
                        $srcimg = $dataOne['Image']??'';
                        $name = 'imgproduct';
                        include ('UploadFilePage.php') 
                        ?>
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
              <button type="button" class="btn btn-danger" id="btnclosemodel"  data-bs-dismiss="modal" >Close</button>
          </div>

        </div>
    </div>
  </div>