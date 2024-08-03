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
            <br /><br /><br />
            @if (isset($report))
            <h2>Résultats</h2>
            <p>Chiffre d'affaires total: {{ number_format($report['totalRevenue'][0]['total_revenue']) }} F CFA</p>
            <p>Quantité totale vendue: {{ $report['totalQuantity'][0]['total_quantity'] }}</p>
        @endif
        </form>

    
    </div>
@endsection
