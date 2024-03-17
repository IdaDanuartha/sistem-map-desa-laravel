@extends('layouts.main')
@section('title', 'Tambah Lokasi')
@section('main')

    <div class="table-wrapper mt-[20px] input-teacher">
        <form action="{{ route('villages.store') }}" method="post" enctype="multipart/form-data"
            class="grid grid-cols-12 gap-4">
            @csrf
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="text" class="form-label">Nama Lokasi</label>
                <input type="date" id="date" name="date" class="input-crud" value="{{ old('date') }}" required />
                @error('date')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="documentation_image" class="text-second">Dokumentasi</label>
                <label for="documentation_image" class="d-block mb-3">
                    <img src="{{ asset('assets/img/upload-image.jpg') }}" class="create-guidance-preview-img border"
                        width="300" alt="">
                </label>
                <input type="file" id="documentation_image" name="documentation_image"
                    class="input-crud py-0 create-guidance-input" />
                @error('documentation_image')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex items-center gap-3 mt-2">
                <button class="button btn-main" type="submit">Tambah</button>
                <a href="{{ route('villages.index') }}" class="button btn-second text-white">Batal Tambah</a>
            </div>
        </form>
    </div>
@endsection

@push('js')
@endpush
