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
                <form role="form" action="<?php echo admin_url('football_menu/add'); ?>" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="name">Name Menu</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="<?php echo set_value('name') ?>">
                      <div><?php echo form_error('name'); ?></div>
                    </div>
                    <div class="form-group">
                      <label for="site_title">Site title</label>
                      <input type="text" class="form-control" name = "site_title" id="site_title" placeholder="Enter Title" value="<?php echo set_value('site_title') ?>">
                      <div><?php echo form_error('site_title'); ?></div>
                    </div>
                    <div class="form-group">
                      <label for="meta_key">Meta keywords</label>
                      <input type="text" class="form-control" name="meta_key" id="meta_key" placeholder="Enter keyword" value="<?php echo set_value('meta_key') ?>">
                      <div><?php echo form_error('meta_key'); ?></div>
                    </div>
                    <div class="form-group">
                      <label for="meta_desc">Meta description</label>
                      <textarea name="meta_desc" id="meta_desc" class="form-control" rows="3"><?php echo set_value('meta_desc') ?></textarea>
                      <div><?php echo form_error('meta_desc'); ?></div>
                    </div>
                    <label>Parent ID</label>
                      <select name="parent" class="form-control">
                        <option>Input Parent</option>
                        <?php foreach ($list as $parent): ?>
                        <option value="<?php echo $parent->id ?>"><?php echo $parent->name ?></option>
                      <?php endforeach; ?>
                      </select>
                    <label>Sort Order</label>
                      <select name="sort" class="form-control">
                        <option>Input localiton</option>
                        <?php foreach ($sort_order as $sort): ?>
                        <option value="<?php echo $sort ?>">Location <?php echo $sort ?></option>
                        <?php endforeach; ?>
                      </select>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-warning" onclick="window.location.href='<?php echo admin_url("football_menu")?>'">Cancel</button>
                  </div>
                </form>
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
