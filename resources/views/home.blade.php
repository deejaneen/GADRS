@extends('layout.weblayout')

@section('banner')
    <div class="container">
        <div class="row">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        <div class="row-top">
            {{-- @auth


                <div class="column-left">
                    <p class="user-name-home">Hi, {{ Auth::user()->first_name }}</p>
                </div>
            @endauth --}}
            <div class="welcome-section">
                <div class="welcome-title1">
                    <h3>WELCOME TO</h3>
                </div>
                <div class="welcome-title2">
                    <h1>GYM AND DORM <span style="color: var(--color-warning)">RESERVATION SYSTEM</span></h1>
                </div>
                <div class="welcome-name">
                    <h3>Hi <span style="color: var(--color-orange)">{{ Auth::user()->first_name }}</span></h3>
                </div>
            </div>

            <div class="column-bar"></div>
            <div class="column-left-top">
            </div>
            <div class="column-left-bottom">
            </div>
            <div class="column-right-top">


            </div>
            <div class="column-right-bottom">
            </div>
        </div>
        <div class="row-bottom">
            <div class="column-bottom">
                <ul class="home-reservation-table">
                    <li class="reservation-table-home">
                        <h1><i class="ri-key-2-fill"></i> MY RESERVATIONS<i class="ri-receipt-fill"></i></h1>
                    </li>
                    <table class="table-home table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Type</th>
                                <th scope="col">Column heading</th>
                                <th scope="col">Column heading</th>
                                <th scope="col">Column heading</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-active">
                                <th scope="row">Active</th>
                                <td>Column content</td>
                                <td>Column content</td>
                                <td>Column content</td>
                            </tr>
                            <tr>
                                <th scope="row">Default</th>
                                <td>Column content</td>
                                <td>Column content</td>
                                <td>Column content</td>
                            </tr>
                        </tbody>
                    </table>
                </ul>
            </div>
        </div>
    </div>
@endsection
