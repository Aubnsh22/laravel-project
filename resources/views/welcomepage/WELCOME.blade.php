<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Welcome</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{asset('css/style.css')}}" />
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


@keyframes float {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-30px); }
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
    display:none; 
  }
}
  .about-section {
      padding: 80px 50px;
      background: rgba(10, 9, 19, 0.9);
      color: white;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .about-container {
      max-width: 1200px;
      width: 100%;
      display: flex;
      align-items: center;
      gap: 60px;
    }
    
    .about-image {
      flex: 1;
      max-width: 500px;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(220, 144, 22, 0.3);
    }
    
    .about-content {
      flex: 1;
    }
    
    .section-title {
      font-size: 2.5rem;
      color: #dc9016;
      margin-bottom: 30px;
      font-weight: 700;
      text-transform: uppercase;
    }
    
    .about-text {
      color: #cdbfbf;
      line-height: 1.8;
      margin-bottom: 20px;
    }
    
    .highlight-text {
      color: #dc9016;
      font-weight: 600;
    }
    
    @media (max-width: 768px) {
      .about-container {
        flex-direction: column;
      }
      
      .about-image {
        max-width: 100%;
      }
    }
    html {
  scroll-behavior: smooth;
}

.top-links {
  position: fixed;
  background: rgba(10, 9, 19, 0.9); 
  backdrop-filter: blur(5px); 
  transition: all 0.3s ease;
}


#about {
  padding-top: 100px;
}

html {
  scroll-behavior: smooth;
  scroll-padding-top: 80px; 
}

#home, #about {
  scroll-margin-top: 0px; 
}
#contact{
  scroll-margin-top: -80px;
}
/* === CONTACT SECTION === */
.contact-section {
  padding: 80px 50px;
  background: rgba(10, 9, 19, 0.9);
  color: white;
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
 
}

.contact-container {
  max-width: 1200px;
  width: 100%;
}

.contact-subtitle {
  color: #cdbfbf;
  font-size: 1.1rem;
  margin-bottom: 50px;
  text-align: center;
}

.contact-content {
  display: flex;
  gap: 60px;
}

.contact-info {
  flex: 1;
}

.info-item {
  display: flex;
  align-items: flex-start;
  gap: 20px;
  margin-bottom: 30px;
}

.info-icon {
  background: rgba(220, 144, 22, 0.2);
  border-radius: 50%;
  width: 50px;
  height: 50px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.info-icon svg {
  width: 24px;
  height: 24px;
  color: #dc9016;
}

.info-text h3 {
  color: #dc9016;
  margin-bottom: 5px;
  font-size: 1.2rem;
}

.info-text p {
  color: #cdbfbf;
  line-height: 1.6;
}

.contact-form {
  flex: 1;
  background: rgba(255, 255, 255, 0.05);
  padding: 30px;
  border-radius: 10px;
  backdrop-filter: blur(5px);
  border: 1px solid rgba(220, 144, 22, 0.2);
  margin-top: -5px;
}

.form-group {
  margin-bottom: 20px;
}

.form-group input,
.form-group textarea {
  width: 100%;
  padding: 12px 15px;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(220, 144, 22, 0.3);
  border-radius: 5px;
  color: white;
  font-family: 'Poppins', sans-serif;
  transition: all 0.3s ease;
}

.form-group input:focus,
.form-group textarea:focus {
  outline: none;
  border-color: #dc9016;
  box-shadow: 0 0 0 2px rgba(220, 144, 22, 0.2);
}

.form-group textarea {
  resize: vertical;
}

.submit-btn {
  background-color: #dc9016;
  color: white;
  border: none;
  padding: 12px 30px;
  border-radius: 5px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  width: 100%;
}

.submit-btn:hover {
  background-color: #c57e12;
  transform: translateY(-2px);
}

/* Responsive adjustments for contact section */
@media (max-width: 768px) {
  .contact-content {
    flex-direction: column;
  }
  
  .contact-info, .contact-form {
    width: 100%;
  }
}

@media (max-width: 576px) {
  .contact-section {
    padding: 60px 20px;
  }
  
  .info-item {
    flex-direction: column;
    gap: 10px;
  }
}
.copywright {
  color: #cdbfbf;
  font-family:Georgia, 'Times New Roman', Times, serif;
  text-align: center;
  margin: 0 auto; 
  width: fit-content; 
}
</style>
</head>
<body>
  <div class="top-links">
    <div class="logo">LOGO</div>
    <div class="nav-container">
      <ul class="nav-links">
        <li><a href="#home">HOME</a></li>
        <li><a href="#about">ABOUT</a></li>
        <li><a href="#contact">CONTACT</a></li>
      </ul>
      <button class="login-btn" onclick="window.location.href='signin'">LOGIN</button>
    </div>
  </div>

  <main id="home">
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

  <section id="about" class="about-section">
    <div class="about-container">
      <div class="about-content">
        <h2 class="section-title">About Our <span class="highlight-text">Time Tracking</span> System</h2>
        <p class="about-text">
          Our platform is designed to help teams and individuals <span class="highlight-text">track work hours efficiently</span>, 
          manage projects, and streamline productivity. Whether you're a freelancer, 
          small business, or large enterprise, our tools adapt to your needs.
        </p>
        <p class="about-text">
          With features like <span class="highlight-text">real-time tracking</span>, detailed reports, and seamless integration, 
          you'll never lose track of billable hours again. Our system is built with 
          security and simplicity in mind.
        </p>
        <p class="about-text">
          <span class="highlight-text">Join thousands</span> of professionals who have transformed their workflow with 
          our time management solution.
        </p>
      </div>
      <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="About our system" class="about-image">
    </div>
  </section>

  <section id="contact" class="contact-section">
    <div class="contact-container">
      <h2 class="section-title">Get In <span class="highlight-text">Touch</span></h2>
      <p class="contact-subtitle">Have questions or need assistance? We're here to help!</p>
      
      <div class="contact-content">
        <div class="contact-info">
          <div class="info-item">
            <div class="info-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
              </svg>
            </div>
            <div class="info-text">
              <h3>Phone</h3>
              <p>+212 645186011</p>
            </div>
          </div>
          
          <div class="info-item">
            <div class="info-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                <polyline points="22,6 12,13 2,6"></polyline>
              </svg>
            </div>
            <div class="info-text">
              <h3>Email</h3>
              <p>ayoubabs@gmail.com</p>
            </div>
          </div>
          
          <div class="info-item">
            <div class="info-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                <circle cx="12" cy="10" r="3"></circle>
              </svg>
            </div>
            <div class="info-text">
              <h3>Location</h3>
              <p>Bokidan ait youssef et ali<br>AL HOCEIMA MAROC</p>
            </div>
          </div>
        </div>
        
        <form class="contact-form">
          <div class="form-group">
            <input type="text" placeholder="Your Name" required>
          </div>
          <div class="form-group">
            <input type="email" placeholder="Your Email" required>
          </div>
          <div class="form-group">
            <input type="text" placeholder="Subject">
          </div>
          <div class="form-group">
            <textarea placeholder="Your Message" rows="5" required></textarea>
          </div>
          <button type="submit" class="submit-btn">Send Message</button>
          
        </form>
      </div>
    </div>
    
  </section>

</body>
<footer class="copywright">
  The rights are reserved <strong>&copy;2025</strong>
</footer>
</html>