@extends('layout.base')

@section('content')
    <div>
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
        <form action="{{ route('profiles.update', ['id' => $user->id]) }}" class="category-form" method="POST">
            @csrf
            <h1 class="text-center">Editer votre profil</h1>
            <div class="form-group">
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

        {{-- @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif --}}

        {{-- <form action="{{ route('profile.update', ['id' => $user->id]) }}" method="POST">
                    @csrf
                    <div class="card mt-5 p-3">
                        <h2 class="text-center">Editer votre profil</h2>

                        <div class="form-group">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" id="name" name="name" class="form-control" required
                                value="{{ Auth::user()->name }}">
                        </div><br />

                        <div>
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" name="email" id="email" placeholder="enter your email here..."
                                class="form-control" required>
                        </div><br />

                        {{-- <div>
                            <label for="password" class="form-label">password</label>
                            <input type="password" name="password" id="password"
                                placeholder="enter your password here..." class="form-control" required>
                        </div><br /> --}}

        {{-- <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Valider</button>
                        </div><br />

                        <div class="d-flex">
                            <p>Déjà un compte ?</p>&nbsp;
                            <a href="">S'inscrire </a>
                        </div><br />


                    </div> --}}


        {{-- </form> --}}
    </div>
@endsection
