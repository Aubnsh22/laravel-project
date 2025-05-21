<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>AubCharika - Dashboard</title>
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

    .dashboard-container {
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

    .metrics-section {
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(10px);
      border-radius: 12px;
      padding: 30px;
      border: 1px solid rgba(255, 179, 0, 0.2);
    }

    .metric-card {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 8px;
      padding: 15px;
      text-align: center;
      transition: all 0.3s;
    }

    .metric-card:hover {
      background: rgba(255, 179, 0, 0.15);
      transform: translateY(-5px);
    }

    .metric-card i {
      font-size: 1.5rem;
      color: #ffc107;
      margin-bottom: 10px;
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
      background: rgba(0, 0, 0, 0.8);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 179, 0, 0.2);
      color: white;
    }

    .modal-header {
      border-bottom: 1px solid rgba(255, 179, 0, 0.2);
    }

    .modal-footer {
      border-top: 1px solid rgba(255, 179, 0, 0.2);
    }

    .btn-primary {
      background: var(--gold-gradient);
      border: none;
      color: #000;
    }

    .btn-primary:hover {
      background: linear-gradient(195deg, rgba(255, 147, 5, 1) 0%, rgba(248, 238, 196, 1) 100%);
    }

    .form-control {
      background: rgba(255, 255, 255, 0.1);
      border: none;
      color: white;
    }

    .form-control:focus {
      background: rgba(255, 255, 255, 0.2);
      color: white;
      box-shadow: none;
    }

    .alert {
      background: rgba(255, 179, 0, 0.2);
      color: #ffc107;
      border: none;
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar d-flex flex-column justify-content-between p-3">
  <div>
    <div id="logo" class="text-center mb-4 d-flex align-items-center justify-content-center">
      <img src="{{asset('images/logo.png')}}" alt="Logo" class="logo me-2">
      <h5 class="text-warning fw-bold mt-1">saadCharika</h5>
    </div>

    <ul id="elements" class="nav flex-column mb-auto">
      <li class="nav-item">
        <a href="{{ url('dashboard') }}" class="nav-link active">
          <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('employees') }}" class="nav-link">
          <i class="fas fa-users"></i> Employés
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('tasksadmin') }}" class="nav-link">
          <i class="fas fa-tasks"></i> Tâches
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('statistics') }}" class="nav-link">
          <i class="fas fa-chart-bar"></i> Statistiques
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('requests') }}" class="nav-link">
          <i class="fas fa-envelope"></i> Demandes
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('sendmessage') }}" class="nav-link">
          <i class="fas fa-envelope"></i> Message
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('settingsadmin') }}" class="nav-link">
          <i class="fas fa-cog"></i> Paramètres
        </a>
      </li>
    </ul>
  </div>

  <div>
    <ul id="Elements2" class="nav nav-pills flex-column">
      <li class="nav-item">
        <a href="{{ url('myaccountt') }}" class="nav-link">
          <i class="fas fa-user-circle"></i> Mon compte
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('logout') }}" class="nav-link">
          <i class="fas fa-sign-out-alt"></i> Déconnexion
        </a>
      </li>
    </ul>
  </div>
</div>

<!-- Main Content -->
<div class="main-content">
  <div class="dashboard-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div class="search-bar">
        <input type="text" class="form-control" placeholder="Rechercher ici...">
      </div>
      <div class="notification-icon">
        <button class="btn rounded-circle">
          <i class="fas fa-bell"></i>
        </button>
      </div>
    </div>

    <div class="hero-section">
      <h1 class="fw-bold mb-3">Tableau de bord Admin<br>Aperçu</h1>
      <button class="btn btn-dark fw-semibold me-3" data-bs-toggle="modal" data-bs-target="#datePickerModal">Télécharger le rapport</button>
      <button class="btn btn-outline-dark fw-semibold">Gérer l'équipe</button>
    </div>

    <div class="metrics-section">
      <h4 class="mb-4">Métriques clés</h4>
      <div class="row g-3">
        <div class="col-md-3">
          <div class="metric-card">
            <i class="fas fa-users"></i>
            <h5>Employés totaux</h5>
            <h3>{{ \App\Models\User::count() }}</h3>
          </div>
        </div>
        <div class="col-md-3">
          <div class="metric-card">
            <i class="fas fa-clock"></i>
            <h5>Présences aujourd'hui</h5>
            <h3>{{ \App\Models\Attendance::where('date', \Carbon\Carbon::today()->toDateString())->count() }}</h3>
          </div>
        </div>
        <div class="col-md-3">
          <div class="metric-card">
            <i class="fas fa-envelope"></i>
            <h5>Demandes en attente</h5>
            <h3>{{ \App\Models\Leave_request::where('status', 'pending')->count() }}</h3>
          </div>
        </div>
      </div>

      <h4 class="mt-5 mb-4">Activités récentes</h4>
      <ul class="list-unstyled">
        @if (!empty($recentActivities))
          @foreach ($recentActivities as $activity)
            <li class="d-flex align-items-center mb-3">
              <i class="{{ $activity['icon'] }} me-2 {{ $activity['color'] }}"></i>
              <span>{{ $activity['text'] }} ({{ \Carbon\Carbon::parse($activity['timestamp'])->format('d/m/Y H:i') }})</span>
            </li>
          @endforeach
        @else
          <li>Aucune activité récente disponible.</li>
        @endif
      </ul>
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
    <img src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : 'https://randomuser.me/api/portraits/women/44.jpg' }}" alt="avatar" class="user-avatar">
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
      <div class="fs-5 fw-bold" id="hour"></div>
      <div class="fs-5 fw-bold" id="minute"></div>
      <div class="text-uppercase small text-primary" id="ampm"></div>
    </div>
  </div>

  <div class="section-label">Message</div>
  <div class="message-box d-flex align-items-start gap-2">
    <img src="https://randomuser.me/api/portraits/men/36.jpg" alt="avatar" class="user-avatar-small">
    <div>
      <div class="fw-bold small">Mr Ayoub Nassih <span class="text-muted">• Il y a 1 minute</span></div>
      <div>Khdm mgwd wla sir t9wd</div>
    </div>
  </div>
</div>

<!-- Date Picker Modal -->
<div class="modal fade" id="datePickerModal" tabindex="-1" aria-labelledby="datePickerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="datePickerModalLabel">Choisir une date pour le rapport</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="reportDate" class="form-label">Sélectionner une date</label>
          <input type="date" class="form-control" id="reportDate" max="{{ $today }}">
        </div>
        <div id="dateError" class="alert d-none"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-primary" id="downloadReportBtn">Télécharger</button>
      </div>
    </div>
  </div>
</div>

<script>
  // Pass data to JavaScript
  const recentActivities = @json($recentActivities);
  const user = {
    full_name: @json(Auth::user()->full_name),
    role: @json(Auth::user()->role)
  };
  const today = @json($today);

  // Function to generate and download PDF
  function exportActivityReport(attendanceData, selectedDate) {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Colors
    const goldStart = [255, 179, 0];
    const goldEnd = [248, 238, 196];
    const darkBg = [10, 9, 19];
    const textColor = [255, 255, 255];

    // Current date and time
    const now = new Date();
    const reportDate = new Date(selectedDate).toLocaleDateString('fr-FR', { day: 'numeric', month: 'long', year: 'numeric' });
    const reportTime = now.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' });

    // Header
    doc.setFillColor(...goldStart);
    doc.rect(0, 0, 210, 40, 'F');
    doc.setFontSize(20);
    doc.setTextColor(0, 0, 0);
    doc.text('AubCharika Attendance Report', 20, 20);
    doc.setFontSize(12);
    doc.text(`Admin: ${user.full_name} (${user.role})`, 20, 30);
    doc.text(`Généré le: ${now.toLocaleDateString('fr-FR')} ${reportTime}`, 20, 35);

    // Attendance Table
    doc.setTextColor(...textColor);
    doc.setFontSize(14);
    doc.text(`Présences du ${reportDate}`, 20, 50);
    const tableData = attendanceData.map(attendance => [
      attendance.user,
      attendance.status,
      attendance.clock_in,
      attendance.clock_out,
      `${attendance.hours}h`
    ]);
    doc.autoTable({
      startY: 55,
      head: [['Nom', 'Statut', 'Entrée', 'Sortie', 'Heures Totales']],
      body: tableData.length > 0 ? tableData : [['-', 'Aucune présence', '-', '-', '-']],
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

    // Footer
    doc.setFontSize(8);
    doc.setTextColor(150, 150, 150);
    doc.text('Généré par le système HRM AubCharika', 20, doc.internal.pageSize.height - 10);

    // Download PDF
    doc.save(`Rapport_Presences_${user.full_name}_${selectedDate}.pdf`);
  }

  // Handle date selection and validation
  document.getElementById('downloadReportBtn').addEventListener('click', function() {
    const selectedDate = document.getElementById('reportDate').value;
    const errorDiv = document.getElementById('dateError');

    if (!selectedDate) {
      errorDiv.classList.remove('d-none');
      errorDiv.textContent = 'Veuillez sélectionner une date.';
      return;
    }

    // Send AJAX request to validate date and fetch data
    fetch('{{ url('get-attendance-by-date') }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({ date: selectedDate })
    })
    .then(response => response.json())
    .then(data => {
      errorDiv.classList.add('d-none');
      if (data.status === 'error') {
        errorDiv.classList.remove('d-none');
        errorDiv.textContent = data.message;
      } else {
        // Generate PDF
        exportActivityReport(data.data, selectedDate);
        // Close modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('datePickerModal'));
        modal.hide();
      }
    })
    .catch(error => {
      errorDiv.classList.remove('d-none');
      errorDiv.textContent = 'Une erreur s\'est produite. Veuillez réessayer.';
      console.error('Error:', error);
    });
  });

  // Date and Time Update
  function updateDateTime() {
    const now = new Date();
    
    // Mise à jour de la date
    document.getElementById('year').textContent = now.getFullYear();
    document.getElementById('month').textContent = now.toLocaleString('fr-FR', { month: 'short' });
    document.getElementById('day').textContent = now.getDate();
    document.getElementById('weekday').textContent = now.toLocaleString('fr-FR', { weekday: 'long' });
    
    // Mise à jour de l'heure
    let hours = now.getHours();
    const ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12; // Convertir 0 en 12 pour minuit/midi
    const minutes = now.getMinutes().toString().padStart(2, '0');
    
    document.getElementById('hour').textContent = hours;
    document.getElementById('minute').textContent = minutes;
    document.getElementById('ampm').textContent = ampm;
  }

  // Mise à jour immédiate et périodique
  updateDateTime();
  setInterval(updateDateTime, 60000); // Mise à jour toutes les 60 secondes
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>