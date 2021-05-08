<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>

</head>

<body>

    <h1>Get It At The Cheapest Price</h1>

    <h2> Products</h2>

    <h3>Laptops</h3>


    @foreach ($prods as $product )

    <li> Product: {{ $product->product_name }} </li>
    <li> Cost: {{ $product->product_cost }} </li>
    <li> <a href={{ $product->url }} > Buy Here</a></li> 

    <p>-----------------------------------------</p>
    @endforeach



</body>

</html>