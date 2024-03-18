<?php

namespace App\Repositories;

use App\Models\Infrastructure;
use App\Utils\UploadFile;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class InfrastructureRepository
{
  public function __construct(
    protected readonly Infrastructure $infrastructure,
    protected readonly UploadFile $file
  ) {}

  public function findAll(): Collection
  {
    return $this->infrastructure->latest()->get();
  }

  public function findAllPaginate($paginate = 10): LengthAwarePaginator
  {
    return $this->infrastructure->latest()->paginate($paginate);
  }

  public function findById(Infrastructure $infrastructure): Infrastructure
  {
    return $this->infrastructure->where('id', $infrastructure->id)->first();
  }

  public function store($request): Infrastructure|Exception
  {
    DB::beginTransaction();
    try {    
        $request["user_id"] = auth()->id();      
        if (Arr::has($request, 'path')) {
            $image = Arr::get($request, 'path');
            $path = $this->file->uploadSingleFile($image, "infrastructures");
            $request["path"] = $path;
        }

        $infrastructure = $this->infrastructure->create($request);

    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }
    DB::commit();
    return $infrastructure;
  }

  public function update($request, Infrastructure $infrastructure): bool
  {
    DB::beginTransaction();    
    try {  
        if (Arr::has($request, 'path') && Arr::get($request, 'path')) {		
            $image = Arr::get($request, 'path');
            $this->file->deleteExistFile("infrastructures/$infrastructure->path");

            $path = $this->file->uploadSingleFile($image, "infrastructures");
            $request['path'] = $path;
        }

      $infrastructure_updated = $infrastructure->updateOrFail($request);
    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }

    DB::commit();
    return $infrastructure_updated;
  }

  public function delete(Infrastructure $infrastructure): bool
  {
    DB::beginTransaction();
    try {
        $delete_infrastructure = $infrastructure->deleteOrFail();
        $this->file->deleteExistFile("infrastructures/$infrastructure->path");
    } catch (\Exception $e) {
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }    

    DB::commit();
    return $delete_infrastructure;
  }
}