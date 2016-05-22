<section class="content-header">
  <h1>General Form Elements<small>Preview</small></h1>
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
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Quick Example</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="<?php echo admin_url("football_menu/edit/$info->id"); ?>" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="name">Name Menu</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="<?php echo set_value('name', $info->name) ?>">
                      <div><?php echo form_error('name'); ?></div>
                    </div>
                    <div class="form-group">
                      <label for="site_title">Site title</label>
                      <input type="text" class="form-control" name = "site_title" id="site_title" placeholder="Enter Title" value="<?php echo set_value('site_title', $info->site_title) ?>">
                      <div><?php echo form_error('site_title'); ?></div>
                    </div>
                    <label>Parent</label>
                     <div class="form-group">
                      <?php echo form_dropdown(array('name' => 'parent_id', 'class' => 'form-control', 'style' => 'width:25%'), $listParent, set_value('parent_id', $info->parent_id)); ?>
                      <div><?php echo form_error('parent_id'); ?></div>
                    </div>
                    <label>Sort Order</label>
                     <div class="form-group">
                       <?php echo form_dropdown(array('name' => 'sort', 'class' => 'form-control', 'style' => 'width:25%'), $listSort, set_value('sort', $info->sort_order)); ?>
                       <div><?php echo form_error('sort'); ?></div>
                     </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Sửa</button>
                    <button type="button" class="btn btn-warning" onclick="window.location.href='<?php echo admin_url("football_menu")?>'">Cancel</button>
                  </div>
                </form>
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
