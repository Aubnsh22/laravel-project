<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>AubCharika - Set Profile Picture</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
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
    .upload-container {
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(10px);
      padding: 20px;
      border-radius: 12px;
      border: 1px solid rgba(255, 179, 0, 0.2);
      width: 400px;
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
  <div class="upload-container">
    <h2 class="text-center mb-4">Set Profile Picture</h2>
    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <form action="{{ route('store.profile.picture') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label for="profile_photo" class="form-label">Upload Profile Photo</label>
        <input type="file" class="form-control" id="profile_photo" name="profile_photo" accept="image/*">
      </div>
      <button type="submit" class="btn btn-custom w-100">Upload</button>
    </form>
  </div>
</body>
</html>