<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class AuthRepository 
{
  public function __construct(
    protected readonly User $user,
  ) {}

  public function login($credentials)
  {
    try {         
      if(auth()->attempt(Arr::except($credentials, "remember"), Arr::only($credentials, "remember"))) {
        if(isset($credentials["remember"]) && !empty($credentials["remember"])) {
          setcookie("username", $credentials["username"], time() + (7 * 24 * 60 * 60));
          setcookie("password", $credentials["password"], time() + (7 * 24 * 60 * 60));        
        } else {
          setcookie("username", "");
          setcookie("password", "");
        }

        return true;
      } else {
        throw new Exception();
      }

    } catch (\Exception $e) {
      logger($e->getMessage());
      setcookie("username", "");
      setcookie("password", "");
      throw $e;
    }            
  } 
  
  public function logout($request): bool
  {
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return true;
  }
}