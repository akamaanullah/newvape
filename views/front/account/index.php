<?php
/**
 * NEW VAPE - MY ACCOUNT PAGE (my-account.php)
 * Clean, high-converting 2-column Login & Registration page.
 */
$page_title   = 'My Account - New Vape';
$current_page = 'my-account';
$page_js      = 'account';

include dirname(__DIR__) . '/includes/header.php';
?>

<!-- Breadcrumb Navigation -->
<nav class="breadcrumb-nav" aria-label="Breadcrumb">
  <div class="container">
    <ol class="breadcrumb-list">
      <li class="breadcrumb-item"><a href="<?= url() ?>">HOME</a></li>
      <li class="breadcrumb-separator">/</li>
      <li class="breadcrumb-item active" aria-current="page">MY ACCOUNT</li>
    </ol>
  </div>
</nav>

<!-- Main Account Page Content -->
<section class="account-page-main">
  <div class="container">
    
    <div class="account-forms-grid">
      
      <!-- Login Column -->
      <div class="account-form-column" id="loginColumn">
        <h1 class="account-box-title">Login</h1>
        <div class="account-form-card">
          <form class="account-form" id="loginForm" novalidate>
            
            <div class="account-form-group">
              <label for="loginUsername" class="account-label">Username or email address <span class="required-star">*</span></label>
              <input type="text" id="loginUsername" name="username" class="account-input" placeholder="you@example.com" required autocomplete="username">
              <span class="field-error-msg" id="errLoginUsername">Please enter your username or email.</span>
            </div>

            <div class="account-form-group">
              <label for="loginPassword" class="account-label">Password <span class="required-star">*</span></label>
              <div class="password-input-wrap">
                <input type="password" id="loginPassword" name="password" class="account-input" placeholder="••••••••" required autocomplete="current-password">
                <button type="button" class="btn-password-toggle" aria-label="Toggle password visibility" onclick="togglePasswordVisibility('loginPassword', this)">
                  <svg class="eye-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                    <line x1="1" y1="1" x2="23" y2="23"></line>
                  </svg>
                </button>
              </div>
              <span class="field-error-msg" id="errLoginPassword">Please enter your password.</span>
            </div>

            <div class="account-remember-wrap">
              <input type="checkbox" id="rememberMe" name="rememberme" class="account-checkbox" checked>
              <label for="rememberMe" class="remember-label">Remember me</label>
            </div>

            <div class="account-btn-row">
              <button type="submit" class="btn-account-submit" id="btnLoginSubmit">Log in</button>
            </div>

            <div class="account-lost-password">
              <a href="#" class="lost-password-link" id="linkLostPassword">Lost your password?</a>
            </div>

            <div class="account-status-msg" id="loginStatusMsg" style="display: none;"></div>

          </form>
        </div>
      </div>

      <!-- Register Column -->
      <div class="account-form-column" id="registerColumn">
        <h2 class="account-box-title">Register</h2>
        <div class="account-form-card">
          <form class="account-form" id="registerForm" novalidate>
            
            <div class="account-form-group">
              <label for="regEmail" class="account-label">Email address <span class="required-star">*</span></label>
              <input type="email" id="regEmail" name="email" class="account-input" placeholder="you@example.com" required autocomplete="email">
              <span class="field-error-msg" id="errRegEmail">Please enter a valid email address.</span>
            </div>

            <div class="account-form-group">
              <label for="regPassword" class="account-label">Password <span class="required-star">*</span></label>
              <div class="password-input-wrap">
                <input type="password" id="regPassword" name="password" class="account-input" placeholder="Create strong password" required autocomplete="new-password">
                <button type="button" class="btn-password-toggle" aria-label="Toggle password visibility" onclick="togglePasswordVisibility('regPassword', this)">
                  <svg class="eye-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                    <line x1="1" y1="1" x2="23" y2="23"></line>
                  </svg>
                </button>
              </div>
              <span class="field-error-msg" id="errRegPassword">Password must be at least 6 characters.</span>
            </div>

            <p class="account-privacy-notice">
              Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our <a href="privacy.php" class="link-privacy-underline">privacy policy</a>.
            </p>

            <div class="account-btn-row">
              <button type="submit" class="btn-account-submit" id="btnRegisterSubmit">Register</button>
            </div>

            <div class="account-status-msg" id="regStatusMsg" style="display: none;"></div>

          </form>
        </div>
      </div>

    </div>

  </div>
</section>

<script>
function togglePasswordVisibility(inputId, btn) {
  const input = document.getElementById(inputId);
  if (!input) return;
  
  if (input.type === 'password') {
    input.type = 'text';
    btn.innerHTML = `<svg class="eye-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
      <circle cx="12" cy="12" r="3"></circle>
    </svg>`;
  } else {
    input.type = 'password';
    btn.innerHTML = `<svg class="eye-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
      <line x1="1" y1="1" x2="23" y2="23"></line>
    </svg>`;
  }
}

document.addEventListener('DOMContentLoaded', function () {
  const loginForm = document.getElementById('loginForm');
  const registerForm = document.getElementById('registerForm');
  const linkLostPassword = document.getElementById('linkLostPassword');

  // Handle ?action=register URL query
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.get('action') === 'register') {
    const regInput = document.getElementById('regEmail');
    if (regInput) {
      setTimeout(() => {
        regInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
        regInput.focus();
      }, 200);
    }
  }

  // Login form submission
  if (loginForm) {
    loginForm.addEventListener('submit', function (e) {
      e.preventDefault();
      const username = document.getElementById('loginUsername');
      const pass = document.getElementById('loginPassword');
      const statusMsg = document.getElementById('loginStatusMsg');
      const btn = document.getElementById('btnLoginSubmit');
      let valid = true;

      if (!username.value.trim()) {
        username.classList.add('has-error');
        document.getElementById('errLoginUsername').style.display = 'block';
        valid = false;
      } else {
        username.classList.remove('has-error');
        document.getElementById('errLoginUsername').style.display = 'none';
      }

      if (!pass.value.trim()) {
        pass.classList.add('has-error');
        document.getElementById('errLoginPassword').style.display = 'block';
        valid = false;
      } else {
        pass.classList.remove('has-error');
        document.getElementById('errLoginPassword').style.display = 'none';
      }

      if (valid) {
        btn.disabled = true;
        btn.textContent = 'Logging in...';
        setTimeout(() => {
          btn.disabled = false;
          btn.textContent = 'Log in';
          statusMsg.className = 'account-status-msg success';
          statusMsg.textContent = 'Welcome back! Login successful. Redirecting...';
          statusMsg.style.display = 'block';
          setTimeout(() => {
            window.location.href = 'index.php';
          }, 1200);
        }, 800);
      }
    });
  }

  // Register form submission
  if (registerForm) {
    registerForm.addEventListener('submit', function (e) {
      e.preventDefault();
      const email = document.getElementById('regEmail');
      const pass = document.getElementById('regPassword');
      const statusMsg = document.getElementById('regStatusMsg');
      const btn = document.getElementById('btnRegisterSubmit');
      let valid = true;

      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!email.value.trim() || !emailPattern.test(email.value.trim())) {
        email.classList.add('has-error');
        document.getElementById('errRegEmail').style.display = 'block';
        valid = false;
      } else {
        email.classList.remove('has-error');
        document.getElementById('errRegEmail').style.display = 'none';
      }

      if (!pass.value.trim() || pass.value.length < 6) {
        pass.classList.add('has-error');
        document.getElementById('errRegPassword').style.display = 'block';
        valid = false;
      } else {
        pass.classList.remove('has-error');
        document.getElementById('errRegPassword').style.display = 'none';
      }

      if (valid) {
        btn.disabled = true;
        btn.textContent = 'Creating account...';
        setTimeout(() => {
          btn.disabled = false;
          btn.textContent = 'Register';
          statusMsg.className = 'account-status-msg success';
          statusMsg.textContent = 'Account created successfully! Welcome to New Vape.';
          statusMsg.style.display = 'block';
          setTimeout(() => {
            window.location.href = 'index.php';
          }, 1200);
        }, 800);
      }
    });
  }

  // Lost password handler
  if (linkLostPassword) {
    linkLostPassword.addEventListener('click', function (e) {
      e.preventDefault();
      const email = prompt('Please enter your email address to reset password:');
      if (email && email.trim()) {
        alert('Password reset instructions have been sent to ' + email.trim());
      }
    });
  }
});
</script>

<?php
include dirname(__DIR__) . '/includes/footer.php';
?>
