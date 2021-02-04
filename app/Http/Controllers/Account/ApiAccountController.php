<?php

namespace App\Http\Controllers\Account;

use Illuminate\Support\Facades\Http as HttpClient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class ApiAccountController extends Controller
{
    /**
     * Create a new api controller instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('auth');
    }

    public static function getMyAccount() {
        return Auth::user();
    }

    public static function updateMyAccount($params = [])
    {
        $response = null;
        $user = Auth::user(); 
        if (!is_null($user)) {
            $user->name = $params['inputName'];
            $user->lastname = $params['inputLastname'];
            $user->type_document = $params['inputTypeDocument'];
            $user->document_number = $params['inputDocumentNumber'];
            if (isset($params['inputPassword']) && isset($params['inputPassword']) !== "" ) {
                $user->password = Hash::make($params['inputPassword']);
            }
            if (isset($params['inputEmail']) && isset($params['inputEmail']) !== "" ) {
                $user->email = $params['inputEmail'];
            }
            $user->save();
            $response = $user;
        }
        return $response;
    }

    public static function logoutAll()
    {
        $response = null;
        if (Auth::user()) {
            $request = HttpClient::withHeaders([
                'Authorization' => 'Bearer ' . Auth::user()->access_token
            ])->delete(env('API_BUSINESS_URL') . 'user/logout-all');
            if ($request->successful()) {
                $response = $request->json();
            }
        }
        return $response;
    }
}
