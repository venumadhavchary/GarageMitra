@extends('layouts.auth.index')

@section('content')
    <div class="wrapper">
        <section class="form login">
            <h1>Login</h1>
            <form action="">
                @csrf
                <div id="error_text" class="error-txt">This is a error message</div>
                <div id="success_text" class="success-txt">This is a success message</div>
                <div class="field input">
                    <label class="text-red-50" for="mobile_number">Mobile No:</label>
                    <input type="tel" id="mobile_number" name="mobile_number" placeholder="99999-00000" 
                        maxlength="10" inputmode="numeric" required>
                    </div>
                    <div class="field button">
                        <button id="send_otp" type="submit">Send Otp</button>
                    </div>
                <div  class="field input" id="otp_field" style="display:none;">
                    <label for="otp">Otp:</label>
                    <a href="#" id="resend_otp">Resend Otp</a> 
                    <input type="text" id="otp" name="otp" maxlength="10" inputmode="numeric" placeholder="Enter OTP" >
                </div>
                <div class="field button">
                    <button id="login_button" style="display: none" type="submit">Login</button>
                </div>

            </form>
        </section>
    </div>

    <script>
        // Create a global variable that your external JS can read
        const appRoutes = {
            sendOtp: "{{ route('auth.send_otp') }}", 
            resendOtp: "{{ route('auth.resend_otp') }}", 
            login: "{{ route('auth.login') }}"
        };
    </script>
@endsection
