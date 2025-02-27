@php
$configData = Helper::applClasses();
@endphp

<div class="main-menu menu-fixed {{ ($configData['theme'] === 'dark' || $configData['theme'] === 'semi-dark') ? 'menu-dark' : 'menu-light' }} menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
      <li class="nav-item me-auto">
        <a class="navbar-brand" href="{{ url('/') }}">
          <h2 class="brand-text">Elitecare Hospital</h2>
        </a>
      </li>
      <li class="nav-item nav-toggle">
        <a class="nav-link modern-nav-toggle pe-0" data-toggle="collapse">
          <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
          <i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" data-feather="disc" data-ticon="disc"></i>
        </a>
      </li>
    </ul>
  </div>

  <div class="shadow-bottom"></div>
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      @if(isset($menuData) && isset($menuData->menu))
      @foreach($menuData->menu as $menu)
      <li class="nav-item {{ Request::is($menu->url) ? 'active' : '' }}">
        @if($menu->slug === 'logout')
        <a href="{{ route('logout') }}"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
          class="d-flex align-items-center">
          @else
          <a href="{{ $menu->url }}" class="d-flex align-items-center">
            @endif
            @if(isset($menu->icon))
            <i data-feather="{{ $menu->icon }}"></i>
            @endif
            <span class="menu-title text-truncate">{{ $menu->name }}</span>
          </a>
      </li>
      @endforeach
      @endif
    </ul>
  </div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
  @csrf
</form>

@push('scripts')
<script>
  $(document).ready(function() {
    $('.logout-link').on('click', function(e) {
      e.preventDefault();

      $.ajax({
        url: "{{ route('logout') }}",
        type: 'POST',
        dataType: 'json',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          if (response.status === 'success') {
            window.location.href = response.redirect;
          } else {
            alert('Logout failed. Please try again.');
          }
        },
        error: function(xhr, status, error) {
          console.error('Logout error:', error);
          $('#logout-form').submit();
        }
      });
    });
  });
</script>
@endpush