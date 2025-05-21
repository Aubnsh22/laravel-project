  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>AubCharika - Clock In</title>
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

      /* Clock In Section */
      .clock-in-container {
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

      .clock-in-section {
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(10px);
        border-radius: 12px;
        padding: 30px;
        display: flex;
        align-items: center;
        border: 1px solid rgba(255, 179, 0, 0.2);
      }

      .clock-circle {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 30px;
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.4);
      }

      .clock-circle.clocked-in {
        background: rgb(102, 255, 0);
        box-shadow: 0 4px 15px rgba(0, 255, 21, 0.4);
      }

      .clock-circle.clocked-out {
        background: rgb(209, 31, 31);
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.4);
      }

      .clock-circle i {
        font-size: 2.5rem;
        color: white;
      }

      .clockin-btn {
        min-width: 180px;
        padding: 12px 25px;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s;
      }

      /* Date & Time Boxes */
      .date-box {
        background: #ffb300;
        background: linear-gradient(195deg, rgba(255, 179, 0, 1) 0%, rgba(255, 147, 5, 1) 67%, rgba(248, 238, 196, 1) 100%);
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
        background: none;
        border-radius: 15px;
        padding: 10px;
        color: black;
        max-height: 200px;
        overflow-y: auto;
      }

      /* Custom Scrollbar */
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
        background: linear-gradient(195deg, rgba(255, 179, 0, 1) 0%, rgba(255, 147, 5, 1) 67%, rgba(248, 238, 196, 1) 100%);
      }

      .message-item:last-child {
        margin-bottom: 0;
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
        cursor: pointer;
      }

      /* Dropdown Styles */
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

      .alert {
        background: rgba(255, 179, 0, 0.2);
        border: none;
        color: #fff;
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
          <a href="{{ url('Clock-In') }}" class="nav-link active">
            <i class="fas fa-clock"></i> Clock In/Out
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('history') }}" class="nav-link">
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
    <div class="clock-in-container">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="search-bar">
          <input type="text" class="form-control" placeholder="Search Here...">
        </div>
        <div class="notification-icon">
          <button class="btn rounded-circle">
            <i class="fas fa-bell"></i>
          </button>
        </div>
      </div>

      <div class="hero-section">
        <h1 class="fw-bold mb-3">Full Workforce<br>Tracking Services</h1>
        <button class="btn btn-dark fw-semibold me-3">Get Started</button>
        <button class="btn btn-outline-dark fw-semibold">Learn More</button>
      </div>

      @if (session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
      @endif

      @if (session('error'))
          <div class="alert alert-danger">
              {{ session('error') }}
          </div>
      @endif

      @if ($timeMessage)
          <div class="alert alert-warning">
              {{ $timeMessage }}
          </div>
      @endif

      @if ($expectedTimes && $expectedTimes['start_time'] && $expectedTimes['end_time'])
          <div class="alert alert-info">
              Today's allowed clock-in window: {{ \Carbon\Carbon::parse($expectedTimes['start_time'])->format('h:i A') }} - {{ \Carbon\Carbon::parse($expectedTimes['end_time'])->format('h:i A') }}
          </div>
      @endif

      <div class="clock-in-section">
        <div class="clock-circle {{ $isClockedIn ? 'clocked-in' : 'clocked-out' }}">
          <i class="fas fa-fingerprint"></i>
        </div>
        <div class="clockin">
          @if($isClockedIn)
            <button class="btn btn-light clockin-btn mb-3" disabled>Clocked In at {{ \Carbon\Carbon::parse($attendance->clock_in)->format('h:i A') }}</button><br>
            <a href="{{ url('Clock-Out') }}"><button class="btn btn-outline-light clockin-btn">Clock Out</button></a>
          @else
            <form method="POST" action="{{ url('Clock-In') }}">
              @csrf
              <button type="submit" class="btn btn-outline-light clockin-btn mb-3" {{ $timeMessage ? 'disabled' : '' }}>Clock In</button>
            </form>
          @endif
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

  <script>
    // Function to update date and time
    function updateDateTime() {
      const now = new Date(); // Use system time instead of hardcoded value

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

    // Immediate and periodic update
    updateDateTime();
    setInterval(updateDateTime, 60000);
  </script></script>

  <!-- Bootstrap JS for dropdown functionality -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
  </html>