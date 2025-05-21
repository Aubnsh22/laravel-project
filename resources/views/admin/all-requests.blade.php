<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>AubCharika - All Requests</title>
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

    .requests-container {
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

    .requests-section {
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(10px);
      border-radius: 12px;
      padding: 30px;
      border: 1px solid rgba(255, 179, 0, 0.2);
      max-height: 500px; /* Limit the height of the section */
      overflow-y: auto; /* Add vertical scrollbar */
    }

    .request-table {
      width: 100%;
      border-collapse: collapse;
    }

    .request-table th, .request-table td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid rgba(255, 179, 0, 0.2);
    }

    .request-table th {
      background: rgba(255, 179, 0, 0.15);
      color: #ffc107;
      position: sticky;
      top: 0;
      z-index: 1;
    }

    .request-table tr:hover {
      background: rgba(255, 255, 255, 0.05);
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
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 179, 0, 0.2);
      color: white;
    }

    .modal-header, .modal-footer {
      border: none;
    }

    .modal-title {
      color: #ffc107;
    }

    .certificate-section img, .certificate-section object {
      max-width: 100%;
      border: 1px solid rgba(255, 179, 0, 0.2);
      border-radius: 8px;
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
        <a href="{{ route('dashboard') }}" class="nav-link">
          <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.employees') }}" class="nav-link">
          <i class="fas fa-users"></i> Employees
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('tasksadmin') }}" class="nav-link">
          <i class="fas fa-tasks"></i> Tasks
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('statistics') }}" class="nav-link">
          <i class="fas fa-chart-bar"></i> Statistics
        </a>
      </li>
      <li class="nav-item">
        <a id="page" href="{{ url('settingsadmin') }}" class="nav-link active">
          <i class="fas fa-envelope"></i> Requests
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('message') }}" class="nav-link">
          <i class="fas fa-envelope"></i> Message
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('settings') }}" class="nav-link">
          <i class="fas fa-cog"></i> Settings
        </a>
      </li>
    </ul>
  </div>
  <div>
    <ul id="Elements2" class="nav nav-pills flex-column">
      <li class="nav-item">
        <a href="{{ route('myaccountt') }}" class="nav-link">
          <i class="fas fa-user-circle"></i> My Account
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('logout') }}" class="nav-link">
          <i class="fas fa-sign-out-alt"></i> Sign Out
        </a>
      </li>
    </ul>
  </div>
</div>

<!-- Main Content -->
<div class="main-content">
  <div class="requests-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div class="search-bar">
        <input type="text" class="form-control" placeholder="Search Requests...">
      </div>
      <div class="notification-icon">
        <button class="btn rounded-circle">
          <i class="fas fa-bell"></i>
        </button>
      </div>
    </div>

    <div class="hero-section">
      <h1 class="fw-bold mb-3">All Requests<br>Overview</h1>
      <a href="{{ route('requests') }}" class="btn btn-dark fw-semibold me-3">View Pending Requests</a>
      <button class="btn btn-outline-dark fw-semibold">Filter Requests</button>
    </div>

    <div class="requests-section">
      <h4 class="mb-4">All Requests</h4>
      @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif
      <table class="request-table">
        <thead>
          <tr>
            <th>Employee</th>
            <th>Request Type</th>
            <th>Submitted</th>
            <th>Duration</th>
            <th>Status</th>
            <th>Certificate</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($requests as $request)
            <tr>
              <td>{{ $request->user->full_name }}</td>
              <td>{{ ucfirst($request->leave_type) }} Leave</td>
              <td>{{ $request->created_at->format('Y-m-d') }}</td>
              <td>
                {{ \Carbon\Carbon::parse($request->start_date)->diffInDays(\Carbon\Carbon::parse($request->end_date)) + 1 }} days
              </td>
              <td>
                <span class="badge {{ $request->status == 'approved' ? 'bg-success' : ($request->status == 'denied' ? 'bg-danger' : 'bg-warning') }}">
                  {{ ucfirst($request->status) }}
                </span>
              </td>
              <td>
                @if ($request->certificate_path)
                  <a href="#" class="text-info text-decoration-none view-details-btn"
                     data-bs-toggle="modal"
                     data-bs-target="#requestDetailsModal"
                     data-employee="{{ $request->user->full_name }}"
                     data-type="{{ ucfirst($request->leave_type) }} Leave"
                     data-start-date="{{ $request->start_date }}"
                     data-end-date="{{ $request->end_date }}"
                     data-message="{{ $request->message }}"
                     data-certificate-path="{{ $request->certificate_path ? asset('storage/' . $request->certificate_path) : '' }}"
                     data-extension="{{ $request->certificate_path ? pathinfo($request->certificate_path, PATHINFO_EXTENSION) : '' }}"
                     data-request-id="{{ $request->id }}">
                    View
                  </a>
                @else
                  <span class="text-muted">N/A</span>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center">No requests found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Modal for Request Details -->
    <div class="modal fade" id="requestDetailsModal" tabindex="-1" aria-labelledby="requestDetailsModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="requestDetailsModalLabel">Leave Request Details</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p><strong>Employee:</strong> <span id="modal-employee"></span></p>
            <p><strong>Type:</strong> <span id="modal-type"></span></p>
            <p><strong>Dates:</strong> <span id="modal-start-date"></span> to <span id="modal-end-date"></span></p>
            <p><strong>Message:</strong> <span id="modal-message"></span></p>
            <div class="certificate-section mt-4" id="modal-certificate-section">
              <h5 class="mb-3">Medical Certificate</h5>
              <div id="modal-certificate-content"></div>
              <div id="modal-download-link"></div>
            </div>
            <p class="text-muted mt-4" id="modal-no-certificate" style="display: none;">No medical certificate uploaded.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
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

  document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('requestDetailsModal');
    modal.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget;
      const employee = button.getAttribute('data-employee');
      const type = button.getAttribute('data-type');
      const startDate = button.getAttribute('data-start-date');
      const endDate = button.getAttribute('data-end-date');
      const message = button.getAttribute('data-message');
      const certificatePath = button.getAttribute('data-certificate-path');
      const extension = button.getAttribute('data-extension').toLowerCase();
      const requestId = button.getAttribute('data-request-id');

      document.getElementById('modal-employee').textContent = employee;
      document.getElementById('modal-type').textContent = type;
      document.getElementById('modal-start-date').textContent = startDate;
      document.getElementById('modal-end-date').textContent = endDate;
      document.getElementById('modal-message').textContent = message;

      const certificateSection = document.getElementById('modal-certificate-section');
      const certificateContent = document.getElementById('modal-certificate-content');
      const downloadLinkContainer = document.getElementById('modal-download-link');
      const noCertificateMessage = document.getElementById('modal-no-certificate');

      if (certificatePath && extension) {
        certificateSection.style.display = 'block';
        noCertificateMessage.style.display = 'none';
        certificateContent.innerHTML = '';
        downloadLinkContainer.innerHTML = '';

        if (['jpg', 'jpeg', 'png'].includes(extension)) {
          const img = document.createElement('img');
          img.src = certificatePath;
          img.alt = 'Medical Certificate';
          img.className = 'img-fluid';
          certificateContent.appendChild(img);
        } else {
          const object = document.createElement('object');
          object.data = certificatePath;
          object.type = 'application/pdf';
          object.width = '100%';
          object.height = '500px';
          object.innerHTML = `<p>Unable to display PDF.</p>`;
          certificateContent.appendChild(object);

          const downloadLink = document.createElement('a');
          downloadLink.href = `/requests/${requestId}/download`;
          downloadLink.className = 'btn btn-outline-warning mt-2';
          downloadLink.textContent = 'Download PDF';
          downloadLinkContainer.appendChild(downloadLink);
        }
      } else {
        certificateSection.style.display = 'none';
        noCertificateMessage.style.display = 'block';
      }
    });
  });
</script>
</body>
</html>