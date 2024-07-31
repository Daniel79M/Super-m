@extends('layout.base')

<<<<<<< HEAD
@section('css')
    <style>
        canvas {
            width: 100% !important;
            aspect-ratio: 1/1;
        }
    </style>
@endsection

=======
>>>>>>> 462f19c3d3b81c36d8f96ddf15c40607acd5471b
@section('content')
    @include('includes.sidebar')

    <div class="wrap-content">
<<<<<<< HEAD

        @include('includes.appbar')
        <br/>
        
            <div>
                <table width="100%">
                    <tr>
                        <td>
                            <h2>Choisir les produits Achetés</h2>
                        </td>
                    </tr>
                </table><br />

                @if ($message = Session::get('success'))
                    <ul class="alert alert-success">
                        <li>{{ $message }}</li>
                    </ul>
                @endif
            <form action="{{ route('sales.index') }}" method="POST" id="myForm">
                @csrf
                <div class="border datatable-cover">
                    <table id="datatable" id="myTable">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Nom</th>
                                <th>Prix</th>
                                <th>Quantité</th>
                                <th width="100" class="text-center">
                                    Validation
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            @foreach ($products as $product)`
                                <tr >
                                    <td>
                                        {{ $product->id }}
                                    </td>
                                    <td>
                                        {{ $product->name }} 
                                    </td>
                                    <td>
                                        {{ number_format($product->price, 0, " ") }} F CFA
                                    </td>
                                    <td>
                                        <input type="number" min="1" value="5" max="1000000" placeholder="quantité ..."
                                            id="quantity" class="dateInput" name="quantity" required />
                                    </td>
                                    <td class=" text-center1">
                                        <input type="checkbox" name="options" id="validate" value="value">
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    <br />
                    <table width="100%">
                        <tr class="">
                            <td>
                                <input type="date" class="dateInput" name="" id="">
                            </td>
                            <td class="text-right sales">
                                <button type="submit">Submit</button>
                                {{-- <a href="#" class="button primary" onclick="getCheckedValues()">
                                    valider la vente
                                </a> --}}
                            </td>
                        </tr>
                    </table>
                    
                </div>
            </form>
        </div>
        
        {{-- <script>
            const questionContainer = document.querySelector(".click-event");
            
            const response = document.querySelector("#true");
            


            questionContainer.addEventListener("click", () => {
            questionContainer.classList.toggle("question-clicked")
            response.style.background = "green"
        });
        </script> --}}
=======
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
>>>>>>> 462f19c3d3b81c36d8f96ddf15c40607acd5471b
    </div>
@endsection