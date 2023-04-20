@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card AuthContainer">

                <div class="card-body">
                    <h1 class="text-center mb-5 fw-bold">{{ __('Register') }}</h1>
                    <form method="POST" action="{{route('registration.user')}}" enctype="multipart/form-data">
                    @csrf
                        @if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                        @endif

                        @if(Session::has('fail'))
                            <div class="alert alert-danger">{{Session::get('fail')}}</div>
                        @endif

                    <div class="d-flex containner">
                        <div>
                            <div class="mb-3 img w-25 w-100">
                                <img id="image" src={{asset('images/yourPicture.png')}} height="140px" width="140px" style="border-radius:50%; cursor: pointer;"/>
                                <input type="file" id="imgInput" name="img"  style="display: none;" class="@error('img') is-invalid @enderror"/>

                                @error('img')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="w-75 w-100 inputs" >
                            <div class="row mb-3">
                                <label for="first_name" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('First name') }}</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="last_name" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Last name') }}</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="phone" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Phone Number') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="tel"
                                    pattern="(?:\+212|0)(?:\s|-)*[1-9](?:[\.\-\s]*\d{2}){4}|06(?:\s|-)*\d{2}(?:[\.\-\s]*\d{2}){3}"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                                    <span class="fw-bold" >Format : 06 61 23 45 67 Or +212661234567</span>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="address" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Address') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Email Address') }}</label>

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
                                <label for="password" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Password') }}</label>

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
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="role" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Role') }}</label>

                                <div class="col-md-6">

                                    <select class="form-select" name="role" id="role" value="{{ old('role') }}" required>
                                        <option value="1">Client</option>
                                        <option value="2">Fisher</option>
                                    </select>

                                </div>
                            </div>

                            <div id="fishingLisenceInput">

                            </div>

                            <div id="Vehicle&DrivingLisenceInputs">

                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>

                                    @if (Route::has('login'))
                                        <p>Already have an account, <a class="text-decoration-none" href="{{ route('login') }}">{{ __('Login') }}</a></p>
                                    @endif
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
    <h1>License</h1>

    <div class="row mb-3">
    <label for="license_number" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('License Number') }}</label>

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
    <label for="expiration_date" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Expiration Date') }}</label>

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
    <label for="issue_date" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Issue Date') }}</label>

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
        <label for="type" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('License Type') }}</label>

        <div class="col-md-6">
            <select id="type" class="form-select @error('type') is-invalid @enderror" name="type" required>
                <option value="Recreational">Recreational</option>
                <option value="Commercial">Commercial</option>
                <option value="Sport">Sport</option>
                <option value="Fly Fishing">Fly Fishing</option>
                <option value="Saltwater">Saltwater</option>
                <option value="Freshwater">Freshwater</option>
            </select>

            @error('type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>


    <div class="row mb-3">
    <label for="issuing_authority" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Issuing Authority') }}</label>

    <div class="col-md-6">
        <textarea id="issuing_authority" type="text" class="form-control @error('issuing_authority') is-invalid @enderror" name="issuing_authority" required autocomplete="issuing_authority" autofocus>{{ old('issuing_authority') }}</textarea>

        @error('issuing_authority')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>

    <div class="row mb-3">
    <label for="document" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Document') }}</label>

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
    <label for="notes" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Notes') }}</label>

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

roleSelect?.addEventListener('change', (event) => {
    const selectedValue = event.target.value;

    if (selectedValue == 2) {
        fishingLisenceInput.innerHTML = fisherInputs;
        VehicleDrivingLisenceInputs.innerHTML= '';
    } else {
        fishingLisenceInput.innerHTML = '';
        VehicleDrivingLisenceInputs.innerHTML= '';
    }
});

</script>

@endsection
