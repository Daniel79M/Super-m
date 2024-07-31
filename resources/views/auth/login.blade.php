
{{-- @extends("base") --}}
@extends('layout.base')

@section('content')

    <body class="dam">
        {{-- <h1>Se connecter</h1> --}}

        <div>
            <div>
                <form action="{{ route('auth.login') }}" method="post" class="category-form dan" >

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            {!! implode('', $errors->all('<li>:message</li>')) !!}
                        </ul>
                    @endif

                    @csrf
                    <div>
                        <h1 class="text-center">To log in</h1>
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="title" name="name">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </div>


                    <div >
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email') }}">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>

                    <div>
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </div>
                    <a href="{{ route('password.request')}}">Mot de passe oublier?</a><br><br>

                    <button class="button w-100 primary">To log in</button>
                </form>
            </div>
           
        </div>
    </body>

@endsection
