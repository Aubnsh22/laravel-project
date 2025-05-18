<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>AubCharika - History</title>
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

    /* Sidebar */
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

    /* Main Content */
    .main-content {
      grid-column: 2;
      padding: 30px;
      margin-left: 30px;
    }

    /* User Card */
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

    /* History Container */
    .history-container {
      max-width: 900px;
      margin: 0 auto;
    }

    /* Search Form */
    .search-form .form-control, 
    .search-form .form-select {
      background: rgba(255, 255, 255, 0.1);
      border: none;
      color: white;
    }

    .search-form .btn {
      background: var(--gold-gradient);
      color: #000;
      font-weight: 600;
    }

    /* Table Styles - Version dynamique comme dans Stats */
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

    /* Status Badges */
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

    /* Summary Card */
    .summary-card {
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(10px);
      border-radius: 12px;
      padding: 20px;
      border: 1px solid rgba(255, 179, 0, 0.1);
    }

    /* Hero Section */
    .hero-section {
      background: var(--gold-gradient);
      border-radius: 12px;
      padding: 30px;
      margin-bottom: 25px;
      color: #000;
      box-shadow: 0 4px 15px rgba(255, 179, 0, 0.3);
    }

    /* Responsive */
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
    }

    .user-avatar {
      width: 40px;
      height: 40px;
      object-fit: cover;
      border-radius: 50%;
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar d-flex flex-column justify-content-between p-3">
  <div>
    <div id="logo" class="text-center mb-4 d-flex align-items-center justify-content-center">
      <img src="{{asset('images/logo.png')}}" alt="Logo" class="logo me-2">
      <h5 class="text-warning fw-bold mt-1">AubCharika</h5>
    </div>

    <ul id="elements" class="nav flex-column mb-auto">
      <li class="nav-item">
        <a href="{{ url('Clock_In') }}" class="nav-link">
          <i class="fas fa-clock"></i> Clock In
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
          <i class="fas fa-plane-departure"></i> Tasks
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
        <a href="#" class="nav-link">
          <i class="fas fa-sign-out-alt"></i> Sign Out
        </a>
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
      <button class="btn btn-outline-dark fw-semibold">Export Report</button>
    </div>

    <!-- Search Form -->
    <form class="row g-3 mb-4 search-form">
      <div class="col-md-4">
        <input type="week" class="form-control" placeholder="Select Week">
      </div>
      <div class="col-md-3">
        <select class="form-select">
          <option selected>Month</option>
          <option>January</option>
          <option>February</option>
          <option>March</option>
          <option>April</option>
          <option>May</option>
          <option>June</option>
          <option>July</option>
          <option>August</option>
          <option>September</option>
          <option>October</option>
          <option>November</option>
          <option>December</option>
        </select>
      </div>
      <div class="col-md-3">
        <select class="form-select">
          <option selected>Year</option>
          <option>2025</option>
          <option>2024</option>
          <option>2023</option>
        </select>
      </div>
      <div class="col-md-2">
        <button class="btn w-100" type="button">
          <i class="fas fa-search me-1"></i> Search
        </button>
      </div>
    </form>

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
          <tr>
            <td>2023-05-15</td>
            <td>Monday</td>
            <td><span class="badge-present">Present</span></td>
            <td>08:58 AM</td>
            <td>05:02 PM</td>
            <td>8.1h</td>
          </tr>
          <tr>
            <td>2023-05-16</td>
            <td>Tuesday</td>
            <td><span class="badge-present">Present</span></td>
            <td>09:05 AM</td>
            <td>05:15 PM</td>
            <td>8.2h</td>
          </tr>
          <tr>
            <td>2023-05-17</td>
            <td>Wednesday</td>
            <td><span class="badge-absent">Absent</span></td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
          </tr>
          <tr>
            <td>2023-05-18</td>
            <td>Thursday</td>
            <td><span class="badge-present">Present</span></td>
            <td>08:45 AM</td>
            <td>04:50 PM</td>
            <td>8.1h</td>
          </tr>
          <tr>
            <td>2023-05-19</td>
            <td>Friday</td>
            <td><span class="badge-present">Present</span></td>
            <td>09:10 AM</td>
            <td>04:45 PM</td>
            <td>7.6h</td>
          </tr>
          <tr>
            <td>2023-05-20</td>
            <td>Saturday</td>
            <td><span class="badge-weekend">Weekend</span></td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
          </tr>
          <tr>
            <td>2023-05-21</td>
            <td>Sunday</td>
            <td><span class="badge-weekend">Weekend</span></td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Summary Card -->
    <div class="summary-card">
      <div class="row">
        <div class="col-md-6">
          <h5 class="text-warning mb-3">Weekly Summary</h5>
          <div class="row">
            <div class="col-6 text-center mb-3">
              <div class="fs-4 fw-bold">4</div>
              <small class="text-muted">Days Worked</small>
            </div>
            <div class="col-6 text-center mb-3">
              <div class="fs-4 fw-bold">31.6h</div>
              <small class="text-muted">Total Hours</small>
            </div>
            <div class="col-6 text-center">
              <div class="fs-4 fw-bold">79%</div>
              <small class="text-muted">Target Achieved</small>
            </div>
            <div class="col-6 text-center">
              <div class="fs-4 fw-bold">8.1h</div>
              <small class="text-muted">Daily Avg</small>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="d-flex justify-content-between mb-2">
            <span>Weekly Target: 40h</span>
            <span>79%</span>
          </div>
          <div class="progress" style="height: 10px;">
            <div class="progress-bar" style="width: 79%; background: var(--gold-gradient);"></div>
          </div>
          <div class="mt-3 text-center">
            <span class="badge bg-warning text-dark me-2">
              <i class="fas fa-info-circle me-1"></i> 1 day absent this week
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
      <h6 class="fw-bold mb-0">Saad Nassih</h6>
      <small>employee</small>
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

<script>
  // Fonction pour mettre à jour l'heure et la date
  function updateDateTime() {
    const now = new Date();
    
    // Mise à jour de la date
    document.getElementById('year').textContent = now.getFullYear();
    document.getElementById('month').textContent = now.toLocaleString('default', { month: 'short' });
    document.getElementById('day').textContent = now.getDate();
    document.getElementById('weekday').textContent = now.toLocaleString('default', { weekday: 'long' });
    
    // Mise à jour de l'heure
    let hours = now.getHours();
    const ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12;
    const minutes = now.getMinutes().toString().padStart(2, '0');
    
    document.getElementById('hour').textContent = hours;
    document.getElementById('minute').textContent = minutes;
    document.getElementById('ampm').textContent = ampm;
  }

  // Mise à jour immédiate et périodique
  updateDateTime();
  setInterval(updateDateTime, 60000);

  // Fonction pour générer des données aléatoires (simulation)
  function generateRandomHistory() {
    const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    const tbody = document.querySelector('.dynamic-table tbody');
    tbody.innerHTML = '';

    const today = new Date();
    const currentDay = today.getDay(); // 0 (Sunday) to 6 (Saturday)
    
    for (let i = 0; i < 7; i++) {
      const date = new Date();
      date.setDate(today.getDate() - (currentDay - i));
      
      const isWeekend = i >= 5; // Saturday (5) and Sunday (6)
      const isAbsent = !isWeekend && Math.random() < 0.1; // 10% chance d'absence
      
      const row = document.createElement('tr');
      
      // Date
      const dateCell = document.createElement('td');
      dateCell.textContent = date.toISOString().split('T')[0];
      row.appendChild(dateCell);
      
      // Day
      const dayCell = document.createElement('td');
      dayCell.textContent = days[i];
      row.appendChild(dayCell);
      
      // Status
      const statusCell = document.createElement('td');
      if (isWeekend) {
        statusCell.innerHTML = '<span class="badge-weekend">Weekend</span>';
      } else if (isAbsent) {
        statusCell.innerHTML = '<span class="badge-absent">Absent</span>';
      } else {
        statusCell.innerHTML = '<span class="badge-present">Present</span>';
      }
      row.appendChild(statusCell);
      
      // Clock In/Out
      const clockInCell = document.createElement('td');
      const clockOutCell = document.createElement('td');
      const hoursCell = document.createElement('td');
      
      if (isWeekend || isAbsent) {
        clockInCell.textContent = '-';
        clockOutCell.textContent = '-';
        hoursCell.textContent = '-';
      } else {
        const clockInHour = 8 + Math.floor(Math.random() * 2); // Entre 8h et 9h
        const clockInMinute = Math.floor(Math.random() * 60);
        const clockOutHour = 16 + Math.floor(Math.random() * 2); // Entre 16h et 17h
        const clockOutMinute = Math.floor(Math.random() * 60);
        
        const clockInTime = `${clockInHour.toString().padStart(2, '0')}:${clockInMinute.toString().padStart(2, '0')} AM`;
        const clockOutTime = `${clockOutHour.toString().padStart(2, '0')}:${clockOutMinute.toString().padStart(2, '0')} PM`;
        
        clockInCell.textContent = clockInTime;
        clockOutCell.textContent = clockOutTime;
        
        // Calcul des heures travaillées
        const totalHours = (clockOutHour + 12) - clockInHour + (clockOutMinute - clockInMinute) / 60;
        hoursCell.textContent = totalHours.toFixed(1) + 'h';
      }
      
      row.appendChild(clockInCell);
      row.appendChild(clockOutCell);
      row.appendChild(hoursCell);
      
      tbody.appendChild(row);
    }
  }

  // Générer des données aléatoires au chargement
  document.addEventListener('DOMContentLoaded', generateRandomHistory);
</script>

</body>
</html>