<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            List Data Tables Spain
            <small>Spain tables</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Danh Sách</a></li>
            <li class="active">Spain</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
        <?php $this->load->view('admin/message'); ?>
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title col-md-4">Danh sách Spain</h3>
                  <div class="col-md-4">
                    <form action="<?php echo admin_url('spain/index'); ?>" id="search_football_menu" method="post">
                      <div class="input-group">
                        <input type="text" name="" class="form-control" value="" title="Tìm kiếm">
                         <span class="input-group-btn">
                             <button name="search" class="btn btn-default" value="search_bad_number" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                          </span>
                      </div>
                    </form>
                </div>
                  <button type="button" class="btn btn-success pull-right" onclick="window.location.href='<?php echo admin_url("spain/add")?>'">Thêm mới</button>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th></th>
                        <th>NO.</th>
                        <th>Title</th>
                        <th>Parent</th>
                        <th>Views</th>
                        <th>Tags</th>
                        <th>Create Date</th>
                        <th>Create User</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($list as $no => $row): ?>
                      <tr>
                        <td style="margin-left: -20px"><input type="checkbox" value="<?php echo $row->id ?>"></td>
                        <td><?php echo $no+1 ?></td>
                        <td>
                        	<img width="50px" height="40px" src="<?php echo $row->image_link ?>" alt="">
                        	<?php echo $row->title ?>
                        </td>
                        <td><?php echo $row->name ?></td>
                        <td><?php echo $row->views ?></td>
                        <td><?php echo $row->tags
                           	/*$tags_id = explode(',', $row->tags);
                            $this->load->model('football_tags_model');
                            $tags = $this->football_tags_model->get_tags_name($tags_id);
                            if ($tags) {
                              foreach ($tags as $tag_name) 
                              {
                                echo $tag_name->name;
                              }
                            }       */              
                         ?></td>
                        <td><?php echo $row->create_date ?></td>
                        <td><?php echo $row->create_user ?></td>
                        <td>
                          <button type="button" class="btn btn-primary" onclick="window.location.href='<?php echo admin_url("spain/views/$row->id")?>'">Views</button>
                          <button type="button" class="btn btn-warning" onclick="window.location.href='<?php echo admin_url("spain/edit/$row->id")?>'">Edit</button>
                          <button type="button" class="btn btn-danger" onclick="confirm_delete('<?php echo $row->id ?>');">Delete</button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
          <div id="dialog-message" title="Confirm Delete"></div>
        </section><!-- /.content -->
         <!-- DataTables -->
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
                  window.location ="<?php echo admin_url('spain/delete')?>" + '/' + $id;
                },
                Cancel: function() {
              $( this ).dialog( "close" );
            }
              }
            });
          });
}</script>