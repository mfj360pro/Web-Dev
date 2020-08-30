<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Brand -->
        <a class="navbar-brand py-0" href="/{{$accesstype}}/">
            {{$accessname}}
        </a>
        <div class="dropdown-divider"></div>

        <!-- Collapse -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ni ni-single-02"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <a href="/{{$accesstype}}/signout" class="dropdown-item">
                        <i class="ni ni-user-run"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </li>
        </ul>

        <div class="collapse navbar-collapse" id="sidenav-collapse-main">

            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-9 collapse-brand">
                        <a href="/{{$accesstype}}/">Me</a>
                    </div>
                    <div class="col-3 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>

            <ul id="menu-nav" class="navbar-nav">
                @foreach ($menus as $item)
                    <li id="{{$item['menu']['element']}}" class="nav-item">
                        <a class="nav-link h4" href="/{{$item['accesstype']}}/{{$item['menu']['link']}}">
                            <i class="ni ni-tv-2 text-primary"></i>
                            {{$item['menu']['title']}}
                            <span class="badge badge-pill badge-default ml-2 text-white"></span>
                        </a>
                    </li>
                @endforeach                
            </ul>

        </div>
    </div>
</nav>
