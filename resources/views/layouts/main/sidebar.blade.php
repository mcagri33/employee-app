<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Employee Management</h4>
        </div>
        <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{route('dashboard')}}">
                <div class="menu-label">Dashboard</div>
            </a>
        </li>

        <li class="menu-label">Employee Management</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-award-fill"></i>
                </div>
                <div class="menu-title">System Management</div>
            </a>
            <ul>
                <li> <a href="{{route('castle.country.index')}}"><i class="bi bi-circle"></i>Country</a>
                </li>
                <li> <a href="#"><i class="bi bi-circle"></i>State</a>
                </li>
                <li> <a href="#"><i class="bi bi-circle"></i>City</a>
                </li>
                <li> <a href="#"><i class="bi bi-circle"></i>Department</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-award-fill"></i>
                </div>
                <div class="menu-title">User Management</div>
            </a>
            <ul>
                <li> <a href="{{route('castle.user.index')}}"><i class="bi bi-circle"></i>User</a>
                </li>
                <li> <a href="#"><i class="bi bi-circle"></i>Role</a>
                </li>
                <li> <a href="#"><i class="bi bi-circle"></i>Permission</a>
                </li>
                </li>
            </ul>
        </li>
    </ul>
    <!--end navigation-->
</aside>
