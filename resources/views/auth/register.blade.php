@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        {{--
                            return it back as it was when the size is less than 768 px
                            - edit the width and the display flex div bellow and after it go to backend
                        --}}
                    <div class="d-flex containner">
                        <div>
                            <div class="mb-3 img w-25">
                                <img id="image" src={{asset('images/yourPicture.png')}} height="140px" width="140px" style="border-radius:50%"/>
                                <input type="file" id="imgInput" name="img"  style="display: none;" class="@error('img') is-invalid @enderror"/>

                                @error('img')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="w-75" >
                        <div class="row mb-3">
                            <label for="first-name" class="col-md-4 col-form-label text-md-end">{{ __('First name') }}</label>

                            <div class="col-md-6">
                                <input id="first-name" type="text" class="form-control @error('first-name') is-invalid @enderror" name="first-name" value="{{ old('first-name') }}" required autocomplete="first-name" autofocus>

                                @error('first-name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="last-name" class="col-md-4 col-form-label text-md-end">{{ __('Last name') }}</label>

                            <div class="col-md-6">
                                <input id="last-name" type="text" class="form-control @error('last-name') is-invalid @enderror" name="last-name" value="{{ old('last-name') }}" required autocomplete="last-name" autofocus>

                                @error('last-name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="tel"
                                pattern="(?:\+212|0)(?:\s|-)*[1-9](?:[\.\-\s]*\d{2}){4}|06(?:\s|-)*\d{2}(?:[\.\-\s]*\d{2}){3}"
                                class="form-control @error('phone') is-invalid @enderror"
                                name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                                <span><strong>Format :</strong> 06 61 23 45 67 Or +212661234567</span>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- remove it from the dom until the user choose his role --}}

                        {{-- turn this to dropdown --}}
                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>

                            <div class="col-md-6">

                                <select class="form-select" name="role" id="role" required>
                                    <option value="1">Client</option>
                                    <option value="2">Fisher</option>
                                    <option value="3">Delivery Man</option>
                                </select>

                            </div>
                        </div>

                        <div id="fishingLisenceInput">

                        </div>

                        <div id="Vehicle&DrivingLisenceInputs">

                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

const fishingLisenceInput = document.getElementById('fishingLisenceInput');
const VehicleDrivingLisenceInputs = document.getElementById('Vehicle&DrivingLisenceInputs');
const roleSelect = document.getElementById('role');

const fisherInputs = `
    <div class="row mb-3">
    <label for="license_number" class="col-md-4 col-form-label text-md-end">{{ __('License Number') }}</label>

    <div class="col-md-6">
        <input id="license_number" type="text" class="form-control @error('license_number') is-invalid @enderror" name="license_number" value="{{ old('license_number') }}" required autocomplete="license_number" autofocus>

        @error('license_number')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>

    <div class="row mb-3">
    <label for="expiration_date" class="col-md-4 col-form-label text-md-end">{{ __('Expiration Date') }}</label>

    <div class="col-md-6">
        <input id="expiration_date" type="date" class="form-control @error('expiration_date') is-invalid @enderror" name="expiration_date" value="{{ old('expiration_date') }}" required autocomplete="expiration_date" autofocus>

        @error('expiration_date')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>

    <div class="row mb-3">
    <label for="issue_date" class="col-md-4 col-form-label text-md-end">{{ __('Issue Date') }}</label>

    <div class="col-md-6">
        <input id="issue_date" type="date" class="form-control @error('issue_date') is-invalid @enderror" name="issue_date" value="{{ old('issue_date') }}" required autocomplete="issue_date" autofocus>

        @error('issue_date')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>

    <div class="row mb-3">
    <label for="type" class="col-md-4 col-form-label text-md-end">{{ __('Type') }}</label>

    <div class="col-md-6">
        <input id="type" type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}" required autocomplete="type" autofocus>

        @error('type')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>

    <div class="row mb-3">
    <label for="issuing_authority" class="col-md-4 col-form-label text-md-end">{{ __('Issuing Authority') }}</label>

    <div class="col-md-6">
        <input id="issuing_authority" type="text" class="form-control @error('issuing_authority') is-invalid @enderror" name="issuing_authority" value="{{ old('issuing_authority') }}" required autocomplete="issuing_authority" autofocus>

        @error('issuing_authority')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>

    <div class="row mb-3">
    <label for="document" class="col-md-4 col-form-label text-md-end">{{ __('Document') }}</label>

    <div class="col-md-6">
        <input id="document" type="file" class="form-control @error('document') is-invalid @enderror" name="document" value="{{ old('document') }}" autocomplete="document" autofocus>

        @error('document')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>

    <div class="row mb-3">
    <label for="notes" class="col-md-4 col-form-label text-md-end">{{ __('Notes') }}</label>

    <div class="col-md-6">
        <textarea id="notes" class="form-control @error('notes') is-invalid @enderror" name="notes" autocomplete="notes" autofocus>{{ old('notes') }}</textarea>

        @error('notes')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>
`;

const DeliveryManInputs = `
    <div class="row mb-3">
    <label for="max_deliveries_in_day" class="col-md-4 col-form-label text-md-end">{{ __('Max Deliveries in a Day') }}</label>

    <div class="col-md-6">
        <input id="max_deliveries_in_day" type="number" class="form-control @error('max_deliveries_in_day') is-invalid @enderror" name="max_deliveries_in_day" value="{{ old('max_deliveries_in_day') }}" required autocomplete="max_deliveries_in_day" autofocus>

        @error('max_deliveries_in_day')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>

    <div class="row mb-3">
    <label for="license_number" class="col-md-4 col-form-label text-md-end">{{ __('License Number') }}</label>

    <div class="col-md-6">
        <input id="license_number" type="text" class="form-control @error('license_number') is-invalid @enderror" name="license_number" value="{{ old('license_number') }}" required autocomplete="license_number" autofocus>

        @error('license_number')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>

    <div class="row mb-3">
    <label for="issue_date" class="col-md-4 col-form-label text-md-end">{{ __('Issue Date') }}</label>

    <div class="col-md-6">
        <input id="issue_date" type="date" class="form-control @error('issue_date') is-invalid @enderror" name="issue_date" value="{{ old('issue_date') }}" required autocomplete="issue_date" autofocus>

        @error('issue_date')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>

    <div class="row mb-3">
    <label for="expiration_date" class="col-md-4 col-form-label text-md-end">{{ __('Expiration Date') }}</label>

    <div class="col-md-6">
        <input id="expiration_date" type="date" class="form-control @error('expiration_date') is-invalid @enderror" name="expiration_date" value="{{ old('expiration_date') }}" required autocomplete="expiration_date" autofocus>

        @error('expiration_date')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>

    <div class="row mb-3">
    <label for="issuing_place" class="col-md-4 col-form-label text-md-end">{{ __('Issuing Place') }}</label>

    <div class="col-md-6">
        <input id="issuing_place" type="text" class="form-control @error('issuing_place') is-invalid @enderror" name="issuing_place" value="{{ old('issuing_place') }}" required autocomplete="issuing_place" autofocus>

        @error('issuing_place')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>

    <div class="row mb-3">
    <label for="class" class="col-md-4 col-form-label text-md-end">{{ __('Class') }}</label>

    <div class="col-md-6">
        <input id="class" type="text" class="form-control @error('class') is-invalid @enderror" name="class" value="{{ old('class') }}" required autocomplete="class" autofocus>

        @error('class')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>

    <div class="row mb-3">
    <label for="document" class="col-md-4 col-form-label text-md-end">{{ __('Document') }}</label>

    <div class="col-md-6">
        <input id="document" type="file" class="form-control @error('document') is-invalid @enderror" name="document" value="{{ old('document') }}" autocomplete="document">

        @error('document')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>

    <div class="row mb-3">
    <label for="notes" class="col-md-4 col-form-label text-md-end">{{ __('Notes') }}</label>

    <div class="col-md-6">
        <textarea id="notes" class="form-control @error('notes') is-invalid @enderror" name="notes">{{ old('notes') }}</textarea>

        @error('notes')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>

`;

// console.log(fishingLisenceInput,  VehicleDrivingLisenceInputs, roleSelect);

roleSelect?.addEventListener('change', (event) => {
    const selectedValue = event.target.value;

    if (selectedValue == 2) {
        fishingLisenceInput.innerHTML = fisherInputs;
        VehicleDrivingLisenceInputs.innerHTML= '';
    } else if (selectedValue == 3) {
        VehicleDrivingLisenceInputs.innerHTML = DeliveryManInputs;
        fishingLisenceInput.innerHTML = '';
    } else {
        fishingLisenceInput.innerHTML = '';
        VehicleDrivingLisenceInputs.innerHTML= '';
    }
});

</script>

@endsection
