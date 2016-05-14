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
                <?php echo form_open_multipart(admin_url('spain/edit'));?>
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
                     <div class="input-group">
                        <?php echo form_input(array('name' => 'image_link','id' => 'image_link', 'readonly' => 'readonly', 'class'=>'form-control'), set_value('image_link', $info->image_link));?>
                        <span class="input-group-btn">
                        <button class="btn btn-default" id="idchonanh" type="button" onclick="BrowseServer();">Chọn Ảnh</button>
                      </span>
                      <div><?php echo form_error('image_link'); ?></div>
                    </div>
                    <div class="form-group">
                    <label>Parent <b class="required">*</b></label>
                    <?php echo form_dropdown('parent_id', $options, set_value('parent_id', $info->parent_id), array('class' => 'form-control', 'width' => '30%')); ?>
                    <div><?php echo form_error('image_link'); ?></div>
                    </div>
                    <div class="form-group">
                    <label>Tags for content <b class="required">*</b></label>
                    <?php echo form_dropdown('tags[]', $tags, set_value('tags[]', $info->tags), array('class' => 'form-control select2', 'multiple' => 'multiple', 'data-placeholder' => 'Select a tag', 'style' => 'width: 100%')); ?>
                      <div><?php echo form_error('tags[]'); ?></div>
                  </div><!-- /.form-group -->
                <label for="TextAreaHtml">Content <b class="required">*</b></label>
                    <textarea id="TextAreaHtml" name="content" rows="20" cols="180" data-placeholder="This is my textarea to be replaced with CKEditor."><?php echo $info->content ?></textarea>
                     <div><?php echo form_error('content'); ?></div>
                    <div class="form-group">
                      <label for="image_list">Images list</label>
                       <?php echo form_upload( array('name' => 'image_list[]', 'multiple' => 'multiple', 'size' => '20'), set_value('image_list[]', $info->image_list)); ?>
                      <p class="help-block">Chọn list danh sách ảnh.</p>
                      <div><?php echo form_error('image_list'); ?></div>
                    </div>
                    <div class="form-group">
                      <input type="text" name="" id="idanh" class="form-control" style="width: 40%">
                      <button type="button" id="idchonanh" class="btn btn-default">Chọn Ảnh</button>
                    </div>
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
<!-- <script src="http://localhost:8888/LeThai/DoAn/fckeditor/ckeditor/ckeditor.js"></script> -->
<script src="<?php echo base_url('public') ?>/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"></script>
<!-- <script src="<?php echo base_url('public') ?>/plugins/ckeditor/samples/sample.js"></script> -->
<script>
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
        $("#idchonanh").click(function () {
            var finder = new CKFinder();
            finder.selectActionFunction = function (fileUrl) {
                $("#image_link").val(fileUrl);
            };
            finder.popup();
        });

      });
      /*$(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('content');
      });*/

</script>
<script type="text/javascript">
    var editor;
    function createEditor(languageCode, id) {
        var editor = CKEDITOR.replace(id, {
            language: languageCode,
            toolbar : 'Basic',  /*this does the magic */
            uiColor : '#9AB8F3'
        });
    }

    $(function () {
        createEditor('vi', 'TextAreaHtml');
    });
</script>

