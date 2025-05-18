<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Welcome</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{asset('css/signin.css')}}">
<style>
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}

body {
  height: 100vh;
  background: #0a0913;
  background-image:
    radial-gradient(circle at bottom left, #e28d0ec2 0%, #865c1dbc 5%, #131209 30%),
    radial-gradient(circle at top right, #b3781d00 0%, #fb9b0c40 20%, #090811 60%);
  background-repeat: no-repeat;
  background-size: cover;
}

/* === TOP LINKS === */
.top-links {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px 50px;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  z-index: 10;
  background: transparent;
}

.logo {
  font-size: 24px;
  font-weight: 700;
  color: white;
}

.nav-container {
  display: flex;
  align-items: center;
  gap: 60px;
}

.nav-links {
  display: flex;
  list-style: none;
  gap: 30px;
  margin-right: 250px;
}

.nav-links a {
  text-decoration: none;
  color: #cdbfbf;
  font-weight: 600;
  transition: color 0.3s;
}

.nav-links a:hover {
  color: #dc9016;
}

.login-btn {
  background-color: #dc9016;
  border-radius: 10px;
  color: white;
  border: none;
  font-weight: 900;
  font-size: 16px;
  padding: 10px 20px;
  cursor: pointer;
  padding: 10px;
  padding-left: 30px;
  padding-right: 30px;
}

/* === MAIN CONTENT === */
main {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  padding: 20px;
}

.welcome-container {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 80px;
  max-width: 1200px;
  width: 100%;
  padding: 0 50px;
}

.image-container {
  flex: 1;
  max-width: 500px;
}

.welcome-image {
  width: 110%;
  height: auto;
  filter: drop-shadow(0 0 15px rgba(220, 144, 22, 0.4));
  animation: float 3s ease-in-out infinite;
}

.welcome-content {
  flex: 1;
  max-width: 500px;
}

.greeting {
  font-size: 16px;
  color: #9aaab0;
  margin-bottom: 10px;
}

.welcome-content h1 {
  font-size: 3rem;
  font-weight: 900;
  color: #dc9016;
  text-transform: uppercase;
  line-height: 1.1;
  margin: 0.2em 0;
  font-family: Georgia, 'Times New Roman', Times, serif;
  white-space: nowrap;
}

.highlight {
  color: #dc9016;
  font-weight: 900;
}

.subtext {
  font-size: 18px;
  color: #7f8c8d;
  margin-top: 20px;
}




@media (max-width: 992px) {
  .welcome-container {
    gap: 50px;
  }
  
  .welcome-content h1 {
    font-size: 2.5rem;
  }
}

@media (max-width: 768px) {
  .welcome-container {
    flex-direction: column;
    text-align: center;
    gap: 40px;
  }
  
  .image-container {
    max-width: 400px;
    
  }
  
  .nav-links {
    margin-right: 0;
    gap: 20px;
  }
  
  .nav-container {
    gap: 30px;
  }
}

@media (max-width: 576px) {
  .top-links {
    padding: 20px;
  }
  
  .welcome-container {
    padding: 0 20px;
  }
  
  .welcome-content h1 {
    font-size: 2rem;
    white-space: normal;
  }
  
  .nav-links {
    display: none; /* Hide nav links on very small screens */
  }
}


/* === FORM STYLES === */
/* === FORM STYLES === */
.login-form {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  padding: 40px 30px;
  width: 360px;
  z-index: 100;
  text-align: center;
  background: rgba(17, 12, 6, 0.85);
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
  border-radius: 15px;
  border: 1px solid rgba(220, 144, 22, 0.2);
  box-shadow: 0 10px 35px rgba(174, 97, 20, 0.3);
}

.login-form h5 {
  color: #dc9016;
  margin-bottom: 30px;
  font-size: 1.8rem;
  font-weight: 600;
  text-transform: uppercase;
  font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
  letter-spacing: 1px;
}

.login-form input {
  width: 100%;
  padding: 14px 20px;
  margin: 12px 0;
  border: none;
  border-radius: 8px;
  font-size: 16px;
  background: rgba(255, 255, 255, 0.989);
  color: #000000;
  transition: all 0.3s ease;
}

.login-form input::placeholder {
  color: rgba(0, 0, 0, 0.5);
}

.login-form input:focus {
  outline: none;
  background: rgba(255, 221, 174, 0.588);
  box-shadow: 0 0 0 2px rgba(220, 144, 22, 0.3);
}

.login-form button {
  background-color: #dc9016;
  color: white;
  border: none;
  padding: 14px 20px;
  margin-top: 25px;
  border-radius: 8px;
  cursor: pointer;
  font-weight: 600;
  width: 100%;
  font-size: 16px;
  transition: all 0.3s ease;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.login-form button:hover {
  background-color: #e69a1e;
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(220, 144, 22, 0.3);
}

/* Add the "YOUR WORKDAYS" text */
.login-form::after {
  content: "YOUR WORKDAYS";
  display: block;
  color: rgba(255, 255, 255, 0.3);
  font-size: 0.9rem;
  margin-top: 30px;
  letter-spacing: 2px;
  font-weight: 300;
}

/* Remove blur effect when form is active */

.blur {
  filter: blur(5px);
  height: 100vh;
  overflow: hidden;
}
</style>
</head>
<body>
  <div class="blur" id="blurBackground">
   <div class="top-links">
    <div class="logo">LOGO</div>

    <div class="nav-container">
      <ul class="nav-links">
        <li><a href="#">HOME</a></li>
        <li><a href="#">ABOUT</a></li>
        <li><a href="#">CONTACT</a></li>
      </ul>
      <button class="login-btn">LOGIN</button>
    </div>
  </div>

  <main>
    <div class="welcome-container">
      <div class="image-container">
        <img src="{{asset('images/photobig.png')}}" alt="Work illustration" class="welcome-image">
      </div>
      <div class="welcome-content">
        <p class="greeting">HI THERE!</p>
        <h1>READY TO</h1>
        <h1 class="highlight">CLOCK IN?</h1>
        <p class="subtext">YOUR WORKDAY STARTS HERE.</p>
      </div>
    </div>
  </main>
  </div>

  <form class="login-form" method="post" action="{{ route('login') }}">
    @csrf
    <h5>Welcome Back</h5>
    <input type="text" name="username" placeholder="Username" value="{{ old('username') }}" required>
    @error('username')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
    <input type="password" name="password" placeholder="Password" required>
    @error('password')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
    <button type="submit">Sign In</button>
</form>

  <script>
    document.getElementById('blurBackground').addEventListener('click', function() {
      window.location.href = 'welcome'; // or the route to your welcome page
    });
    
    // Prevent the form from closing when clicking inside it
    document.querySelector('.login-form').addEventListener('click', function(e) {
      e.stopPropagation();
    });
  </script>
</body>
</html>