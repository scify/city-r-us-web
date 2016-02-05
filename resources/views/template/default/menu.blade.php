<div class="sidebar horizontal-bar">
    <div class="page-sidebar-inner slimscroll">
        <ul class="menu accordion-menu">
            <li class="">
                <a href="{{url('dashboard')}}" class="waves-effect waves-button">
                    <i class="fa fa-dashboard fa-2x"></i>
                    <p>{{trans('admin_menu.dashboard')}}</p>
                </a>
            </li>
            <li class="droplink">
                <a class="waves-effect waves-button">
                    <i class="fa fa-bullseye fa-2x"></i>
                    <p>{{trans('admin_menu.missions')}}</p>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class=""><a href="{{ url('missions') }}">{{trans('admin_menu.showMissions')}}</a></li>
                    <li class=""><a href="{{ url('missions/create') }}">{{trans('admin_menu.createMission')}}</a></li>
                </ul>
            </li>

            <li class="droplink">
                <a class="waves-effect waves-button">
                    <i class="fa fa-user fa-2x"></i>
                    <p>{{trans('admin_menu.users')}}</p>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class=""><a href="{{ url('users') }}">{{trans('admin_menu.showUsers')}}</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- Page Sidebar Inner -->
</div>
