<?php

namespace App\Repositories;

use App\Models\Village;
use App\Utils\UploadFile;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class VillageRepository
{
  public function __construct(
    protected readonly Village $village,
    protected readonly UploadFile $file
  ) {}

  public function findAll(): Collection
  {
    return $this->village->latest()->get();
  }

  public function findAllPaginate($paginate = 10): LengthAwarePaginator
  {
    return $this->village->latest()->paginate($paginate);
  }

  public function findById(Village $village): Village
  {
    return $this->village->where('id', $village->id)->first();
  }

  public function store($request): Village|Exception
  {
    DB::beginTransaction();
    try {         
        if (Arr::has($request, 'path')) {
            $image = Arr::get($request, 'path');
            $path = $this->file->uploadSingleFile($image, "villages");
            $request["path"] = $path;
        }

        $village = $this->village->create($request);

    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }
    DB::commit();
    return $village;
  }

  public function update($request, Village $village): bool
  {
    DB::beginTransaction();    
    try {  
        if (Arr::has($request, 'path') && Arr::get($request, 'path')) {		
            $image = Arr::get($request, 'path');
            $this->file->deleteExistFile("villages/$village->path");

            $path = $this->file->uploadSingleFile($image, "villages");
            $request['path'] = $path;
        }

      $village_updated = $village->updateOrFail($request);
    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }

    DB::commit();
    return $village_updated;
  }

  public function delete(Village $village): bool
  {
    DB::beginTransaction();
    try {
        $delete_village = $village->deleteOrFail();
        $this->file->deleteExistFile("villages/$village->path");
    } catch (\Exception $e) {
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }    

    DB::commit();
    return $delete_village;
  }
}