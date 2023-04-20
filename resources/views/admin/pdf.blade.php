<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 80%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: center;
  padding: 8px;

}
th{
    color: rgb(77, 59, 126);
}


tr:nth-child(even) {
  background-color: #dddddd;
}

tr:hover {background-color: rgba(68, 68, 68, 0.438);}

.continer{
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    width: 100%;
    margin: auto;
}
</style>
<body >
        
    <h1 style="text-align: center; color:rgb(77, 59, 126);">Order Details</h1>

<div class="continer">
    <table >
        <tr>
            <th>Customer Name</th>
            <th>Customer Email</th>
            <th>Customer Phone</th>
            <th>Customer Address</th>
            <th>Customer   ID</th>
            
        </tr>
        <tr>
            <td>{{$order->name}}</td>
            <td>{{$order->email}}</td>
            <td>{{$order->phone}}</td>
            <td>{{$order->address}}</td>
            <td>{{$order->user_id}}</td>
            
        </tr>
    </table>

    <br>

    <table >
        <tr>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Product Quantity</th>
            <th>Product Status</th>
            <th>Product Id</th>
            <th>Product Image</th>
        </tr>
        <tr>
            <td>{{$order->product_title}}</td>
            <td>{{$order->price}}</td>
            <td>{{$order->quantity}}</td>
            <td>{{$order->payment_status}}</td>
            <td>{{$order->product_id}}</td>
            <td><img style="height:100px; width:100px;" src="product/{{$order->image}}" alt=""></td>
        </tr>
    </table>

    

</div>
   
</body>
</html>