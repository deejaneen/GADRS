@extends('layout.receivinglayout')

@section('receivingdashboard')
<aside>
    <div class="top">
        <div class="logo">
            <img src="{{ asset('images/COA CAR logo.png') }}" alt="">
            <h2 class="primary-light">COA <span class="danger">CAR</span></h2>
        </div>
        <div class="close" id="close-btn">
            <span class="ri-close-fill"></span>
        </div>

        <div class="sidebar">
            <a href="{{ route('receivinghome') }}" >
                <span class="ri-dashboard-line ">
                    <h3>Dashboard</h3>
                </span>
            </a>
           
            <a href="{{ route('receivingpending') }}" class="active">
                <span class="ri-time-line">
                    <h3>Pending</h3>
                </span>
                
            </a>
            <a href="{{ route('receivingreceived') }}">
                <span class="ri-folder-received-fill">
                    <h3>Received</h3>
                </span>
            </a>
            <a href="{{ route('receivingeditreservations') }}">
                <span class="ri-edit-2-line">
                    <h3>Edit Reservations</h3>
                </span>
            </a>
            <form action="{{ route('logout') }}" method="POST" id="logout-form-navbar">
                @csrf

                <button class="no-underline logout btn btn-danger btn-md" type="submit" id="logout-button">
                    <span class="ri-logout-box-r-line">
                        <h3>LOGOUT</h3></span>
                </button>
            </form>
        </div>
    </div>
</aside>
    <main>
        <h1>Pending</h1>
   

        <div class="insights">
            {{-- -------------------------------END-OF-SALES-------------------- --}}
           
            {{-- -------------------------------END-OF-GYM-RESERVATIONS-------------------- --}}
            <div class="gymreservation">
                <span class="ri-basketball-fill"></span>
                <div class="middle">
                    <div class="left">
                        <h3>Total Pending Reservations - Gym</h3>
                        <h1>
                            {{ $gymsPendingCount }}
                        </h1>
                    </div>
                  
                </div>
            </div>
             {{-- -------------------------------END-OF-DORM-RESERVATIONS-------------------- --}}
           
        </div>

        {{-- ------------------END OF INSIGHTS------------------ --}}
       
    </main>
    
    <div class="right">
        <div class="top">
            <button id="menu-btn">
                <span class="ri-menu-line"></span>
            </button>
            <div class="profile">
                <div class="info">
                    <p>Hey, <b>{{ Auth::user()->first_name }}</b></p>
                    <small class="text-muted">{{ Auth::user()->role }}</small>
                </div>
                <div class="profile-photo">
                    <img src="{{ asset('images/COA CAR logo.png') }}" alt="">
                </div>
            </div>
        </div>
     
        {{-- ------------------ END OF RECENT UPDATES ------------------ --}}
      
    </div>
    <div class="card" id="ReceivingPendingTableCard">
        <div>
            <h2 class="card-header text-center home">Assign a Form Number</h2>
        </div>
        <table class="table-home table-hover stripe" id="ReceivingPendingTable" style="width: 100%">
            <thead>
                <tr>
                    <th scope="col">Form Number</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time Start</th>
                    <th scope="col">Time End</th>
                    <th scope="col">Occupant Type</th>
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gyms as $gym)
                    <tr class="table-active">
                        <td>{{ $gym->form_number_id }}</td>
                        <td>{{ $gym->reservation_date }}</td>
                        <td>{{ $gym->reservation_time_start }}</td>
                        <td>{{ $gym->reservation_time_end }}</td>
                        <td>{{ $gym->occupant_type }}</td>
                        <td>{{ $gym->price }}</td>
                        <td style="color:var(--color-orange);">{{ $gym->status }}</td>
                        <td class="buttons">
                            <form action="">
                                <button class="btn btn-primary btn-lg rounded-pill" id="receivingAssignNumberbtn"
                                    style="color: var(--color-orange);">Assign Number</button>
                            </form>
                            <form action="">
                                <button class="btn btn-primary btn-lg rounded-pill" id="receivingViewFormbtn"
                                    style="color: var(--color-orange);">View Form</button>
                            </form>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>
@endsection
