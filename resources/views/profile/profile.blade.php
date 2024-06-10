@extends('layout.weblayout')

@section('profileview')
    <div class="container py-4">
            <div class="profileview-container">
                @include('profile.leftcolumn_sidebar')
                <div class="right-column profile" @readonly(true)>
                    <div class="img-circle text-center">
                        <img src="{{ $user->getImageURL() }}" alt="">

                    </div>
                    <hr>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-edit-profile">
                        <span class="ri-pencil-line"></span>Edit
                    </a>
                    <div class="inputBox firstname">
                        <input type="text" value="{{ $user->first_name }}" disabled>
                        <span>First Name</span>
                    </div>
                    <div class="inputBox middlename">
                        <input type="text" value="{{ $user->middle_name }}" disabled>
                        <span>Middle Name</span>
                    </div>
                    <div class="inputBox lastname">
                        <input type="text" value="{{ $user->last_name }}" disabled>
                        <span>Last Name</span>
                    </div>
                    <div class="inputBox email">
                        <input type="text" value="{{ $user->email }}" disabled>
                        <span>Email</span>
                    </div>
                    <div class="inputBox contact-number">
                        <input type="text" value="{{ $user->contact_number }}"disabled>
                        <span>Contact Number</span>
                    </div>

                </div>

            </div>
    </div>
@endsection
