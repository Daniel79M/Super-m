<header class="app-bar">
    <table width="100%">
        <tr>
            <td>
                <a href="{{ route('home') }}">
                    <b>Home</b>
                </a>
            </td>
            <td class="text-right">
                <a href="">
                    <form action="{{ route('auth.logout')}}" method="post">
                        @method("delete")
                        @csrf
                        <button class="btn-deconnect">Se deconnecter</button>

                    </form>
                    {{-- <a href="{{ route('auth.login')}}">Se deconnecter</a> --}}
                </a>
            </td>
        </tr>

        
    </table>
</header>