<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order</title>
    <style>
        body {
            font-family: sans-serif;
        }
        table,th,td{
            width: 100%;
            border: 0.5px solid;
            /* border-collapse: collapse; */
        }
        h3{
            text-align : center;
        }
    </style>
</head>
<body>
    <h3>RESTO-LUMEN REPORT ORDERS</h3>
    <p>Customer Name : {{$customer->customers->customer_name}}</p>
    <p>Total Price : Rp. {{$customer->customers->total_price}}</p>
    <p>Qty : {{$customer->qty}}</p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Menu Items</th>
                <th>Qty</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $order)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$order->menus->name}}</td>
                <td>{{$order->qty}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>