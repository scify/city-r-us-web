<?php  $lang = "templates/menu."; ?> {{--  resource label path --}}

<div class="sidebar horizontal-bar">
    <div class="page-sidebar-inner slimscroll">
        <ul class="menu accordion-menu">
            <li class="">
                <a href="{{url('dashboard')}}" class="waves-effect waves-button">
                    <i class="fa fa-dashboard fa-2x"></i>
                    <p>{{trans($lang.'dashboard')}}</p>
                </a>
            </li>
            <li class="droplink">
                <a class="waves-effect waves-button">
                    <i class="fa fa-bullseye fa-2x"></i>
                    <p>{{trans($lang.'missions')}}</p>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class=""><a href="{{ url('missions') }}">{{trans($lang.'showMissions')}}</a></li>
                    <li class=""><a href="{{ url('missions/create') }}">{{trans($lang.'createMission')}}</a></li>
                </ul>
            </li>

            <li class="droplink">
                <a class="waves-effect waves-button">
                    <i class="fa fa-user fa-2x"></i>
                    <p>{{trans($lang.'users')}}</p>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class=""><a href="{{ url('users') }}">{{trans($lang.'showUsers')}}</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- Page Sidebar Inner -->
</div>
