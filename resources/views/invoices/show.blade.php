@extends('layout.base')

@section('content')
    @include('includes.sidebar')

    <div class="wrap-content">
        @include('includes.appbar')

        <br /><br /><br />
        <div class="container">
            <table width="100%">
                <tr>
                    <td>
                        <h2>Facture {{ $sale->id }}</h2>
                    </td>
                </tr>
            </table><br />
            @if ($message = Session::get('success'))
                <ul class="alert alert-success">
                    <li>{{ $message }}</li>
                </ul>
            @endif

            <div class="border datatable-cover">
                <table id="myTable" class="dataTable stripe">
                    <thead>
                        <tr>
                            
                            <th>Date</th>
                            <th>Produits</th>
                            <th>Quantité</th>
                            <th>Prix unitaire</th>
                            <th>Prix total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sale->saleItems as $item)
                            <tr>
                                
                                <td>{{ $sale->date }}</td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->price, 0, ' ') }} FCFA</td>
                                <td>{{ number_format($item->quantity * $item->price, 0, ' ') }} FCFA</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div>
                    <h3>Total: {{ number_format($total_sale, 0, ' ') }} FCFA</h3>
                </div>
            </div>

            <div class="text-position">
                <h3><span class="color">Super-Market</span> Vous Dit Merci Pour Votre Achat</h3>
            </div>
        </div>
        <div>
            <a href="{{ route('invoices.pdf', ['sale_id' => $sale->id]) }}" class="button primary">
                Imprimer
            </a>
        </div>
    </div>
@endsection
