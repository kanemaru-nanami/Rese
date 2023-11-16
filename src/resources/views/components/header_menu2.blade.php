<header class="header">
  <h1 class="header-ttl">Rese</h1>
  <nav class="header-nav">
    <ul class="header-nav-list">
      @if( Auth::check() )
      <li class="header-nav-item"><a href="/shop_all">Home</a></li>
      @endif
      <li class="header-nav-item"><a href="/register">Registration</a></li>
      <li class="header-nav-item"><a href="/login">Login</a></li>
    </ul>
  </nav>
</header>