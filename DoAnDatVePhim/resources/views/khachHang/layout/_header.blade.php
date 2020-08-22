<!-- Chỉ có Trang chủ mới thêm class header-wrapper--home -->
<header class="header-wrapper{{$isHomePage ? ' header-wrapper--home' : ''}}">
    <div class="container">
        <!-- Logo link-->
        <a href="{{route('khachHang.trangChuPage')}}" class="logo">
            <img alt='logo' src="{{asset('images/bkcinema.png')}}">
        </a>
        <!-- Main website navigation-->
        <nav id="navigation-box">
            <!-- Toggle for mobile menu mode -->
            <a href="#" id="navigation-toggle">
                <span class="menu-icon">
                    <span class="icon-toggle" role="button" aria-label="Toggle Navigation">
                      <span class="lines"></span>
                    </span>
                </span>
            </a>
            <!-- Link navigation -->
            <ul id="navigation">
                <li>
                    <span class="sub-nav-toggle plus"></span>
                    <a href="#">Phim</a>
                    <ul>
                        <li class="menu__nav-item"><a href="#">Đang chiếu</a></li>
                        <li class="menu__nav-item"><a href="#">Sắp chiếu</a></li>
                    </ul>
                </li>
                <li>
                    <span class="sub-nav-toggle plus"></span>
                    <a href="#">Rạp / Giá vé</a>
                </li>
                <li>
                    <span class="sub-nav-toggle plus"></span>
                    <a href="#">Hỗ trợ</a>
                </li>
            </ul>
        </nav>
        @if (auth()->check())
            @php $taiKhoan = auth()->user()->toArray(); @endphp
            <div class="control-panel">
                <div class="auth auth--home">
                    <div class="auth__show">
                        <span class="auth__image">
                          <img alt="" src="http://placehold.it/31x31">
                        </span>
                    </div>
                    <a href="#" class="btn btn--sign btn--singin">
                        {{$taiKhoan['ho_ten']}}
                    </a>
                    <ul class="auth__function">
                        <li><a href="#" class="auth__function-item">Vé đã đặt</a></li>
                        <li><a href="#" class="auth__function-item">Hồ sơ cá nhân</a></li>
                        <li><a href="#" class="auth__function-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a></li>
                        <form id="logout-form" action="{{ route('khachHang.dangXuat') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>

                </div>
                <a href="{{route('khachHang.datVePage')}}" class="btn btn-md btn--warning btn--book btn-control--home login-window">Đặt vé</a>
            </div>
        @else
            <div class="control-panel">
                <a href="{{route('khachHang.dangNhapPage')}}" class="btn btn--sign login-window">Đăng nhập</a>
                <a href="{{route('khachHang.datVePage')}}" class="btn btn-md btn--warning btn--book login-window">Đặt vé</a>
            </div>
        @endif
    </div>
</header>
