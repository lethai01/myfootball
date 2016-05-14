<html>
<head>
<title>Upload Form</title>
</head>
<body>
<!-- <input type="text" id='selectnumber' name="selectnumber" onchange=""> -->
<?php echo form_open_multipart('admin/test/do_image_upload');?>
   <input type="file" name="profile_pic"/>
   <br />
   <input type="submit" value="upload" name="submit_form"/>
<?php echo form_close(); ?>
</body>
</html>