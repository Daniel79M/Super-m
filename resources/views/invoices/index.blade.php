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
                            <th>Nom</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    {{ $product->name }}
                                </td>
                                <td>
                                    {{ number_format($product->price, 0, " ") }} F CFA
                                </td>
                                <td>
                                    {{ $product->quantity }}
                                </td>
                                <td>
                                    {{ $product->entire }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div><h3>TotalFinal :</h2></div>
            </div>
            <div class="text-position">
                <h3><span class="color">Super-Market</span> Vous Dit Merci Pour Votre Achat</h3>
            </div>
        </div>
        <div>
            <a href="{{ route('products.create') }}" class="button primary">
                Imprimer
            </a>
        </div>

    </div>
@endsection