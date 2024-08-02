@extends('layout.base')

@section('content')
@include('includes.appbar')
@include('includes.sidebar')
<div class="container">
    <h1>Statistiques des Chiffres d'Affaires Mensuels</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mois</th>
                <th>Chiffre d'Affaires</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach($sales as $sale) --}}
                <tr>
                    {{-- <td>{{ Carbon\Carbon::createFromDate($sale->year, $sale->month, 1)->format('F Y') }}</td>
                    <td>{{ number_format($sale->total_amount, 2) }} FCFA</td> --}}
                </tr>
            {{-- @endforeach --}}
        </tbody>
    </table>
</div>
@endsection

