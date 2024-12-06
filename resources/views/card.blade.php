<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100%;
        }
        .card {
            width: 20%;
            height: 60vh;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-direction: column;
            border: 1px solid black;
        }
        .lang {
            display: flex;
            justify-content: flex-end;
            width: 100%;
            height: 3%;
        }
        .company-name {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 5%;
        }
        .product-image {
            border: 1px solid black;
            width: 80%;
            height: 30%;
            display: flex;
            justify-content: center;
            align-items: center;

        }
        .product-image img {
            width: 100%;
            height: 100%;
        }
        .GTIN {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .desc {
            width: 80%;
            height: 20%;
            margin-bottom: 20px
        }
        .weight {
            width: 80%;
            margin-bottom: 10%;
        }
        .lang button {
            border: none;
            background:none;
            margin: 10px;
            cursor: pointer;
        }

    </style>
</head>
<body>
    <div class="card">
        <div class="lang"><button>EN</button><button>FR</button></p></div>
        <div class="company-name"><p>{{ $company->name }}</p></div>
        <div class="product-image"><img src="" alt="product image"></div>
        <div class="GTIN"><p>{{ $gtin }}</p></div>
        <div class="desc"><p>{{ $product->description }}</p></div>
        <div class="weight"><p>weight: {{ $product->gross }}</p><p>net content weight: {{ $product->net }}{{ $product->unit }}</p></div>
    </div>
</body>
</html>
