<?php
    $srcimg = $srcimg ?? "";
    $name = $name ?? "image";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Site</title>
  <!-- FontAwesome CDN -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</head>
<body>
  <div class="mb-3">
    <a
      id=""
      class="btn btn-primary"
      role="button"
      onclick="$('#InputFile-<?php echo $name ?>').click()"
      >Button</a>
    
    <input
      hidden
      onchange="UploadFile(this,'<?php echo $name ?>')"
      type="file"
      class="form-control"
      name="<?php echo $name ?>"
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
          width="300px" height="300px"
        />
      </picture>
      <div id="progress-container-<?php echo $name ?>">
        <div id="progress-bar-<?php echo $name ?>">0%</div>
      </div>
      <i class="fa-solid fa-xmark" role="button" onclick="deletefile($('#imgfile-<?php echo $name ?>').attr('src'),'<?php echo $name ?>')"></i>

    </div>
  </div>
  
</body>
<script src="https://code.jquery.com/jquery.min.js"></script>
<script src="js/UploadFile.js"></script>
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
</html>