<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Data Tables
            <small>advanced tables</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title col-md-4">Danh sách menu</h3>
                  <div class="col-md-4">
                    <form action="<?php echo admin_url('football/index'); ?>" id="search_football_menu" method="post">
                      <div class="input-group">
                        <input type="text" name="" class="form-control" value="" title="Tìm kiếm">
                         <span class="input-group-btn">
                             <button name="search" class="btn btn-default" value="search_bad_number" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                          </span>
                      </div>
                    </form>
                </div>
                  <button type="button" class="btn btn-success pull-right" onclick="window.location.href='<?php echo admin_url("football_menu/add")?>'">Thêm mới</button>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th></th>
                        <th>NO.</th>
                        <th>Name</th>
                        <th>Parent ID</th>
                        <th>Sort Order</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $no = 0 ?>
                    <?php foreach ($list as $row): ?>
                    <?php $no = $no + 1 ?>
                      <tr>
                        <td style="margin-left: -20px"><input type="checkbox" value="<?php echo $row->id ?>"></td>
                        <td><?php echo $no ?></td>
                        <td><?php echo $row->name ?></td>
                        <td><?php echo $row->parent_id ?></td>
                        <td><?php echo $row->sort_order ?></td>
                        <td>
                          <button type="button" class="btn btn-primary" onclick="window.location.href='<?php echo admin_url("football_menu/views/$row->id")?>'">Views</button>
                          <button type="button" class="btn btn-warning">Edit</button>
                          <button type="button" class="btn btn-danger">Delete</button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
         <!-- DataTables -->