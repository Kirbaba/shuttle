<form action="" method="post" enctype="multipart/form-data" name="front_end_upload" >
    <p>Выберите дату <input type="date" name="date" id="date" value="{date}"/></p>
    {images}
    <label> Добавьте все файлы здесь:
        <input type="file" name="kv_multiple_attachments[]" multiple="multiple" >
    </label>
    <input type="submit" name="uploadimg" value="Загрузить" >


</form>