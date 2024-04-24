@extends('layouts.main')
@section('title', 'Edit Profile Pengguna')
@section('main')
    <form class="mt-[20px] p-0 flex gap-5 lg:flex-row flex-col" action="{{ route("profile.update") }}" method="POST">
        @csrf
        @method("PUT")
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
                    <input type="text" name="username" class="input-crud" value="{{ old("username") ?? auth()->user()->username }}" />
                    @error('username')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mb-4 flex flex-col">
                    <label class="text-second">Email</label>
                    <input type="text" name="email" class="input-crud" value="{{ old("email") ?? auth()->user()->email }}" />
                    @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 col-12 mb-4 flex flex-col">
                    <label class="text-second">Password</label>
                    <input type="password" name="password" class="input-crud"    />
                    @error('password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 mt-3">
                    <button type="submit" class="button btn-main">Edit Profile</button>
                </div>
            </div>
        </div>
    </form>
@endsection
