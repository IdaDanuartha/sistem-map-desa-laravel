@extends('layouts.main')
@section('title', 'Profile Pengguna')
@section('main')
    <div class="mt-[20px] p-0 flex gap-5 lg:flex-row flex-col">
        {{-- <div class="table-wrapper p-[18px] w-full h-fit md:max-w-[300px]">
        @if (isset(auth()->user()->profile_image))
            <img src="{{ asset('uploads/users/' . auth()->user()->profile_image) }}" alt="Profile Image" class="rounded w-full edit-profile-preview-img aspect-square object-cover object-center h-auto"/>
        @else
            <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Profile Image" class="edit-profile-preview-img rounded w-full aspect-square object-cover object-center h-auto"/>
        @endif
    </div> --}}
        <div class="table-wrapper w-full">
            <div class="row">
                <div class="col-md-6 col-12 mb-4 flex flex-col">
                    <label class="text-second">Username</label>
                    <input type="text" class="input-crud" value="{{ auth()->user()->username }}" readonly />
                </div>
                <div class="col-md-6 col-12 mb-4 flex flex-col">
                    <label class="text-second">Email</label>
                    <input type="text" class="input-crud" value="{{ auth()->user()->email }}" readonly />
                </div>
                <div class="col-12 mt-3">
                    <a href="{{ route('profile.edit') }}" class="button btn-main">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
@endsection
