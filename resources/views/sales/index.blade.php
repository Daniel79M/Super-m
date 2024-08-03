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
        <br /><br /><br />
        <div id="result"></div>
        <br /><br /><br />
        <div class="border datatable-cover">
            <table width="100%">
                <tr>
                    <td>
                        <h2>Liste des ventes</h2>
                    </td>
                    <td class="text-right">
                        <a href="{{ route('sales.create') }}" class="button primary">
                            Effectuer une vente
                        </a>
                    </td>
                </tr>
            </table><br />
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
                                <ul>
                                    @foreach ($sale->saleItems as $item)
                                        <li style="list-style-type: none">
                                            {{ $item->product->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul style="list-style-type: none">
                                    @foreach ($sale->saleItems as $item)
                                        <li>
                                            {{ $item->quantity }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul style="list-style-type: none">
                                    @foreach ($sale->saleItems as $item)
                                        <li>
                                            {{ number_format($item->price) }} FCFA

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

                                <a href="{{ route('invoices.show', ['sale_id' => $sale->id]) }}"
                                    class="icon-button primary">
                                    <i class="fas fa-print"></i>
                                </a>

                                &nbsp;
                                <form class="d-inline" action="{{ route('sales.destroy', $sale->id) }}" method="POST"
                                    onsubmit="return confirm('Êtes-vous sûr(e) de vouloir supprimer le produit? Cette action sera irréversible !')">
                                    @csrf
                                    @method('DELETE')
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
