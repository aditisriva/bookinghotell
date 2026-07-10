/**
 * auth.js — bookHotel (Local-only, no Supabase)
 * Handles login, signup, forgot password with localStorage.
 */
'use strict';

/* ── UI Utilities ── */
function setInvalid(input, errEl, msg) {
  input.classList.add('is-invalid'); input.classList.remove('is-valid');
  if (errEl) errEl.textContent = msg;
  const s = input.closest('.fl-wrap')?.querySelector('.fl-status');
  if (s) s.innerHTML = '<i class="bi bi-x-circle-fill" style="color:#dc2626"></i>';
}
function setValid(input, errEl) {
  input.classList.remove('is-invalid'); input.classList.add('is-valid');
  if (errEl) errEl.textContent = '';
  const s = input.closest('.fl-wrap')?.querySelector('.fl-status');
  if (s) s.innerHTML = '<i class="bi bi-check-circle-fill" style="color:#16a34a"></i>';
}
function clearState(input, errEl) {
  input.classList.remove('is-invalid', 'is-valid');
  if (errEl) errEl.textContent = '';
  const s = input.closest('.fl-wrap')?.querySelector('.fl-status');
  if (s) s.innerHTML = '';
}
function shakeField(input) {
  const wrap = input.closest('.fl-group') || input;
  wrap.animate([{transform:'translateX(0)'},{transform:'translateX(-6px)'},{transform:'translateX(6px)'},{transform:'translateX(-4px)'},{transform:'translateX(4px)'},{transform:'translateX(0)'}],{duration:320,easing:'ease-out'});
}
function showToast(message, type = 'success') {
  const container = document.getElementById('toastContainer');
  if (!container) return;
  const toast = document.createElement('div');
  toast.className = `toast-item toast-${type}`;
  const icon = type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-circle-fill';
  toast.innerHTML = `<i class="bi ${icon}"></i><span>${message}</span>`;
  container.appendChild(toast);
  setTimeout(() => { toast.style.animation = 'toastIn .3s ease reverse forwards'; setTimeout(() => toast.remove(), 300); }, 3500);
}
function pageTransition(targetURL) {
  const overlay = document.getElementById('pageOverlay');
  if (!overlay) { window.location.href = targetURL; return; }
  overlay.classList.add('slide-in');
  setTimeout(() => { window.location.href = targetURL; }, 500);
}
function isValidEmail(str) { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(str); }
function isValidMobile(str) { return /^[6-9]\d{9}$/.test(str.replace(/\D/g, '')); }
function scorePassword(pwd) {
  if (!pwd) return 0;
  let s = 0;
  if (pwd.length >= 8) s++;
  if (/[A-Z]/.test(pwd)) s++;
  if (/\d/.test(pwd)) s++;
  if (/[^A-Za-z0-9]/.test(pwd)) s++;
  return s;
}

/* ── Entrance Animation ── */
document.addEventListener('DOMContentLoaded', () => {
  const overlay = document.getElementById('pageOverlay');
  if (overlay) {
    overlay.classList.add('slide-in');
    requestAnimationFrame(() => requestAnimationFrame(() => {
      overlay.classList.remove('slide-in');
      overlay.classList.add('slide-out');
      setTimeout(() => overlay.classList.remove('slide-out'), 500);
    }));
  }
  const fields = document.querySelectorAll('.fl-group, .check-row, .btn-submit, .or-divider, .social-row, .switch-txt, .form-head');
  fields.forEach((el, i) => {
    el.style.opacity = '0'; el.style.transform = 'translateY(16px)';
    el.style.transition = `opacity .4s ease ${i * 0.06}s, transform .4s ease ${i * 0.06}s`;
    setTimeout(() => { el.style.opacity = '1'; el.style.transform = 'translateY(0)'; }, 80 + i * 60);
  });
  if (document.getElementById('loginForm'))  initLoginPage();
  if (document.getElementById('signupForm')) initSignupPage();
});

/* ── LOGIN PAGE ── */
function initLoginPage() {
  const form = document.getElementById('loginForm');
  const identifier = document.getElementById('identifier');
  const password   = document.getElementById('password');
  const identifierErr = document.getElementById('identifierErr');
  const passwordErr   = document.getElementById('passwordErr');
  const togglePwd  = document.getElementById('togglePwd');
  const eyeIcon    = document.getElementById('eyeIcon');
  const loginBtn   = document.getElementById('loginBtn');
  const loginBtnLabel  = document.getElementById('loginBtnLabel');
  const loginBtnLoader = document.getElementById('loginBtnLoader');
  const alertError = document.getElementById('alertError');
  const alertSuccess = document.getElementById('alertSuccess');
  const alertErrorMsg  = document.getElementById('alertErrorMsg');

  togglePwd?.addEventListener('click', () => {
    const show = password.type === 'password';
    password.type = show ? 'text' : 'password';
    eyeIcon.className = show ? 'bi bi-eye-slash-fill' : 'bi bi-eye-fill';
  });

  identifier?.addEventListener('blur', () => {
    const v = identifier.value.trim();
    if (!v) setInvalid(identifier, identifierErr, 'Email or mobile is required.');
    else if (!isValidEmail(v) && !isValidMobile(v)) setInvalid(identifier, identifierErr, 'Enter a valid email or 10-digit mobile.');
    else setValid(identifier, identifierErr);
  });
  identifier?.addEventListener('input', () => { if (identifier.classList.contains('is-invalid')) clearState(identifier, identifierErr); });
  password?.addEventListener('blur', () => { if (!password.value) setInvalid(password, passwordErr, 'Password is required.'); else setValid(password, passwordErr); });
  password?.addEventListener('input', () => { if (password.classList.contains('is-invalid')) clearState(password, passwordErr); });

  // Forgot password modal
  const forgotLink   = document.getElementById('forgotLink');
  const forgotModal  = document.getElementById('forgotModal');
  const closeModal   = document.getElementById('closeModal');
  const sendResetBtn = document.getElementById('sendResetBtn');
  const resetEmail   = document.getElementById('resetEmail');
  const resetErr     = document.getElementById('resetErr');
  const resetSuccess = document.getElementById('resetSuccess');

  forgotLink?.addEventListener('click', (e) => { e.preventDefault(); forgotModal?.classList.add('open'); });
  closeModal?.addEventListener('click', () => forgotModal?.classList.remove('open'));
  forgotModal?.addEventListener('click', (e) => { if (e.target === forgotModal) forgotModal.classList.remove('open'); });

  sendResetBtn?.addEventListener('click', () => {
    const email = resetEmail.value.trim();
    if (!email || !isValidEmail(email)) { setInvalid(resetEmail, resetErr, 'Enter a valid email.'); shakeField(resetEmail); return; }
    setValid(resetEmail, resetErr);
    sendResetBtn.disabled = true;
    sendResetBtn.textContent = 'Sending…';
    setTimeout(() => {
      sendResetBtn.disabled = false;
      sendResetBtn.innerHTML = '<span class="btn-label">Send Reset Link</span>';
      resetSuccess?.classList.remove('d-none');
      setTimeout(() => { forgotModal?.classList.remove('open'); resetSuccess?.classList.add('d-none'); resetEmail.value = ''; clearState(resetEmail, resetErr); }, 2500);
    }, 1200);
  });

  // Form submit — localStorage based
  form?.addEventListener('submit', (e) => {
    e.preventDefault();
    let valid = true;
    const idVal = identifier.value.trim();
    const pwVal = password.value;

    if (!idVal) { setInvalid(identifier, identifierErr, 'Email or mobile is required.'); shakeField(identifier); valid = false; }
    else if (!isValidEmail(idVal) && !isValidMobile(idVal)) { setInvalid(identifier, identifierErr, 'Enter a valid email or mobile.'); shakeField(identifier); valid = false; }
    else setValid(identifier, identifierErr);

    if (!pwVal) { setInvalid(password, passwordErr, 'Password is required.'); shakeField(password); valid = false; }
    else setValid(password, passwordErr);

    if (!valid) { if (alertErrorMsg) alertErrorMsg.textContent = 'Please fix the errors above.'; alertError?.classList.remove('d-none'); return; }

    alertError?.classList.add('d-none');
    loginBtnLabel?.classList.add('d-none');
    loginBtnLoader?.classList.remove('d-none');
    if (loginBtn) loginBtn.disabled = true;

    setTimeout(() => {
      loginBtnLabel?.classList.remove('d-none');
      loginBtnLoader?.classList.add('d-none');
      if (loginBtn) loginBtn.disabled = false;

      // Save user to localStorage
      const name = isValidEmail(idVal) ? idVal.split('@')[0] : idVal;
      localStorage.setItem('bh_user', JSON.stringify({ name: name.charAt(0).toUpperCase() + name.slice(1), email: idVal }));
      alertSuccess?.classList.remove('d-none');
      showToast('Signed in successfully! Welcome back 👋', 'success');
      setTimeout(() => pageTransition('index.php'), 1200);
    }, 1400);
  });

  document.querySelectorAll('#goSignup, #switchToSignup').forEach(link => {
    link.addEventListener('click', (e) => { e.preventDefault(); pageTransition('signup.php'); });
  });
}

/* ── SIGNUP PAGE ── */
function initSignupPage() {
  const form = document.getElementById('signupForm');
  const fullName = document.getElementById('fullName');
  const email    = document.getElementById('email');
  const mobile   = document.getElementById('mobile');
  const password = document.getElementById('password');
  const confirmPassword = document.getElementById('confirmPassword');
  const agreeTerms = document.getElementById('agreeTerms');
  const fullNameErr = document.getElementById('fullNameErr');
  const emailErr    = document.getElementById('emailErr');
  const mobileErr   = document.getElementById('mobileErr');
  const passwordErr = document.getElementById('passwordErr');
  const confirmErr  = document.getElementById('confirmErr');
  const termsErr    = document.getElementById('termsErr');
  const signupBtn   = document.getElementById('signupBtn');
  const signupBtnLabel  = document.getElementById('signupBtnLabel');
  const signupBtnLoader = document.getElementById('signupBtnLoader');
  const alertError  = document.getElementById('alertError');
  const alertErrorMsg = document.getElementById('alertErrorMsg');
  const alertSuccess = document.getElementById('alertSuccess');
  const strengthWrap  = document.getElementById('strengthWrap');
  const strengthFill  = document.getElementById('strengthFill');
  const strengthLabel = document.getElementById('strengthLabel');
  const strengthText  = ['', 'Weak', 'Fair', 'Good', 'Strong'];
  const strengthColor = ['', '#ef4444', '#f97316', '#eab308', '#22c55e'];

  function updateStrength(pwd) {
    if (!strengthWrap) return;
    if (!pwd) { strengthWrap.style.display = 'none'; return; }
    strengthWrap.style.display = 'block';
    const score = scorePassword(pwd);
    if (strengthFill) strengthFill.setAttribute('data-s', score);
    if (strengthLabel) { strengthLabel.textContent = strengthText[score] || ''; strengthLabel.style.color = strengthColor[score] || ''; }
    const rules = [{id:'rule-len',pass:pwd.length>=8},{id:'rule-upper',pass:/[A-Z]/.test(pwd)},{id:'rule-num',pass:/\d/.test(pwd)},{id:'rule-sym',pass:/[^A-Za-z0-9]/.test(pwd)}];
    rules.forEach(r => { const el = document.getElementById(r.id); if(!el) return; el.classList.toggle('pass', r.pass); const i = el.querySelector('i'); if(i) i.className = r.pass ? 'bi bi-check-circle-fill' : 'bi bi-circle'; });
  }

  function initEye(btnId, iconId, inputEl) {
    const btn = document.getElementById(btnId), icon = document.getElementById(iconId);
    if (!btn || !icon || !inputEl) return;
    btn.addEventListener('click', () => { const show = inputEl.type === 'password'; inputEl.type = show ? 'text' : 'password'; icon.className = show ? 'bi bi-eye-slash-fill' : 'bi bi-eye-fill'; });
  }
  initEye('togglePwd', 'eyeIcon', password);
  initEye('toggleConfirm', 'eyeConfirmIcon', confirmPassword);

  mobile?.addEventListener('input', () => { mobile.value = mobile.value.replace(/\D/g, '').slice(0, 10); });
  password?.addEventListener('input', () => updateStrength(password.value));

  function validateFullName() { const v = fullName.value.trim(); if (!v) { setInvalid(fullName, fullNameErr, 'Full name is required.'); return false; } if (v.length < 3) { setInvalid(fullName, fullNameErr, 'Min 3 characters.'); return false; } setValid(fullName, fullNameErr); return true; }
  function validateEmail()    { const v = email.value.trim(); if (!v) { setInvalid(email, emailErr, 'Email is required.'); return false; } if (!isValidEmail(v)) { setInvalid(email, emailErr, 'Enter a valid email.'); return false; } setValid(email, emailErr); return true; }
  function validateMobile()   { const v = mobile.value.trim(); if (!v) { setInvalid(mobile, mobileErr, 'Mobile is required.'); return false; } if (!isValidMobile(v)) { setInvalid(mobile, mobileErr, 'Enter valid 10-digit mobile.'); return false; } setValid(mobile, mobileErr); return true; }
  function validatePassword() { const v = password.value; if (!v) { setInvalid(password, passwordErr, 'Password is required.'); return false; } if (v.length < 8) { setInvalid(password, passwordErr, 'Min 8 characters.'); return false; } if (!/[A-Z]/.test(v)) { setInvalid(password, passwordErr, 'Include one uppercase letter.'); return false; } if (!/\d/.test(v)) { setInvalid(password, passwordErr, 'Include one number.'); return false; } setValid(password, passwordErr); return true; }
  function validateConfirm()  { const v = confirmPassword.value; if (!v) { setInvalid(confirmPassword, confirmErr, 'Confirm your password.'); return false; } if (v !== password.value) { setInvalid(confirmPassword, confirmErr, 'Passwords do not match.'); return false; } setValid(confirmPassword, confirmErr); return true; }

  [fullName, email, mobile, password, confirmPassword].forEach((inp, i) => {
    const errs = [fullNameErr, emailErr, mobileErr, passwordErr, confirmErr];
    inp?.addEventListener('blur', [validateFullName, validateEmail, validateMobile, validatePassword, validateConfirm][i]);
    inp?.addEventListener('input', () => { if (inp.classList.contains('is-invalid')) clearState(inp, errs[i]); });
  });

  form?.addEventListener('submit', (e) => {
    e.preventDefault();
    const checks = [validateFullName(), validateEmail(), validateMobile(), validatePassword(), validateConfirm()];
    let termsOk = true;
    if (agreeTerms && !agreeTerms.checked) { if (termsErr) termsErr.textContent = 'You must agree to the Terms.'; termsOk = false; }
    else { if (termsErr) termsErr.textContent = ''; }
    if (!checks.every(Boolean) || !termsOk) { if (alertErrorMsg) alertErrorMsg.textContent = 'Please fix the errors above.'; alertError?.classList.remove('d-none'); form.querySelector('.is-invalid')?.focus(); return; }
    alertError?.classList.add('d-none');
    signupBtnLabel?.classList.add('d-none');
    signupBtnLoader?.classList.remove('d-none');
    if (signupBtn) signupBtn.disabled = true;

    setTimeout(() => {
      signupBtnLabel?.classList.remove('d-none');
      signupBtnLoader?.classList.add('d-none');
      if (signupBtn) signupBtn.disabled = false;
      alertSuccess?.classList.remove('d-none');
      showToast('Account created! Welcome to bookHotel 🎉', 'success');
      form.reset();
      if (strengthWrap) strengthWrap.style.display = 'none';
      setTimeout(() => pageTransition('login.php'), 2000);
    }, 1800);
  });
}
