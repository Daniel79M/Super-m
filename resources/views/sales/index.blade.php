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


        @include('includes.appbar')
    <div class="wrap-content">
        <div id="result"></div>
        <div class="border datatable-cover">
            <table id="datatable" class="stripe">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th width="100" class="text-center">
                            Opérations
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach () --}}
                        <tr>
                            <td>
                                {{ 0 }}
                            </td>
                            <td>
                                {{-- {{ number_format($product->price, 0, " ") }} F CFA --}}
                            </td>
                            <td>
                                {{ 0 }}
                            </td>
                            <td class="text-center">
                                <a href="" class="icon-button primary">
                                    <i class="fas fa-pen-to-square"></i>
                                </a>
                                &nbsp;
                                <form class="d-inline" action="" method="POST" onsubmit="return confirm('Êtes-vous sûr(e) de vouloir supprimer le produit? Cette action sera irréversible !')">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="icon-button error">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    {{-- @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
@endsection