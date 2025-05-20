<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>AubCharika - Set Expected Hours</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #0a0913;
      color: white;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .form-container {
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(10px);
      padding: 20px;
      border-radius: 12px;
      border: 1px solid rgba(255, 179, 0, 0.2);
      width: 500px;
    }
    .btn-custom {
      background: linear-gradient(195deg, rgba(255, 179, 0, 1) 0%, rgba(255, 147, 5, 1) 67%, rgba(248, 238, 196, 1) 100%);
      color: #000;
      transition: all 0.3s;
    }
    .btn-custom:hover {
      background: rgba(255, 179, 0, 0.15);
      color: #ffc107;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2 class="text-center mb-4">Set Expected Hours for the Week</h2>
    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <form action="{{ route('store.expected.hours') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="week_start_date" class="form-label">Week Start Date (Monday)</label>
        <input type="date" class="form-control" id="week_start_date" name="week_start_date" required>
      </div>
      <div class="mb-3">
        <label for="monday_hours" class="form-label">Monday Hours</label>
        <input type="number" step="0.01" class="form-control" id="monday_hours" name="monday_hours" value="0" required>
      </div>
      <div class="mb-3">
        <label for="tuesday_hours" class="form-label">Tuesday Hours</label>
        <input type="number" step="0.01" class="form-control" id="tuesday_hours" name="tuesday_hours" value="0" required>
      </div>
      <div class="mb-3">
        <label for="wednesday_hours" class="form-label">Wednesday Hours</label>
        <input type="number" step="0.01" class="form-control" id="wednesday_hours" name="wednesday_hours" value="0" required>
      </div>
      <div class="mb-3">
        <label for="thursday_hours" class="form-label">Thursday Hours</label>
        <input type="number" step="0.01" class="form-control" id="thursday_hours" name="thursday_hours" value="0" required>
      </div>
      <div class="mb-3">
        <label for="friday_hours" class="form-label">Friday Hours</label>
        <input type="number" step="0.01" class="form-control" id="friday_hours" name="friday_hours" value="0" required>
      </div>
      <div class="mb-3">
        <label for="saturday_hours" class="form-label">Saturday Hours</label>
        <input type="number" step="0.01" class="form-control" id="saturday_hours" name="saturday_hours" value="0" required>
      </div>
      <div class="mb-3">
        <label for="sunday_hours" class="form-label">Sunday Hours</label>
        <input type="number" step="0.01" class="form-control" id="sunday_hours" name="sunday_hours" value="0" required>
      </div>
      <button type="submit" class="btn btn-custom w-100">Save Expected Hours</button>
    </form>
  </div>
</body>
</html>