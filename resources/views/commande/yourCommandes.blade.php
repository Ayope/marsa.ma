@extends('layouts.app')

@section('content')

<div class="container mt-3">
    @php
        $totalProducts = 0;
    @endphp

    <h1>Your Orders</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Date</th>
                <th scope="col">Bill-to name</th>
                <th scope="col">Total</th>
                <th scope="col">Order status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($command as $c)
                <tr class="table-secondary">
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->created_at }}</td>
                    <td>{{Session::get('user')->first_name . ' ' . Session::get('user')->last_name}}</td>
                    <td id="totalDisplayed{{ $c->id }}"></td>
                    <td>{{ $c->status }}</td>
                    <td>
                    @if($c->status != 'canceled' && $c->status != 'delivered')
                        <a href="{{route('cancel', ['user_id' => Session::get('user')->id, 'command_id' => $c->id])}}" class='btn btn-danger mb-2'>Cancel</a>
                    @else
                        <a class='btn btn-danger disabled mb-2' disabled>Cancel</a>
                    @endif
                        <button id="showProduct" class="btn btn-primary mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#products-{{ $c->id }}" aria-expanded="false" aria-controls="products-{{ $c->id }}">
                            show more
                        </button>
                    </td>
                </tr>
                    <tr id="products-{{ $c->id }}" class="collapse">
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                    @foreach($c->product as $p)
                    @php
                        $totalProducts += $p->price * $p->pivot->quantity
                    @endphp
                        @if($p->status == 'available')
                            <tr id="products-{{ $c->id }}" class="collapse table-striped">
                                <td><a href="{{route('show', $p->title)}}" class="text-inherit text-decoration-none"><img src="{{asset('products-img')}}\{{ $p->photo }}" width="150px" height="auto" alt="{{ $p->title }}"></a></td>
                                <td><a href="{{route('show', $p->title)}}" class="text-inherit text-decoration-none">{{ $p->title }}</a></td>
                                <td>{{ $p->price }} DH</td>
                                <td>
                                    <div class="input-group flex-nowrap ">
                                        <input id="quantity" type="number" class="form-control" value="{{$p->pivot->quantity}}" disabled style="min-width:100px">
                                        <div class="input-group-append">
                                            <span class="input-group-text rounded-0 rounded-end">KG</span>
                                        </div>
                                    </div>
                                </td>
                                <td>{{$p->price * $p->pivot->quantity}} DH</td>
                                <td></td>
                            </tr>
                        @else
                            <tr style="background-color:#e2e3e575;" id="products-{{ $c->id }}" class="collapse table-striped">
                                <td><img src="{{asset('products-img')}}\{{ $p->photo }}" style="opacity: 0.5" class="" width="150px" height="auto" alt="{{ $p->title }}"></td>
                                <td> <span style="opacity: 0.5">{{ $p->title }}</span> <span style="opacity: 0.5" class=" text-danger">(This product does not exist)</span> </td>
                                <td><span style="opacity: 0.5">{{ $p->price }}</span> <span style="opacity: 0.5">DH</span> </td>
                                <td>
                                    <div class="input-group flex-nowrap">
                                        <input type="number" class="form-control" disabled value="{{$p->pivot->quantity}}" disabled style="min-width:100px; opacity: 0.5">
                                        <div class="input-group-append" style="opacity: 0.5">
                                            <span style="opacity: 0.5" class="input-group-text rounded-0 rounded-end">KG</span>
                                        </div>
                                    </div>
                                </td>
                                {{-- change the price --}}
                                <td> <span style="opacity: 0.5"></span> <span style="opacity: 0.5">{{ $p->price * $p->pivot->quantity}}DH</span> </td>
                                <td></td>
                            </tr>
                        @endif

                    @endforeach

                    <input type="hidden" id="totalCalculated{{ $c->id }}" value="{{$totalProducts}}">

                    <script>
                        total = document.getElementById('totalCalculated{{ $c->id }}')
                        totalDiv = document.getElementById('totalDisplayed{{ $c->id }}')

                        function putPrice(total){
                            totalDiv.innerText = total.value + ' DH';
                        }

                        putPrice(total);

                    </script>

                    @php
                        $totalProducts = 0;
                    @endphp
                </div>

            @endforeach
        </tbody>
    </table>
</div>

<script>
    showBtn = document.getElementById('showProduct');
    showBtn.addEventListener('click', ()=>{
        if(showBtn.innerText == 'show more'){
            showBtn.innerText = 'show less'
        }else{
            showBtn.innerText = 'show more'
        }
    })
</script>
@endsection
