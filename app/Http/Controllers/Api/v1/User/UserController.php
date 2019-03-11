<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ForgotPasswordRequest;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Requests\User\SaveBillingAddressRequest;
use App\Http\Requests\User\SaveDeliveryAddressRequest;
use App\Http\Requests\User\SaveRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\WordpressService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    private $wordpressService;


    /**
     * UserController constructor.
     *
     * @param WordpressService $wordpressService
     */
    public function __construct(WordpressService $wordpressService)
    {
        $this->wordpressService = $wordpressService;
    }


    /**
     * @param LoginRequest $request
     *
     * @return mixed
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $response
            = Response::Error('The email or password you entered is incorrect.');

        if (Auth::attempt($credentials)) {
            $data['jwt_token'] = Auth::user()
                ->createToken('User Access Token')->accessToken;
            $response = Response::Success($data);
        }

        return $response;
    }


    /**
     * @param RegisterRequest $request
     *
     * @return mixed
     */
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $userCheck = User::where(function ($query) use ($data) {
            $query->where('user_login', $data['email']);
            $query->orWhere('user_email', $data['email']);
        })->exists();

        if ($userCheck) {
            $response
                = Response::Error('An account is already registered with your email address. Please log in.');
        } else {
            $user = new User;
            $user->user_login = $data['email'];
            $user->user_pass = $data['password'];
            $user->user_email = $data['email'];
            $user->save();

            $user->saveMeta([
                'description'   => $data['birthday'],
                'phone' => $data['phone'],
            ]);

            $response = Response::Success();
        }

        return $response;
    }


    /**
     * @param ForgotPasswordRequest $request
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $data = $request->validated();

        $response = $this->wordpressService->post('users/lostpassword',[
            'user_login' => $data['email']
        ]);

        $data = collect($response['data'])->only('message');

        // Check Errors
        if(!$response['success']){
            $response = Response::Error($data['message']);
        }else{
            $response =  Response::Success($data);
        }

        return $response;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return Response::Success(new UserResource(Auth::user()));
    }

    /**
     * @param SaveRequest $request
     *
     * @return mixed
     */
    public function saveUser(SaveRequest $request)
    {
        $data = $request->validated();

        $userCheck = User::where(function ($query) use ($data) {
            $query->where('user_login', $data['email']);
            $query->orWhere('user_email', $data['email']);
        })->exists();

        if ($userCheck && $data['email'] !== Auth::user()->email) {
            $response
                = Response::Error('An account is already registered with your email address. Please log in.');
        } else {
            Auth::user()->save([
                'email' => $data['email']
            ]);

            Auth::user()->saveMeta([
                'first_name' => $data['first_name'],
                'last_name'  => $data['last_name'],
                'description'   => $data['birthday'],
                'phone' => $data['phone']
            ]);

            $response = Response::Success();
        }


        return $response;
    }

    /**
     * @param SaveBillingAddressRequest $request
     *
     * @return mixed
     */
    public function saveBillingAddress(SaveBillingAddressRequest $request)
    {
        $data = $request->validated();

        Auth::user()->saveMeta([
            'billing_first_name' => $data['first_name'],
            'billing_last_name' => $data['last_name'],
            'billing_address_1' => $data['address_1'],
            'billing_address_2' => $data['address_2'],
            'billing_city' => $data['city'],
            'billing_postcode' => $data['postcode'],
            'billing_country' => $data['country'],
            'billing_state' => $data['state'],
            'billing_phone' => $data['phone']
        ]);

        return Response::Success();
    }


    /**
     * @param SaveDeliveryAddressRequest $request
     *
     * @return mixed
     */
    public function saveDeliveryAddress(SaveDeliveryAddressRequest $request)
    {
        $data = $request->validated();

        Auth::user()->saveMeta([
            'shipping_address_1' => $data['address_1'],
            'shipping_address_2' => $data['address_2'],
            'shipping_city' => $data['city'],
            'shipping_postcode' => $data['postcode'],
            'shipping_country' => $data['country'],
            'shipping_state' => $data['state'],
            'shipping_additional_instruction' => $data['additional_instruction']
        ]);

        return Response::Success();
    }
}
