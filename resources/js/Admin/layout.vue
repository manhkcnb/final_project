<template>
  <div id="wrapper">
    <!-- ... Navbar ... -->
    
    <div class="navbar-default navbar-static-side" role="navigation">
      <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
          <li>
            <router-link to="/home"><i class="fa fa-dashboard fa-fw"></i> Home page</router-link>
          </li>
          <li>
            <router-link to="/categories"><i class="fa fa-table fa-fw"></i> Categories</router-link>
          </li>
          <li>
            <router-link to="/products"><i class="fa fa-edit fa-fw"></i> Products</router-link>
          </li>
          <li>
            <router-link to="/colors"><i class="fa fa-edit fa-fw"></i> Color</router-link>
          </li>
          <li>
            <router-link to="/users"><i class="fa fa-edit fa-fw"></i> User</router-link>
          </li>
          <li>
            <router-link to="/sizes"><i class="fa fa-edit fa-fw"></i> Size</router-link>
          </li>
          <li>
            <router-link to="/logout"><i class="fa fa-edit fa-fw"></i> Logout</router-link>
          </li>
        </ul>
      </div>
    </div>

    <div id="page-wrapper" style="padding-top: 20px;">
      <div class="row">
        <div class="col-lg-12">
          <!-- content here -->
          <router-view></router-view>
          <!-- end content -->
        </div>
      </div>
    </div>
  </div>
</template>
