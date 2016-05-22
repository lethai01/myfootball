<?php $id_ = $this->uri->rsegment(4); $where = $this->uri->rsegment(3); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Data Tables<small>advanced tables</small></h1>
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
          <h3 class="box-title col-md-4">Tổng số : <?php echo $total_rows ?></h3>
          <div class="col-md-4">
            <form action="<?php echo admin_url('footer/index'); ?>" id="search_footer" method="post">
              <?php echo form_dropdown(array('name' => 'type', 'class' => 'form-control', 'id' => 'type', 'style' => 'width:40%'), $options, set_value('type')); ?>
              <?php echo form_hidden('num_per_page', set_value('num_per_page')) ?>
            </form>
          </div>
          <button type="button" class="btn btn-success pull-right" onclick="window.location.href='<?php echo admin_url("footer/add")?>'">Thêm mới</button>
        </div><!-- /.box-header -->
        <?php echo form_open(admin_url('footer/delete_all'), 'post'); ?>
        <div class="box-body mailbox-messages">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="width:85px">
                  <button class="btn btn-default btn-sm checkbox-toggle" type="button"><i class="fa fa-square-o"></i></button>
                  <button class="btn btn-default btn-sm" name="delall" value="delete_all" type="submit" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash-o"></i></button>
                </th>
                <th>NO.</th>
                <th>Version</th>
                <th>Intro</th>
                <th>Content Left</th>
                <th>Content Right</th>
                <th>Display</th>
                <th>Create User</th>
                <th>Create Date</th>
                <th style="width:150px">Action</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($list as $no => $row): ?>
              <tr>
                <td style="margin-left: -20px"><input type="checkbox" name="ids[]" value="<?php echo $row->id ?>"></td>
                <td><?php echo $no +1 ?></td>
                <td><?php echo $row->version ?></td>
                <td><?php echo $row->intro?></td>
                <td><?php echo $row->content_left?></td>
                <td><?php echo $row->content_right?></td>
                <td><?php
                switch ($row->type) {
                   case '1':
                     echo 'Admin';
                     break;
                   
                   default:
                     echo "Page";
                     break;
                 }                 
                ?></td>
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
                  <button type="button" class="btn btn-warning" onclick="window.location.href='<?php echo admin_url("footer/edit/$row->id")?>'">Edit</button>
                  <button type="button" class="btn btn-danger" onclick="confirm_delete('<?php echo $row->id ?>');">Delete</button>
                </td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
        <?php echo form_close(); ?>
      </div><!-- /.box -->
    <?php if($total_rows > $num_per_page) { ?>
    <div class="row paging-area">
      <div class="numberShow">
        <?php echo form_dropdown('num_page', $row_of_page, $num_per_page, array('id' => 'dropdown_numrow','class' => 'form-control selectnumberShow'));?>
        <label class="space" style="margin-top: 6px"><?php echo 'Showing '.$start.' to '.$end. ' of '. $total_rows . ' entries'; ?></label>
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

<script>
(function($) {
  $(document).ready(function() {
  $('.pagination a').click(function () {
        var link = $(this).get(0).href; // get the link from the DOM object
        var form = $('#search_footer'); // get the form you want to submit
        // var segments = link.split('/');
        // assume the page number is the fifth parameter of the link
        // $('#page').val(segments[4]); // set a hidden field with the page number
        form.attr('action', link); // set the action attribute of the form
        form.submit(); // submit the form
        return false; // avoid the default behaviour of the link
    });
    $('#dropdown_numrow').change(function(){
                    var number_of_rows = $("#dropdown_numrow").val();
                    var form = $('#search_footer'); // get the form you want to submit
                    $("[name='num_per_page']").val(number_of_rows);
                    form.submit(); // submit the form
                    return false; // avoid the default behaviour of the link
                });
     $('#type').change(function(){
                    var form = $('#search_footer'); // get the form you want to submit
                    form.submit(); // submit the form
                    return false; // avoid the default behaviour of the link
                });
  });
})(jQuery);
</script>

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
                  window.location ="<?php echo admin_url('footer/delete')?>" + '/' + $id;
                },
                Cancel: function() {
              $( this ).dialog( "close" );
            }
              }
            });
          });
}</script>
<!-- phân trang -->