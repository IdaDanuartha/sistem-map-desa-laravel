@extends('layouts.main')
@section('title')
    Halaman Peta Sarana dan Prasarana Desa
@endsection

@section('main')
    <div class="py-14 pt-2">
        @auth
            <div class="flex justify-end mb-3">
                <a href="{{ route('facilities.importView') }}"
                    class="flex button bg-green-600 text-white mr-3 duration-200 capitalize w-max items-center gap-1"
                    type="button">
                    Import
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                </a>
                <a href="{{ route('facilities.create') }}"
                    class="flex button btn-main duration-200 capitalize w-max items-center gap-1" type="button">
                    Tambah Lokasi Sarana dan Prasarana
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                        <g clip-path="url(#clip0_7909_670)">
                            <path
                                d="M5.59868 11.9841C5.51903 11.9548 5.43528 11.9331 5.36022 11.8945C5.09928 11.7602 4.94839 11.5457 4.91571 11.2524C4.9083 11.1868 4.90779 11.1201 4.90779 11.0542C4.90728 9.78863 4.90754 8.52301 4.90754 7.25714C4.90754 7.20735 4.90754 7.15756 4.90754 7.09041C4.84728 7.09041 4.79826 7.09041 4.74924 7.09041C3.46422 7.09041 2.17945 7.09093 0.894429 7.09016C0.474685 7.08991 0.16728 6.87901 0.0531524 6.51697C0.0449822 6.49118 0.034259 6.46437 0.034259 6.43782C0.0329824 6.14675 0.00591727 5.85237 0.040896 5.56565C0.0840449 5.2128 0.391705 4.95697 0.744811 4.92199C0.806598 4.91586 0.869151 4.91459 0.931449 4.91459C2.2009 4.91407 3.47009 4.91433 4.73954 4.91433C4.78932 4.91433 4.83937 4.91433 4.90754 4.91433C4.90754 4.8551 4.90754 4.80633 4.90754 4.75731C4.90754 3.47229 4.90856 2.18701 4.90677 0.901989C4.90626 0.542755 5.04592 0.267776 5.37145 0.10284C5.60966 -0.0176703 6.38098 -0.0189474 6.61894 0.100797C6.88422 0.234585 7.04124 0.450074 7.07519 0.748542C7.0826 0.814159 7.08362 0.880542 7.08362 0.94667C7.08413 2.21229 7.08388 3.4779 7.08388 4.74378C7.08388 4.79382 7.08388 4.84412 7.08388 4.91433C7.14107 4.91433 7.18983 4.91433 7.23834 4.91433C8.4843 4.91433 9.73051 4.92429 10.9762 4.90948C11.4657 4.90361 11.8394 5.07441 11.9766 5.60522C11.9766 5.86999 11.9766 6.13475 11.9766 6.39978C11.8384 6.93441 11.46 7.10088 10.9765 7.09552C9.73103 7.08122 8.48558 7.09067 7.24013 7.09067C7.19136 7.09067 7.1426 7.09067 7.08388 7.09067C7.08388 7.15961 7.08388 7.20939 7.08388 7.25944C7.08388 8.53629 7.0826 9.81314 7.0849 11.09C7.08541 11.3422 7.02158 11.5654 6.84081 11.7487C6.71596 11.8754 6.55741 11.9348 6.39298 11.9844C6.12847 11.9841 5.86371 11.9841 5.59868 11.9841Z"
                                fill="white" />
                        </g>
                        <defs>
                            <clipPath id="clip0_7909_670">
                                <rect width="12" height="12" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                </a>
            </div>
        @endauth
        <div class="my-3">
            <input type="text" id="search-box" placeholder="Cari berdasarkan nama lokasi..." class="input-crud bg-white"
                value="{{ request()->get('search') }}" />
        </div>
        <div class="relative">
            <div class="absolute loader-animation z-[5] w-full h-full bg-black/20 hidden justify-center items-center">
                <svg aria-hidden="true" class="w-10 h-10 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="currentColor" />
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentFill" />
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
            <div id="map"></div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        let facilities = JSON.parse('<?= json_encode($facilities) ?>')

        $(function() {
            let facilityData = []
            facilities.forEach(facility => {
                facilityData.push(facility.name)
            })
            $("#search-box").autocomplete({
                source: function(request, response) {
                    var results = $.ui.autocomplete.filter(facilityData, request.term);
                    response(results.slice(0, 15));
                }
            });
        });

        // initialize the map on the "map" div with a given center and zoom
        let map = L.map('map')
        $("#search-box").change(function() {
            setTimeout(() => {
                $(".loader-animation").toggleClass("active")
                if ($("#search-box").val() !== "") {
                    let findLocation = facilities.filter(facility => facility.name == $("#search-box")
                        .val())[0]
                    console.log(findLocation)
                    map.setView([parseFloat(findLocation.latitude), parseFloat(findLocation.longitude)],
                        50);
                } else {
                    map.setView([-8.659488860100769, 115.16421012486913], 15);
                }
            }, 1000);
            $(".loader-animation").toggleClass("active")
        })
        map.setView([-8.659488860100769, 115.16421012486913], 15);


        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.Control.geocoder().addTo(map)

        facilities.forEach(facility => {
            $("#search-box").change(function() {
                setTimeout(() => {
                    if ($("#search-box").val() !== "") {
                        if (facility.name === $("#search-box").val()) {
                            showPopupMap(facility, "facilities", true)
                            $("#search-box").val("")
                        } else {
                            showPopupMap(facility, "facilities")
                        }
                    } else {
                        showPopupMap(facility, "facilities")
                    }
                }, 1000);
            })
            showPopupMap(facility, "facilities")
        });
    </script>
@endpush
