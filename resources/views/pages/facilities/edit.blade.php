@extends('layouts.main')
@section('title', 'Edit Lokasi')
@section('main')

    <div class="table-wrapper mt-[20px] input-teacher">
        <form action="{{ route('villages.update', $village->id) }}" method="post" enctype="multipart/form-data"
            class="grid grid-cols-12 gap-4">
            @csrf
            @method("PUT")
            <div class="col-span-12 md:col-span-6 flex flex-col">
            <label for="name" class="form-label required">Nama Lokasi</label>
                <input type="text" id="name" name="name" placeholder="Nama lokasi tempat..." class="input-crud" value="{{ $village->name }}" required />
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col mt-2.5">
                <label for="description" class="form-label">Deskripsi</label>
                <input type="text" id="description" name="description" placeholder="Deskripsi lokasi..." class="input-crud" value="{{ $village->description }}" />
                @error('description')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="latitude" class="form-label required">Latitude</label>
                <input type="text" id="latitude" name="latitude" placeholder="-8.669707872134664" class="input-crud" value="{{ $village->latitude }}" required />
                @error('latitude')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="longitude" class="form-label required">Longitude</label>
                <input type="text" id="longitude" name="longitude" placeholder="115.21038945070518" class="input-crud" value="{{ $village->longitude }}" required />
                @error('longitude')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 sm:col-span-4 flex flex-col">
                <label for="path" class="text-second">Gambar Lokasi</label>
                <label for="path" class="d-block mb-3">
                    @if (isset($village->path))
                        <img src="{{ asset('uploads/villages/' . $village->path) }}" class="edit-village-preview-img border" width="400" alt="">
                    @else
                        <img src="{{ asset('assets/img/upload-image.jpg') }}" class="edit-village-preview-img border" width="400" alt="">
                    @endif
                </label>
                <input type="file" id="path" name="path"
                    class="input-crud py-0 edit-village-input" />
                @error('path')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex items-center gap-3 mt-2">
                <button class="button btn-main" type="submit">Simpan Perubahan</button>
                <a href="{{ route('villages.index') }}" class="button btn-second text-white">Batal Simpan</a>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
        previewImg("edit-village-input", "edit-village-preview-img")
    </script>
@endpush
