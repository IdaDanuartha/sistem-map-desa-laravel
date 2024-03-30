<?php

namespace App\Http\Controllers;

use App\Models\Infrastructure;
use App\Http\Controllers\Controller;
use App\Http\Requests\Infrastructure\StoreInfrastructureRequest;
use App\Http\Requests\Infrastructure\UpdateInfrastructureRequest;
use App\Imports\InfrastructureImport;
use App\Repositories\InfrastructureRepository;
use App\Utils\ResponseMessage;
use Exception;
use Illuminate\Http\Request;

class InfrastructureController extends Controller
{
    public function __construct(
        protected readonly InfrastructureRepository $infrastructure,
        protected readonly ResponseMessage $responseMessage
    ) {}

    public function index(Request $request)
    {                                   
        $infrastructures = $this->infrastructure->findAll();
        return view('pages.infrastructures.index', compact("infrastructures"));
    }

    public function create()
    {                                           
        return view('pages.infrastructures.create');
    }

    public function importView()
    {                                           
        return view('pages.infrastructures.import');
    }

    public function show(Infrastructure $infrastructure)
    {                                    
        return view('pages.infrastructures.detail', compact("infrastructure"));
    }

    public function showJson(Infrastructure $infrastructure)
    {                                    
        return response()->json([
            "infrastructure" => $this->infrastructure->findById($infrastructure)
        ]);
    }

    public function edit(Infrastructure $infrastructure)
    {                                           
        return view('pages.infrastructures.edit', compact("infrastructure"));
    }

    public function store(StoreInfrastructureRequest $request)
    {        
        try {
            $store = $this->infrastructure->store($request->validated());

            if($store instanceof Infrastructure) return redirect(route("infrastructures.index"))
                                ->with("success", $this->responseMessage->response("Lokasi"));
            throw new Exception($this->responseMessage->response("Lokasi", false));
        } catch (\Exception $e) {  
            logger($e->getMessage());

            return redirect(route("infrastructures.create"))->with("error", $this->responseMessage->response("lokasi", false));
        }
    }

    public function import(Request $request)
    {
        try {
            // Excel::import(new VillageImport, $request->file);
            (new InfrastructureImport)->import($request->file, null, \Maatwebsite\Excel\Excel::CSV);

            return redirect(route("infrastructures.index"))->with("success", $this->responseMessage->response("Lokasi"));
        } catch (\Exception $e) {
            logger($e->getMessage());

            return redirect(route("infrastructures.import"))->with("error", "Gagal menambahkan lokasi! Cek kembali format file (.csv)");
        }
    }

    public function update(UpdateInfrastructureRequest $request, Infrastructure $infrastructure)
    {
        try {                     
            $update = $this->infrastructure->update($request->validated(), $infrastructure);

            if($update) return redirect(route('infrastructures.index'))
                                ->with('success', $this->responseMessage->response("Lokasi", true, 'update'));
            throw new Exception($this->responseMessage->response("lokasi", false, 'update'));
        } catch (\Exception $e) {
            return redirect()->route('infrastructures.edit', $infrastructure->id)->with('error', $this->responseMessage->response("lokasi", false, 'update'));
        }
    }

    public function destroy(Infrastructure $infrastructure)
    {
        try {
            $this->infrastructure->delete($infrastructure);

            return redirect()->route('infrastructures.index')->with('success', $this->responseMessage->response("Lokasi", true, 'delete'));
        } catch (\Exception $e) {            
            return redirect()->route('infrastructures.index')->with('error', $this->responseMessage->response("lokasi", false, 'delete'));
        }
    }
}
