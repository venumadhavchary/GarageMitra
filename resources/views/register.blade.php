@extends('layouts.auth.index')

@section('content')
    <div class="wrapper">
        <section class="form login">
            <h1>Register</h1>
            <form action="">
                @csrf
                <div id="error_text" class="error-txt">This is a error message</div>
                <div id="success_text" class="success-txt">This is a success message</div>
                {{-- <div class="field image image-preview-container">
                    <img src="https://via.placeholder.com/150" alt="Profile" id="preview-img" class="circular-image">

                    <input type="file" id="image-input" name="image" accept="image/*">
                </div> --}}
                <div class="field input">
                    <label class="text-red-50" for="name">Name</label>
                    <input type="tel" id="name" name="name" placeholder="Jhon Doe" required>
                </div>
                <div class="field input">
                    <label class="text-red-50" for="mobile_number">Mobile No:</label>
                    <input type="tel" id="mobile_number" value="{{ $mobile_number }}" readonly>
                </div>
                <div class="field input">
                    <label for="shop_name">Shop Name</label>
                    <input type="text" id="shop_name" name="shop_name">
                </div>
                <div class="field input">
                    <label for="state">State</label>
                    <input type="text" id="state" name="state">
                </div>
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email">
                </div>
                <div class="field input">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address">
                </div>
                <div class="field input">
                    <label for="gstin">Gstin Numbner</label>
                    <input type="text" id="gstin" name="gstin">
                </div>

                <a href="{{ route('change_number') }}" class="link">Change Mobile Number</a>
                <div class="field button">
                    <button id="register_button" type="submit">Register</button>
                </div>

            </form>
        </section>
    </div>

    <script>
        // Create a global variable that your external JS can read
        const appRoutes = {
            register: "{{ route('auth.store') }}"
        };
    </script>
@endsection
