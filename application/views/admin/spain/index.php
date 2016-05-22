<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>List Data Tables Spain<small>Spain tables</small></h1>
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
          <h3 class="box-title col-md-4">Tổng số : <?php echo $total_rows ?></h3>
          <div class="col-md-4">
            <form action="<?php echo admin_url('spain/index'); ?>" id="search_spain" method="post">
              <div class="input-group">
                <input type="text" name="title" class="form-control" value="<?php echo set_value('title') ?>" title="Tìm kiếm">
                <?php echo form_hidden('num_per_page', set_value('num_per_page')) ?>
                <span class="input-group-btn">
                  <button name="search" class="btn btn-default" value="search_content" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                </span>
              </div>
            </form>
          </div>
          <button type="button" class="btn btn-success pull-right" onclick="window.location.href='<?php echo admin_url("spain/add")?>'">Thêm mới</button>
        </div><!-- /.box-header -->
        <?php echo form_open(admin_url('spain/delete_all'), 'post'); ?>
        <div class="box-body mailbox-messages">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>
                  <button class="btn btn-default btn-sm checkbox-toggle" type="button"><i class="fa fa-square-o"></i></button>
                  <button class="btn btn-default btn-sm" name="delall" value="delete_all" type="submit" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash-o"></i></button>
                </th>
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
                <td style="margin-left: -20px"><input type="checkbox" name="ids[]" value="<?php echo $row->id ?>"></td>
                <td><?php echo $no+1 ?></td>
                <td>
                  <img width="60px" height="50px" src="<?php echo $row->image_thumb ?>" alt="">
                  <?php echo $row->title ?>
                </td>
                <td><?php echo $row->name ?></td>
                <td><?php echo $row->views ?></td>
                <td><?php 
                      $tags_id = explode(',', $row->tags);
                    $this->load->model('football_tags_model');
                    $tags = $this->football_tags_model->get_tags_name($tags_id);
                    if ($tags) {
                      foreach ($tags as $tag_name) 
                      {
                        echo $tag_name->name;echo "<br>";
                      }
                    }              
                  ?></td>
                <td><?php
                    if ($row->update_date != null) {
                      echo Util::convertStringDate2String($row->update_date, DBConfig::DATE, ViewsConfig::VIEWDATE);
                    }else{
                      echo Util::convertStringDate2String($row->create_date, DBConfig::DATE, ViewsConfig::VIEWDATE);
                    }
                    ?></td>
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
        <?php if($total_rows > $num_per_page) { ?>
        <div class="row paging-area box-header">
          <div class="numberShow">
            <?php echo form_dropdown('num_page', $row_of_page, $num_per_page, array('id' => 'dropdown_spain','class' => 'form-control selectnumberShow'));?>
            <label class="space"><?php echo 'Showing '.$start.' to '.$end. ' of '. $total_rows . ' entries'; ?></label>
          </div>
          <nav>
            <ul class="pagination">
                <li><?php echo $this->pagination->create_links(); ?></li>
            </ul>
          </nav>
        </div>
        <?php }?>
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

<!-- delete col -->         
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
<!-- phân trang -->
<script>
(function($) {
    $(document).ready(function() {

        // bind onclick event to the pagination links
        $('.pagination a').click(function () {
            var link = $(this).get(0).href; // get the link from the DOM object
            var form = $('#search_spain'); // get the form you want to submit
            // var segments = link.split('/');
            // assume the page number is the fifth parameter of the link
            // $('#page').val(segments[4]); // set a hidden field with the page number
            form.attr('action', link); // set the action attribute of the form
            form.submit(); // submit the form
            return false; // avoid the default behaviour of the link
        });
        $('#dropdown_spain').change(function(){
                    var number_of_rows = $("#dropdown_spain").val();
                    var form = $('#search_spain'); // get the form you want to submit
                    $("[name='num_per_page']").val(number_of_rows);
                    form.submit(); // submit the form
                    return false; // avoid the default behaviour of the link
                });
    });
})(jQuery);
</script>