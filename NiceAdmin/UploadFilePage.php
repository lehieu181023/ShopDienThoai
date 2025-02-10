<?php
    $srcimg = $srcimg ?? "https://m.media-amazon.com/images/I/31aqU1dRJyL.__AC_QL70_ML2_.jpg";
    $name = $name ?? "image";
?>
<div>
  <div class="mb-3">
    <a
      id="btnthem-<?php echo $name ?>"
      class="btn btn-primary"
      role="button"
      onclick="$('#InputFile-<?php echo $name ?>').click()"
      >Chọn ảnh</a>
    
    <input type="hidden" name="<?php echo $name ?>" id="imgfile-value-<?php echo $name ?>" value="<?php echo $srcimg ?>">  
    
    <input
      hidden
      onchange="UploadFile(this,'<?php echo $name ?>')"
      type="file"
      class="form-control"
      id="InputFile-<?php echo $name ?>"
      placeholder=""
      aria-describedby="fileHelpId"
      accept=".txt,.csv,.jpg,.png,.gif,.png"
    />
    <div id="Preview-<?php echo $name ?>" class="mt-3" hidden>
      <picture>
        <source srcset="sourceset" type="image/svg+xml+jpg+png" />
        <img
          id="imgfile-<?php echo $name ?>"
          src="<?php echo $srcimg ?>"
          class="img-fluid"
          alt="image desc"
          width="200px" height="200px"
        />
      </picture>
      <div id="progress-container-<?php echo $name ?>">
        <div id="progress-bar-<?php echo $name ?>">0%</div>
      </div>
      <i class="fa-solid fa-xmark" role="button" onclick="deletefile($('#imgfile-<?php echo $name ?>').attr('src'),'<?php echo $name ?>')"></i>

    </div>
  </div>
  
</div>
<style>
        #progress-container-<?php echo $name ?> {
            width: 100%;
            background: #f3f3f3;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 20px 0;
            display: none;
        }
        #progress-bar-<?php echo $name ?> {
            height: 20px;
            width: 0;
            background: #4caf50;
            border-radius: 5px;
            text-align: center;
            line-height: 20px;
            color: white;
        }    
</style>
<script>
  $(document).ready(function() {
    if($('#imgfile-<?php echo $name ?>').attr('src') != null){
      $('#Preview-<?php echo $name ?>').removeAttr('hidden');
    }
  });
</script>
