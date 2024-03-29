<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Family;
use App\Child;
use App\Invite;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nickname' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->whereNull('deleted_at'),],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $checkUniqueName = true;
        while ($checkUniqueName) {
            $familyName = Str::random(16);
            $checkUniqueName = Family::where('name', $familyName)->exists();
        }

        $family = Family::create([
            'name' => $familyName,
            'nickname' => 'よんで',
            'introduction' => 'よろしくお願いします。',
        ]);

        Child::create([
            'family_id' => $family->id,
            'gender_code' => '0',
            'name' => 'お子さま',
        ]);

        $checkUniqueName = true;
        while ($checkUniqueName) {
            $userName = Str::random(16);
            $checkUniqueName = User::where('name', $userName)->exists();
        }

        return User::create([
            'family_id' => $family->id,
            'name' => $userName,
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * ユーザー名登録画面表示処理（Googleアカウント利用）
     */
    public function showProviderUserRegistrationForm(Request $request, string $provider)
    {
        $token = $request->token;

        $providerUser = Socialite::driver($provider)->userFromToken($token);

        return view('auth.social_register', [
            'provider' => $provider,
            'email' => $providerUser->getEmail(),
            'token' => $token,
        ]);
    }

    /**
     * よんでIDの登録画面で「登録」ボタンを押した後の、ユーザー登録処理（Googleアカウント利用）
     */
    public function registerProviderUser(Request $request, string $provider)
    {

        $request->validate([
            'nickname' => ['required', 'string', 'max:50'],
            'token' => ['required', 'string'],
        ]);

        $token = $request->token;

        $providerUser = Socialite::driver($provider)->userFromToken($token);

        $checkUniqueName = true;
        while ($checkUniqueName) {
            $familyName = Str::random(16);
            $checkUniqueName = Family::where('name', $familyName)->exists();
        }

        $family = Family::create([
            'name' => $familyName,
            'nickname' => 'よんで',
            'introduction' => 'よろしくお願いします。',
        ]);

        Child::create([
            'name' => 'お子さま',
            'family_id' => $family->id,
        ]);

        $checkUniqueName = true;
        while ($checkUniqueName) {
            $userName = Str::random(16);
            $checkUniqueName = User::where('name', $userName)->exists();
        }

        $user = User::create([
            'name' => $userName,
            'nickname' => $request->nickname,
            'email' => $providerUser->getEmail(),
            'email_verified_at' => now(),
            'password' => null,
            'family_id' => $family->id,

        ]);

        $this->guard()->login($user, true);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * ユーザー名登録画面表示処理（招待ユーザー登録）
     */
    public function showInvitedUserRegistrationForm(string $token)
    {
        $invite = Invite::where('token', $token)->first();

        if (!isset($invite)) {
            abort(401);
        }

        return view('auth.invite_register', [
            'token' => $invite->token,
            'family_id' => $invite->family_id,
            'email' => $invite->email,
        ]);
    }

    /**
     * よんでIDの登録画面で「登録」ボタンを押した後の、ユーザー登録処理（招待ユーザー登録）
     */
    public function registerInvitedUser(Request $request)
    {
        if (!$invite = Invite::where('token', $request->token)->first()) {
            abort(401);
        }

        $request->validate([
            'nickname' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->whereNull('deleted_at'),],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $checkUniqueName = true;
        while ($checkUniqueName) {
            $userName = Str::random(16);
            $checkUniqueName = User::where('name', $userName)->exists();
        }

        $user = User::create([
            'name' => $userName,
            'nickname' => $request->nickname,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'family_id' => $request->family_id,
        ]);

        $this->guard()->login($user, true);

        $invite->delete();

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        return $user->email_verified_at === null
            ? view('auth.registered') // 通常の新規登録
            : redirect($this->redirectPath()); // Googleアカウントでの新規登録
    }
}
