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
        <br/><br/><br/><br/><br/><br/>
        <form action="{{ route('sales.store') }}" method="POST" id="myForm">
            @csrf
            <div class="border datatable-cover">
                <table id="datatable" id="myTable">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nom</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th width="100" class="text-center">Validation</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ ($product->price) }} F CFA</td>
                                <td>
                                    <input type="number" min="1" value="1" max="1000000" placeholder="quantité ..."
                                        name="quantities[{{ $product->id }}]" required />
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="products[]" value="{{ $product->id }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br />
                <table width="100%">
                    <tr>
                        <td><input type="date" class="dateInput" name="sale_date" required></td>
                        <td class="text-right sales">
                            <button type="submit" id="">Soumettre</button>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
            {{-- <div>
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
            
                @csrf
                <div class="border datatable-cover">
                    <table id="datatable" id="myTable">
                        <thead>
                            <tr>
                                <th  class="text-center1">id</th>
                                <th>Nom</th>
                                <th>Prix</th>
                                <th>Quantité</th>
                                <th width="100" class="text-center">
                                    Validation
                                    <input type="checkbox" name="" id="select_all_ids">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            @foreach ($products as $product)`
                                <tr >
                                    <td  class="text-center1 ">
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
                                        <input type="checkbox" name="ids" id="" class="checkbox_ids" value="value">
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                        <tr class="">
                            <table width="100%">
                        
                            </table>
                        </tr>
                    </table>
                    <br />
                    
                    
                </div>
            
        </div> --}}
        
        {{-- <script>
            $(function(e){
                $("#select_all_ids").click(function(){
                    $('.checkbox_ids').prop('checked',$(this).prop('checked'));
                });
            });
        
        </script> --}}
    </div>
@endsection