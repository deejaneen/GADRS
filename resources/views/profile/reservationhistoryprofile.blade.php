@extends('layout.weblayout')

@section('profileview')
    <div class="profileview-container">
        <div class="left-column">
           <div class="card-body pt-3">
            <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
                <li class="nav-item">
                    <a href="{{route('profile')}}" class="nav-link">ACCOUNT DETAILS</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('passwordprofile')}}" class="nav-link">PRIVACY AND SECURITY</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('reservationhistoryprofile')}}" class="{{(Route::is('reservationhistoryprofile')) ? 'text-white bg-primary rounded' : ''}} nav-link">RESERVATION HISTORY</a>
                </li>
            </ul>
           </div>
        </div>
        <div class="right-column">
            <!-- Content for the right column goes here -->
            <h2>Right Column</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec velit eu est eleifend viverra. Nullam
                euismod nulla id bibendum accumsan. Mauris suscipit consectetur tellus.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec velit eu est eleifend viverra. Nullam
                euismod nulla id bibendum accumsan. Mauris suscipit consectetur tellus.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec velit eu est eleifend viverra. Nullam
                euismod nulla id bibendum accumsan. Mauris suscipit consectetur tellus.</p>
        </div>
    </div>
@endsection
