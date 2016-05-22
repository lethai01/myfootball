<?php  
  $html_input = array('class' => 'form-control',
                      'title' => 'Nhập giá trị',
                      'placeholder' => 'Nhập giá trị');
  $html_input_version = array_replace($html_input, array('name' => 'version'));
  $html_input_intro = array_replace($html_input, array('name' => 'intro', 'id' => 'intro', 'rows' => '3'));
?>

<section class="content-header">
  <h1>Thêm mới bài viết cho Spain :<small style="color:red"><strong>Các trường (*) là bắt buộc</strong></small></h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Forms</a></li>
      <li class="active">General Elements</li>
    </ol>
</section>
 <!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-8 col-md-offset-2">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Thêm mới bài viết</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <?php echo form_open_multipart(admin_url('footer/add'));?>
          <div class="box-body">
            <div class="form-group">
              <label for="name">Version<b class="required">*</b></label>
              <?php echo form_input($html_input_version, set_value('version')); ?>
              <div><?php echo form_error('version'); ?></div>
            </div>
            <div class="form-group">
              <label for="intro">Intro<b class="required">*</b></label>
              <?php echo form_textarea($html_input_intro, set_value('intro')); ?>
              <div><?php echo form_error('intro'); ?></div>
            </div>
            <div class="form-group">
            <label>Display<b class="required">*</b></label>
            <?php echo form_dropdown('type', $options, set_value('type'), array('class' => 'form-control', 'width' => '30%')); ?>
            <div><?php echo form_error('type'); ?></div>
            </div>
            <div class="form-group">
              <label for="content">Content Left<b class="required">*</b></label>
              <textarea id="content_left" name="content_left" rows="20" cols="180" data-placeholder="This is my textarea to be replaced with CKEditor."><?php echo set_value('content_left') ?></textarea>
              <div><?php echo form_error('content_left'); ?></div>
            </div>
            <div class="form-group">
              <label for="content">Content Right<b class="required">*</b></label>
              <textarea id="content_right" name="content_right" rows="20" cols="180" data-placeholder="This is my textarea to be replaced with CKEditor."><?php echo set_value('content_right') ?></textarea>
              <div><?php echo form_error('content_right'); ?></div>
            </div>
          </div><!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Add</button>
            <button type="button" class="btn btn-warning" onclick="window.location.href='<?php echo admin_url("footer/index")?>'">Cancel</button>
          </div>
        <?php echo form_close(); ?>
      </div><!-- /.box -->
    </div><!--/.col (right) -->
  </div>   <!-- /.row -->
</section><!-- /.content -->

<script src="<?php echo base_url('public') ?>/fckeditor/ckeditor/ckeditor.js"></script>
<!-- ckeditor -->
<script type="text/javascript">
   CKEDITOR.replace( 'content_left',
    {
      filebrowserBrowseUrl : '<?php echo base_url() ?>public/fckeditor/ckfinder/ckfinder.html',
      filebrowserImageBrowseUrl : '<?php echo base_url() ?>public/fckeditor/ckfinder/ckfinder.html?type=Images',
      filebrowserFlashBrowseUrl : '<?php echo base_url() ?>public/fckeditor/ckfinder/ckfinder.html?type=Flash',
      filebrowserUploadUrl : 
         '<?php echo base_url() ?>public/fckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&currentFolder=/archive/',
      filebrowserImageUploadUrl : 
         '<?php echo base_url() ?>public/fckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&currentFolder=/cars/',
      filebrowserFlashUploadUrl : '<?php echo base_url() ?>public/fckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });
   CKEDITOR.replace( 'content_right',
    {
      filebrowserBrowseUrl : '<?php echo base_url() ?>public/fckeditor/ckfinder/ckfinder.html',
      filebrowserImageBrowseUrl : '<?php echo base_url() ?>public/fckeditor/ckfinder/ckfinder.html?type=Images',
      filebrowserFlashBrowseUrl : '<?php echo base_url() ?>public/fckeditor/ckfinder/ckfinder.html?type=Flash',
      filebrowserUploadUrl : 
         '<?php echo base_url() ?>public/fckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&currentFolder=/archive/',
      filebrowserImageUploadUrl : 
         '<?php echo base_url() ?>public/fckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&currentFolder=/cars/',
      filebrowserFlashUploadUrl : '<?php echo base_url() ?>public/fckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });
</script>