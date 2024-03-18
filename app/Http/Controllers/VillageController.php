<?php

namespace App\Http\Controllers;

use App\Models\Village;
use App\Http\Controllers\Controller;
use App\Http\Requests\Village\StoreVillageRequest;
use App\Http\Requests\Village\UpdateVillageRequest;
use App\Repositories\VillageRepository;
use App\Utils\ResponseMessage;
use Exception;
use Illuminate\Http\Request;

class VillageController extends Controller
{
    public function __construct(
        protected readonly VillageRepository $village,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {                                   
        $villages = $this->village->findAll();
        return view('pages.villages.index', compact("villages"));
    }

    public function create()
    {                                           
        return view('pages.villages.create');
    }

    public function show(Village $village)
    {                                    
        return view('pages.villages.detail', compact("village"));
    }

    public function showJson(Village $village)
    {                                    
        return response()->json([
            "village" => $this->village->findById($village)
        ]);
    }

    public function edit(Village $village)
    {                                           
        return view('pages.villages.edit', compact("village"));
    }

    public function store(StoreVillageRequest $request)
    {        
        try {
            $store = $this->village->store($request->validated());

            if($store instanceof Village) return redirect(route("villages.index"))
                                ->with("success", $this->responseMessage->response("Lokasi"));
            throw new Exception($this->responseMessage->response("Lokasi", false));
        } catch (\Exception $e) {  
            logger($e->getMessage());

            return redirect(route("villages.create"))->with("error", $this->responseMessage->response("lokasi", false));
        }
    }

    public function update(UpdateVillageRequest $request, Village $village)
    {
        try {                     
            $update = $this->village->update($request->validated(), $village);

            if($update) return redirect(route('villages.index'))
                                ->with('success', $this->responseMessage->response("Lokasi", true, 'update'));
            throw new Exception($this->responseMessage->response("lokasi", false, 'update'));
        } catch (\Exception $e) {
            return redirect()->route('villages.edit', $village->id)->with('error', $this->responseMessage->response("lokasi", false, 'update'));
        }
    }

    public function destroy(Village $village)
    {
        try {
            $this->village->delete($village);

            return redirect()->route('villages.index')->with('success', $this->responseMessage->response("Lokasi", true, 'delete'));
        } catch (\Exception $e) {            
            return redirect()->route('villages.index')->with('error', $this->responseMessage->response("lokasi", false, 'delete'));
        }
    }
}
