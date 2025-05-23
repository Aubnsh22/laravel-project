<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>AubCharika - History</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <!-- jsPDF and AutoTable CDNs -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script>
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

    .history-container {
      max-width: 900px;
      margin: 0 auto;
    }

    .search-form .form-control, 
    .search-form .form-select {
      background: rgba(255, 255, 251, 0.1);
      border: none;
      color: white;
    }

    .search-form .btn {
      background: var(--gold-gradient);
      color: #000;
      font-weight: 600;
    }

    .dynamic-table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(10px);
      border-radius: 12px;
      overflow: hidden;
      border: 1px solid rgba(255, 179, 0, 0.1);
      margin-bottom: 20px;
    }

    .dynamic-table thead {
      background: var(--gold-gradient);
      color: #000;
    }

    .dynamic-table th {
      font-weight: 600;
      padding: 15px;
      text-align: left;
    }

    .dynamic-table td {
      padding: 12px 15px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .dynamic-table tr:last-child td {
      border-bottom: none;
    }

    .dynamic-table tr:hover {
      background: rgba(255, 179, 0, 0.1);
    }

    .badge-present {
      background-color: rgba(40, 167, 69, 0.2);
      color: #28a745;
      padding: 5px 10px;
      border-radius: 20px;
      font-weight: 600;
    }

    .badge-absent {
      background-color: rgba(220, 53, 69, 0.2);
      color: #dc3545;
      padding: 5px 10px;
      border-radius: 20px;
      font-weight: 600;
    }

    .badge-weekend {
      background-color: rgba(108, 117, 125, 0.2);
      color: #6c757d;
      padding: 5px 10px;
      border-radius: 20px;
    }

    .summary-card {
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(10px);
      border-radius: 12px;
      padding: 20px;
      border: 1px solid rgba(255, 179, 0, 0.1);
    }

    .hero-section {
      background: var(--gold-gradient);
      border-radius: 12px;
      padding: 30px;
      margin-bottom: 25px;
      color: #000;
      box-shadow: 0 4px 15px rgba(255, 179, 0, 0.3);
    }

    @media (max-width: 768px) {
      .dynamic-table {
        display: block;
        overflow-x: auto;
      }
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
      max-height: 200px;
      overflow-y: auto;
    }

    .message-box::-webkit-scrollbar {
      width: 8px;
    }

    .message-box::-webkit-scrollbar-track {
      background: rgba(186, 186, 186, 0.2);
      border-radius: 10px;
    }

    .message-box::-webkit-scrollbar-thumb {
      background: white;
      border-radius: 10px;
    }

    .message-box::-webkit-scrollbar-thumb:hover {
      background: white;
    }

    .message-item {
      display: flex;
      align-items: start;
      gap: 10px;
      margin-bottom: 15px;
      padding: 10px;
      border: 1px solid rgba(255, 179, 0, 0.3);
      border-radius: 8px;
    }

    .message-item:last-child {
      margin-bottom: 0;
    }

    .user-avatar {
      width: 40px;
      height: 40px;
      object-fit: cover;
      border-radius: 50%;
    }

    .profile-dropdown .dropdown-menu {
      background: rgba(0, 0, 0, 0.8);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 179, 0, 0.2);
      border-radius: 8px;
    }

    .profile-dropdown .dropdown-item {
      color: rgba(255, 255, 255, 0.8);
      padding: 10px 15px;
      transition: all 0.3s;
    }

    .profile-dropdown .dropdown-item:hover {
      background: rgba(255, 179, 0, 0.15);
      color: #ffc107;
    }

    .profile-dropdown .dropdown-item i {
      margin-right: 10px;
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
        <a href="{{ url('Clock-In') }}" class="nav-link">
          <i class="fas fa-clock"></i> Clock In/Out
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('history') }}" class="nav-link active">
          <i class="fas fa-history"></i> History
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('stats') }}" class="nav-link">
          <i class="fas fa-chart-bar"></i> Stats
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('leave') }}" class="nav-link">
          <i class="fas fa-plane-departure"></i> Leave
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('tasks') }}" class="nav-link">
          <i class="fas fa-tasks"></i> Tasks
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('settings') }}" class="nav-link">
          <i class="fas fa-cog"></i> Settings
        </a>
      </li>
    </ul>
  </div>

  <div>
    <ul id="Elements2" class="nav nav-pills flex-column">
      <li class="nav-item">
        <a href="{{ url('myaccount') }}" class="nav-link">
          <i class="fas fa-user-circle"></i> My Account
        </a>
      </li>
      <li class="nav-item">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="nav-link btn btn-link">
            <i class="fas fa-sign-out-alt"></i> Sign Out
          </button>
        </form>
      </li>
    </ul>
  </div>
</div>

<!-- Main Content -->
<div class="main-content">
  <div class="history-container">
    <div class="hero-section">
      <h1 class="fw-bold mb-3">Track Your<br>Attendance History</h1>
      <button class="btn btn-dark fw-semibold me-3">View Details</button>
      <button class="btn btn-outline-dark fw-semibold" onclick="exportReport()">Export Report</button>
    </div>

    <!-- Search Form -->
    <form class="row g-3 mb-4 search-form" action="{{ route('history') }}" method="GET">
  <div class="col-md-4">
    <input type="week" class="form-control" name="week" placeholder="Select Week" value="{{ old('week', request()->input('week')) }}">
  </div>
  <div class="col-md-3">
    <select class="form-select" name="month">
      <option value="">Month</option>
      <option value="January" {{ old('month', request()->input('month')) == 'January' ? 'selected' : '' }}>January</option>
      <option value="February" {{ old('month', request()->input('month')) == 'February' ? 'selected' : '' }}>February</option>
      <option value="March" {{ old('month', request()->input('month')) == 'March' ? 'selected' : '' }}>March</option>
      <option value="April" {{ old('month', request()->input('month')) == 'April' ? 'selected' : '' }}>April</option>
      <option value="May" {{ old('month', request()->input('month')) == 'May' ? 'selected' : '' }}>May</option>
      <option value="June" {{ old('month', request()->input('month')) == 'June' ? 'selected' : '' }}>June</option>
      <option value="July" {{ old('month', request()->input('month')) == 'July' ? 'selected' : '' }}>July</option>
      <option value="August" {{ old('month', request()->input('month')) == 'August' ? 'selected' : '' }}>August</option>
      <option value="September" {{ old('month', request()->input('month')) == 'September' ? 'selected' : '' }}>September</option>
      <option value="October" {{ old('month', request()->input('month')) == 'October' ? 'selected' : '' }}>October</option>
      <option value="November" {{ old('month', request()->input('month')) == 'November' ? 'selected' : '' }}>November</option>
      <option value="December" {{ old('month', request()->input('month')) == 'December' ? 'selected' : '' }}>December</option>
    </select>
  </div>
  <div class="col-md-3">
    <select class="form-select" name="year">
      <option value="">Year</option>
      <option value="2025" {{ old('year', request()->input('year')) == '2025' ? 'selected' : '' }}>2025</option>
      <option value="2024" {{ old('year', request()->input('year')) == '2024' ? 'selected' : '' }}>2024</option>
      <option value="2023" {{ old('year', request()->input('year')) == '2023' ? 'selected' : '' }}>2023</option>
    </select>
  </div>
  <div class="col-md-2">
    <button class="btn w-100" type="submit">
      <i class="fas fa-search me-1"></i> Search
    </button>
  </div>
</form>

    <!-- Current Clock-In Status -->
    @if($isClockedIn && $currentAttendance)
      <div class="alert alert-success">
        You are currently clocked in since {{ \Carbon\Carbon::parse($currentAttendance->clock_in, 'Africa/Casablanca')->format('h:i A') }}.
        Ongoing hours: {{ \Carbon\Carbon::parse($currentAttendance->clock_in, 'Africa/Casablanca')->diffInHours(\Carbon\Carbon::now('Africa/Casablanca')) }}h
      </div>
    @endif

    <!-- Dynamic Table -->
    <div class="table-responsive">
      <table class="dynamic-table">
        <thead>
          <tr>
            <th>Date</th>
            <th>Day</th>
            <th>Status</th>
            <th>Clock In</th>
            <th>Clock Out</th>
            <th>Total Hours</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($attendanceData as $attendance)
            <tr>
              <td>{{ $attendance[0] }}</td>
              <td>{{ $attendance[1] }}</td>
              <td>
                @if ($attendance[2] === 'Present')
                  <span class="badge-present">Present</span>
                @elseif ($attendance[2] === 'In Progress')
                  <span class="badge-present">In Progress</span>
                @else
                  <span class="badge-absent">Incomplete</span>
                @endif
              </td>
              <td>{{ $attendance[3] }}</td>
              <td>{{ $attendance[4] }}</td>
              <td>{{ $attendance[5] }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center">No attendance records found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Weekly Summary -->
    <div class="summary-card">
      <div class="row">
        <div class="col-md-6">
          <h5 class="text-warning mb-3">Summary</h5>
          <div class="row">
            <div class="col-6 text-center mb-3">
              <div class="fs-4 fw-bold">{{ $daysWorked }}</div>
              <small class="text-muted">Days Worked</small>
            </div>
            <div class="col-6 text-center mb-3">
              <div class="fs-4 fw-bold">{{ number_format($totalHours, 1) }}h</div>
              <small class="text-muted">Total Hours</small>
            </div>
            <div class="col-6 text-center">
              <div class="fs-4 fw-bold">{{ number_format($targetAchieved, 0) }}%</div>
              <small class="text-muted">Target Achieved</small>
            </div>
            <div class="col-6 text-center">
              <div class="fs-4 fw-bold">{{ number_format($dailyAvg, 1) }}h</div>
              <small class="text-muted">Daily Avg</small>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="d-flex justify-content-between mb-2">
            <span>Target: {{ number_format($weeklyExpectedHours, 1) }}h</span>
            <span>{{ number_format($targetAchieved, 0) }}%</span>
          </div>
          <div class="progress" style="height: 10px;">
            <div class="progress-bar" style="width: {{ $targetAchieved }}%; background: var(--gold-gradient);"></div>
          </div>
          <div class="mt-3 text-center">
            <span class="badge bg-warning text-dark me-2">
              <i class="fas fa-info-circle me-1"></i> {{ $daysAbsent }} day(s) incomplete
            </span>
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
      <h6 class="fw-bold mb-0">{{ Auth::user()->full_name }}</h6>
      <small>{{ Auth::user()->role }}</small>
    </div>
    <div class="profile-dropdown dropdown">
      <img src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : 'https://randomuser.me/api/portraits/women/44.jpg' }}" alt="avatar" class="user-avatar" data-bs-toggle="dropdown" aria-expanded="false">
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ url('myaccount') }}"><i class="fas fa-user-circle"></i> My Account</a></li>
        <li><a class="dropdown-item" href="{{ url('logout') }}"><i class="fas fa-sign-out-alt"></i> Sign Out</a></li>
        <li><a class="dropdown-item" href="{{ url('set-profile-picture') }}"><i class="fas fa-camera"></i> Set Profile Picture</a></li>
      </ul>
    </div>
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

  <div class="section-label">Messages</div>
  <div class="message-box">
    @forelse ($messages as $message)
      <div class="message-item">
        <img src="https://randomuser.me/api/portraits/men/36.jpg" alt="avatar" class="user-avatar-small">
        <div>
          <div class="fw-bold small">
            {{ $message->sender->full_name ?? 'Admin' }}
            <span class="text-muted">
              • {{ $message->sent_at_human }}
            </span>
          </div>
          <div>{{ $message->content }}</div>
        </div>
      </div>
    @empty
      <div>No messages available.</div>
    @endforelse
  </div>
</div>

<!-- Pass Data to JavaScript -->
<script>
  // Attendance data
  const attendances = @json($attendanceData);

  // User data
  const user = {
    full_name: @json(Auth::user()->full_name),
    role: @json(Auth::user()->role),
    employee_id: @json(Auth::user()->employee_id ?? 'N/A')
  };

  // Summary data
  const summary = {
    daysWorked: @json($daysWorked),
    totalHours: @json(number_format($totalHours, 1)),
    targetAchieved: @json(number_format($targetAchieved, 0)),
    dailyAvg: @json(number_format($dailyAvg, 1)),
    weeklyTarget: @json(number_format($weeklyExpectedHours, 1)),
    daysAbsent: @json($daysAbsent)
  };

  // Function to generate and download PDF
  function exportReport() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Colors
    const goldStart = [255, 179, 0];
    const goldEnd = [248, 238, 196];
    const darkBg = [10, 9, 19];
    const textColor = [255, 255, 255];

    // Header
    doc.setFillColor(...goldStart);
    doc.rect(0, 0, 210, 40, 'F');
    doc.setFontSize(20);
    doc.setTextColor(0, 0, 0);
    doc.text('AubCharika Attendance Report', 20, 20);
    doc.setFontSize(12);
    doc.text(`Employee: ${user.full_name} (${user.role})`, 20, 30);
    doc.text(`Generated on: ${new Date().toLocaleDateString()}`, 20, 35);

    // Attendance Table
    doc.setTextColor(...textColor);
    doc.setFontSize(14);
    doc.text('Attendance History', 20, 50);
    doc.autoTable({
      startY: 55,
      head: [['Date', 'Day', 'Status', 'Clock In', 'Clock Out', 'Total Hours']],
      body: attendances,
      theme: 'grid',
      headStyles: {
        fillColor: goldStart,
        textColor: [0, 0, 0],
        fontSize: 10
      },
      bodyStyles: {
        fillColor: darkBg,
        textColor: textColor,
        fontSize: 9
      },
      alternateRowStyles: {
        fillColor: [20, 18, 38]
      },
      margin: { top: 55, left: 20, right: 20 }
    });

    // Weekly Summary
    let finalY = doc.lastAutoTable.finalY + 10;
    doc.setFontSize(14);
    doc.text('Weekly Summary', 20, finalY);
    doc.setFontSize(10);
    doc.text(`Days Worked: ${summary.daysWorked}`, 20, finalY + 10);
    doc.text(`Total Hours: ${summary.totalHours}h`, 20, finalY + 15);
    doc.text(`Target Achieved: ${summary.targetAchieved}%`, 20, finalY + 20);
    doc.text(`Daily Average: ${summary.dailyAvg}h`, 20, finalY + 25);
    doc.text(`Weekly Target: ${summary.weeklyTarget}h`, 20, finalY + 30);
    doc.text(`Days Incomplete: ${summary.daysAbsent}`, 20, finalY + 35);

    // Progress Bar Simulation
    doc.setFillColor(...goldStart);
    doc.rect(20, finalY + 40, 100, 5, 'F');
    doc.setFillColor(...goldEnd);
    doc.rect(20, finalY + 40, summary.targetAchieved, 5, 'F');

    // Footer
    doc.setFontSize(8);
    doc.setTextColor(150, 150, 150);
    doc.text('Generated by AubCharika HRM System', 20, doc.internal.pageSize.height - 10);

    // Download PDF
    doc.save(`Attendance_Report_${user.full_name}_${new Date().toISOString().split('T')[0]}.pdf`);
  }

  // Date and Time Update
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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>