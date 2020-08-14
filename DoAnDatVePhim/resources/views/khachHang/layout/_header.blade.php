<!-- Chỉ có Trang chủ mới thêm class header-wrapper--home -->
<header class="header-wrapper{{$isHomePage ? ' header-wrapper--home' : ''}}">
    <div class="container">
        <!-- Logo link-->
        <a href='index.html' class="logo">
            <img alt='logo' src="{{asset('images/logo.png')}}">
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
                    <a href="#">Mua vé</a>
                </li>
                <li>
                    <span class="sub-nav-toggle plus"></span>
                    <a href="#">Góc điện ảnh</a>
                    <ul>
                        <li class="menu__nav-item"><a href="#">Thể loại phim</a></li>
                        <li class="menu__nav-item"><a href="#">Diễn viên</a></li>
                        <li class="menu__nav-item"><a href="#">Đạo diễn</a></li>
                        <li class="menu__nav-item"><a href="#">Bình luận phim</a></li>
                    </ul>
                </li>
                <li>
                    <span class="sub-nav-toggle plus"></span>
                    <a href="#">Sự kiện</a>
                    <ul>
                        <li class="menu__nav-item"><a href="#">Ưu đãi</a></li>
                        <li class="menu__nav-item"><a href="#">Phim hay tháng</a></li>
                        <li class="menu__nav-item"><a href="#">2 col gallery</a></li>
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
                <!-- Mega menu -->
                {{--                <li>--}}
                {{--                    <span class="sub-nav-toggle plus"></span>--}}
                {{--                    <a href="#">Mega menu</a>--}}
                {{--                    <ul class="mega-menu container">--}}
                {{--                        <li class="col-md-3 mega-menu__coloum">--}}
                {{--                            <h4 class="mega-menu__heading">Now in the cinema</h4>--}}
                {{--                            <ul class="mega-menu__list">--}}
                {{--                                <li class="mega-menu__nav-item"><a href="#">The Counselor</a></li>--}}
                {{--                                <li class="mega-menu__nav-item"><a href="#">Bad Grandpa</a></li>--}}
                {{--                                <li class="mega-menu__nav-item"><a href="#">Blue Is the Warmest Color</a></li>--}}
                {{--                                <li class="mega-menu__nav-item"><a href="#">Capital</a></li>--}}
                {{--                                <li class="mega-menu__nav-item"><a href="#">Spinning Plates</a></li>--}}
                {{--                                <li class="mega-menu__nav-item"><a href="#">Bastards</a></li>--}}
                {{--                            </ul>--}}
                {{--                        </li>--}}

                {{--                        <li class="col-md-3 mega-menu__coloum mega-menu__coloum--outheading">--}}
                {{--                            <ul class="mega-menu__list">--}}
                {{--                                <li class="mega-menu__nav-item"><a href="#">Gravity</a></li>--}}
                {{--                                <li class="mega-menu__nav-item"><a href="#">Captain Phillips</a></li>--}}
                {{--                                <li class="mega-menu__nav-item"><a href="#">Carrie</a></li>--}}
                {{--                                <li class="mega-menu__nav-item"><a href="#">Cloudy with a Chance of Meatballs 2</a></li>--}}
                {{--                            </ul>--}}
                {{--                        </li>--}}

                {{--                        <li class="col-md-3 mega-menu__coloum">--}}
                {{--                            <h4 class="mega-menu__heading">Ending soon</h4>--}}
                {{--                            <ul class="mega-menu__list">--}}
                {{--                                <li class="mega-menu__nav-item"><a href="#">Escape Plan</a></li>--}}
                {{--                                <li class="mega-menu__nav-item"><a href="#">Rush</a></li>--}}
                {{--                                <li class="mega-menu__nav-item"><a href="#">Prisoners</a></li>--}}
                {{--                                <li class="mega-menu__nav-item"><a href="#">Enough Said</a></li>--}}
                {{--                                <li class="mega-menu__nav-item"><a href="#">The Fifth Estate</a></li>--}}
                {{--                                <li class="mega-menu__nav-item"><a href="#">Runner Runner</a></li>--}}
                {{--                            </ul>--}}
                {{--                        </li>--}}

                {{--                        <li class="col-md-3 mega-menu__coloum mega-menu__coloum--outheading">--}}
                {{--                            <ul class="mega-menu__list">--}}
                {{--                                <li class="mega-menu__nav-item"><a href="#">Insidious: Chapter 2</a></li>--}}
                {{--                            </ul>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}
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
                        <li><a href="#" class="auth__function-item">Phim đang theo dõi</a></li>
                        <li><a href="#" class="auth__function-item">Vé đã đặt</a></li>
                        <li><a href="#" class="auth__function-item">Thảo luận</a></li>
                        <li><a href="#" class="auth__function-item">Cài đặt</a></li>
                        <li><a href="#" class="auth__function-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a></li>
                        <form id="logout-form" action="{{ route('khachHang.dangXuat') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>

                </div>
                <a href="#" class="btn btn-md btn--warning btn--book btn-control--home login-window">Đặt vé</a>
            </div>
        @else
            <div class="control-panel">
                <a href="{{route('khachHang.dangNhapPage')}}" class="btn btn--sign login-window">Đăng nhập</a>
                <a href="#" class="btn btn-md btn--warning btn--book login-window">Đặt vé</a>
            </div>
        @endif
    </div>
</header>
