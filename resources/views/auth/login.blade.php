@extends('layout.base')

@section('content')
    <div>
        @if ($errors->any())
            <ul class="alert alert-danger">
                {!! implode('', $errors->all('<li>:message</li>')) !!}
            </ul>
        @endif

        <form action="{{ route('auth.login') }}" class="category-form" method="POST">
            @csrf
            <div>
                <h1 class="text-center">Login</h1>

                {{-- <div class="form-group">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div><br /> --}}

                <div>
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" placeholder="enter your email here..." required>
                </div><br />
                <div>
                    <label for="password">password</label>
                    <input type="password" name="password" id="password" placeholder="enter your password here..."
                        required>
                </div><br />

                <div>
                    <a href="">forget Password ?</a>
                </div><br />

                <div>
                    <button type="submit" class="button w-100 primary">Sign in</button>
                </div><br />
            </div>
        </form>
    </div>
@endsection
