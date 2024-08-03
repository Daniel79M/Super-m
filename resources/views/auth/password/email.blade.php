@extends('layout.base')

@section('content')
<body class="dam">
    <div class="dd" >

        @if ($errors->any())
                <div class="alert alert-danger ">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        
        <form method="POST" class="category-form dan"  action="{{ route('otp.sendOtp') }}">

        <h1>Reset password</h1>
            @csrf
            <div >
                <label for="email">Email :</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <button type="submit" class="button w-100 primary">Send OTP code</button>
        </form>
        @if (session('status'))
            <div class="alert alert-success mt-3">
                {{ session('status') }}
            </div>
        @endif
    </div>
    
</body>
@endsection