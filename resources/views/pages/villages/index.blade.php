@extends('layouts.main')
@section('title') Halaman Peta Administrasi Desa @endsection

@section('main')
<div class="py-14 pt-2">
    @auth
        <div class="flex justify-end mb-3">
            <a href="{{ route('villages.create') }}" class="flex button btn-main duration-200 capitalize w-max items-center gap-1" type="button">
                Tambah Lokasi
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                    <g clip-path="url(#clip0_7909_670)">
                        <path d="M5.59868 11.9841C5.51903 11.9548 5.43528 11.9331 5.36022 11.8945C5.09928 11.7602 4.94839 11.5457 4.91571 11.2524C4.9083 11.1868 4.90779 11.1201 4.90779 11.0542C4.90728 9.78863 4.90754 8.52301 4.90754 7.25714C4.90754 7.20735 4.90754 7.15756 4.90754 7.09041C4.84728 7.09041 4.79826 7.09041 4.74924 7.09041C3.46422 7.09041 2.17945 7.09093 0.894429 7.09016C0.474685 7.08991 0.16728 6.87901 0.0531524 6.51697C0.0449822 6.49118 0.034259 6.46437 0.034259 6.43782C0.0329824 6.14675 0.00591727 5.85237 0.040896 5.56565C0.0840449 5.2128 0.391705 4.95697 0.744811 4.92199C0.806598 4.91586 0.869151 4.91459 0.931449 4.91459C2.2009 4.91407 3.47009 4.91433 4.73954 4.91433C4.78932 4.91433 4.83937 4.91433 4.90754 4.91433C4.90754 4.8551 4.90754 4.80633 4.90754 4.75731C4.90754 3.47229 4.90856 2.18701 4.90677 0.901989C4.90626 0.542755 5.04592 0.267776 5.37145 0.10284C5.60966 -0.0176703 6.38098 -0.0189474 6.61894 0.100797C6.88422 0.234585 7.04124 0.450074 7.07519 0.748542C7.0826 0.814159 7.08362 0.880542 7.08362 0.94667C7.08413 2.21229 7.08388 3.4779 7.08388 4.74378C7.08388 4.79382 7.08388 4.84412 7.08388 4.91433C7.14107 4.91433 7.18983 4.91433 7.23834 4.91433C8.4843 4.91433 9.73051 4.92429 10.9762 4.90948C11.4657 4.90361 11.8394 5.07441 11.9766 5.60522C11.9766 5.86999 11.9766 6.13475 11.9766 6.39978C11.8384 6.93441 11.46 7.10088 10.9765 7.09552C9.73103 7.08122 8.48558 7.09067 7.24013 7.09067C7.19136 7.09067 7.1426 7.09067 7.08388 7.09067C7.08388 7.15961 7.08388 7.20939 7.08388 7.25944C7.08388 8.53629 7.0826 9.81314 7.0849 11.09C7.08541 11.3422 7.02158 11.5654 6.84081 11.7487C6.71596 11.8754 6.55741 11.9348 6.39298 11.9844C6.12847 11.9841 5.86371 11.9841 5.59868 11.9841Z" fill="white"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_7909_670">
                            <rect width="12" height="12" fill="white"/>
                        </clipPath>
                    </defs>
                </svg>
            </a>
        </div>
    @endauth
    <div class="my-3">
        <input type="text" id="search-box" placeholder="Cari berdasarkan nama lokasi..." class="input-crud bg-white" value="{{ request()->get("search") }}" />
    </div>
    <div id="map"></div>
</div>
@endsection

@push('js')
    <script>
        let villages = JSON.parse('<?= json_encode($villages) ?>')

        $( function() {
            let villageData = []
            villages.forEach(village => {
                villageData.push(village.name)
            })
            $( "#search-box" ).autocomplete({
                source: villageData
            });
        } );

        // initialize the map on the "map" div with a given center and zoom
        let map = L.map('map')
        $("#search-box").change(function() {
            if($("#search-box" ).val() !== "") {
                let findLocation = villages.filter(village => village.name == $("#search-box" ).val())[0]
                console.log(findLocation)
                map.setView([parseFloat(findLocation.latitude), parseFloat(findLocation.longitude)], 50);
            } else {
                map.setView([-8.659488860100769, 115.16421012486913], 15);
            }
        })
        map.setView([-8.659488860100769, 115.16421012486913], 15);


        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.Control.geocoder().addTo(map)

        villages.forEach(village => {
            $("#search-box").change(function() {
                if($("#search-box" ).val() !== "") {
                    if(village.name === $("#search-box").val()) {
                        showPopupMap(village, "villages", true)
                        $("#search-box").val("")
                    } else {
                        showPopupMap(village, "villages")
                    }
                } else {
                    showPopupMap(village, "villages")
                }
            })
            showPopupMap(village, "villages")
        });

    </script>
@endpush    