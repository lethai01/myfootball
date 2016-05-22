<?php  
  $html_input = array('class' => 'form-control',
                      'title' => 'Nhập giá trị',
                      'placeholder' => 'Nhập giá trị');
  $html_input_title = array_replace($html_input, array('name' => 'name'));
  $html_input_intro = array_replace($html_input, array('name' => 'intro', 'id' => 'intro', 'rows' => '3'));
  $html_input_keyword = array_replace($html_input, array('name' => 'meta_key'));
  $html_input_desc = array_replace($html_input, array('name' => 'meta_desc', 'rows' => '2'));
?>

<section class="content-header">
  <h1>Chỉnh sửa bài viết :<small style="color:red"><strong>Các trường (*) là bắt buộc</strong></small></h1>
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
                  <h3 class="box-title">Sửa bài viết</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open_multipart(admin_url("spain/edit/$info->id"));?>
                  <div class="box-body">
                    <div class="form-group">
                      <label for="name">Title <b class="required">*</b></label>
                      <?php echo form_input($html_input_title, set_value('name', $info->title)); ?>
                      <div><?php echo form_error('name'); ?></div>
                    </div>
                    <div class="form-group">
                      <label for="intro">Intro<b class="required">*</b></label>
                      <?php echo form_textarea($html_input_intro, set_value('intro', $info->intro)); ?>
                      <div><?php echo form_error('intro'); ?></div>
                    </div>
                    <div class="form-group">
                      <label for="meta_key">Meta keywords</label>
                     <?php echo form_input($html_input_keyword, set_value('meta_key', $info->meta_key))?>
                      <div><?php echo form_error('meta_key'); ?></div>
                    </div>
                    <div class="form-group">
                      <label for="meta_desc">Meta description</label>
                     <?php echo form_textarea($html_input_desc, set_value('meta_desc', $info->meta_desc)); ?>
                      <div><?php echo form_error('meta_desc'); ?></div>
                    </div>
                    <div class="form-group">
                    <label for="image_link">Ảnh nền <b class="required">*</b></label>
                       <div class="input-group">
                          <?php echo form_input(array('name' => 'image_link','id' => 'image_link', 'readonly' => 'readonly', 'class'=>'form-control'), set_value('image_link', $info->image_link));?>
                          <span class="input-group-btn">
                          <button class="btn btn-default" type="button" onclick="BrowseServer();">Chọn Ảnh</button>
                        </span>
                      </div>
                      <div><?php echo form_error('image_link'); ?></div>
                    </div>
                    <div class="form-group">
                    <label>Parent <b class="required">*</b></label>
                    <?php echo form_dropdown('parent_id', $options, set_value('parent_id', $info->parent_id), array('class' => 'form-control', 'width' => '30%')); ?>
                    <div><?php echo form_error('image_link'); ?></div>
                    </div>
                    <div class="form-group">
                    <label>Tags for content <b class="required">*</b></label>
                    <?php $tags = explode(',', $info->tags);?>
                    <?php echo form_dropdown('tags[]', $list_tags, set_value('tags[]', $tags), array('class' => 'form-control select2', 'multiple' => 'multiple', 'data-placeholder' => 'Select a tag', 'style' => 'width: 100%')); ?>
                      <div><?php echo form_error('tags[]'); ?></div>
                  </div><!-- /.form-group -->
                    <label for="TextAreaHtml">Content <b class="required">*</b></label>
                    <textarea id="TextAreaHtml" name="content" rows="20" cols="180" data-placeholder="This is my textarea to be replaced with CKEditor."><?php echo $info->content ?></textarea>
                     <div><?php echo form_error('content'); ?></div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Edit</button>
                    <button type="button" class="btn btn-warning" onclick="window.location.href='<?php echo admin_url("spain/index")?>'">Cancel</button>
                  </div>
                <?php echo form_close(); ?>
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
<script src="<?php echo base_url('public') ?>/fckeditor/ckfinder/ckfinder.js"></script>

<!-- ckfinter -->
<script type="text/javascript">
        function BrowseServer() {
            var finder = new CKFinder();
            //finder.basePath = '../';
            finder.selectActionFunction = SetFileField;
            finder.popup();
        }
        function SetFileField(fileUrl) {
            document.getElementById('image_link').value = fileUrl;
        }
    </script>
<script src="<?php echo base_url('public') ?>/fckeditor/ckeditor/ckeditor.js"></script>
<!-- ckeditor -->
<script type="text/javascript">
   CKEDITOR.replace( 'content',
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
<script src="<?php echo base_url('public') ?>/plugins/select2/select2.full.min.js"></script>
<script>
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
      });

</script>


