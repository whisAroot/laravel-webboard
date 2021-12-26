<div>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #eb6ec5;">
        <a class="navbar-brand" href="/">เว็บบอร์ด</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            @if (Auth::user())
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  {{Auth::user()->name}}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">แก้ไขข้อมูลส่วนตัว</a>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">ออกจากระบบ</a>
                </div>
              </li> 
            @else
            <li class="nav-item">
              <a class="nav-link" href="{{route('login')}}">เข้าสู่ระบบ</a>
            </li>
            @endif
          </ul>
        </div>
      </nav>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>