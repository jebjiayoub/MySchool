@extends('layouts.app')

@section('content')

<!-- Page content -->
<div class="w3-content" style="max-width:2000px;margin-top:8px">

    <!-- Add New Contact Section -->
    <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">

    @if(session()->has('success'))
      <div class="w3-panel w3-green w3-display-container w3-card-4" style="margin-left: auto; margin-right: auto; margin-top: -10px; width: 100%">
        <span onclick="this.parentElement.style.display='none'"
        class="w3-button w3-large w3-display-topright">&times;</span>
        <h3>Success!</h3>
        <p>{{ session()->get('success') }}</p>
      </div>
    @endif

        <div id="contacts-form">
            <form method="POST" action="{{ route('contacts.store') }}">
            @csrf

                <div class="w3-row-padding">
                    <div class="w3-half">
                        <input type="text" id="firstname" name="firstname" placeholder="First Name" value="{{old('firstname')}}">
                        @if($errors->has('firstname'))
                            <div class="error">{{ $errors->first('firstname') }}</div>
                        @endif
                    </div>
                    <div class="w3-half">
                        <input type="text" id="lastname" name="lastname" placeholder="Last Name" value="{{old('lastname')}}">
                        @if($errors->has('lastname'))
                            <div class="error">{{ $errors->first('lastname') }}</div>
                        @endif
                    </div>
                </div>

                <input type="text" id="email" name="email" placeholder="Email" value="{{old('email')}}">
                @if($errors->has('email'))
                    <div class="error">{{ $errors->first('email') }}</div>
                @endif
                <input type="text" id="address1" name="address1" placeholder="Address1" value="{{old('address1')}}">
                @if($errors->has('address1'))
                    <div class="error">{{ $errors->first('address1') }}</div>
                @endif
                <input type="text" id="address2" name="address2" placeholder="Address2" value="{{old('address2')}}">
                @if($errors->has('address2'))
                    <div class="error">{{ $errors->first('address2') }}</div>
                @endif

                <div class="w3-row-padding">
                    <div class="w3-twothird">
                        <input type="text" id="phone" name="phone" placeholder="Phone" value="{{old('phone')}}">
                        @if($errors->has('phone'))
                            <div class="error">{{ $errors->first('phone') }}</div>
                        @endif
                    </div>
                    <div class="w3-third">
                        <input type="date" id="birth-date" name="birth_date" placeholder="Birth Date" value="{{old('birth_date')}}">
                        @if($errors->has('birth_date'))
                            <div class="error">{{ $errors->first('birth_date') }}</div>
                        @endif
                    </div>
                </div>

                <input type="submit" value="Create New Contact">
            </form>
        </div>

    </div>

    <!-- End Page Content -->
</div>

@endsection