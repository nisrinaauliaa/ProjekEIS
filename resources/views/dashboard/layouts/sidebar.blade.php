<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" style="color: #B42B51" href="/dashboard">
            <span data-feather="grid"></span>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/posts*') ? 'active' : '' }}" style="color: #B42B51" href="/dashboard/posts">
            <span style="color: #B42B51" data-feather="file-text"></span>
            All Posts
          </a>
      </ul>

      {{-- hanya muncul ketika yang login adalah admin --}}
      @can('admin')
      <h6 class="sidebar-heading d-flex justify-content-between align-items-center p-3 mt-4 mb-1 text-muted">
        <span style="color: #B42B51">Administrator</span>
      </h6>

      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/categories*') ? 'active' : '' }}" style="color: #B42B51" href="/dashboard/categories">
            <span style="color: #B42B51" data-feather="server"></span>
            Post Categories
          </a> 
        </li>
      </ul>
      @endcan
    </div>
  </nav>