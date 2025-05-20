<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>AubCharika - Statistics</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

    /* Statistics Section */
    .stats-container {
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

    .stats-section {
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(10px);
      border-radius: 12px;
      padding: 30px;
      border: 1px solid rgba(255, 179, 0, 0.2);
    }

    .stats-tabs {
      display: flex;
      border-bottom: 1px solid rgba(255, 179, 0, 0.2);
      margin-bottom: 25px;
      gap: 5px;
    }

    .stats-tab {
      padding: 12px 25px;
      cursor: pointer;
      color: rgba(255, 255, 255, 0.7);
      border-bottom: 3px solid transparent;
      transition: all 0.3s;
      font-weight: 500;
      border-radius: 6px 6px 0 0;
    }

    .stats-tab:hover {
      color: #ffc107;
      background: rgba(255, 179, 0, 0.1);
    }

    .stats-tab.active {
      color: #ffc107;
      border-bottom: 3px solid #ffc107;
      background: rgba(255, 179, 0, 0.1);
    }

    .stat-card {
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(10px);
      border-radius: 12px;
      padding: 25px;
      margin-bottom: 25px;
      border: 1px solid rgba(255, 179, 0, 0.1);
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s;
    }

    .stat-card:hover {
      transform: translateY(-3px);
    }

    .average-hours {
      font-size: 2.8rem;
      font-weight: 700;
      color: #ffc107;
      margin-bottom: 5px;
    }

    .ranking-list .list-group-item {
      background: rgba(255, 255, 255, 0.05);
      border: none;
      margin-bottom: 10px;
      border-radius: 8px;
      transition: all 0.3s;
    }

    .ranking-list .list-group-item:hover {
      background: rgba(255, 179, 0, 0.1);
    }

    .progress {
      height: 8px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 4px;
    }

    .progress-bar {
      background: var(--gold-gradient);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .stats-content {
      display: none;
      animation: fadeIn 0.4s ease-out;
    }

    .stats-content.active {
      display: block;
    }

    /* Date & Time Boxes */
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

    /* Search & Notification */
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
        <a href="{{ url('statistics') }}" class="nav-link active">
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
  <div class="stats-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div class="search-bar">
        <input type="text" class="form-control" placeholder="Search Statistics...">
      </div>
      <div class="notification-icon">
        <button class="btn rounded-circle">
          <i class="fas fa-bell"></i>
        </button>
      </div>
    </div>

    <div class="hero-section">
      <h1 class="fw-bold mb-3">Statistics<br>Overview</h1>
      <button class="btn btn-dark fw-semibold me-3">View All Stats</button>
      <button class="btn btn-outline-dark fw-semibold">Filter Stats</button>
    </div>

    <div class="stats-section">
      <h4 class="mb-4">Performance Metrics</h4>
      
      <!-- Navigation par onglets -->
      <div class="stats-tabs">
        <div class="stats-tab active" data-target="overview-tab">
          <i class="fas fa-tachometer-alt me-2"></i>Overview
        </div>
        <div class="stats-tab" data-target="employee-tab">
          <i class="fas fa-users me-2"></i>Employee Performance
        </div>
      </div>

      <!-- Contenu des onglets -->
      <div id="overview-tab" class="stats-content active">
        <div class="stat-card">
          <div class="row align-items-center">
            <div class="col-md-4 text-center mb-4 mb-md-0">
              <div class="average-hours">15</div>
              <div class="text-warning mb-3">Active Employees</div>
              <div class="d-flex justify-content-center gap-3">
                <div class="text-center">
                  <div class="fw-bold">+10%</div>
                  <small>vs last month</small>
                </div>
                <div class="text-center">
                  <div class="fw-bold">105h</div>
                  <small>total this month</small>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <canvas id="overviewChart" height="200"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div id="employee-tab" class="stats-content">
        <div class="stat-card">
          <div class="row">
            <div class="col-md-6 mb-4 mb-md-0">
              <h5 class="text-warning mb-3">
                <i class="fas fa-chart-line me-2"></i>Average Performance
              </h5>
              <canvas id="employeeChart" height="250"></canvas>
            </div>
            <div class="col-md-6">
              <h5 class="text-warning mb-3">
                <i class="fas fa-medal me-2"></i>Top Performers
              </h5>
              <div class="list-group ranking-list" id="topPerformersList">
                <!-- Generated by JS -->
              </div>
            </div>
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

<script>
  // Navigation par onglets
  document.querySelectorAll('.stats-tab').forEach(tab => {
    tab.addEventListener('click', () => {
      document.querySelectorAll('.stats-tab').forEach(t => t.classList.remove('active'));
      document.querySelectorAll('.stats-content').forEach(c => c.classList.remove('active'));
      
      tab.classList.add('active');
      document.getElementById(tab.dataset.target).classList.add('active');
    });
  });

  // Graphique Aperçu
  const overviewCtx = document.getElementById('overviewChart').getContext('2d');
  new Chart(overviewCtx, {
    type: 'bar',
    data: {
      labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
      datasets: [{
        label: 'Total Hours',
        data: [120, 115, 130, 125, 110, 80, 20],
        backgroundColor: 'rgba(255, 179, 0, 0.7)',
        borderColor: 'rgba(255, 179, 0, 1)',
        borderWidth: 1,
        borderRadius: 4
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          max: 150,
          grid: {
            color: 'rgba(255, 255, 255, 0.1)'
          },
          ticks: {
            color: 'rgba(255, 255, 255, 0.7)',
            callback: function(value) {
              return value + 'h';
            }
          }
        },
        x: {
          grid: {
            display: false
          },
          ticks: {
            color: 'rgba(255, 255, 255, 0.7)'
          }
        }
      },
      plugins: {
        legend: {
          display: false
        }
      }
    }
  });

  // Graphique Performance Employés
  const employeeCtx = document.getElementById('employeeChart').getContext('2d');
  new Chart(employeeCtx, {
    type: 'line',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      datasets: [{
        label: 'Average Score',
        data: [85, 87, 88, 90, 89, 91, 92, 90, 93, 94, 92, 95],
        fill: true,
        backgroundColor: 'rgba(255, 179, 0, 0.1)',
        borderColor: 'rgba(255, 179, 0, 1)',
        tension: 0.3,
        pointBackgroundColor: 'rgba(255, 179, 0, 1)',
        pointRadius: 4,
        pointHoverRadius: 6
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          max: 100,
          grid: {
            color: 'rgba(255, 255, 255, 0.1)'
          },
          ticks: {
            color: 'rgba(255, 255, 255, 0.7)',
            callback: function(value) {
              return value + '/100';
            }
          }
        },
        x: {
          grid: {
            display: false
          },
          ticks: {
            color: 'rgba(255, 255, 255, 0.7)'
          }
        }
      },
      plugins: {
        legend: {
          display: false
        },
        tooltip: {
          backgroundColor: 'rgba(0, 0, 0, 0.8)',
          titleColor: '#ffc107',
          bodyColor: 'white',
          borderColor: 'rgba(255, 179, 0, 0.5)',
          borderWidth: 1
        }
      }
    }
  });

  // Top Performers
  const employees = [
    { name: "Sophie Martin", position: "Fullstack Developer", score: 94, department: "Development" },
    { name: "Thomas Leroy", position: "UX Designer", score: 89, department: "Design" },
    { name: "Julie Bernard", position: "Product Manager", score: 85, department: "Marketing" },
    { name: "Nicolas Petit", position: "Frontend Developer", score: 82, department: "Development" }
  ];

  const topPerformersList = document.getElementById('topPerformersList');
  employees.forEach(emp => {
    const item = document.createElement('div');
    item.className = 'list-group-item';
    item.innerHTML = `
      <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
          <div class="rank-circle me-3">${emp.score}</div>
          <div>
            <h6 class="mb-0">${emp.name}</h6>
            <small class="text-muted">${emp.position} • ${emp.department}</small>
          </div>
        </div>
        <div class="text-end">
          <span class="badge bg-primary">${emp.score}/100</span>
        </div>
      </div>
      <div class="progress mt-2">
        <div class="progress-bar" style="width: ${emp.score}%"></div>
      </div>
    `;
    topPerformersList.appendChild(item);
  });

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
</body>
</html>