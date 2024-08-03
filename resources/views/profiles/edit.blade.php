@extends('layout.base')

@section('content')

    <body class="dam">
        <div >
            @if ($errors->any())
                <ul class="alert alert-danger">
                    {!! implode('', $errors->all('<li>:message</li>')) !!}
                </ul>
            @endif
    
            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif
            <form action="{{ route('profiles.update', ['id' => $user->id]) }}" class="category-form dan" method="POST">
                @csrf
                <h1 class="text-center">Editer votre profil</h1>
                <div >
                    <label for="name">Nom</label>
                    <input type="text" class="
                            @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
    
                <div>
                    <label for="email">Email</label>
                    <input type="email" class=" 
                            @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
    
                <button type="submit" class="button w-100 primary">Mettre à jour</button>
            </form>
    
        </div>
    </body>
@endsection
