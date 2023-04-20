@extends('layouts.app')

@section('content')

<div class="container my-3">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card AuthContainer">
                <div class="card-body">
                    <h1 class="text-center mb-5 fw-bold">Add a delivery man</h1>
                    <form method="POST" action="{{route('createDeliveryMan')}}" enctype="multipart/form-data">
                    @csrf
                        @if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                        @endif

                        @if(Session::has('fail'))
                            <div class="alert alert-danger">{{Session::get('fail')}}</div>
                        @endif

                    <input type="hidden" name="fisher_id" value="{{Session::get('user')->id}}">

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
                                <label for="email" class="col-md-4 col-form-label text-md-end fw-bold">Email Address <br> <span class="text-decoration-underline text-danger">will be used as login email</span> </label>

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
                                <label for="max_deliveries_in_day" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Max Deliveries in a Day') }}</label>

                                <div class="col-md-6">
                                    <input id="max_deliveries_in_day" type="number" class="form-control @error('max_deliveries_in_day') is-invalid @enderror" name="max_deliveries_in_day" value="{{ old('max_deliveries_in_day') }}" required autocomplete="max_deliveries_in_day" min="1" autofocus>

                                    @error('max_deliveries_in_day')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                </div>

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
                                <label for="issuing_place" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Issuing Place') }}</label>

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
                                <label for="class" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Class') }}</label>

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
                                <label for="document" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Document') }}</label>

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
                                <label for="notes" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Notes') }}</label>

                                <div class="col-md-6">
                                    <textarea id="notes" class="form-control @error('notes') is-invalid @enderror" name="notes">{{ old('notes') }}</textarea>

                                    @error('notes')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                </div>

                                <h1>vehicle</h1>

                                <div class="row mb-3">
                                    <label for="registration_matricule" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Registration Matricule') }}</label>

                                    <div class="col-md-6">
                                        <input id="registration_matricule" type="text" class="form-control @error('registration_matricule') is-invalid @enderror" name="registration_matricule" value="{{ old('registration_matricule') }}" required autofocus>

                                        @error('registration_matricule')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="make" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Make') }}</label>

                                    <div class="col-md-6">
                                        <input id="make" type="text" class="form-control @error('make') is-invalid @enderror" name="make" value="{{ old('make') }}" required>

                                        @error('make')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="model" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Model') }}</label>

                                    <div class="col-md-6">
                                        <input id="model" type="text" class="form-control @error('model') is-invalid @enderror" name="model" value="{{ old('model') }}" required>

                                        @error('model')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">

                                    <label for="capacity" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Capacity') }}</label>

                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input id="capacity" type="number" class="form-control @error('capacity') is-invalid @enderror" name="capacity" value="{{ old('capacity') }}" required>

                                            <div class="input-group-append">
                                                <span class="input-group-text rounded-0 rounded-end">KG</span>
                                            </div>
                                        </div>

                                        @error('capacity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="photo" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Photo') }}</label>

                                    <div class="col-md-6">
                                        <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror" name="photo">

                                        @error('photo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="type" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Type') }}</label>

                                    <div class="col-md-6">
                                        <select id="type" class="form-select @error('type') is-invalid @enderror" name="type" required>
                                            <option value="motorcycle">motorcycle</option>
                                            <option value="Pickup Truck">Pickup Truck</option>
                                            <option value="Van">Van</option>
                                        </select>

                                        @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="insurance" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Insurance') }}</label>

                                    <div class="col-md-6">
                                        <input id="insurance" type="text" class="form-control @error('insurance') is-invalid @enderror" name="insurance" value="{{ old('insurance') }}" required>

                                        @error('insurance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>



                            <div class="w-100 d-flex justify-content-center">
                                {{-- route('indexDeliveryMen') --}}
                                <a href="{{route('showDeliveryMen')}}" class="btn btn-secondary w-25 me-4">Cancel</a>
                                <button type="submit" class="btn btn-primary w-25">Submit</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    .AuthContainer{
        box-shadow: none;
    }
</style>
@endsection
