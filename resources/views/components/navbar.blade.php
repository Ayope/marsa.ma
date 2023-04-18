<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm w-100">
    <div class="container">
        {{-- redirect to route('store') only if he had role client --}}
        <a class="navbar-brand" href="{{ route('store') }}">
            <img src="{{asset('images/Marsa.ma.png')}}" height="45px" alt="marsa.ma">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            {{-- show it only if he had client role --}}
            <ul class="navbar-nav ms-auto mt-1">
                <li class="nav-item">
                    <form class="d-flex" action="{{route('search')}}" method="POST">
                        @csrf
                        <input class="form-control me-2" name='search' type="search" placeholder="Search" aria-label="Search" size="30" oninput="checkInput()">
                        <button class="btn btn-outline-dark" type="submit" id="submit-btn" disabled><i class="bi bi-search"></i></button>
                    </form>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto d-flex flex-row">
                @if(Session::get('user')->roles[0]->name == 'client')
                <li class="nav-item me-3">
                    <a href="{{route('showCart',  ['user_id' => Session::get('user')->id])}}" class="text-decoration-none">
                        <span class="fa-layers fa-fw">
                            <i class="bi bi-cart" style="font-size: 33px; color:black;"></i>
                            <span class="badge rounded-pill badge-notification bg-success">
                                {{ $productCount = app('App\Http\Controllers\CommandController')->CartCount(Session::get('user')->id)}}
                            </span>
                        </span>
                    </a>
                </li>
                @endif
                <!-- Authentication Links -->
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <img src="{{asset('profile-img')}}/{{Session::get('user')->photo}}" height="40px" width="40px" class="rounded-circle" alt="{{Session::get('user')->first_name . ' ' . Session::get('user')->last_name}}">

                        {{-- change the src by an input comes from database --}}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('commandes', Session::get('user')->id)}}">
                            {{ __('Orders') }}
                        </a>

                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
function checkInput() {
    const input = document.querySelector('input[name="search"]');
    const submitBtn = document.querySelector('#submit-btn');

    if (input.value.trim().length > 0) {
    submitBtn.disabled = false;
    } else {
    submitBtn.disabled = true;
    }
}
</script>

