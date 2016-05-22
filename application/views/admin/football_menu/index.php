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
        <?php $this->load->view('admin/message'); ?>
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title col-md-4">Danh sách menu</h3>
                  <div class="col-md-4">
                    <form action="<?php echo admin_url('football_menu/index'); ?>" id="search_football_menu" method="post">
                      <div class="input-group">
                        <input type="text" name="menu_name" class="form-control" value="<?php echo set_value('menu_name') ?>" title="Tìm kiếm">
                         <span class="input-group-btn">
                             <button name="search" class="btn btn-default" value="search_menu" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                          </span>
                      </div>
                    </form>
                </div>
                  <button type="button" class="btn btn-success pull-right" onclick="window.location.href='<?php echo admin_url("football_menu/add")?>'">Thêm mới</button>
                </div><!-- /.box-header -->
                <?php echo form_open(admin_url('football_menu/delete_all'), 'post'); ?>
                <div class="box-body mailbox-messages">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>
                          <button class="btn btn-default btn-sm checkbox-toggle" type="button"><i class="fa fa-square-o"></i></button>
                          <button class="btn btn-default btn-sm" name="delall" value="delete_all" type="submit" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash-o"></i></button>
                        </th>
                        <th>NO.</th>
                        <th>Name</th>
                        <th>Parent ID</th>
                        <th>Sort Order</th>
                        <th>Create User</th>
                        <th>Create Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $no = 0 ?>
                    <?php foreach ($list as $row): ?>
                    <?php $no = $no + 1 ?>
                      <tr>
                        <td style="margin-left: -20px"><input type="checkbox" name="ids[]" value="<?php echo $row->id ?>"></td>
                        <td><?php echo $no ?></td>
                        <td><?php echo $row->name ?></td>
                        <td><?php echo $row->parent_id ?></td>
                        <td><?php echo $row->sort_order ?></td>
                        <td><?php
                        if ($row->update_user != null) {
                          echo $row->update_user;
                        }else{
                          echo $row->create_user;
                        }   
                         ?></td>
                        <td><?php 
                        if ($row->update_date != null) {
                          echo $row->update_date;
                        }else{
                          echo $row->create_date;
                        }  
                        ?></td>
                        <td>
                          <button type="button" class="btn btn-primary" onclick="window.location.href='<?php echo admin_url("football_menu/views/$row->id")?>'">Views</button>
                          <button type="button" class="btn btn-warning" onclick="window.location.href='<?php echo admin_url("football_menu/edit/$row->id")?>'"">Edit</button>
                          <button type="button" class="btn btn-danger" onclick="confirm_delete('<?php echo $row->id ?>');">Delete</button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
                <?php echo form_close(); ?>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
          <div id="dialog-message" title="Confirm Delete"></div>
        </section><!-- /.content -->
         <!-- DataTables -->

<!-- check all table -->
<script src="<?php echo base_url('public') ?>/plugins/iCheck/icheck.min.js"></script>
    <!-- Page Script -->
    <script>
      $(function () {
        //Enable iCheck plugin for checkboxes
        //iCheck for checkbox and radio inputs
        $('.mailbox-messages input[type="checkbox"]').iCheck({
          checkboxClass: 'icheckbox_flat-blue',
          radioClass: 'iradio_flat-blue'
        });

        //Enable check and uncheck all functionality
        $(".checkbox-toggle").click(function () {
          var clicks = $(this).data('clicks');
          if (clicks) {
            //Uncheck all checkboxes
            $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
            $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
          } else {
            //Check all checkboxes
            $(".mailbox-messages input[type='checkbox']").iCheck("check");
            $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
          }
          $(this).data("clicks", !clicks);
        });});
</script>

<!-- delete col table -->
<script type="text/javascript">
function confirm_delete($id){
  $(function() {
    $('#dialog-message').empty();
        $('#dialog-message').append("Bạn có muốn xóa trường này?");
        $( "#dialog-message" ).dialog({
              modal: true,
              buttons: {
                OK: function() {
                  $( this ).dialog( "close" );
                  window.location ="<?php echo admin_url('football_menu/delete')?>" + '/' + $id;
                },
                Cancel: function() {
              $( this ).dialog( "close" );
            }
              }
            });
          });
}</script>