<header class="app-bar">
    <table width="100%">
        <tr>
            <td>
                <a href="{{ route('home') }}">
                    <b class="title">Home</b>
                </a>
            </td>
            <td class="text-right">
                
            @if ($errors->any())
                {{-- <ul class="alert alert-danger">
                    {!! implode('', $errors->all('<li>:message</li>')) !!}
                </ul> --}}
            @endif
            <form action="{{ route('auth.logout') }}" method="POST">
                @csrf
                <button type="submit" class="button tertiary">Se deconnecter</button>
            </form>
            </td>
        </tr>
    </table>
</header>