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
                <?php echo form_open_multipart(admin_url('spain/add'));?>
                  <div class="box-body">
                    <div class="form-group">
                      <label for="name">Title <b class="required">*</b></label>
                      <?php echo form_input($html_input_title, set_value('name')); ?>
                      <div><?php echo form_error('name'); ?></div>
                    </div>
                    <div class="form-group">
                      <label for="intro">Intro<b class="required">*</b></label>
                      <?php echo form_textarea($html_input_intro, set_value('intro')); ?>
                      <div><?php echo form_error('intro'); ?></div>
                    </div>
                    <div class="form-group">
                      <label for="meta_key">Meta keywords</label>
                     <?php echo form_input($html_input_keyword, set_value('meta_key'))?>
                      <div><?php echo form_error('meta_key'); ?></div>
                    </div>
                    <div class="form-group">
                      <label for="meta_desc">Meta description</label>
                     <?php echo form_textarea($html_input_desc, set_value('meta_desc')); ?>
                      <div><?php echo form_error('meta_desc'); ?></div>
                    </div>
                     <div class="input-group">
                        <?php echo form_input(array('name' => 'image_link','id' => 'image_link', 'readonly' => 'readonly', 'class'=>'form-control'), set_value('image_link'));?>
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button" onclick="BrowseServer();">Chọn Ảnh</button>
                      </span>
                    </div>
                    <div class="form-group">
                    <label>Parent <b class="required">*</b></label>
                    <?php echo form_dropdown('parent_id', $options, set_value('parent_id'), array('class' => 'form-control', 'width' => '30%')); ?>
                    <div><?php echo form_error('image_link'); ?></div>
                    </div>
                    <div class="form-group">
                    <label>Tags for content <b class="required">*</b></label>
                    <?php echo form_dropdown('tags[]', $tags, set_value('tags[]'), array('class' => 'form-control select2', 'multiple' => 'multiple', 'data-placeholder' => 'Select a tag', 'style' => 'width: 100%')); ?>
                      <div><?php echo form_error('tags[]'); ?></div>
                  </div><!-- /.form-group -->
                <label for="content">Content <b class="required">*</b></label>
                    <textarea id="content" name="content" rows="20" cols="180" data-placeholder="This is my textarea to be replaced with CKEditor."></textarea>
                     <div><?php echo form_error('content'); ?></div>
                   <!--  <div class="form-group">
                     <label for="image_list">Imags list</label>
                      <?php echo form_upload( array('name' => 'image_list[]', 'multiple' => 'multiple', 'size' => '20'), set_value('image_list[]')); ?>
                     <p class="help-block">Chọn list danh sách ảnh.</p>
                     <div><?php echo form_error('image_list'); ?></div>
                   </div> -->
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-warning" onclick="window.location.href='<?php echo admin_url("football_menu")?>'">Cancel</button>
                  </div>
                <?php echo form_close(); ?>
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
<!-- <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script> -->
<script src="<?php echo base_url('public') ?>/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url('public') ?>/ckfinder/ckfinder.js"></script>
<script src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"></script>
<script>
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
      });
    var editor;
    function createEditor(languageCode, id) {
        var editor = CKEDITOR.replace(id, {
            language: languageCode
        });
    }

    $(function () {
        createEditor('vi', 'content');
    });

</script>
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
