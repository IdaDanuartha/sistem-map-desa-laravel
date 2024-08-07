<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Http\Controllers\Controller;
use App\Http\Requests\Facility\StoreFacilityRequest;
use App\Http\Requests\Facility\UpdateFacilityRequest;
use App\Imports\FacilityImport;
use App\Repositories\FacilityRepository;
use App\Utils\ResponseMessage;
use Exception;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function __construct(
        protected readonly FacilityRepository $facility,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {                                   
        $facilities = $this->facility->findAll();
        return view('pages.facilities.index', compact("facilities"));
    }

    public function create()
    {                                           
        return view('pages.facilities.create');
    }
    
    public function importView()
    {                                           
        return view('pages.facilities.import');
    }

    public function show(Facility $facility)
    {                                    
        return view('pages.facilities.detail', compact("facility"));
    }

    public function showJson(Facility $facility)
    {                                    
        return response()->json([
            "facility" => $this->facility->findById($facility)
        ]);
    }

    public function edit(Facility $facility)
    {                                           
        return view('pages.facilities.edit', compact("facility"));
    }

    public function store(StoreFacilityRequest $request)
    {        
        try {
            $store = $this->facility->store($request->validated());

            if($store instanceof Facility) return redirect(route("facilities.index"))
                                ->with("success", $this->responseMessage->response("Lokasi"));
            throw new Exception($this->responseMessage->response("Lokasi", false));
        } catch (\Exception $e) {  
            logger($e->getMessage());

            return redirect(route("facilities.create"))->with("error", $this->responseMessage->response("lokasi", false));
        }
    }

    public function import(Request $request)
    {
        try {
            // Excel::import(new VillageImport, $request->file);
            (new FacilityImport)->import($request->file, null, \Maatwebsite\Excel\Excel::CSV);

            return redirect(route("facilities.index"))->with("success", $this->responseMessage->response("Lokasi"));
        } catch (\Exception $e) {
            logger($e->getMessage());

            return redirect(route("facilities.import"))->with("error", "Gagal menambahkan lokasi! Cek kembali format file (.csv)");
        }
    }

    public function update(UpdateFacilityRequest $request, Facility $facility)
    {
        try {                     
            $update = $this->facility->update($request->validated(), $facility);

            if($update) return redirect(route('facilities.index'))
                                ->with('success', $this->responseMessage->response("Lokasi", true, 'update'));
            throw new Exception($this->responseMessage->response("lokasi", false, 'update'));
        } catch (\Exception $e) {
            return redirect()->route('facilities.edit', $facility->id)->with('error', $this->responseMessage->response("lokasi", false, 'update'));
        }
    }

    public function destroy(Facility $facility)
    {
        try {
            $this->facility->delete($facility);

            return redirect()->route('facilities.index')->with('success', $this->responseMessage->response("Lokasi", true, 'delete'));
        } catch (\Exception $e) {            
            return redirect()->route('facilities.index')->with('error', $this->responseMessage->response("lokasi", false, 'delete'));
        }
    }
}
