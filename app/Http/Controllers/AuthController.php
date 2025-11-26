<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if(Auth::check()){
        //     return route('jobcards.index');
        // }
        if(session('verified_phone')){
            return view('register', ['mobile_number' => session('verified_phone')]);
        }
        return view('login');
    }
    public function changeNumber()
    {
        session()->forget('verified_phone');
        session()->forget('verified_at');
        return redirect()->route('login');
    }
    public function sendOtp(Request $request)
    {
        $validated = $request->validate([
            'mobile_number' => 'required|numeric|digits:10',
        ]);

        $mobileNumber = $validated['mobile_number'];

        $otp = rand(100000, 999999);

        session([
            'otp_' . $request->mobile_number => [
                'otp' => $otp,
                'expires_at' => now()->addMinutes(5)
            ]
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'OTP sent successfully',
            'otp' => $otp
        ], 200);
    }

    public function resendOtp(Request $request)
    {
        $validated = $request->validate([
            'mobile_number' => 'required|numeric|digits:10',
        ]);

        $mobileNumber = $validated['mobile_number'];

        if (session('otp_' . $mobileNumber) && now()->lessThan(session('otp_' . $mobileNumber)['expires_at']->subMinutes(4))) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please wait before requesting a new OTP.',
            ], 429);
        }
        return $this->sendOtp($request);
    }
    private function verifyOtp($mobileNumber, $otp)
    {

        $sessionData = session('otp_' . $mobileNumber);

        if (!$sessionData) {
            return ['status' => 'error', 'message' => 'OTP expired or not requested.'];
        }

        if ($sessionData['otp'] != $otp) {
            return ['status' => 'error', 'message' => 'Invalid OTP.'];
        }

        if (now()->greaterThan($sessionData['expires_at'])) {
            session()->forget('otp_' . $mobileNumber);
            return ['status' => 'error', 'message' => 'OTP has expired.'];
        }

        return ['status' => 'success', 'message' => 'OTP verified successfully'];
    }
    public function login(Request $request)
    {
        $validated = $request->validate([
            'mobile_number' => 'required|numeric|digits:10',
            'otp' => 'required|numeric|digits:6',
        ]);

        $mobileNumber = $validated['mobile_number'];
        $otp = $validated['otp'];

        $otpVerificationResponse = $this->verifyOtp($mobileNumber, $otp);

        if ($otpVerificationResponse['status'] == 'error') {
            return response()->json([
                'status' => 'error',
                'message' => $otpVerificationResponse['message'],
            ], 400);
        }

        $user = User::where('number', $mobileNumber);
        if ($user->exists()) {
            Auth::login($user->first());
            return response()->json([
                'status' => 'success',
                'redirect_url' => route('jobcards.index'),
                'message' => 'Login successful',
            ], 200);
        }

        session([
            'verified_phone' => $mobileNumber,
            'verified_at' => now()
        ]);
        return response()->json([
            'status' => 'success',
            'redirect_url' => route('register'),
            'message' => 'Mobile number verified. Proceed to signup.',
        ], 200);
    }
    public function register(Request $request)
    {
        $mobile_number = session('verified_phone');
        if (!$mobile_number) {
            return redirect()->route('login');
        }
        
        return view('register' , ['mobile_number' => $mobile_number]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mobile_number = session('verified_phone');
        if (!$mobile_number) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized access. Please verify your mobile number first.',
            ], 401);
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'shop_name' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'email' => 'required|email|unique:users,email',
            'gst_number' => 'nullable|string|max:50',
        ]);

        User::create([
            'name' => $validated['name'],
            'shop_name' => $validated['shop_name'],
            'state' => $validated['state'],
            'shop_address' => $validated['address'],
            'email' => $validated['email'],
            'gst_number' => $validated['gst_number'] ?? null,
            'number' => $mobile_number,
        ]);
        Auth::loginUsingId(User::where('number', $mobile_number)->first()->id);
        session()->forget('verified_phone');
        return response()->json([
            'status' => 'success',
            'redirect_url' => route('dashboard'),
            'message' => 'Registration successful. Redirecting to dashboard.',
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    // public function show(Jobs $jobs)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Jobs $jobs)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Jobs $jobs)
    // {
    //     //
    // }

    /**
 * Remove the specified resource from storage.
 */
    // public function destroy(Jobs $jobs)
    // {
    //     //
    // }
}
