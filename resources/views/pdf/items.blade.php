<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Items List</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 70px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        th {
            font-weight: bold;
            background-color: #f2f2f2;
        }
        .footer {
            position: fixed;
            bottom: 0;
            text-align: center;
            font-size: 10px;
        }
    </style>
</head>
<body>

<div class="header">
    <img src="{{ public_path('icons/Nihal_das.png') }}" style="height:120px; width:120px;">

    <h2>Das & Co.</h2>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Item Name</th>
            <th>Price</th>
            <th>Available Stock</th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->item_name }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->stock_quantity }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="footer">
    Generated on: {{ now()->format('d-m-Y H:i:s') }}
</div>

</body>
</html>
