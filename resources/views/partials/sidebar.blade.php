<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('public/health/img/mak.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Arif Khan</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li <?php if(Session::get('menu') == 'dashboard') echo 'class="active"';  ?>>
          <a href="{{route('dashboard')}}">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li <?php if(Session::get('menu') == 'patient') echo 'class="active"';  ?>>
          <a href="{{route('patient')}}">
            <i class="fa fa-wheelchair"></i> <span>Patient</span>
          </a>
        </li>
        <li <?php if(Session::get('menu') == 'pathology') echo 'class="active"';  ?>>
          <a href="{{route('patient_by_pathology')}}">
            <i class="fa fa-medkit"></i> <span>Pathology</span>
          </a>
        </li>
        <li <?php if(Session::get('menu') == 'pharmacy') echo 'class="active"';  ?>>
          <a href="{{route('patient_by_pharmacy')}}">
            <i class="fa fa-medkit"></i> <span>Pharmacy</span>
          </a>
        </li>
        <li <?php if(Session::get('menu') == 'medicine') echo 'class="active"';  ?>>
          <a href="{{route('list_medicine')}}">
            <i class="fa fa-medkit"></i> <span>Medicine</span>
          </a>
        </li>
        <li <?php if(Session::get('menu') == 'test') echo 'class="active"';  ?>>
          <a href="{{route('list_test')}}">
            <i class="fa fa-medkit"></i> <span>Medical Test</span>
          </a>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>