@extends('layouts.app')

@section('content')
@if(Session::has('success'))
<div class="alert alert-success">{{Session::get('success')}}</div>
@endif

@if(Session::has('fail'))
<div class="alert alert-danger">{{Session::get('fail')}}</div>
@endif
<div class="container mt-4">
    <h1><i class="bi bi-cart me-3" style="font-size: 33px; color:black;"></i>Cart</h1>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                {{-- user can click the row to go see the product --}}
                    @if($product['status'] == 'available'){{-- check the status  instead --}}
                        <tr>
                            <td><a href="{{route('show', $product['title'])}}" class="text-inherit text-decoration-none"><img src="{{asset('products-img')}}\{{ $product['photo'] }}" width="150px" height="auto" alt="{{ $product['title'] }}"></a></td>
                            <td><a href="{{route('show', $product['title'])}}" class="text-inherit text-decoration-none">{{ $product['title'] }}</a></td>
                            <td id="originPrice">{{ $product['price'] }} DH</td>
                            <td>
                                <div class="input-group flex-nowrap ">
                                    <input id="quantity" type="number" class="form-control" value="{{$product['pivot']['quantity']}}" min="1" max="{{$product['quantity']}}" style="min-width:100px">
                                    <div class="input-group-append">
                                        <span class="input-group-text rounded-0 rounded-end">KG</span>
                                    </div>
                                </div>
                            </td>
                            <td id="price"> DH</td>
                            <td>
                                <form action="{{route('deleteFromCart')}}" method="POST">
                                    @csrf
                                    <input id="user_id" type="hidden" name="user_id" value="{{Session::get('user')->id}}">
                                    <input id="product_id" type="hidden" name="product_id" value="{{$product['id']}}">
                                    <button class="btn btn-danger exclude-opacity">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @else
                        <tr style="background-color:#e2e3e575;" >
                                <td><img src="{{asset('products-img')}}\{{ $product['photo'] }}" style="opacity: 0.5" class="" width="150px" height="auto" alt="{{ $product['title'] }}"></td>
                                <td> <span style="opacity: 0.5">{{ $product['title'] }}</span> <span style="opacity: 0.5" class=" text-danger">(This product does not exist)</span> </td>
                                <td><span style="opacity: 0.5">{{ $product['price'] }}</span> <span style="opacity: 0.5">DH</span> </td>
                                <td>
                                    <div class="input-group flex-nowrap">
                                        <input type="number" class="form-control" disabled value="{{$product['pivot']['quantity']}}" min="1" max="{{$product['quantity']}}" style="min-width:100px; opacity: 0.5">
                                        <div class="input-group-append" style="opacity: 0.5">
                                            <span style="opacity: 0.5" class="input-group-text rounded-0 rounded-end">KG</span>
                                        </div>
                                    </div>
                                </td>
                                {{-- change the price --}}
                                <td> <span style="opacity: 0.5"></span> <span style="opacity: 0.5">{{ $product['price'] * $product['pivot']['quantity']}}DH</span> </td>
                            <td>
                                <form action="{{route('deleteFromCart')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{Session::get('user')->id}}">
                                    <input type="hidden" name="product_id" value="{{$product['id']}}">
                                    <button class="btn btn-danger exclude-opacity">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    @if(!$products)
        <div class="text-center mb-3">
            <p class="m-0"><i class="bi bi-cart-x-fill" style="font-size: 120px"></i></p>
            <p>Your cart is empty for the moment</p>
            <a href="{{route('store')}}" class="text-decoration-none btn btn-primary">See the latest products</a>
        </div>
    @endif

    <div class="text-right mt-3 ms-3">
        <p><strong>Total:</strong> <span id="total"> </span></p>
        <a href="{{route('checkout')}}" class="btn btn-primary">Checkout</a>
    </div>
</div>

<script>
    // send quantity to backend and modify the total
    let quantityInputs = document.querySelectorAll("#quantity");
    let userId = document.querySelector("#user_id").value;
    totalOfAllDiv = document.querySelector('#total');
    let totalOfAll = 0;

    window.addEventListener('load', (event) => {

        quantityInputs.forEach((input, index) => {
            let originPrice = parseInt(document.querySelectorAll('#originPrice')[index].innerText)
            quantity = input.value;
            totalPriceForProduct = originPrice * quantity;
            document.querySelectorAll("#price")[index].innerText = totalPriceForProduct + ' DH';

            totalOfAll = totalOfAll + totalPriceForProduct

            totalOfAllDiv.innerText = totalOfAll + ' DH';
        });
    });



    const handleChange = (event, index) => {
            let quantity = parseInt(event?.target?.value)
            let originPrice = parseInt(document.querySelectorAll('#originPrice')[index].innerText)
            let currentTotalPrice = parseInt(document.querySelectorAll("#price")[index].innerText)

            let productId = parseInt(document.querySelectorAll("#product_id")[index].value)

            let newPrice = originPrice * quantity

            if(!quantity){
                document.querySelectorAll("#price")[index].innerText = 0 + ' DH';
            } else {
                document.querySelectorAll("#price")[index].innerText = newPrice + ' DH';

                totalOfAll = (totalOfAll - currentTotalPrice) + newPrice;

                totalOfAllDiv.innerText = totalOfAll + ' DH';

                fetch('{{ route('updateQuantityPrice') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        quantity: quantity,
                        userId: userId,
                        productId: productId
                    })
                })
                .then(response => response.json())
                .then(data => console.log(data))
                .catch(error => console.log(error));
            }
        }

        quantityInputs.forEach((input, index) => {
            input.addEventListener("change", (event) => handleChange(event, index));
            input.addEventListener("keyup", (event) => handleChange(event, index));
        });

</script>


@endsection
