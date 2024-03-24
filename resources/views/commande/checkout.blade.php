@extends('layouts.app')

@section('content')
    <div class="container d-flex flex-column w-100 justify-content-center my-3 containerOfAll">
        <form action="{{route('confirm')}}" method="POST">
            @csrf
            <div class="card mb-3">
                <div class="d-flex justify-content-between card-header bg-success text-white">
                    <h5 class="mb-0">Address</h5>
                    <a href="{{route('profile', Session::get('user')->id)}}" class="d-flex align-items-center text-dark">
                        Modify {{-- this goes to the profile edit page --}}
                    </a>
                </div>
                <div class="card-body">
                    <p class="card-text">{{Session::get('user')->first_name . ' ' . Session::get('user')->last_name}}
                        <br>{{Session::get('user')->address}}
                        <br>{{Session::get('user')->phone_number}}
                    </p>
                </div>
            </div>
            @php
                $total = 0;
            @endphp
            <div class="card mb-3">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Delivery</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">delivered to your addresss
                        <br> <span class="text-secondary">Our team gonna call you for confirmation</span>
                    </p>
                    <div class="d-flex flex-wrap justify-content-center">
                        @foreach ($products as $product)
                        <div class="text-center mb-3 ms-3">
                            <img class="img-fluid float-left" style="height: 100px; width:auto"
                                src="{{asset('products-img')}}/{{$product['photo']}}"
                                alt="product image">
                            <p class="card-text mb-0">{{$product['title']}}</p>
                            <p class="card-text text-muted mb-0">Price: {{$product['price']}} DH</p>
                            <p class="card-text text-muted small">QTT: {{$product['pivot']['quantity']}}</p>
                        </div>
                        @php
                            $total += $product['price'] * $product['pivot']['quantity']
                        @endphp
                        @endforeach
                        @if (!$products)
                            <div class="d-flex flex-column align-items-center justify-content-center">
                                <h4 class="mb-3">No products here yet</h4>
                                <a href="{{route('store')}}" class="btn btn-success"><i class="bi bi-cart"></i> Continue shopping</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center bg-success py-2">
                  <div class="d-flex align-items-center">
                    <h5 class="ml-2 mb-0  text-white font-weight-bold">Payment method</h5>
                  </div>
                  <a href="#" id="modify-link" class="d-flex align-items-center text-dark">Modify</a>
                </div>
                <div class="card-body d-flex justify-content-between align-items-center py-2" id="card-body-content">
                  <div class="d-flex align-items-center">
                    <div>
                        <input type="hidden" value="offline" name="PaymentMethod">
                        <input type='hidden' value='{{Session::get('user')->id}}' name="user_id">
                        <span class="d-block font-weight-bold">Payment by cash</span>
                        <span class="d-block text-muted">Pay in cash as soon as you receive your order</span>
                    </div>
                  </div>
                </div>
              </div>


            <div class="my-3 border border-dark p-3 w-100 rounded total">
                <p>Total Products: <span>{{$total}}</span> DH</p>
                <p>Delivery: <span>25</span> DH</p>
                <hr>
                <p><strong> Total:</strong> <span>{{$total + 25}}</span> DH</p>

                @if($products)
                    <button type="submit" class="btn btn-success">
                        Confirm commande
                    </button>
                @else
                    <button type="submit" class="btn btn-success" disabled>
                        Confirm commande
                    </button>
                @endif
            </div>
        </form>
    </div>

    <style>
        @media (min-width: 1000px) {
            .containerOfAll {
                max-width: 75%;
            }
            .total{
                max-width: 25%;
            }

        }
    </style>

    <script>
        // Get the necessary elements
const modifyLink = document.querySelector('#modify-link');
const cardBodyContent = document.querySelector('#card-body-content');

// Define the options for the dropdown
const options = [
    { value: 'offline', text: 'Payment by cash' },
    { value: 'online', text: 'Payment by credit card' },
];

// Add an event listener to the "Modifier" link
modifyLink.addEventListener('click', function(event) {
  event.preventDefault();

  // Create the dropdown element
  const dropdown = document.createElement('select');

  // Add the options to the dropdown
  options.forEach(function(option) {
    const optionElement = document.createElement('option');
    optionElement.value = option.value;
    optionElement.textContent = option.text;
    dropdown.appendChild(optionElement);
  });

  // Replace the card body content with the dropdown
  cardBodyContent.innerHTML = '';
  cardBodyContent.appendChild(dropdown);

  // Add an event listener to the "Done" button
  const doneButton = document.createElement('button');
  doneButton.textContent = 'Done';
  doneButton.classList.add('btn', 'btn-success');

  doneButton.addEventListener('click', function() {
    // Get the selected option from the dropdown
    const selectedOption = dropdown.options[dropdown.selectedIndex];
    // Replace the dropdown with the selected option
    const newContent = document.createElement('div');
    let description;

    if(selectedOption.value == 'offline'){
        description = 'Pay in cash as soon as you receive your order.'
        newContent.innerHTML = `
            <span class="d-block font-weight-bold">${selectedOption.text}</span>
            <input type='hidden' value='${selectedOption.value}' name="PaymentMethod">
            <input type='hidden' value='{{Session::get('user')->id}}' name="user_id">
            <span class="d-block text-muted">${description}</span>
        `;
    } else {
        description = 'Easy, secure, and helps avoid any contact with coins or bills.'
        newContent.innerHTML = `
            <span class="d-block font-weight-bold">${selectedOption.text}</span>
            <input type='hidden' value='${selectedOption.value}' name="PaymentMethod">
            <input type='hidden' value='{{Session::get('user')->id}}' name="user_id">
            <span class="d-block text-muted">${description}</span>

            <div>
                <div class="form-group row my-3">
                    <label for="card_number" class="col-md-4 col-form-label text-md-right">{{ __('Card Number') }}</label>

                    <div class="col-md-6">
                        <input id="card_number" type="text" class="form-control @error('card_number') is-invalid @enderror" name="card_number" value="{{ old('card_number') }}" required autocomplete="card_number" autofocus>

                        @error('card_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="security_code" class="col-md-4 col-form-label text-md-right">{{ __('Security Code') }}</label>

                    <div class="col-md-6">
                        <input id="security_code" type="text" class="form-control @error('security_code') is-invalid @enderror" name="security_code" value="{{ old('security_code') }}" required autocomplete="security_code">

                        @error('security_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="expiration_month" class="col-md-4 col-form-label text-md-right">{{ __('Expiration Month') }}</label>

                    <div class="col-md-6">
                        <input id="expiration_month" type="number" class="form-control @error('expiration_month') is-invalid @enderror" name="expiration_month" value="{{ old('expiration_month') }}" required autocomplete="expiration_month" min="1" max="12">

                        @error('expiration_month')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="expiration_year" class="col-md-4 col-form-label text-md-right">{{ __('Expiration Year') }}</label>

                    <div class="col-md-6">
                        <input id="expiration_year" type="number" class="form-control @error('expiration_year') is-invalid @enderror" name="expiration_year" value="{{ old('expiration_year') }}" required autocomplete="expiration_year" min="{{ date('Y') }}" max="{{ date('Y') + 10 }}">

                        @error('expiration_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>`;
    }


    cardBodyContent.innerHTML = '';

    cardBodyContent.appendChild(newContent);
  });

  cardBodyContent.appendChild(doneButton);
});

    </script>
@endsection
