






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



<li class="menu-item {{request()->routeIs('product.*') ? 'active open' : ' '}}">
  <a href="javascript:void(0);" class="menu-link menu-toggle">
    <i class="menu-icon tf-icons bx bx-home-smile"></i>
    <div class="text-truncate" data-i18n="Dashboards">Products</div>

  </a>
  <ul class="menu-sub">
    <li class="menu-item {{request()->routeIs('product.create') ? 'active open' : ' '}}">
      <a href="{{route('product.create')}}" class="menu-link">
        <div class="text-truncate" data-i18n="Analytics">Add Products</div>
      </a>
    </li>
    <li class="menu-item {{request()->routeIs('product.index') ? 'active open' : ' '}}">
      <a href="{{route('product.index')}}" class="menu-link">
        <div class="text-truncate" data-i18n="Analytics">Product List</div>
      </a>
    </li>

  </ul>
</li>







{{-- * Dropdown Menu  --}}
