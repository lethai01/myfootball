<html>
<head>
<title>Upload Form</title>
</head>
<body>
<!-- <input type="text" id='selectnumber' name="selectnumber" onchange=""> -->
<?php echo form_open_multipart('admin/test/do_image_upload');?>
   <input type="file" name="profile_pic[]" size="20" multiple/>
   <br />
   <input type="submit" value="upload" name="submit_form"/>
<?php echo form_close(); ?>
<!-- <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript">
	function select_number(val)
	{
	   $.ajax({
	     type: 'post',
	     url: '<?php echo admin_url('uploadimage/selectnumber'); ?>',
	     data: {
	       selectnumber:val
	     },
	     success: function (response) {
	       document.getElementById("profile_pic").innerHTML=response;
	     }
	   });
}
	</script> -->
</body>
</html>