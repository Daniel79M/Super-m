@extends('layout.base')

@section('css')
@endsection

@section('content')
    @include('includes.sidebar')

    <div class="wrap-content">
        @include('includes.appbar')

        <br /><br /><br /><br /><br /><br /><br /><br />

        <form action="{{ route('reports.generate') }}" class="category-form" method="POST">
            <h1>Rapport de Vente</h1>
            @csrf
            <label for="start_date">Date de Début:</label>
            <input type="date" id="start_date" name="start_date" required>
            <br>
            <label for="end_date">Date de Fin:</label>
            <input type="date" id="end_date" name="end_date" required>
            <br>
            <button type="submit" class="button w-100 primary">Afficher le bilan</button>
            <br />
        </form>
        <div class="report-tab">
            @if (isset($report))
                <h2>Bilan du {{ $report['start_date'] }} au {{ $report['end_date'] }}</h2>

                <p>
                    Chiffre d'affaires total: <b>{{ number_format($report['totalRevenue'][0]['total_revenue']) }} F CFA</b>
                </p>
                <p>
                    Quantité totale vendue: <b>{{ $report['totalQuantity'][0]['total_quantity'] }} </b>
                </p>

                <div class="border datatable-cover">
                    <table id="datatable" class="stripe">
                        <thead>
                            <tr>
                                <th>Nom du Produit</th>
                                <th>Prix Unitaire</th>
                                <th>Quantité Vendue</th>
                                <th>Prix Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($report['productsSold'] as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ number_format($product->unit_price) }} F CFA</td>
                                    <td>{{ $product->total_quantity }}</td>
                                    <td>{{ number_format($product->total_price) }} F CFA</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>
@endsection