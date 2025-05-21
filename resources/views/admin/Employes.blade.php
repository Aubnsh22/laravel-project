<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>AubCharika - Employees</title>
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

    .employees-container {
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

    .employees-section {
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(10px);
      border-radius: 12px;
      padding: 30px;
      border: 1px solid rgba(255, 179, 0, 0.2);
    }

    .employee-table {
      width: 100%;
      border-collapse: collapse;
    }

    .employee-table th, .employee-table td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid rgba(255, 179, 0, 0.2);
    }

    .employee-table th {
      background: rgba(255, 179, 0, 0.15);
      color: #ffc107;
    }

    .employee-table tr:hover {
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
        <a href="{{ url('employees') }}" class="nav-link active">
          <i class="fas fa-users"></i> Employees
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('set-expected-hours') }}" class="nav-link">
          <i class="fas fa-cog"></i> Set Schedule
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
        <a href="{{ url('blacklist') }}" class="nav-link">
          <i class="fas fa-envelope"></i> blacklist
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
  <div class="employees-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div class="search-bar">
        <input type="text" class="form-control" placeholder="Search Employees...">
      </div>
      <div class="notification-icon">
        <button class="btn rounded-circle">
          <i class="fas fa-bell"></i>
        </button>
      </div>
    </div>
    <div class="hero-section">
      <h1 class="fw-bold mb-3">Employee Management<br>Overview</h1>
      <button class="btn btn-dark fw-semibold me-3" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">Add Employee</button>
      <button class="btn btn-outline-dark fw-semibold">Export Data</button>
    </div>
    <div class="employees-section">
      <h4 class="mb-4">Employee List</h4>
      <table class="employee-table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Role</th>
            <th>Department</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($employees as $employee)
            @if ($employee->role !== 'admin' && $employee->role !== 'Admin' )
              <tr>
                <td>{{ $employee->full_name }}</td>
                <td>{{ $employee->role }}</td>
                <td>{{ $employee->department }}</td>
                <td>
                  <button class="btn btn-sm btn-outline-light action-btn me-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $employee->id }}">Edit</button>
                  <form action="{{ route('employee.destroy', $employee->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger action-btn" onclick="return confirm('Are you sure you want to delete this employee?')">Remove</button>
                  </form>
                </td>
              </tr>
            @endif
          @empty
            <tr>
              <td colspan="4">No employees found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Edit Employee Modals -->
@foreach ($employees as $employee)
  <div class="modal fade" id="editModal{{ $employee->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $employee->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel{{ $employee->id }}">Edit Employee</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('employee.update', $employee->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="full_name{{ $employee->id }}" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="full_name{{ $employee->id }}" name="full_name" value="{{ $employee->full_name }}" required>
                @error('full_name') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
              <div class="col-md-6 mb-3">
                <label for="username{{ $employee->id }}" class="form-label">Username</label>
                <input type="text" class="form-control" id="username{{ $employee->id }}" name="username" value="{{ $employee->username }}" required>
                @error('username') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
              <div class="col-md-6 mb-3">
                <label for="email{{ $employee->id }}" class="form-label">Email</label>
                <input type="email" class="form-control" id="email{{ $employee->id }}" name="email" value="{{ $employee->email }}" required>
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
              <div class="col-md-6 mb-3">
                <label for="phone_number{{ $employee->id }}" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phone_number{{ $employee->id }}" name="phone_number" value="{{ $employee->phone_number }}" required>
                @error('phone_number') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
              <div class="col-md-6 mb-3">
                <label for="department{{ $employee->id }}" class="form-label">Department</label>
                <select class="form-control" id="department{{ $employee->id }}" name="department" required>
                  <option value="Information Technology" {{ $employee->department == 'Information Technology' ? 'selected' : '' }}>Information Technology</option>
                  <option value="Creative" {{ $employee->department == 'Creative' ? 'selected' : '' }}>Creative</option>
                  <option value="Operations" {{ $employee->department == 'Operations' ? 'selected' : '' }}>Operations</option>
                  <option value="Human Resources" {{ $employee->department == 'Human Resources' ? 'selected' : '' }}>Human Resources</option>
                </select>
                @error('department') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
              <div class="col-md-6 mb-3">
                <label for="role{{ $employee->id }}" class="form-label">Role</label>
                <select class="form-control" id="role{{ $employee->id }}" name="role" required>
                  <option value="Employee" {{ $employee->role == 'Employee' ? 'selected' : '' }}>Employee</option>
                  <option value="Developer" {{ $employee->role == 'Developer' ? 'selected' : '' }}>Developer</option>
                  <option value="Designer" {{ $employee->role == 'Designer' ? 'selected' : '' }}>Designer</option>
                  <option value="Manager" {{ $employee->role == 'Manager' ? 'selected' : '' }}>Manager</option>
                </select>
                @error('role') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
              <div class="col-md-6 mb-3">
                <label for="hire_date{{ $employee->id }}" class="form-label">Hire Date</label>
                <input type="date" class="form-control" id="hire_date{{ $employee->id }}" name="hire_date" value="{{ $employee->hire_date }}" required>
                @error('hire_date') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
              <div class="col-md-6 mb-3">
                <label for="work_location{{ $employee->id }}" class="form-label">Work Location</label>
                <input type="text" class="form-control" id="work_location{{ $employee->id }}" name="work_location" value="{{ $employee->work_location }}" required>
                @error('work_location') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endforeach

<!-- Add Employee Modal -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addEmployeeModalLabel">Add New Employee</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="addEmployeeForm" action="{{ route('employee.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="fullName" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="fullName" name="full_name" placeholder="Saad Nassih" required>
              @error('full_name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="saadnassih" required>
              @error('username') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="saad.nassih@example.com" required>
              @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label for="phoneNumber" class="form-label">Phone Number</label>
              <input type="tel" class="form-control" id="phoneNumber" name="phone_number" placeholder="+212 600 123 456" required>
              @error('phone_number') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label for="department" class="form-label">Department</label>
              <select class="form-control" id="department" name="department" required>
                <option value="" disabled selected>Select Department</option>
                <option value="Information Technology">Information Technology</option>
                <option value="Creative">Creative</option>
                <option value="Operations">Operations</option>
                <option value="Human Resources">Human Resources</option>
              </select>
              @error('department') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label for="role" class="form-label">Role</label>
              <select class="form-control" id="role" name="role" required>
                <option value="" disabled selected>Select Role</option>
                <option value="Employee">Employee</option>
                <option value="Developer">Developer</option>
                <option value="Designer">Designer</option>
                <option value="Manager">Manager</option>
              </select>
              @error('role') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label for="hireDate" class="form-label">Hire Date</label>
              <input type="date" class="form-control" id="hireDate" name="hire_date" required>
              @error('hire_date') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label for="workLocation" class="form-label">Work Location</label>
              <input type="text" class="form-control" id="workLocation" name="work_location" placeholder="Main Office, Casablanca" required>
              @error('work_location') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Employee</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- User Card -->
<div id="carte" class="user-card-container mr-5">
  <div class="user-header d-flex align-items-center justify-content-between mb-3">
    <div>
      <h6 class="fw-bold mb-0">Saad Nassih</h6>
      <small>Admin</small>
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