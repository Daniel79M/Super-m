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

        {{-- <div class="container">
            <h1>Liste des Ventes</h1>
            <table id="datatable" class=" stripe ">
                <thead>
                    <tr>
                        <th>ID Vente</th>
                        <th>Date</th>
                        <th>Produits</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <td>{{ $sale->id }}</td>
                            <td>{{ $sale->date }}</td>
                        </tr>
                        <tr>
                            @foreach ($sale->saleItems as $item)
                            <td>
                                <ul>
                                    
                                        <li>
                                            {{ $item->product->name }} - 
                                            {{ $item->quantity }} x 
                                            {{ ($item->price) }} F CFA
                                        </li>
                                </ul>
                            </td>
                        @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> --}}
    <div class="wrap-content">
        @include('includes.appbar')
        <br /><br /><br />
        <div id="result"></div>
        <div class="border datatable-cover">
            <table id="datatable" class="stripe">
                <thead>
                    <tr>
                        <th>ID Vente</th>
                        <th>Date</th>
                        <th>Produits</th>
                        <th>Quantité</th>
                        <th>Prix unitaire</th>
                        <th>Prix total</th>

                        <th width="100" class="text-center">
                            Opérations
                        </th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($sales as $sale)
                            <tr>
                                <td>
                                    {{ $sale->id }}
                                </td>
                                <td>
                                    {{ $sale->date }}
                                </td>
                                    <td class="text-center1">
                                        <ul >
                                            @foreach  ($sale->saleItems as $item)
                                            <li style="list-style-type: none">
                                                {{ $item->product->name }}
                                            </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul  style="list-style-type: none">
                                            @foreach  ($sale->saleItems as $item)
                                            <li>
                                                {{ $item->quantity }}
                                            </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul  style="list-style-type: none">
                                            @foreach  ($sale->saleItems as $item)
                                            <li>
                                                {{ number_format ($item->price) }} FCFA
                                                
                                            </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul style="list-style-type: none;">
                                            @php
                                                $totalPrice = 0;
                                            @endphp
                                            @foreach ($sale->saleItems as $item)
                                                @php
                                                    $totalPrice += $item->quantity * $item->price;
                                                @endphp
                                            @endforeach
                                            <li>{{ number_format($totalPrice) }} FCFA</li>
                                        </ul>
                                        
                                    </td>
                                
                                    <td class="text-center">
                                        
                                            <a href="" class="icon-button primary">
                                                <i class="fas fa-print"></i>
                                            </a>
                                        
                                        &nbsp;
                                        {{-- <form class="d-inline" action="{{ route('sale.destroy', $sale->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr(e) de vouloir supprimer le produit? Cette action sera irréversible !')"> --}}
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="icon-button error">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection