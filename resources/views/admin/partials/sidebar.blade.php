<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <a class="nav-link collapsed" href="" data-bs-toggle="collapse" data-bs-target="#collapseUsers" aria-expanded="false" aria-controls="collapseUsers">
                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                Users
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseUsers" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('admin.users') }}">All</a>
                    <a class="nav-link" href="{{ route('admin.users.guests') }}">Guests</a>
                    <a class="nav-link" href="{{ route('admin.users.authors') }}">Authors</a>
                </nav>
            </div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePosts" aria-expanded="false" aria-controls="collapsePosts">
                <div class="sb-nav-link-icon"><i class="fas fa-layer-group"></i></div>
                Posts
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapsePosts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('admin.posts') }}">All</a>
                    <a class="nav-link" href="{{ route('admin.posts.approved') }}">Approved</a>
                    <a class="nav-link" href="{{ route('admin.posts.pending') }}">Pending</a>
                    <a class="nav-link" href="{{ route('admin.posts.rejected') }}">Rejected</a>
                </nav>
            </div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseDefinitions" aria-expanded="false" aria-controls="collapseDefinitions">
                <div class="sb-nav-link-icon"><i class="fas fa-align-left"></i></div>
                Definitions
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseDefinitions" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('admin.definitions') }}">All</a>
                    <a class="nav-link" href="{{ route('admin.definitions.approved') }}">Approved</a>
                    <a class="nav-link" href="{{ route('admin.definitions.pending') }}">Pending</a>
                    <a class="nav-link" href="{{ route('admin.definitions.rejected') }}">Rejected</a>
                </nav>
            </div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseComments" aria-expanded="false" aria-controls="collapseComments">
                <div class="sb-nav-link-icon"><i class="fas fa-layer-group"></i></div>
                Comments
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseComments" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('admin.comments.index') }}">All</a>
                    <a class="nav-link" href="{{ route('admin.comments.approved') }}">Approved</a>
                    <a class="nav-link" href="{{ route('admin.comments.pending') }}">Pending</a>
                    <a class="nav-link" href="{{ route('admin.comments.rejected') }}">Rejected</a>
                </nav>
            </div>
        </div>
    </div>
</nav>
