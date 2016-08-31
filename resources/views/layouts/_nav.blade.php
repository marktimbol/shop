    @inject('cart', 'App\ShoppingCart\ShoppingCart')

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Laravel
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/cart') }}">Cart</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/dashboard') }}">
                                        My Account
                                    </a>
                                    <a href="{{ url('/logout') }}">
                                        <i class="fa fa-btn fa-sign-out"></i>Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    <li class="TopCart">
                        <a href="{{ url('/cart') }}">
                            <i class="fa fa-shopping-basket"></i>
                        </a>
                        <div class="TopCart--items">
                            @foreach( $cart->all() as $item )
                            <div class="TopCart--item">
                                <div class="TopCart--item-image">
                                    <img src="/images/watch-small.jpg" alt="" title="" class="img-responsive" />
                                </div>
                                <div class="TopCart--item-name">
                                    <h5>{{ $item->name }}</h5>
                                    <h6>AED {{ $item->price }}</h6>
                                </div>
                                <div class="TopCart--item-action">
                                    <span>&times;</span>
                                </div>
                            </div>
                            @endforeach

                            <hr />
                            <h4>Total: AED {{ $cart->subtotal() }}</h4>
                            <hr />

                            <p>
                                <a href="/cart" class="btn btn-default">Cart</a>
                                <a href="/checkout" class="btn btn-default">Checkout</a>
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>