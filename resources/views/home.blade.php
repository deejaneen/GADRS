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
    @auth


    <div class="column-left">
      <p class="user-name-home">Hi, {{ Auth::user()->first_name }}</p>
    </div>
    @endauth
    <div class="column-right">
      <ul class="welcome-to-gadrs">
        <li>
          <h1 class="welcome-text1">WELCOME TO</h1>
        </li>
        <li>
          <h1 class="welcome-text2">COA-CAR</h1>
        </li>
        <li>
          <h1 class="welcome-text1">RESERVATION SYSTEM</h1>
        </li>
      </ul>

    </div>
  </div>
  <div class="row-bottom">
    <div class="column-bottom">
      <ul class="home-reservation-table">
        <li class="test-home">
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