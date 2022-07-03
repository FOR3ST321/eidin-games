@extends('partial.headerFooter')

@section('content')
<div style="margin-top: 50px;margin-bottom:50px">
    <div class="container d-flex justify-content-between">
        <div class="col-5 d-flex flex-column align-items-center">
            <img src="{{ $profile->profile_url }}" alt="" class="rounded-circle" style="height: 350px; width:350px">
        </div>
        <div class="col-6">
            <div class="d-flex justify-content-between">
                <div style="width: 60%">
                    <h1>{{ $profile->username }}</h1>
                    <h3>{{ $profile->name }}</h3>
                </div>
                <a href="" class="btn btn-warning fs-5 m-auto" style="height: 45px"><i class="lni lni-pencil-alt"></i> Update</a>
            </div>
            <div class="mt-3 mb-5 border border-3 border-primary"></div>
            <div class="d-flex">
                <div style="width: 20%">
                    <h5 class="text-secondary">Email</h5> <br>
                    <h5 class="text-secondary">Country</h5> <br>
                    <h5 class="text-secondary">Role</h5>
                </div>
                <div style="width: 80%">
                    <h5>: {{ $profile->email }}</h5> <br>
                    <h5>: {{ $profile->country }}</h5> <br>
                    <h5>: {{ucwords(Auth::user()->role)}} {{(Auth::user()->developer != null) ? " And Developer": ""}}</h5>
                </div>
            </div>
            <div class="mt-5 mb-3 border border-3 border-primary"></div>
            <div class="d-flex">
                <div class="text-center" style="width: 25%">
                    Game(s) Uploaded
                    <h2>{{ $games_developed }}</h2>
                </div>
                <div class="text-center" style="width: 25%">
                    Game(s) Owned
                    <h2>{{ $games }}</h2>
                </div>
                <div class="text-center" style="width: 25%">
                    Review(s) Written
                    <h2>{{ $reviews }}</h2>
                </div>
                <div class="text-center" style="width: 25%">
                    Donation(s) Given
                    <h2>{{ $donations }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
