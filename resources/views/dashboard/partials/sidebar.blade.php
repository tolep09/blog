<div class="sidebar" data-color="purple" data-background-color="white">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
    <div class="logo"><a href="http://www.creative-tim.com" class="simple-text logo-normal">
        Larablog
      </a></div>
    <div class="sidebar-wrapper">
      <ul class="nav">
        <li class="nav-item {{ Request::path() == 'dashboard/users' ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-users"></i>
            <p>Usuarios</p>
          </a>
        </li>
        <li class="nav-item {{ Request::path() == 'dashboard/categories' ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('categories.index') }}">
            <i class="fas fa-th-list"></i>
            <p>Categorías</p>
          </a>
        </li>
        <li class="nav-item {{ Request::path() == 'dashboard/posts' ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('posts.index') }}">
            <i class="fas fa-blog"></i>
            <p>Posts</p>
          </a>
        </li>
      </ul>
    </div>
  </div>