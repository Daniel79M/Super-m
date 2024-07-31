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
    </div>
@endsection