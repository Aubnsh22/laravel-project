<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AubCharika - Set Expected Hours</title>
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

        .form-container {
            max-width: 900px;
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

        .form-section {
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 30px;
            border: 1px solid rgba(255, 179, 0, 0.2);
        }

        .form-section h3 {
            color: #ffc107;
            margin-bottom: 20px;
        }

        .form-control, .form-control:focus {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            border-radius: 8px;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .btn-submit {
            background: var(--gold-gradient);
            color: #000;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            transition: all 0.3s;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 179, 0, 0.3);
        }

        .day-row {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .day-label {
            flex: 0 0 150px;
            font-weight: 600;
        }

        .time-inputs {
            flex: 1;
            display: flex;
            gap: 10px;
        }

        .alert {
            background: rgba(255, 179, 0, 0.2);
            border: none;
            color: #fff;
            border-radius: 8px;
            padding: 15px;
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

        #carte {
            background: none !important;
        }

        .schedule-table {
            width: 100%;
            border-collapse: collapse;
        }

        .schedule-table th, .schedule-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid rgba(255, 179, 0, 0.2);
        }

        .schedule-table th {
            background: rgba(255, 179, 0, 0.15);
            color: #ffc107;
        }

        .schedule-table tr:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .action-btn {
            padding: 5px 10px;
            font-size: 0.85rem;
            border-radius: 5px;
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
                    <a href="{{ url('settingsadmin') }}" class="nav-link active">
                        <i class="fas fa-cog"></i> Settings
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('message') }}" class="nav-link">
                        <i class="fas fa-envelope"></i> Message
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('requests') }}" class="nav-link">
                        <i class="fas fa-envelope"></i> Requests
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
        <div class="form-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="search-bar">
                    <input type="text" class="form-control" placeholder="Search Schedules...">
                </div>
                <div class="notification-icon">
                    <button class="btn rounded-circle">
                        <i class="fas fa-bell"></i>
                    </button>
                </div>
            </div>

            <div class="hero-section">
                <h1 class="fw-bold mb-3">Set Expected<br>Work Hours</h1>
                <button class="btn btn-dark fw-semibold me-3">View All Schedules</button>
                <button class="btn btn-outline-dark fw-semibold">Reset Form</button>
            </div>

            <div class="form-section">
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

                <h3 class="mb-4">Create/Update Schedule</h3>
                <form method="POST" action="{{ route('store.expected.hours') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="week_start_date" class="form-label">Week Start Date (Monday)</label>
                        <input type="date" class="form-control" id="week_start_date" name="week_start_date" value="{{ $latestExpectedHours->week_start_date ?? now()->startOfWeek()->toDateString() }}" required>
                        @error('week_start_date')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                        <div class="day-row">
                            <div class="day-label">{{ $day }}</div>
                            <div class="time-inputs">
                                <div>
                                    <input type="time" class="form-control" name="{{ strtolower($day) }}_start_time" value="{{ $latestExpectedHours ? $latestExpectedHours->{strtolower($day) . '_start_time'} : '' }}" placeholder="Start Time">
                                    @error(strtolower($day) . '_start_time')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <input type="time" class="form-control" name="{{ strtolower($day) }}_end_time" value="{{ $latestExpectedHours ? $latestExpectedHours->{strtolower($day) . '_end_time'} : '' }}" placeholder="End Time">
                                    @error(strtolower($day) . '_end_time')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="text-center">
                        <button type="submit" class="btn btn-submit">Save Schedule</button>
                    </div>
                </form>
            </div>

            <div class="form-section mt-4">
                <h4 class="mb-4">Existing Schedules</h4>
                <table class="schedule-table">
                    <thead>
                        <tr>
                            <th>Week Start</th>
                            <th>Monday</th>
                            <th>Tuesday</th>
                            <th>Wednesday</th>
                            <th>Thursday</th>
                            <th>Friday</th>
                            <th>Saturday</th>
                            <th>Sunday</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($allExpectedHours as $schedule)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($schedule->week_start_date)->format('Y-m-d') }}</td>
                                <td>{{ $schedule->monday_start_time && $schedule->monday_end_time ? $schedule->monday_start_time->format('H:i') . ' - ' . $schedule->monday_end_time->format('H:i') : '-' }}</td>
                                <td>{{ $schedule->tuesday_start_time && $schedule->tuesday_end_time ? $schedule->tuesday_start_time->format('H:i') . ' - ' . $schedule->tuesday_end_time->format('H:i') : '-' }}</td>
                                <td>{{ $schedule->wednesday_start_time && $schedule->wednesday_end_time ? $schedule->wednesday_start_time->format('H:i') . ' - ' . $schedule->wednesday_end_time->format('H:i') : '-' }}</td>
                                <td>{{ $schedule->thursday_start_time && $schedule->thursday_end_time ? $schedule->thursday_start_time->format('H:i') . ' - ' . $schedule->thursday_end_time->format('H:i') : '-' }}</td>
                                <td>{{ $schedule->friday_start_time && $schedule->friday_end_time ? $schedule->friday_start_time->format('H:i') . ' - ' . $schedule->friday_end_time->format('H:i') : '-' }}</td>
                                <td>{{ $schedule->saturday_start_time && $schedule->saturday_end_time ? $schedule->saturday_start_time->format('H:i') . ' - ' . $schedule->saturday_end_time->format('H:i') : '-' }}</td>
                                <td>{{ $schedule->sunday_start_time && $schedule->sunday_end_time ? $schedule->sunday_start_time->format('H:i') . ' - ' . $schedule->sunday_end_time->format('H:i') : '-' }}</td>
                                <td>
                                    <form action="{{ route('delete.expected.hours', $schedule->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this schedule?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger action-btn">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No schedules found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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
            <img src="{{ Auth::user()->profile_photo_path ? Storage::url(Auth::user()->profile_photo_path) : 'https://randomuser.me/api/portraits/women/44.jpg' }}" alt="avatar" class="user-avatar">
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