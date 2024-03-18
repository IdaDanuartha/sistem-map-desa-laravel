<?php

namespace App\Repositories;

use App\Models\Facility;
use App\Utils\UploadFile;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class FacilityRepository
{
  public function __construct(
    protected readonly Facility $facility,
    protected readonly UploadFile $file
  ) {}

  public function findAll(): Collection
  {
    return $this->facility->latest()->get();
  }

  public function findAllPaginate($paginate = 10): LengthAwarePaginator
  {
    return $this->facility->latest()->paginate($paginate);
  }

  public function findById(Facility $facility): Facility
  {
    return $this->facility->where('id', $facility->id)->first();
  }

  public function store($request): Facility|Exception
  {
    DB::beginTransaction();
    try {    
        $request["user_id"] = auth()->id();      
        if (Arr::has($request, 'path')) {
            $image = Arr::get($request, 'path');
            $path = $this->file->uploadSingleFile($image, "facilities");
            $request["path"] = $path;
        }

        $facility = $this->facility->create($request);

    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }
    DB::commit();
    return $facility;
  }

  public function update($request, Facility $facility): bool
  {
    DB::beginTransaction();    
    try {  
        if (Arr::has($request, 'path') && Arr::get($request, 'path')) {		
            $image = Arr::get($request, 'path');
            $this->file->deleteExistFile("facilities/$facility->path");

            $path = $this->file->uploadSingleFile($image, "facilities");
            $request['path'] = $path;
        }

      $facility_updated = $facility->updateOrFail($request);
    } catch (\Exception $e) {  
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }

    DB::commit();
    return $facility_updated;
  }

  public function delete(Facility $facility): bool
  {
    DB::beginTransaction();
    try {
        $delete_facility = $facility->deleteOrFail();
        $this->file->deleteExistFile("facilities/$facility->path");
    } catch (\Exception $e) {
      logger($e->getMessage());
      DB::rollBack();
      
      return $e;
    }    

    DB::commit();
    return $delete_facility;
  }
}