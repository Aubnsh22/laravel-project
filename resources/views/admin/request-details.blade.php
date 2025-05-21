<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>AubCharika - Request Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    :root {
      --primary-bg: #0a0913;
      --gold-gradient: linear-gradient(195deg, rgba(255, 179, 0, 1) 0%, rgba(255, 147, 5, 1) 67%, rgba(248, 238, 196, 1) 100%);
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
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .details-container {
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(10px);
      border-radius: 12px;
      padding: 30px;
      border: 1px solid rgba(255, 179, 0, 0.2);
      max-width: 600px;
      width: 100%;
    }

    .certificate-section img, .certificate-section object {
      max-width: 100%;
      border: 1px solid rgba(255, 179, 0, 0.2);
      border-radius: 8px;
    }
  </style>
</head>
<body>
  <div class="details-container">
    <h2 class="mb-4 text-warning">Leave Request Details</h2>
    <p><strong>Employee:</strong> {{ $request->user->full_name }}</p>
    <p><strong>Type:</strong> {{ ucfirst($request->leave_type) }} Leave</p>
    <p><strong>Dates:</strong> {{ $request->start_date }} to {{ $request->end_date }}</p>
    <p><strong>Message:</strong> {{ $request->message }}</p>

    @if ($request->certificate_path)
      <div class="certificate-section mt-4">
        <h5 class="mb-3">Medical Certificate</h5>
        @if (in_array(pathinfo($request->certificate_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
          <img src="{{ asset('storage/' . $request->certificate_path) }}" alt="Medical Certificate" class="img-fluid">
        @else
          <object data="{{ asset('storage/' . $request->certificate_path) }}" type="application/pdf" width="100%" height="500px">
            <p>Download PDF <a href="{{ asset('storage/' . $request->certificate_path) }}" target="_blank">Download instead</a>.</p>
          </object>
        @endif
      </div>
    @else
      <p class="text-muted mt-4">No medical certificate uploaded.</p>
    @endif

    <a href="{{ route('requests') }}" class="btn btn-outline-warning mt-4">Back to Requests</a>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>