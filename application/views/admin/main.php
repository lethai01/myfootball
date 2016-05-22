<!DOCTYPE html>
<html>
  <head>
	<?php $this->load->view('admin/head'); ?>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
  	 <div class="wrapper">
  	 	<header class="main-header">
			<?php $this->load->view('admin/header'); ?>
  	 	</header>
  	 	<aside class="main-sidebar">
			<?php $this->load->view('admin/left'); ?>
  	 	</aside>
  	 	 <div class="content-wrapper">
			<?php $this->load->view($temp, $this->data); ?>
  	 	 </div>
		<footer class="main-footer" style="background-color:#b3c2bf">
			<?php $this->load->view('admin/footer'); ?>
		</footer>
  	 </div><!-- ./wrapper -->
  </body>
</html>