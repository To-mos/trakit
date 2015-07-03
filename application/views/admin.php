<!DOCTYPE html> 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?= $title; ?></title>
<body>
    <form method="GET" action="admin/upload-image" enctype="multipart/form-data">
        <input type="file" name="userfile" multiple="multiple"  />
        <label>Select Mode:</label>
        <input type="radio" name="mode" value="crop" checked="checked" />   Crop
        <input type="radio" name="mode" value="resize" />   Resize
        <input type="radio" name="mode" value="rotate" />   Rotate
        <input type="radio" name="mode" value="watermark" />   Water Mark
        <br /><br />
        <input type="Submit" value="Upload" />
    </form>
</body>
</html>