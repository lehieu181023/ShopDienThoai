<?php
    $name = isset($_POST['Name']) ? $_POST['Name'] : '';
    $multiple = isset($_POST['Multiple']) ? $_POST['Multiple'] : '';
    $value = isset($_POST['Value']) ? $_POST['Value'] : '';
    $type = isset($_POST['type']) ? $_POST['type'] : 'document';
    $fileType = isset($_POST['filetype']) ? $_POST['filetype'] : '';
    $folder = isset($_POST['folder']) ? $_POST['folder'] : '';
    $setname = isset($_POST['setname']) ? $_POST['setname'] : '';
    $valueName = isset($_POST['valueName']) ? $_POST['valueName'] : '';
    $setSize = isset($_POST['setSize']) ? $_POST['setSize'] : '';
    $valueSize = isset($_POST['valueSize']) ? $_POST['valueSize'] : '';
    $auto = isset($_POST['auto']) ? $_POST['auto'] : false;
    $changeName = isset($_POST['changeName']) ? $_POST['changeName'] : false;
    $imageHoSo = isset($_POST['imageHoSo']) ? $_POST['imageHoSo'] : false;
    $url = isset($_POST['url']) ? $_POST['url'] : null;
    $edit = isset($_POST['edit']) ? $_POST['edit'] : null;
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/DATN/Assets/js/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
<link href="/DATN/Assets/js/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />

<script src="/DATN/Assets/js/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
<script src="/DATN/Assets/js/jquery-file-upload/js/vendor/tmpl.min.js"></script>
<script src="/DATN/Assets/js/jquery-file-upload/js/vendor/load-image.min.js"></script>
<script src="/DATN/Assets/js/jquery-file-upload/js/vendor/canvas-to-blob.min.js"></script>
<script src="/DATN/Assets/js/jquery-file-upload/js/jquery.iframe-transport.js"></script>
<script src="/DATN/Assets/js/jquery-file-upload/js/jquery.fileupload.js"></script>
<script src="/DATN/Assets/js/jquery-file-upload/js/jquery.fileupload-process.js"></script>
<script src="/DATN/Assets/js/jquery-file-upload/js/jquery.fileupload-image.js"></script>
<script src="/DATN/Assets/js/jquery-file-upload/js/jquery.fileupload-audio.js"></script>
<script src="/DATN/Assets/js/jquery-file-upload/js/jquery.fileupload-video.js"></script>
<script src="/DATN/Assets/js/jquery-file-upload/js/jquery.fileupload-validate.js"></script>
<script src="/DATN/Assets/js/jquery-file-upload/js/jquery.fileupload-ui.js"></script>
<script type="text/javascript" src="/DATN/Assets/js/jquery-file-upload/js/main.js"></script>
<script>
    $(document).ready(function () {
        FormFileUpload.init("<?php echo $changeName; ?>", "<?php echo $type; ?>", null, null, "<?php echo $url; ?>", "<?php echo $auto; ?>", "<?php echo $name; ?>", "<?php echo $multiple; ?>", "<?php echo $value; ?>", "<?php echo $setname; ?>", "<?php echo $valueName; ?>", "<?php echo $setSize; ?>", "<?php echo $valueSize; ?>", "<?php echo $fileType; ?>", "<?php echo $imageHoSo; ?>", "<?php echo $folder; ?>","<?php echo $edit; ?>");
    });
</script>

<div class="row fileupload-buttonbar">
    <?php if(empty($edit)) { ?> 
        <div class="col-lg-7">
            <!-- The fileinput-button span is used to style the file input field as button -->
            <span class="btn btn-success fileinput-button" id="btThem">
                <i class="fa fa-plus"></i>
                <span> Lựa chọn </span>
                <input type="hidden" id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $value ?? ''; ?>">
                <!-- <input type="hidden" id="name_<?php echo $name; ?>" name="name_<?php echo $name; ?>" value=""> -->
                <input type="hidden" id="<?php echo $setname; ?>" data-id="<?php echo $setname; ?>" name="<?php echo $setname; ?>" value="<?php echo $valueName ?? ''; ?>" />
                <input type="hidden" id="<?php echo $setSize; ?>" data-id="<?php echo $setSize; ?>" name="<?php echo $setSize; ?>" value="<?php echo $valueSize ?? ''; ?>" />
                <input type="file" data-id="<?php echo $name; ?>" class="files_<?php echo $name; ?>" <?php echo $multiple ? 'multiple' : ''; ?> />
            </span>
        </div>
    <?php } ?>
    <!-- The global progress state -->
    <div class="col-lg-5 fileupload-progress fade">
        <!-- The global progress bar -->
        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
        </div>
        <!-- The extended global progress state -->
        <div class="progress-extended">&nbsp;</div>
    </div>
</div>

<div class="result-div result-div-<?php echo $name; ?>"></div>

<table role="presentation" class="table table-striped table-uploadvx clearfix">
    <tbody class="result-table-<?php echo $name; ?>" id="table-edit-<?php echo $name; ?>">
        <?php if (!empty($value)) { // co valude -> edit
            $arrFiles = explode(',', $value);
            if ($type == "image") {
                for ($i = 0; $i < count($arrFiles); $i++) {
                    $linkImgEdit = $arrFiles[$i];
                    $nameImgEdit = substr($linkImgEdit, strrpos($linkImgEdit, "/") + 1);
                    ?>
                    <tr class="image-download-image fade show imgPreviewJu">
                        <td colspan="3" class="tdimg">
                            <span class="preview">
                                <a href="<?php echo $linkImgEdit; ?>" title="<?php echo $nameImgEdit; ?>" download="<?php echo $nameImgEdit; ?>" data-gallery>
                                    <img src="<?php echo $linkImgEdit; ?>" width="200" data-id="linkFileImage_<?php echo $name; ?>">
                                </a>
                            </span>
                            <?php if (empty($edit)) { ?>
                                <div class="buttonItem">
                                    <a class="" onclick="editImage($(this), 'linkFileImage_<?php echo $name; ?>','<?php echo $linkImgEdit; ?>');">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                    <a class="removeImgVz" data-url="/JqueryUpload/DeleteFile?url=<?php echo $linkImgEdit; ?>" onclick="removeFileVz($(this))">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a>
                                </div>
                            <?php } ?>
                            <input type="hidden" name="linkFileImage_<?php echo $name; ?>" value="<?php echo $linkImgEdit; ?>" />
                        </td>
                    </tr>
                <?php }
            } else {
                $arrFileName = $valueName != null ? explode('|', $valueName) : null;
                $arrFileSize = $valueSize != null ? explode('|', $valueSize) : null;
                $strFiles = "";
                $nameFile = "";
                $nameshow = "";
                $attchmentName = "";
                $attchmentSize = "";
                for ($i = 0; $i < count($arrFiles); $i++) {
                    $nameFile = "";
                    $nameshow = "";
                    $attchmentName = "";
                    $attchmentSize = "";
                    if ($arrFiles[$i] != "") {
                        $linkFile = $arrFiles[$i];
                        $nameFile = substr($linkFile, strrpos($linkFile, "/") + 1);
                        if ($arrFileName != null && count($arrFileName) > $i) {
                            $attchmentName = $arrFileName[$i];
                        }
                        if ($arrFileSize != null && count($arrFileSize) > $i) {
                            $attchmentSize = $arrFileSize[$i];
                        }
                        if (strlen($nameFile) > 15) {
                            $nameshow = substr($nameFile, 15);
                        } else {
                            $nameshow = $nameFile;
                        }
                        ?>
                        <tr class="template-download">
                            <td>
                                <p class="name">
                                    <a href="<?php echo $linkFile; ?>" title="<?php echo $nameFile; ?>" download="<?php echo $nameFile; ?>"><?php echo $nameshow; ?></a>
                                    <input type="hidden" name="linkFile_<?php echo $name; ?>" value="<?php echo $linkFile; ?>" /><span style="margin-left:5px;color:#337ab7">|</span>
                                    <a href="/Home/ViewFile?linkdown=<?php echo $linkFile; ?>" target="_blank" style="margin-left: 5px; color: #337ab7"><i class="fa fa-search"></i> Xem </a>
                                    <input type="hidden" name="nameFile_<?php echo $name; ?>" value="<?php echo $nameshow; ?>" />
                                </p>
                            </td>
                            <?php if ($changeName == true) { ?>
                                <td width="300">
                                    <input class="form-control valid" type="text" id="replaceName" name="replaceName_<?php echo $name; ?>" value="<?php echo $attchmentName; ?>" />
                                </td>
                            <?php } ?>
                            <td width="80">
                                <p class="size" id="size" name="size"><?php echo $attchmentSize; ?></p>
                                <input type="hidden" name="sizeFile_<?php echo $name; ?>" value="<?php echo $attchmentSize; ?>" />
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                </div>
                            </td>
                            <?php if($edit == null) { ?> 
                                <td width="80">
                                    <!-- H -->
                                    <button class="btn btn-danger delete" id="deleteFile" data-type="GET" data-url="/JqueryUpload/DeleteFile?url=<?php echo $linkFile; ?>" data-delete="/Content/Upload/<?php echo $nameFile; ?>">Xóa</button>
                                </td>
                            <?php } ?>  
                        </tr>
                    <?php }
                }
            }
        } ?>
    </tbody>
</table>

<script id="document-upload-<?php echo $name; ?>" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger label label-danger"></strong>
            <input type="hidden" name="linkFile_<?php echo $name; ?>" value="" />
            <input type="hidden" name="nameFile_<?php echo $name; ?>" value="{%=file.name%}" />
        </td>
        <?php if ($setname != null && $changeName == true) { ?>
            <td width="300"><input class="form-control valid" style="width:100%" type="text" id="replaceName" name="replaceName_<?php echo $name; ?>" value="" /></td>
        <?php } ?>
        <td>
            <p class="size">Đang tải...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                <div class="progress-bar progress-bar-success" style="width:0%;"></div>
            </div>
            <input type="hidden" name="sizeFile" value="" />
        </td>
        <td width="160">
            {% if (!i && !o.options.autoUpload) { %}
            <button class="btn btn-primary start" disabled>
                <i class="glyphicon glyphicon-upload"></i>
                <span>Tải lên</span>
            </button> {% } %} {% if (!i) { %}
            <button class="btn btn-warning cancel">
                <i class="glyphicon glyphicon-cancel"></i>
                <span>Hủy</span>
            </button> {% } %}
        </td>
    </tr> {% } %}
</script>
<!-- The template to display files available for download -->
<script id="document-download-<?php echo $name; ?>" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <p class="name">
                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>
                    {%=file.name%}
                </a>
                <span style="margin-left:5px;color:#337ab7">|</span>
                <a href="/Home/ViewFile?linkdown={%=file.url%}" target="_blank" style="color:#337ab7">
                    <i style="padding-left:5px;" class="fa fa-search"></i> Xem
                </a>
                <input type="hidden" name="linkFile_<?php echo $name; ?>" value="{%=file.url%}" />
                <input type="hidden" name="nameFile_<?php echo $name; ?>" value="{%=file.name%}" />
            </p>
            {% if (file.error) { %}
            <div><span class="error">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <?php if ($changeName == true) { ?>
            <td width="300">
                <input class="form-control valid" style="width:100%" type="text" id="replaceName" name="replaceName_<?php echo $name; ?>" value="{%=file.nameFile%}" />
            </td>
        <?php } ?>

        <td width="80">
            <span class="size" id="AttchmentSize">{%=o.formatFileSize(file.size)%}</span>
            <input type="hidden" name="sizeFile_<?php echo $name; ?>" value="{%=o.formatFileSize(file.size)%}" />
        </td>
        <td width="80">
            <button class="btn btn-danger delete" id = "deleteFile" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}" data-delete="{%=file.url%}" {% if (file.deletewithcredentials) { %} data-xhr-fields='{"withCredentials":true}' {% } %}>Xóa</button>

        </td>
    </tr>
    {% } %}
</script>

<script id="template-upload-<?php echo $name; ?>" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade in">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td width="80">
            <p class="size">{%=o.formatFileSize(file.size)%}</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td width="160">
            {% if (!i && !o.options.autoUpload) { %}
            <button class="btn btn-primary start" disabled>
                <i class="glyphicon glyphicon-upload"></i>
                <span>Tải lên</span>
            </button> {% } %} {% if (!i) { %}
            <button class="btn btn-warning cancel">
                <i class="glyphicon glyphicon-cancel"></i>
                <span>Hủy</span>
            </button> {% } %}
        </td>
    </tr>
    {% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download-<?php echo $name; ?>" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td width="160">
            <p class="name">
                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
            </p>
            {% if (file.error) { %}
            <div><span class="error">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td width="80">
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td width="80">
            <button class="delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}" {% if (file.deletewithcredentials) { %} data-xhr-fields='{"withCredentials":true}' {% } %}>Xóa</button>
        </td>
    </tr>
    {% } %}
</script>


<script id="image-upload-<?php echo $name; ?>" type="text/x-tmpl">

    {% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger label label-danger"></strong>
            <input type="hidden" name="linkFile_<?php echo $name; ?>" value="" />
            <input type="hidden" name="nameFile_<?php echo $name; ?>" value="{%=file.name%}" />
        </td>
        <td>
            <p class="size">Đang tải...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                <div class="progress-bar progress-bar-success" style="width:0%;"></div>
            </div>
            <input type="hidden" name="sizeFile_<?php echo $name; ?>" value="" />
        </td>
        <td width="160">
            {% if (!i && !o.options.autoUpload) { %}
            <button class="btn btn-primary start" disabled>
                <i class="glyphicon glyphicon-upload"></i>
                <span>Tải lên</span>
            </button> {% } %} {% if (!i) { %}
            <button class="btn btn-warning cancel">
                <i class="glyphicon glyphicon-cancel"></i>
                <span>Hủy</span>
            </button> {% } %}
        </td>
    </tr> {% } %}
</script>
<script id="image-download-<?php echo $name; ?>" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download-image fade show imgPreviewJu">
        <td colspan="3" class="tdimg">
            <span class="preview">
                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.url%}" width="200"></a>
            </span>
            <a class="removeImgVz" data-url="/JqueryUpload/DeleteFile?url={%=file.url%}" onclick="removeFileVz($(this))"><i class="fa fa-close" style="font-size: 25px;"></i></a>
            <input type="hidden" name="linkFileImage_<?php echo $name; ?>" value="{%=file.url%}" />
        </td>
    </tr>
    {% } %}
</script>
<style>
    .removeImgVz:hover {cursor: pointer;}
    .table-uploadvx {
        margin-top: 10px;
        font-size: 14px;
    }
    .table-uploadvx > tbody > tr > td{ border-left: none; border-top: 1px solid #ddd !important; border-right: none; border-bottom: none; vertical-align: middle; }
    .table-uploadvx .name{ margin-bottom: 0; }
    .table-uploadvx .progress{ height: 20px !important; margin-bottom: 20px !important; border-radius: 4px !important; -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1) !important; box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1) !important; }
    .table-uploadvx .error{ color: #fff; }
    .table-uploadvx .btndel{ border: none; background: none; }
    .table-uploadvx .tdimg{ background: none; padding: 0 !important; background-color: #fff !important; }
    .table-uploadvx .fade.in{ opacity: 1 !important; }
    #table-edit .template-download{ background-color: #fff; }
    .imgPreviewJu{ width: auto; float: left; margin-right: 25px; margin-bottom: 20px; background: none !important; }
    .imgPreviewJu .buttonItem { position: relative; display: flex; border-radius: 0 0 5px 5px; overflow: hidden}
    .imgPreviewJu .buttonItem >* { flex: 1; text-align: center; font-size: 15px; padding: 3px 10px; background: #3eacff; cursor: pointer; }
    .imgPreviewJu .buttonItem >* > * { color: #fff;}
    .imgPreviewJu .buttonItem >*:hover {background:#347fb8 }
    .imgPreviewJu{ position: relative; display: table; }
    .fileupload-buttonbar .progress-striped{ margin-bottom: 0; }
    .IsViewFile .fileupload-buttonbar,
    .IsViewFile .delete{ display: none; }
</style>