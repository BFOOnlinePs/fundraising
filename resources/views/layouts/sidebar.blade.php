<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul class="sidebar-vertical">
                <!-- Main -->

                <!-- Admin -->
                @if(auth()->user()->user_role == 1)
                    <li class="menu-title"><span>Main</span></li>
                    <li class="submenu">
                        <a href="#"><i class="fe fe-home"></i> <span> Dashboard</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a class="active" href="index.html">Admin Dashboard</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fe fe-home"></i> <span> Users</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a class="active" href="{{ route('users.index') }}">Users list</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fe fe-grid"></i> <span> Fundraising unit</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('fundraising_unit.donors.index') }}">Donors</a></li>
                            <li><a href="calendar.html">Calls</a></li>
                            <li><a href="inbox.html">Proposals</a></li>
                            {{--                        <li><a href="inbox.html">Opportunities</a></li>--}}
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fe fe-grid"></i> <span> Settings</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('settings.region.index') }}">Region</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fe fe-grid"></i> <span> Team</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="#">All Staff</a></li>
                            <li><a href="calendar.html">Staff groups</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fe fe-grid"></i> <span> Media Report</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('media_report.index') }}">Media Report</a></li>
                        </ul>
                    </li>
                @elseif(auth()->user()->user_role == 3)
                    <li class="submenu">
                        <a href="#"><i class="fe fe-grid"></i> <span> Media Report</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('media_report.index') }}">Media Report</a></li>
                        </ul>
                    </li>
                @elseif(auth()->user()->user_role == 4)
                    <li class="menu-title"><span>Main</span></li>
                    <li class="submenu">
                        <a href="#"><i class="fe fe-home"></i> <span> Dashboard</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a class="active" href="index.html">Admin Dashboard</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fe fe-grid"></i> <span> Reports</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('media_report.index') }}">Media report</a></li>
                        </ul>
                    </li>
                @endif
                <!-- /Main -->
            </ul>
        </div>
    </div>
</div>
