<?php

namespace nullx27\Herald\Http\Controllers\Auth;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;
use nullx27\Herald\Http\Controllers\Controller;
use nullx27\Herald\Models\User;

class SSOController extends Controller
{

    protected $redirectTo = '/events';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function login()
    {
        try {
            return Socialite::driver('eveonline')->redirect();
        } catch (Exception $e) {
            return redirect()->route('auth.login');
        }
    }

    public function callback()
    {
        try {
            $ssoUser = Socialite::driver('eveonline')->user();
        } catch (InvalidStateException $e) {
            return redirect()->route('auth.login');
        }

        // Get more detailed character data from CREST
        $httpClient = new Client();
        $url = "https://esi.tech.ccp.is/latest/characters/{$ssoUser->id}/?datasource=tranquility";

        try {
            $response = $httpClient->get($url);
        } catch (Exception $exception) {
            return abort(504, 'ESI is not reachable, try again later.');
        }

        $character = json_decode($response->getBody()->getContents());

        if(!in_array($character->corporation_id, config('auth.whitelist'))) {
            return abort(403, 'Coporation not whitelisted');
        }

        // Check if user exists
        $user = User::firstOrNew(['character_id' => $ssoUser->id]);

        // And then update the data in case something changed
        $user->name = $ssoUser->name;
        $user->owner_hash = $ssoUser->owner_hash;
        $user->save();

        // and then log in
        Auth::login($user, true);
        return redirect()->intended('/events');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
