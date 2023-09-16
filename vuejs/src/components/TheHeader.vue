
<template>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" >Admin page</a>
            </div>
            <!-- /.navbar-header -->
            <div class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <router-link :to="{  name: 'admin-category'}">
                                <span><i class="fa-solid fa-signature"></i> Categories</span>
                            </router-link>
                        </li>                        
                        <li>
                            <router-link :to="{  name: 'admin-products'}">
                                <span><i class="fa-brands fa-product-hunt"></i> Products</span>
                            </router-link>
                        </li>   
                        <li>
                            <router-link :to="{  name: 'admin-colors'}">
                                <span><i class="fa-solid fa-droplet"></i> Colors</span>
                            </router-link>
                        </li>   
                        <li>
                            <router-link :to="{  name: 'admin-sizes'}">
                                <span><i class="pi-calendar"></i> Sizes</span>
                            </router-link>
                        </li>   
                    
                       
                        <li>
                            <router-link :to="{  name: 'admin-users'}">
                                <span><i class="pi pi-user" style="font-size: 1rem"></i> Users</span>
                            </router-link>
                        </li>   
                            <li>
                                <router-link :to="{  path:'/login'}">
                                    <span><i class="pi-sign-out" style="font-size: 1rem"></i> Logout</span>
                                </router-link>
                            </li>   
                    </ul>
                    <!-- /#side-menu -->
                </div>
                <!-- /.sidebar-collapse -->
            </div>
           
            <!-- /.navbar-static-side -->
        </nav>
        <!-- /#page-wrapper -->

    </div>
</template>

