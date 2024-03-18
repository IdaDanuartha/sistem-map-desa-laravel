<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="/assets/" data-template="vertical-menu-template-free">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Sistem Map Desa | @yield('title')</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/apex-charts/apex-charts.css" />

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    {{-- JQuery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <!-- Select 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- Rich Text Editor --}}
    <link rel="stylesheet" href="{{ asset('assets/css/richtexteditor/rte_theme_default.css') }}">

    <!-- Helpers -->
    <script src="/assets/vendor/js/helpers.js"></script>
    <script src="/assets/js/config.js"></script>

    {{-- Leaflet Js --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    {{-- Auto Complete Js --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tarekraafat-autocomplete.js/10.2.7/css/autoComplete.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/css/autoComplete.02.min.css">

</head>

<body>
    @if (session()->has('success'))
        <div class="bs-toast toast toast-placement-ex m-2 fade bg-success top-0 end-0 show" role="alert"
            aria-live="assertive" data-bs-delay="2000" aria-atomic="true">
            <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-medium">Success</div>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session('success') }}
            </div>
        </div>
    @elseif(session()->has('error'))
        <div class="bs-toast toast toast-placement-ex m-2 fade bg-danger top-0 end-0 show" role="alert"
            aria-live="assertive" data-bs-delay="2000" aria-atomic="true">
            <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-medium">Error</div>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <x-sidebar-component></x-sidebar-component>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <x-navbar></x-navbar>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('main')
                    </div>
                    <!-- / Content -->



                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- / Layout wrapper -->

        <!-- Core JS -->
        <!-- build:js /assets/vendor/js/core.js -->

        <script src="/assets/vendor/libs/popper/popper.js"></script>
        <script src="/assets/vendor/js/bootstrap.js"></script>
        <script src="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="/assets/vendor/js/menu.js"></script>

        <!-- endbuild -->

        <!-- Vendors JS -->
        <script src="/assets/vendor/libs/apex-charts/apexcharts.js"></script>

        <!-- Main JS -->
        <script src="/assets/js/main.js"></script>

        <!-- Page JS -->
        <script src="/assets/js/dashboards-analytics.js"></script>

        {{-- Rich Text Editor --}}
        <script src="{{ asset('assets/js/richtexteditor/all_plugins.js') }}"></script>
        <script src="{{ asset('assets/js/richtexteditor/rte.js') }}"></script>

        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
        <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>

        {{-- Auto Complete JS --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tarekraafat-autocomplete.js/10.2.7/autoComplete.min.js"></script>

        <script>
            const previewImg = (input_img, preview_img) => {
                $(`.${input_img}`).change(function() {
                    $(`.${preview_img}`).attr("src", URL.createObjectURL($(`.${input_img}`)[0].files[0]))
                })
            }

            const previewMultipleImages = (input_img, preview_imgs) => {
                $(`.${input_img}`).change(function() {
                    $(`.${preview_imgs}`).html('')
                    for (let i = 0; i < this.files.length; i++) {
                        $(`.${preview_imgs}`).append(`
              <div class="col-3 mb-4">
                <img src="${URL.createObjectURL($(`.${input_img}`)[0].files[i])}" class="border" width="100%" alt="">
              </div>
            `)
                    }
                })
            }

            const formatDate = (date, show_age = false) => {
                const object_date = new Date(date)
                const monthNames = ["January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"
                ];

                let result = `${object_date.getDate()} ${monthNames[object_date.getMonth()]} ${object_date.getFullYear()} `
                if (show_age) {
                    const diff_ms = Date.now() - object_date.getTime();
                    const age_dt = new Date(diff_ms);

                    const age = Math.abs(age_dt.getUTCFullYear() - 1970);
                    return result += `(${age} years old)`
                }

                return result
            }

            const addHours = (date, hours) => {
                date.setHours(date.getHours() + hours);
                return date;
            }

            const formatTime = (date, showInInput = false) => {
                return addHours(new Date(date), 16).toLocaleTimeString([], showInInput ? {
                    hour12: false
                } : {
                    hour: "2-digit",
                    minute: "2-digit"
                })
            }

            const showInputDate = (date) => {
                const object_date = new Date(date)
                return `${object_date.getFullYear()}-${String(object_date.getMonth() + 1).padStart(2, '0')}-${String(object_date.getDate()).padStart(2, '0')}`
            }

            $(document).ready(function() {
                $('.dataTable').DataTable({

                });
            });
            $('.dataTable').dataTable({
                "pageLength": 10,
                "language": {
                    "paginate": {
                        "next": '<span class="material-symbols-outlined">arrow_forward_ios</span>',
                        "previous": '<span class="material-symbols-outlined">arrow_back_ios </span>'
                    }
                }
            });
            oTable = $('.dataTable')
            .DataTable(); //pay attention to capital D, which is mandatory to retrieve "api" datatables' object, as @Lionel said
            $('.searchInputTable').keyup(function() {
                oTable.search($(this).val()).draw();
            })

            const showPopupMap = (data, path, show_popup = false) => {
                const marker = L.marker([data.latitude, data.longitude]).addTo(map)
                if(data.path) {
                    marker
                    .bindPopup(`
                        <h6>${data.name}</h6>
                        <img class="w-full mb-2" src="uploads/${path}/${data.path}" />
                        <div class="flex justify-center">
                            <a href="${path}/${data.id}" class="button btn-main text-white px-10 py-0.5" style="font-size: 10px;">Detail</a>    
                        </div>
                    `)

                    if(show_popup) marker.openPopup()
                } else {
                    marker
                    .bindPopup(`
                        <h6>${data.name}</h6>
                        <div class="flex justify-center">
                            <a href="${path}/${data.id}" class="button btn-main text-white px-10 py-0.5" style="font-size: 10px;">Detail</a>    
                        </div>
                    `)

                    if(show_popup) marker.openPopup()
                }
            }
        </script>

        @stack('js')

</body>

</html>
