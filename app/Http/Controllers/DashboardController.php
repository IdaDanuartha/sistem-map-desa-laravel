<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\FacilityRepository;
use App\Repositories\InfrastructureRepository;
use App\Repositories\VillageRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(
        protected readonly VillageRepository $village,
        protected readonly InfrastructureRepository $infrastructure,
        protected readonly FacilityRepository $facility,
    ) {}

    public function __invoke(Request $request)
    {
        $villages = $this->village->findAll();
        $total_villages = count($this->village->findAll());
        $total_infrastructures = count($this->infrastructure->findAll());
        $total_facilities = count($this->facility->findAll());

        return view('pages.dashboard.index', compact("villages", "total_villages", "total_infrastructures", "total_facilities"));
    }
}
