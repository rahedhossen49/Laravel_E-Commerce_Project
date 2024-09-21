






 <!-- Dashboards -->
 <li class="menu-item {{request()->routeIs('dashboard') ? 'active open' : ' '}}">
  <a href="{{route('dashboard')}}" class="menu-link">
    <i class="menu-icon tf-icons bx bx-home-smile"></i>
    <div class="text-truncate" data-i18n="Dashboards">Dashboards</div>
  </a>
</li>


<li class="menu-item {{request()->routeIs('category.index') ? 'active open' : ' '}} ">
  <a href="{{route('category.index')}}" class="menu-link ">
    <i class='menu-icon bx bxs-category'></i>
    <div class="text-truncate" data-i18n="Dashboards">Categories</div>

  </a>
</li>













{{-- * Dropdown Menu  --}}

{{--
<li class="menu-item active open">
  <a href="javascript:void(0);" class="menu-link menu-toggle">
    <i class="menu-icon tf-icons bx bx-home-smile"></i>
    <div class="text-truncate" data-i18n="Dashboards">Dashboards</div>
    <span class="badge rounded-pill bg-danger ms-auto">5</span>
  </a>
  <ul class="menu-sub">
    <li class="menu-item active">
      <a href="index.html" class="menu-link">
        <div class="text-truncate" data-i18n="Analytics">Analytics</div>
      </a>
    </li>

  </ul>
</li> --}}
