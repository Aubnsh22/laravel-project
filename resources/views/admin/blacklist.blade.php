<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>AubCharika - Blacklist</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    :root {
      --primary-bg: #0a0913;
      --gold-gradient: linear-gradient(195deg, rgba(255, 179, 0, 1) 0%, rgba(255, 147, 5, 1) 67%, rgba(248, 238, 196, 1) 100%);
      --sidebar-width: 220px;
      --user-card-width: 280px;
    }

    body {
      margin: 0;
      height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: var(--primary-bg);
      background-image:
        radial-gradient(circle at bottom left, #e28d0ec2 0%, #865c1dbc 5%, #131209 30%),
        radial-gradient(circle at top right, #b3781d00 0%, #fb9b0c40 20%, #090811 60%);
      background-repeat: no-repeat;
      background-size: cover;
      display: grid;
      grid-template-columns: var(--sidebar-width) auto var(--user-card-width);
      gap: 30px;
      color: white;
    }

    .sidebar {
      width: var(--sidebar-width);
      height: 100vh;
      position: fixed;
      left: 0;
      top: 0;
      padding: 20px;
      background: rgba(0, 0, 0, 0.3);
      backdrop-filter: blur(10px);
      border-right: 1px solid rgba(255, 179, 0, 0.1);
    }

    .logo {
      width: 40px;
      height: auto;
    }

    .nav-link {
      color: rgba(255, 255, 255, 0.8);
      padding: 12px 15px;
      border-radius: 8px;
      margin: 5px 0;
      transition: all 0.3s;
    }

    .nav-link:hover {
      background: rgba(255, 179, 0, 0.15);
      color: #ffc107;
    }

    .nav-link.active {
      background: var(--gold-gradient);
      color: #000;
      font-weight: 600;
      box-shadow: 0 4px 15px rgba(255, 179, 0, 0.3);
    }

    .nav-link i {
      width: 20px;
      text-align: center;
      margin-right: 10px;
    }

    .main-content {
      grid-column: 2;
      padding: 30px;
      margin-left: 30px;
    }

    .user-card-container {
      grid-column: 3;
      width: 280px;
      background-color: #000;
      color: white;
      border-radius: 10px;
      padding: 20px;
      font-family: 'Segoe UI', sans-serif;
      height: fit-content;
      margin-top: 30px;
      position: sticky;
      top: 30px;
    }

    .blacklist-container {
      max-width: 800px;
      margin: 0 auto;
    }

    .hero-section {
      background: var(--gold-gradient);
      border-radius: 12px;
      padding: 30px;
      margin-bottom: 25px;
      color: #000;
      box-shadow: 0 4px 15px rgba(255, 179, 0, 0.3);
    }

    .blacklist-section {
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(10px);
      border-radius: 12px;
      padding: 30px;
      border: 1px solid rgba(255, 179, 0, 0.2);
    }

    .blacklist-table {
      width: 100%;
      border-collapse: collapse;
    }

    .blacklist-table th, .blacklist-table td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid rgba(255, 179, 0, 0.2);
    }

    .blacklist-table th {
      background: rgba(255, 179, 0, 0.15);
      color: #ffc107;
    }

    .blacklist-table tr:hover {
      background: rgba(255, 255, 255, 0.05);
    }

    .action-btn {
      padding: 5px 10px;
      font-size: 0.85rem;
      border-radius: 5px;
    }

    .date-box {
      background: var(--gold-gradient);
      padding: 10px;
      border-radius: 15px;
      width: 100px;
      color: white;
    }

    .time-box {
      background-color: #ffffff;
      padding: 10px;
      border-radius: 15px;
      width: 80px;
      color: black;
    }

    .message-box {
      background: var(--gold-gradient);
      border-radius: 15px;
      padding: 10px;
      color: black;
    }

    .search-bar input {
      background: rgba(255, 255, 255, 0.1);
      border: none;
      color: white;
      padding: 10px 15px;
      border-radius: 8px;
      width: 300px;
    }

    .notification-icon .btn {
      background: var(--gold-gradient);
      color: #000;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .user-avatar-small {
      width: 30px;
      height: 30px;
      object-fit: cover;
      border-radius: 50%;
    }

    #carte {
      background: none !important;
    }

    .user-avatar {
      width: 40px;
      height: 40px;
      object-fit: cover;
      border-radius: 50%;
    }

    .modal-content {
      background: rgba(0, 0, 0, 0.9);
      color: white;
      border: 1px solid rgba(255, 179, 0, 0.2);
    }

    .modal-header {
      border-bottom: 1px solid rgba(255, 179, 0, 0.2);
    }

    .modal-footer {
      border-top: 1px solid rgba(255, 179, 0, 0.2);
    }

    .form-control {
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 179, 0, 0.2);
      color: white;
    }

    .form-control:focus {
      background: rgba(255, 255, 255, 0.2);
      border-color: #ffc107;
      color: white;
      box-shadow: none;
    }

    .form-label {
      color: #ffc107;
    }
  </style>
</head>
<body>
<!-- Sidebar -->
<div class="sidebar d-flex flex-column justify-content-between p-3">
  <div>
    <div id="logo" class="text-center mb-4 d-flex align-items-center justify-content-center">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo me-2">
      <h5 class="text-warning fw-bold mt-1">AubCharika</h5>
    </div>
    <ul id="elements" class="nav flex-column mb-auto">
      <li class="nav-item">
        <a href="{{ url('dashboard') }}" class="nav-link">
          <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('employees') }}" class="nav-link">
          <i class="fas fa-users"></i> Employees
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('tasksadmin') }}" class="nav-link">
          <i class="fas fa-tasks"></i> Tasks
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('statistics') }}" class="nav-link">
          <i class="fas fa-chart-bar"></i> Statistics
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('requests') }}" class="nav-link">
          <i class="fas fa-envelope"></i> Requests
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('message') }}" class="nav-link">
          <i class="fas fa-envelope"></i> Message
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('blacklist') }}" class="nav-link active">
          <i class="fas fa-ban"></i> Blacklist
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('settingsadmin') }}" class="nav-link">
          <i class="fas fa-cog"></i> Settings
        </a>
      </li>
    </ul>
  </div>
  <div>
    <ul id="Elements2" class="nav nav-pills flex-column">
      <li class="nav-item">
        <a href="{{ url('myaccountt') }}" class="nav-link">
          <i class="fas fa-user-circle"></i> My Account
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="fas fa-sign-out-alt"></i> Sign Out
        </a>
      </li>
    </ul>
  </div>
</div>

<!-- Main Content -->
<div class="main-content">
  <div class="blacklist-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div class="search-bar">
        <input type="text" class="form-control" placeholder="Search Blacklisted Users...">
      </div>
      <div class="notification-icon">
        <button class="btn rounded-circle">
          <i class="fas fa-bell"></i>
        </button>
      </div>
    </div>
    <div class="hero-section">
      <h1 class="fw-bold mb-3">Blacklist Management<br>Overview</h1>
      <button class="btn btn-dark fw-semibold me-3" data-bs-toggle="modal" data-bs-target="#addToBlacklistModal">Add to Blacklist</button>
      <button class="btn btn-outline-dark fw-semibold">Export Data</button>
    </div>
    <div class="blacklist-section">
      <h4 class="mb-4">Blacklisted Users</h4>
      @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif
      <table class="blacklist-table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Role</th>
            <th>Department</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($blacklistedUsers as $user)
            <tr>
              <td>{{ $user->full_name }}</td>
              <td>{{ $user->role }}</td>
              <td>{{ $user->department }}</td>
              <td>
                <span class="badge {{ $user->status == 'blocked' ? 'bg-danger' : 'bg-success' }}">
                  {{ ucfirst($user->status) }}
                </span>
              </td>
              <td>
                <form action="{{ route('blacklist.remove', $user->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger action-btn" onclick="return confirm('Are you sure you want to remove this user from the blacklist?')">Remove</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5">No blacklisted users found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Add to Blacklist Modal -->
<div class="modal fade" id="addToBlacklistModal" tabindex="-1" aria-labelledby="addToBlacklistModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addToBlacklistModalLabel">Add User to Blacklist</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('blacklist.add') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12 mb-3">
              <label for="userId" class="form-label">Select User</label>
              <select class="form-control" id="userId" name="user_id" required>
                <option value="" disabled selected>Select a user</option>
                @foreach ($availableUsers as $user)
                  <option value="{{ $user->id }}">{{ $user->full_name }} ({{ $user->username }})</option>
                @endforeach
              </select>
              @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add to Blacklist</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- User Card -->
<div id="carte" class="user-card-container mr-5">
  <div class="user-header d-flex align-items-center justify-content-between mb-3">
    <div>
      <h6 class="fw-bold mb-0">{{ Auth::user()->full_name ?? 'Saad Nassih' }}</h6>
      <small>{{ Auth::user()->role ?? 'Admin' }}</small>
    </div>
    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="avatar" class="user-avatar">
  </div>
  <div class="section-label">Date</div>
  <div class="d-flex align-items-center gap-2 mb-3">
    <div class="date-box text-center">
      <div class="fw-bold fs-5" id="year"></div>
      <div class="fs-6" id="month"></div>
      <div class="fs-3 fw-bold" id="day"></div>
      <div class="small" id="weekday"></div>
    </div>
    <div class="time-box text-center">
      <div class="fs-1 fw-bold" id="hour"></div>
      <div class="fs-1 fw-bold" id="minute"></div>
      <div class="text-uppercase small text-primary" id="ampm"></div>
    </div>
  </div>
  <div class="section-label">Message</div>
  <div class="message-box d-flex align-items-start gap-2">
    <img src="https://randomuser.me/api/portraits/men/36.jpg" alt="avatar" class="user-avatar-small">
    <div>
      <div class="fw-bold small">Mr Ayoub Nassih <span class="text-muted">• 1 Minute Ago</span></div>
      <div>Khdm mgwd wla sir t9wd</div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function updateDateTime() {
    const now = new Date();
    document.getElementById('year').textContent = now.getFullYear();
    document.getElementById('month').textContent = now.toLocaleString('default', { month: 'short' });
    document.getElementById('day').textContent = now.getDate();
    document.getElementById('weekday').textContent = now.toLocaleString('default', { weekday: 'long' });
    let hours = now.getHours();
    const ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12;
    const minutes = now.getMinutes().toString().padStart(2, '0');
    document.getElementById('hour').textContent = hours;
    document.getElementById('minute').textContent = minutes;
    document.getElementById('ampm').textContent = ampm;
  }
  updateDateTime();
  setInterval(updateDateTime, 60000);
</script>
</body>
</html>