<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="card-body">
                <div class="media">
                    <div class="mr-3">
                        <a href="#"><img
                                src="{{ asset('limitless/global_assets/images/placeholders/placeholder.jpg') }}"
                                width="38" height="38" class="rounded-circle" alt=""></a>
                    </div>

                    <div class="media-body">
                        <div class="media-title font-weight-semibold">Victoria Baker</div>
                        <div class="font-size-xs opacity-50">
                            <i class="icon-pin font-size-sm"></i> &nbsp;Santa Ana, CA
                        </div>
                    </div>

                    <div class="ml-3 align-self-center">
                        <a href="#" class="text-white"><i class="icon-cog3"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu"
                        title="Main"></i>
                </li>
                <li class="nav-item">

                    <a href=""
                        class="nav-link ">
                        <i class="icon-home4"></i>
                        <span>
                            Dashboard
                        </span>
                    </a>
                </li>
                

                

                <!-- Uncomment the following section -->

                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link {{ request()->is('product*') ? 'active' : '' }}">
                        <i class="icon-versions"></i>
                        <span>Product</span>
                    </a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item">
                            <a href="{{ route('product.index') }}"
                                class="nav-link {{ request()->routeIs('product.index') ? 'active' : '' }}">
                                <i class="icon-list"></i>Product List
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('product.create') }}"
                                class="nav-link {{ request()->routeIs('product.create') ? 'active' : '' }}">
                                <i class="icon-add-to-list"></i>Product Add
                            </a>
                        </li>
                        
                        
                       
                       
                        <li class="nav-item">
                            <a href="{{ route('unit.index') }}"
                                class="nav-link {{ request()->routeIs('unit.index') ? 'active' : '' }}">
                                <i class="icon-meter-fast"></i>Unit
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('color.index') }}"
                                class="nav-link {{ request()->routeIs('color.index') ? 'active' : '' }}">
                                <i class="icon-paint-format"></i>Color
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('size.index') }}"
                                class="nav-link {{ request()->routeIs('size.index') ? 'active' : '' }}">
                                <i class="icon-align-top"></i>Size
                            </a>
                        </li>
                    </ul>
                </li>



                <li class="nav-item">
                    <a target="_blank" href="{{ route('pos.create') }}"
                        class="nav-link {{ request()->is('pos*') ? 'active' : '' }}">
                        <i class="icon-store2"></i>
                        <span>Point Of Sale</span>
                    </a>
                </li>
            </ul>
        </div>


    </div>

</div>