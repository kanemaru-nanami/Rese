<header class="header">
  <h1 class="header-ttl">Rese</h1>
  @if( Auth::check() )
  <nav class="header-nav">
    <ul class="header-nav-list">
      <li class="header-nav-item"><a href="/shop_all">Home</a></li>
      <li class="header-nav-item">
        <form action="/logout" method="post">
          @csrf
          <button class="header-nav_button">Logout</button>
        </form>
      </li>  
      <li class="header-nav-item"><a href="/">Mypage</a></li>
    </ul>
  </nav>
  @endif
</header>