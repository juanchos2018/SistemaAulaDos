<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use Validator;
use App\Models\VsAccess;
use App\Http\Controllers\DashboardController;

class AuthController extends Controller
{
  /**
   * Create user
   *
   * @param  [string] name
   * @param  [string] email
   * @param  [string] password
   * @param  [string] password_confirmation
   * @return [string] message
   */
  public function register(Request $request)
  {
    $request->validate([
      'name' => 'required|string',
      'email' => 'required|string|email|unique:users',
      'password' => 'required|string|',
      'c_password' => 'required|same:password',
    ]);

    $user = new User([
      'name' => $request->name,
      'email' => $request->email,
      'password' => bcrypt($request->password)
    ]);
    if ($user->save()) {
      return response()->json([
        'message' => 'Successfully created user!'
      ], 201);
    } else {
      return response()->json(['error' => 'Provide proper details']);
    }
  }

  /**
   * Login user and create token
   *
   * @param  [string] email
   * @param  [string] password
   * @param  [boolean] remember_me
   * @return [string] access_token
   * @return [string] token_type
   * @return [string] expires_at
   */
  public function login(Request $request)
  {
    $request->validate([
      'codigo' => 'required|string',
      'password' => 'required|string',
      'remember_me' => 'boolean'
    ]);

    $credentials = request(['email', 'password']);
    if (!Auth::attempt($credentials))
      return response()->json([
        'message' => 'Unauthorized'
      ], 401);
    $user = $request->user();
    $tokenResult = $user->createToken('Personal Access Token');
    $token = $tokenResult->token;
    if ($request->remember_me)
      $token->expires_at = Carbon::now()->addWeeks(1);
    $token->save();
    return response()->json([
      'access_token' => $tokenResult->accessToken,
      'token_type' => 'Bearer',
      'expires_at' => Carbon::parse(
        $tokenResult->token->expires_at
      )->toDateTimeString()
    ]);
  }

  /**
   * Logout user (Revoke the token)
   *
   * @return [string] message
   */

  public function authenticateTwo(Request $request){

    $result = Usuario::login($request->cod_usuario,$request->password,$request->cbx_sucursal);   
    if ($result) {

        $userdata = array(
            'cod_usuario' => $request->cod_usuario,
            'sucursal' => $request->cbx_sucursal
        );      
      
       return redirect()->action([RecepcionController::class, 'Index']);
         
    }else{                  
       return redirect()->back()->withErrors(['errors' => trans('auth.failed')]);
    }        
       
}
  public function authenticate(Request $request){
     
 
        $result = VsAccess::login($request->USU_ID,hash('sha256',$request->USU_PAS));          
       
        if ($result->status==200) {
           $request->session()->put('USU_ROL',$result->user->USU_ROL);
           $request->session()->put('USU_NO',$result->user->USU_NO);
      
         /// return response()->json(['status' => 200,'result' => $result]);   
          return redirect()->action([DashboardController::class, 'dashboardAnalytics']);
        }else{  

          return redirect()->back()->withErrors(['errors' => trans('auth.failed')]);
        }        
                 
}

  public function logout(Request $request)
  {
    $request->user()->token()->revoke();
    return response()->json([
      'message' => 'Successfully logged out'
    ]);
  }

  /**
   * Get the authenticated User
   *
   * @return [json] user object
   */
  public function user(Request $request)
  {
    return response()->json($request->user());
  }
}
