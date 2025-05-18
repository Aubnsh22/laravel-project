@extends('employee/Sidebar')
@section('sidebar')
<!-- Main Content -->
<div class="main-content">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div class="search-bar">
      <input type="text" class="form-control" placeholder="Search Here">
    </div>
    <div class="notification-icon " >
      <button class="btn btn-warning rounded-circle p-2">
        <i class="fas fa-bell"></i>
      </button>
    </div>
  </div>

  <div class="hero-section p-5 rounded-4 mb-4">
    <h1 class="fw-bold text-white mb-3">Full Workforce<br>Tracking Services</h1>
    <button class="btn btn-light fw-semibold me-3">Get Started</button>
    <button class="btn btn-outline-light fw-semibold">Learn More</button>
  </div>

  <!-- Partie Clock In seule dans le main-content -->
  <div class="clock-in-section d-flex align-items-center p-4 rounded-4">
    <div class="circle bg-danger me-3"></div>
    <div class="clockin">
      <button class="btn btn-light fw-semibold mb-2">Today's Attendance</button><br>
      <button class="btn btn-outline-light fw-semibold">Clock In</button>
    </div>
  </div>
</div>
@endsection