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
                        <h2>Factures</h2>
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
                            <th>Prix</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($products as $product) --}}
                            <tr>
                                <td>
                                    
                                </td>
                                <td>
                                    {{-- {{ $product->name }} --}}
                                </td>
                                <td>
                                    {{-- {{ number_format($product->price, 0, " ") }} F CFA --}}
                                </td>
                                <td>
                                    {{-- {{ $product->quantity }} --}}
                                </td>
                            </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
                <div><h3>TotalFinal :</h2></div>
            </div>
            <div class="text-position">
                <h3><span class="color">Super-Market</span> Vous Dit Merci Pour Votre Achat</h3>
            </div>
        </div>
        <div>
            <a href="{{}}" class="button primary">
                Imprimer
            </a>
        </div>

    </div>
@endsection