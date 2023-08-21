<div id="checkout">
	CHECKOUT
</div>

<div id="info">
	<p class="i1">Add to cart interaction prototype by Virgil Pana</p>
<p>    Follow me on <a href="https://dribbble.com/virgilpana" style="color:#ea4c89" target="_blank">Dribbble</a> | <a style="color:#2aa9e0" href="https://twitter.com/virgil_pana" target="_blank">Twitter</a></p>
</div>

<div id="header">	
	<ul>
        <li><a href="{{url('/')}}">HOME</a></li>
        <li><a href="">BRANDS</a></li>
        <li><a href="">DESIGNERS</a></li>
        <li><a href="">CONTACT</a></li>
        <form action="search" method="GET">
            <li>
                <input type="text" name="key" class="search-input" placeholder="Nhập từ khóa tìm kiếm">
                <button type="submit"><i class="fa fa-search"></i></button>
            </li>
        </form>
        @if(session()->has('customer_email'))
            @php
            $customer_email = session('customer_email');
            $namek = DB::table('users')->where('email', $customer_email)->select('name')->first();
            $name = $namek->name;
            @endphp
            <li style="margin-left: 400px;"><a>Hello {{ $name }}</a></li>
            <li><a href="{{ url('logout') }}">Logout</a></li>
        @else
            <li style="margin-left: 500px;"><a href="{{ url('login') }}">Login</a></li>
            <li><a href="{{ url('register') }}">Register</a></li>
        @endif
                           
    </ul>

</div>