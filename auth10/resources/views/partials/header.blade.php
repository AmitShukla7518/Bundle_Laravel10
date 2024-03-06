<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <ul class="nav navbar-nav navbar-right">
                <li class=" nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"> <?php $name = Auth::user()->name;
                                                echo $name;
                                                ?></i>
                    </a>
                    <?php $id = Auth::user()->id; ?>

                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">


                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                this.closest('form').submit(); ">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </form>

                    </div>
                </li>
            </ul>
        </ul>

    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <div class="sidebar">

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('public/images/cogentlogo.png') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">

                    <a href="#" class="d-block">COGENT</a>
                </div>
            </div>
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image" style="padding-left:1.5rem;padding-right:1.5rem;">
                    <?php
                    $users = Auth::user()->profilepicture;
                    $id = Auth::user()->id; ?>


                    <img class="img-circle elevation-4" alt="User Image" src="{{asset('public/dist/img/user2-160x160.jpg')}}">

                </div>
                <div class="info">
                    <a href="{{route('users.edit',$id)}}" class="d-block" style="color:#dee2e6;"><?php echo strtoupper($name) ?> </a>

                </div>
            </div>
            <!-- <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div> -->
            <nav class="mt-2">

                <ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-accordion="false">
                    <!-- <li class="nav-item ">
                        <a href="{{route('dashboard')}}" class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }} ">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li> -->

                    @php
                    $role =Auth::user()->usertype;
                    @endphp
                    @if($role!='agent' )
                    <li class="nav-item ">
                        <a href="{{route('users')}}" class="nav-link {{ request()->is('users/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-plus"></i>
                            <p>Manage User</p>
                        </a>
                    </li>
                    @endif
                    <!--  -->





                </ul>

            </nav>
        </div>
    </aside>