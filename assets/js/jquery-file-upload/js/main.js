var FormFileUpload = function () {
    return {

        //main function to initiate the module
        init: function (changeName, type, result, input, url, auto, name, multiple, value, setname, valueName, setSize, valueSize, fileType, imageHoSo, folder) {
            // setname = "false"; 
            var maxNumberOfFiles = 1;
            if (multiple == "True") { maxNumberOfFiles = 100; }
            //var form = $("#" + name).closest('form');
            var form = $("#fileupload_" + name);
            if (!form)
                form = ".fileupload";
            if (!input) {
                input = "input.files_" + name;
            }
            if (!url) {
                url = "/JqueryUpload/UploadFiles?folder=" + folder;
            }
            auto = auto == "True" ? true : false;   // de upload anh luon khi chon
            if (!result) {
                result = ".result-table-" + name;
            }
            var temp = "template";
            switch (type) {
                case "pdf":
                    fileType = /(\.|\/)(pdf)$/i;
                    temp = "document";
                    break;
                case "image":
                    fileType = /(\.|\/)(gif|jpe?g|png)$/i;
                    temp = "image";
                    break;
                case "video":
                    fileType = /(\.|\/)(m1v|m2v|avi|gl|mjpg|moov|mov|movie|mp2|mpa|mpe|mpeg|mpg|mv)$/i;
                    temp = "video";
                    break;
                case "audio":
                    fileType = /(\.|\/)(au|m2a|m3u|mid|midi|mod|mp3|voc|wav)$/i;
                    temp = "audio";
                    break;
                default:
                    if (fileType == null || fileType == "") {
                        fileType =
                            /(\.|\/)(mp4|m1v|m2v|avi|gl|mjpg|moov|mov|movie|mp2|mpa|mpe|mpeg|mpg|mv|gif|jpe?g|png|au|m2a|m3u|mid|midi|mod|mp3|voc|wav|xl|xla|xls|xlsx|doc|docx|ppt|pptx|txt|pdf|rar|zip)$/i;
                    } else {
                        if (fileType == "video") {
                            fileType = /(\.|\/)(m1v|m2v|avi|gl|mjpg|moov|mov|movie|mp4|mp2|mpa|mpe|mpeg|mpg|mv)$/i;
                        }
                    }
                    temp = "document";
                    break;
                //default:
                //    fileType = /(\.|\/)(m1v|m2v|avi|gl|mjpg|moov|mov|movie|mp2|mpa|mpe|mpeg|mpg|mv|gif|jpe?g|png|au|m2a|m3u|mid|midi|mod|mp3|voc|wav|xl|xla|xls|xlsx|doc|docx|ppt|pptx|txt|pdf)$/i;
                //    temp = "template";
                //    break;
            }



            $(form).fileupload({
                disableImageResize: false,
                fileInput: $(input),
                autoUpload: auto,
                maxNumberOfFiles: maxNumberOfFiles,
                url: url,
                filesContainer: result,
                uploadTemplateId: temp + "-upload-" + name,
                downloadTemplateId: temp + "-download-" + name,
                disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
                acceptFileTypes: fileType,
                maxFileSize: 1500000000,
                send: function (e, data) {
                    var replaceName = data.context.find('input[name="replaceName"]').val();
                    data.files[0].nameFile = replaceName;
                },
                finished: function (e, data) {
                    var nameFile = data.files[0].nameFile;
                    data.context.find('input[name="replaceName"]').val(nameFile);
                    if (data != null) {
                        var idInput = $(input).attr("data-id");
                        var listFile = $("#" + idInput).val();
                        var lstSetName = $("#AttachmentName").val();
                        var lstFileSize = $("#AttachmentSize").val();
                        $.each(data.result.files, function (index, file) {
                            if (listFile != "") {
                                listFile += ",";
                                lstSetName += "|";
                                lstFileSize += "|";
                            }
                            listFile += file.url;
                            lstSetName += file.replaceName;
                            lstFileSize += file.size;
                        });
                        $("#" + idInput).val(listFile);
                        $("#AttachmentName").val(lstSetName);
                        $("#AttachmentSize").val(lstFileSize);
                        // an validate
                        $(".help-block-vb").hide();
                        $("#nutchucnang").prop("disabled", false);
                        if (imageHoSo) {

                            if ($('#table-edit-Photo tr').length > 1) {
                                $('#table-edit-Photo tr:first-child .removeImgVz').click();
                                $('#table-edit-Photo tr:first-child').remove();
                            }
                            console.log('loi')
                        }
                        ///
                        if ($('.showHandle').length > 0) {
                            var lstFileHandle = '';
                            $('.showHandle #table-edit-Vz tr').each(function () {
                                lstFileHandle += '<div class="clsHandle">' + '' + $(this).find('td .name ').html() + '</div>';
                            });
                            $(".handleFile").html(lstFileHandle);
                        }
                    }
                },
                destroyed: function (e, data) {
                    var idInput = $(input).attr("data-id");//Attchment

                    var idInputDelete = $(input).attr("data-delete");
                    var listFile = $("#" + idInput).val();
                    var listFileDelete = $("#" + idInputDelete).val();
                    var dataDelete = $(data.context.context).attr("data-delete");
                    if (listFileDelete != "") {
                        listFileDelete += ","
                    }

                    listFileDelete += dataDelete;
                    $("#" + idInputDelete).val(listFileDelete);
                    var listFileNew = "";
                    var listNameFileNew = "";
                    var listSizeNew = "";

                    var arr = listFile.split(',');
                    $.each(arr, function (index, file) {
                        if (file != dataDelete) {
                            if (listFileNew != "") {
                                listFileNew += ","
                            }
                            listFileNew += file;
                        }
                    });
                    $("#" + idInput).val(listFileNew);
                }
            });
        }
    };

}();
function removeFileVz(elem) {
    elem.parents('tr').remove();
    var data_url = elem.attr("data-url");
    $.ajax({
        url: data_url,
        type: "GET",
        success: function (data) {
            elem.parent().remove();
        }
    });
}