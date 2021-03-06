<!-- NAVBAR WITH RESPONSIVE TOGGLE -->

<nav class="navbar navbar-expand-sm navbar-light bg-light mb-3">
    <div class="container">
        <a class="navbar-brand" href="#">BOOKIS</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home.index')}}">خانه</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">مدیریت دیتابیس</a>
                    <div class="dropdown-menu">
                        <a href="{{route('admin.users.index')}}" class="dropdown-item"> کاربران </a>
                        <a href="{{route('admin.books.index')}}" class="dropdown-item"> کتابها </a>
                    </div>
                </li>
                {{--                وقتی کاربر لاگین نیست--}}
                @unless(auth()->user())
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('auth.index')}}">  ورود یا ثبت نام </a>
                    </li>
                @else
                    {{--                وقتی کاربر لاگین است--}}
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle"
                           data-toggle="dropdown">{{auth()->user()->id}}</a>
                        <div class="dropdown-menu">
                            {{--                    <a href="#" class="dropdown-item"> لینک دوم </a>--}}
                            {{--                    <a href="#" class="dropdown-item"> لینک سوم </a>--}}
                            <a href="{{route('auth.logout',['user'=>auth()->user()])}}" class="dropdown-item"> خروج </a>
{{--                            <a href="{{route('logout')}}" class="dropdown-item"> خروج </a>--}}
                        </div>
                    </li>
                @endunless
            </ul>
        </div>
    </div>
</nav>
