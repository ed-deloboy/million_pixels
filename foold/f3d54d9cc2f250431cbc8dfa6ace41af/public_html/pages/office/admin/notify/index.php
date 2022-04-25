<form class="w-100" action="/botSend/admin" method="POST" enctype="multipart/form-data">
<div class="row">   
<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
    <div class="custom-file-container p-3 mt-0" data-upload-id="myFirstImage">
        <label> <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
        <label class="custom-file-container__custom-file" >
            <input type="file" name="img" class="custom-file-container__custom-file__custom-file-input" accept="image/*">
            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
            <span class="custom-file-container__custom-file__custom-file-control"></span>
        </label>
        <div class="custom-file-container__image-preview"></div>
    </div>
</div>
<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 pt-5 layout-spacing">
    <textarea class="form-control" name="text" placeholder="Текст сообщения" style="height:350px;"></textarea>
</div>
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center layout-spacing">
    <button class="btn btn-success" type="submit">Отправить</button>
</div>
</div> 
</form>
<script>
    var firstUpload = new FileUploadWithPreview('myFirstImage');
</script>
<script>
        $("#local-load").addClass('d-none');
        $("#local-block").removeClass('d-none');
</script>