<?php
 	$info = $this->football_footer_model->getFooter(TypeConfig::ADMIN);
?>
<div style="min-height:50px">
	<div class="row">		
		<div class="text-center" style="margin-bottom:30px; ">
			<strong><?php echo $info->intro ?></strong>
		</div>
		<div class="col-md-6">
			<?php echo $info->content_left ?>
		</div>
		<div class="col-md-6">
			<?php echo $info->content_right ?>
			<div class="pull-right hidden-xs">
		    	<?php echo $info->version ?>
			</div>
		</div>
	</div>
</div>

  