@extends('layout.base')

@section('content')
<body class="dam">
    <div class="dd">
       
        <form method="POST"  class="category-form dan" action="{{ route('otp.verifyOtp') }}">

            @if ($errors->any())
            <ul class="alert alert-danger">
                {!! implode('', $errors->all('<li>:message</li>')) !!}
            </ul>
        @endif

            <h1>Verify OTP Code</h1>
            @csrf
            <input type="hidden" name="email" value="{{ session('otp_email') }}" required>
            <div>
                <label for="otp">Code OTP :</label>
                <input type="text" name="otp" id="otp" class="form-control" required>
            </div>
            <button type="submit" class="button w-100 primary">Verify OTP Code</button>
        </form>
    </div>
    
</body>
@endsection