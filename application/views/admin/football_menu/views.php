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
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered table-striped" id="views_menu">
                    <thead>
                      <tr>
                        <th>NO.</th>
                        <th style="display: none"></th>
                        <th>Name</th>
                        <th>Site Title</th>
                        <th>Parent</th>
                        <th>Sort Order</th>
                        <th>Create Date</th>
                        <th>Create User</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($list as $no => $row): ?>
                      <tr>
                        <td><?php echo $no + 1 ?></td>
                        <th style="display: none"><?php echo $row->id ?></th>
                        <td><?php echo $row->name ?></td>
                        <td><?php echo $row->site_title ?></td>
                        <td><?php
                        $query = $this->db->select('name')->where('id', $row->parent_id)->get('football_menu')->result();
                        foreach ($query as $name) {
                           echo $name->name;
                         } 
                        ?></td>
                        <td><?php echo $row->sort_order ?></td>
                        <td><?php echo $row->create_date ?></td>
                        <td><?php echo $row->create_user ?></td>
                      </tr>
                    <?php endforeach; ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
        <div id="dialog-message" title="Update Error"></div>
         <!-- DataTables -->
<?php $id_ = intval($this->uri->segment(4)) ?>
<script>
$('#views_menu').Tabledit({
    url: '<?php echo admin_url('football_menu/action_menu'); ?>',
    columns: {
        identifier: [1, 'id'],
        editable: [[2, 'name'],
        [3, 'site_title'],
        [4,'parent','{<?php foreach ($parent_id as $key => $parent):?>"<?php echo $parent->id ?>" : "<?php echo $parent->name ?>"<?php if($key+1 < count($parent_id)) echo ","; ?><?php endforeach;?>}'], 
        [5,'sort','{<?php foreach ($sort_order as $key => $sort):?>"<?php echo $sort ?>" : "<?php echo $sort ?>"<?php if($key < count($sort_order)) echo ","; ?><?php endforeach;?>}']]

    },
    maxlength:150,
    onDraw: function() {
    },
    onSuccess: function(data, textStatus, jqXHR) {
        window.location.href="<?php echo admin_url('football_menu/views/'.$id_)?>";
    },
    onFail: function(jqXHR, textStatus, errorThrown) {
        $(function() {
        $('#dialog-message').empty();
        $('#dialog-message').append(jqXHR['responseJSON']['code']);
        $( "#dialog-message" ).dialog({
              modal: true,
              buttons: {
                OK: function() {
                  $( this ).dialog( "close" );
                }
              }
            });
          });
    },
    onAlways: function() {
    },
    onAjax: function(action, serialize) {
    }
});
</script>