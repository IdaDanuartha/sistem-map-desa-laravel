<?php

namespace App\Repositories;

use App\Models\User;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ProfileRepository
{
  public function __construct(
    protected readonly User $user,
    // protected readonly UploadFile $file
  ) {}

  public function update($request): bool  
  {
    DB::beginTransaction();    
    try {  
        // if (Arr::has($request, 'path') && Arr::get($request, 'path')) {		
        //     $image = Arr::get($request, 'path');
        //     $this->file->deleteExistFile("infrastructures/$infrastructure->path");

        //     $path = $this->file->uploadSingleFile($image, "infrastructures");
        //     $request['path'] = $path;
        // }
        $user = $this->user->find(auth()->id());

        if(is_null(Arr::get($request, 'password'))) Arr::pull($request, 'password');			

        $profile = $user->update($request);
    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return false;
    }

    DB::commit();
    return $profile;
  }
}