@extends('layout.weblayout')

@section('profileview')
    <div class="profileview-container">
        <div class="left-column">
           <div class="card-body pt-3">
            <ul class="nav nav-link-profile flex-column fw-bold gap-2">
                <li class="nav-item">
                    <a href="{{route('profile')}}" class="{{(Route::is('profile')) ? 'profile-active' : ''}} nav-link">ACCOUNT DETAILS</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('passwordprofile')}}" class="nav-link">PRIVACY AND SECURITY</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('reservationhistoryprofile')}}" class="nav-link">RESERVATION HISTORY</a>
                </li>
            </ul>
           </div>
        </div>
        <div class="right-column">
           
        </div>
    </div>
@endsection
