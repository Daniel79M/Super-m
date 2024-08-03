<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture {{ $sale->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #ffffff;
            border: var(--primary-color) solid 2px;
            display: inline-block;
            width: 100%;
            margin: auto;
            padding: 10px;
            border: 1px solid #6d6b6b;
            border-radius: 5px;

        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .total {
            text-align: left;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="container">

        <h2>Facture {{ $sale->id }}</h2>

        <table>
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

        <div class="total">
            <h2>Total: {{ number_format($total_sale, 0, ' ') }} FCFA</h2>
        </div>
    </div>
    <div class="footer">
        <h3><span style="color: #007bff;">Super-Market</span> Vous Dit Merci Pour Votre Achat</h3>
    </div>
</body>

</html>
