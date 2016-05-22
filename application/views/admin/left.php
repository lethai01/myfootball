 
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url('public') ?>/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Admin</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo admin_url('football_menu'); ?>">
                <i class="fa fa-files-o"></i>
                <span>Menu Options</span>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Đăng bài viết</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo admin_url('english'); ?>"><i class="fa fa-circle-o"></i>English</a></li>
                <li><a href="<?php echo admin_url('spain'); ?>"><i class="fa fa-circle-o"></i>Spain</a></li>
                <li><a href="<?php echo admin_url('germany'); ?>"><i class="fa fa-circle-o"></i>Germany</a></li>
                <li><a href="<?php echo admin_url('france'); ?>"><i class="fa fa-circle-o"></i>France</a></li>
                <li><a href="<?php echo admin_url('italia'); ?>"><i class="fa fa-circle-o"></i>Italia</a></li>
                <li><a href="<?php echo admin_url('vietnam'); ?>"><i class="fa fa-circle-o"></i>Viet Nam</a></li>
                <li><a href="<?php echo admin_url('remain'); ?>"><i class="fa fa-circle-o"></i>Remain</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Đăng ảnh - Video</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i>Đăng ảnh</a></li>
                <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i>Đăng video</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>User</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i>Quản lý user</a></li>
                <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i>Phân quyền user</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Create tags</span>
              </a>
            </li>
            <li>
              <a href="pages/calendar.html">
                <i class="fa fa-calendar"></i> <span>Customer</span>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Trận Đấu</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i>Create Highlight</a></li>
                <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i>Bảng xếp hạng</a></li>
                <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i>Live soccer</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>About</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Contact</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Support</a></li>
              </ul>
            </li>
            <li>
              <a href="<?php echo admin_url('footer/index'); ?>">
                <i class="fa fa-calendar"></i><span>Footer</span>
              </a>
            </li
          </ul>
        </section>
        <!-- /.sidebar -->