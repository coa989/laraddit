<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <img src="/assets/brand/etaj8l01.svg" alt="" width="118" height="46">
    </div>
    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.dashboard') }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
                </svg> Dashboard</a></li>
        <li class="c-sidebar-nav-title">Actions</li>
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-people"></use>
                </svg> Users</a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.users') }}"><span class="c-sidebar-nav-icon"></span> All</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.users.guests') }}"><span class="c-sidebar-nav-icon"></span> Guests</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.users.authors') }}"><span class="c-sidebar-nav-icon"></span> Authors</a></li>

            </ul>
        </li>
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-library"></use>
                </svg> Posts</a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.posts') }}"><span class="c-sidebar-nav-icon"></span> All</a></li>
                <li class="c-sidebar-nav-item "><a class="c-sidebar-nav-link" href="{{ route('admin.posts.approved') }}"><span class="c-sidebar-nav-icon"></span> Approved</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.posts.waiting') }}"><span class="c-sidebar-nav-icon"></span> Waiting Approval</a></li>
            </ul>
        </li>
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-short-text"></use>
                </svg> Definitions</a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.definitions') }}"><span class="c-sidebar-nav-icon"></span> All</a></li>
                <li class="c-sidebar-nav-item "><a class="c-sidebar-nav-link" href="{{ route('admin.definitions.approved') }}"><span class="c-sidebar-nav-icon"></span> Approved</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.definitions.waiting') }}"><span class="c-sidebar-nav-icon"></span> Waiting Approval</a></li>
            </ul>
        </li>
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div>
