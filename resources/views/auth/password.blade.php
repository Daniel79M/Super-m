@extends('layout.base')

@section('content')
<body class="dam">
    <div>
        <form method="POST" class="category-form dan" action="{{ route('password.update') }}">
            <h1>Password change </h1>
            @csrf
            <div>
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div >
                <label for="password">New Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div>
                <label for="password_confirmation">Confirm New Password:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="button w-100 primary">Reset Password</button>
        </form>
    </div>
</body>
@endsection
