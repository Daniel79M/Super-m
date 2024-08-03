@extends('layout.base')

@section('css')
    <style>
        canvas {
            width: 100% !important;
            aspect-ratio: 1/1;
        }
    </style>
@endsection

@section('content')
    @include('includes.sidebar')

    <div class="wrap-content">

        @include('includes.appbar')
        <br /><br /><br /><br /><br /><br />
        <form action="{{ route('sales.store') }}" method="POST" id="myForm">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif


            @csrf
            <div class="border datatable-cover">
                <table width="100%">
                    <tr>
                        <td>
                            <h2>Sélectionner les produits de la vente</h2>
                        </td>
                    </tr>
                </table><br />

                <table id="datatable" id="myTable">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nom</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th width="100" class="text-center">Validation</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }} F CFA</td>
                                <td>
                                    <input type="number" min="1" value="1" max="1000000"
                                        placeholder="quantité ..." name="quantities[{{ $product->id }}]" required />
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="products[]" value="{{ $product->id }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br />
                <table width="100%">
                    <tr>
                        <td><input type="date" class="dateInput" name="sale_date" required></td>
                        <td class="text-right sales">
                            <button type="submit" class="button w-100 primary">Soumettre</button>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
@endsection
