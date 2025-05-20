<div class="sidebar d-flex flex-column justify-content-between p-3">
  <div>
    <div id="logo" class="text-center mb-4 d-flex">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
      <h5 class="text-warning fw-bold mt-2">AubCharika</h5>
    </div>

    <ul id="elements" class="nav flex-column mb-auto">
      <li class="nav-item">
        <a id="page" href="#" class="nav-link active">
          <i class="fas fa-th"></i> Clock In
        </a>
      </li>
      <li><a href="{{ route('employee.history') }}" class="nav-link"><i class="fas fa-file-alt"></i> History</a></li>
      <li><a href="{{ route('employee.stats') }}" class="nav-link"><i class="fas fa-chart-bar"></i> Stats</a></li>
      <li><a href="{{ route('employee.leave') }}" class="nav-link"><i class="fas fa-plane-departure"></i> Leave</a></li>
      <li><a href="{{ route('employee.tasks') }}" class="nav-link"><i class="fas fa-plane-departure"></i> Tasks</a></li>

      <li><a href="{{ route('employee.setting') }}" class="nav-link"><i class="fas fa-gear"></i> Settings</a></li>
    </ul>
  </div>

  <div>
    <ul id="Elements2" class="nav nav-pills flex-column mb-3">
      <li><a href="#" class="nav-link"><i class="fas fa-user"></i> My Account</a></li>
      <li><a href="#" class="nav-link"><i class="fas fa-sign-out-alt"></i> Sign Out</a></li>
      <li><a href="#" class="nav-link"><i class="fas fa-question-circle"></i> Help</a></li>
    </ul>
  </div>
</div>