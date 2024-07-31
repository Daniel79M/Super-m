<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ URL::asset('assets/icons/fontawesome/css/all.min.css') }}">
    <title>Document</title>
</head>
<body>
    <header class="app-bar">
        <table width="100%">
            <tr>
                <td>
                    <a href="{{ route('home') }}">
                        <b>Home</b>
                    </a>
                </td>
                <td class="text-right">
                    
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        {!! implode('', $errors->all('<li>:message</li>')) !!}
                    </ul>
                @endif
                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="button tertiary">Se deconnecter</button>
                </form>
                </td>
            </tr>
        </table>
    </header>
</body>

</html>
