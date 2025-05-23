<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>AubCharika - Tasks</title>
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

    /* Tasks Section */
    .tasks-container {
      max-width: 800px;
      margin: 0 auto;
    }

    .tasks-section {
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(10px);
      border-radius: 12px;
      padding: 30px;
      border: 1px solid rgba(255, 179, 0, 0.2);
    }

    .hero-section {
      background: var(--gold-gradient);
      border-radius: 12px;
      padding: 30px;
      margin-bottom: 25px;
      color: #000;
      box-shadow: 0 4px 15px rgba(255, 179, 0, 0.3);
    }

    /* Tasks Table */
    .tasks-table {
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

    .tasks-table thead {
      background: var(--gold-gradient);
      color: #000;
    }

    .tasks-table th {
      font-weight: 600;
      padding: 15px;
      text-align: left;
    }

    .tasks-table td {
      padding: 12px 15px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .tasks-table tr:last-child td {
      border-bottom: none;
    }

    .tasks-table tr:hover {
      background: rgba(255, 179, 0, 0.1);
    }

    /* Priority and Status Badges */
    .badge-high {
      background-color: rgba(220, 53, 69, 0.2);
      color: #dc3545;
      padding: 5px 10px;
      border-radius: 20px;
      font-weight: 600;
    }

    .badge-medium {
      background-color: rgba(255, 193, 7, 0.2);
      color: #ffc107;
      padding: 5px 10px;
      border-radius: 20px;
      font-weight: 600;
    }

    .badge-low {
      background-color: rgba(40, 167, 69, 0.2);
      color: #28a745;
      padding: 5px 10px;
      border-radius: 20px;
      font-weight: 600;
    }

    .badge-pending {
      background-color: rgba(108, 117, 125, 0.2);
      color: #6c757d;
      padding: 5px 10px;
      border-radius: 20px;
    }

    .badge-awaiting {
      background-color: rgba(0, 123, 255, 0.2);
      color: #007bff;
      padding: 5px 10px;
      border-radius: 20px;
    }

    .badge-completed {
      background-color: rgba(40, 167, 69, 0.2);
      color: #28a745;
      padding: 5px 10px;
      border-radius: 20px;
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
        <a href="{{ url('clock_in') }}" class="nav-link">
          <i class="fas fa-clock"></i> Clock In/Out
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('employee.history') }}" class="nav-link">
          <i class="fas fa-history"></i> History
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('employee.stats') }}" class="nav-link">
          <i class="fas fa-chart-bar"></i> Stats
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('leave') }}" class="nav-link">
          <i class="fas fa-plane-departure"></i> Leave
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('employee.tasks') }}" class="nav-link active">
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
        <a href="{{ url('logout') }}" class="nav-link">
          <i class="fas fa-sign-out-alt"></i> Sign Out
        </a>
      </li>
    </ul>
  </div>
</div>

<!-- Main Content -->
<div class="main-content">
  <div class="tasks-container">
    

    <h2 class="mb-4 text-warning fw-bold">
      <i class="fas fa-tasks me-2"></i>Daily Tasks
    </h2>

    <div class="hero-section">
      <h1 class="fw-bold mb-3">Manage Your<br>Daily Tasks</h1>
      <button class="btn btn-outline-dark fw-semibold" id="viewAllTasks">View All Tasks</button>
    </div>

    <div class="tasks-section">
      <div class="table-responsive">
        <table class="tasks-table" id="tasksTable">
          <thead>
            <tr>
              <th>Task Title</th>
              <th>Description</th>
              
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Complete Project Proposal</td>
              <td>Draft and submit the project proposal for client review.</td>
            
              <td><span class="badge-pending">Pending</span></td>
              <td>
                <button class="btn btn-sm btn-outline-success" onclick="requestApproval(this)">Complete</button>
              </td>
            </tr>
            <tr>
              <td>Team Meeting</td>
              <td>Attend daily sync meeting with the development team.</td>
              
              <td><span class="badge-completed">Completed</span></td>
              <td>-</td>
            </tr>
            <tr>
              <td>Update Documentation</td>
              <td>Revise API documentation based on recent changes.</td>
           
              <td><span class="badge-pending">Pending</span></td>
              <td>
                <button class="btn btn-sm btn-outline-success" onclick="requestApproval(this)">Complete</button>
              </td>
            </tr>
            <tr>
              <td>Code Review</td>
              <td>Review pull requests from team members.</td>
           
              <td><span class="badge-pending">Pending</span></td>
              <td>
                <button class="btn btn-sm btn-outline-success" onclick="requestApproval(this)">Complete</button>
              </td>
            </tr>
          </tbody>
        </table>
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
  // Function to update date and time
  function updateDateTime() {
    const now = new Date();
    
    // Update date
    document.getElementById('year').textContent = now.getFullYear();
    document.getElementById('month').textContent = now.toLocaleString('default', { month: 'short' });
    document.getElementById('day').textContent = now.getDate();
    document.getElementById('weekday').textContent = now.toLocaleString('default', { weekday: 'long' });
    
    // Update time
    let hours = now.getHours();
    const ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12;
    const minutes = now.getMinutes().toString().padStart(2, '0');
    
    document.getElementById('hour').textContent = hours;
    document.getElementById('minute').textContent = minutes;
    document.getElementById('ampm').textContent = ampm;
  }

  // Function to request admin approval
  function requestApproval(button) {
    const row = button.closest('tr');
    const statusCell = row.querySelector('td:nth-child(4)');
    statusCell.innerHTML = '<span class="badge-awaiting">Awaiting Approval</span>';
    button.parentElement.innerHTML = '-';

    // Simulate admin approval after 5 seconds
    setTimeout(() => {
      statusCell.innerHTML = '<span class="badge-completed">Completed</span>';
    }, 5000);
  }

  // Smooth scroll to tasks table on "View All Tasks" click
  document.getElementById('viewAllTasks').addEventListener('click', () => {
    document.getElementById('tasksTable').scrollIntoView({ behavior: 'smooth' });
  });

  // Immediate and periodic update
  updateDateTime();
  setInterval(updateDateTime, 60000);
</script>

</body>
</html>