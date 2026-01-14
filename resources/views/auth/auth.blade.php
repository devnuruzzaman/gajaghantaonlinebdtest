<?php
use App\Models\Setting;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login - {{ Setting::get('site_name', 'Gajaghanta Online') }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">

@if(Setting::get('favicon'))
<link rel="icon" href="{{ asset(Setting::get('favicon')) }}">
@endif

<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6/css/all.min.css">

<style>
  :root{
    --primary-color: {{ Setting::get('primary_color', '#6366f1') }};
    --primary-hover: {{ Setting::get('primary_color', '#6366f1') }}dd;
    --gstart: {{ Setting::get('gradient_start', '#0b1029') }};
    --gend: {{ Setting::get('gradient_end', '#10163a') }};
  }

  .gradient-bg{
    background: linear-gradient(135deg, var(--gstart) 0%, var(--gend) 100%);
  }

  .btn-primary{
    background: var(--primary-color);
    color: #fff;
    transition: all .25s ease;
    width: 100%;
  }
  .btn-primary:hover{
    background: var(--primary-hover);
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0,0,0,.2);
  }

  .input{
    width:100%;
    border:1px solid #e5e7eb;
    padding:12px 16px;
    border-radius:12px;
    font-size:14px;
    transition: all .2s ease;
    background: rgba(255,255,255,.85);
  }
  .input:focus{
    outline:none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(99,102,241,.12);
    background:#fff;
  }

  .tab{
    flex:1;
    padding:16px 24px;
    font-weight:700;
    text-align:center;
    cursor:pointer;
    transition: all .2s ease;
    border-bottom: 3px solid transparent;
    color:#374151;
    background:#fff;
  }
  .tab:hover{ background:#f9fafb; }

  /* ACTIVE TAB */
  .tab-active{
    border-bottom-color: var(--primary-color);
    color: var(--primary-color);
    background: rgba(99,102,241,.08);
  }

  @keyframes slideIn{
    from{ opacity:0; transform: translateY(16px); }
    to{ opacity:1; transform: translateY(0); }
  }
  .auth-form{ animation: slideIn .35s ease-out; }

  @media (max-width: 640px){
    .input{ font-size:16px; }
  }
</style>
</head>

<body class="min-h-screen gradient-bg flex flex-col">

<header class="max-w-7xl mx-auto w-full px-6 py-5 flex items-center justify-between text-white">
    <div class="flex items-center gap-2">
        @if(Setting::get('logo'))
            <a href="{{ url('/') }}">
                <img src="{{ asset(Setting::get('logo')) }}" alt="{{ Setting::get('site_name', 'Gajaghanta Online') }}" class="w-10 h-10 rounded-full">
            </a>
        @else
            <a href="{{ url('/') }}" class="w-10 h-10 rounded-full" style="background: var(--primary-color);"></a>
        @endif
        <a href="{{ url('/') }}" class="font-bold text-lg">{{ Setting::get('site_name', 'Gajaghanta Online') }}</a>
    </div>

    <nav class="hidden md:flex gap-8 text-sm font-medium text-white/90">
        <a href="{{ url('/') }}" class="hover:text-white">Home</a>
        <a href="javascript:void(0)" onclick="showTab('login')" class="hover:text-white">Login</a>
        <a href="javascript:void(0)" onclick="showTab('register')" class="hover:text-white">Register</a>
    </nav>

    <div class="flex gap-3">
        <a href="{{ url('/') }}" class="border border-white/30 text-white px-4 py-2 rounded-lg text-sm hover:bg-white/10">Back to Home</a>
    </div>
</header>

<main class="flex-1 flex items-center justify-center px-4 py-10">
<div class="max-w-7xl w-full grid lg:grid-cols-2 gap-12 items-center">

  <!-- LEFT -->
  <div class="text-white space-y-8">
      <span class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-medium">
          <i class="fas fa-rocket"></i>
          Join {{ Setting::get('site_name', 'Gajaghanta Online') }}
      </span>

      <h1 class="text-3xl lg:text-4xl xl:text-5xl font-bold leading-tight">
          Start Your Journey with <br>
          <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
              High-Speed Internet
          </span>
      </h1>

      <p class="text-gray-300 max-w-xl text-base lg:text-lg">
          {{ Setting::get('hero_text', 'Experience blazing fast fiber optic internet with 99.9% uptime guarantee. Connect your home or business with the most reliable network in the region.') }}
      </p>

      <div class="space-y-4 max-w-md">
          @foreach([
              ['⚡', 'Lightning Fast Speeds up to 1Gbps'],
              ['✅', '99.9% Network Uptime Guarantee'],
              ['📞', '24/7 Customer Support'],
              ['🛠️', 'Free Installation & Setup']
          ] as $feature)
              <div class="flex items-center gap-4 bg-white/5 backdrop-blur-sm rounded-xl p-4 hover:bg-white/10 transition-all duration-300">
                  <div class="text-2xl">{{ $feature[0] }}</div>
                  <span class="text-sm font-medium">{{ $feature[1] }}</span>
              </div>
          @endforeach
      </div>
  </div>

  <!-- RIGHT CARD -->
  <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-2xl overflow-hidden max-w-md w-full mx-auto border border-white/10">

      <!-- Header -->
      <div class="p-6 border-b border-gray-100 flex items-center gap-3">
          @if(Setting::get('logo'))
              <img src="{{ asset(Setting::get('logo')) }}"
                   alt="{{ Setting::get('site_name', 'Gajaghanta Online') }}"
                   class="w-12 h-12 rounded-xl object-cover">
          @else
              <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white font-bold text-lg"
                   style="background: var(--primary-color);">
                  <i class="fas fa-wifi"></i>
              </div>
          @endif
          <div>
              <h3 class="font-bold text-gray-800">{{ Setting::get('site_name', 'Gajaghanta Online') }}</h3>
              <p class="text-sm text-gray-500">{{ Setting::get('tagline', 'Network Management System') }}</p>
          </div>
      </div>

      <!-- Tabs (DEFAULT: LOGIN ACTIVE) -->
      <div class="flex border-b border-gray-100">
          <button type="button" onclick="showTab('register')" id="registerTab" class="tab">
              <i class="fas fa-user-plus mr-2"></i>Register
          </button>
          <button type="button" onclick="showTab('login')" id="loginTab" class="tab tab-active">
              <i class="fas fa-sign-in-alt mr-2"></i>Login
          </button>
      </div>

      <!-- REGISTER (HIDDEN BY DEFAULT) -->
      <div id="register" class="p-6 space-y-4 auth-form hidden">
          <div class="mb-2">
              <h2 class="text-xl font-bold text-gray-800">Create Account</h2>
              <p class="text-sm text-gray-500 mt-1">{{ Setting::get('register_subtitle', 'Fill in your details to get started') }}</p>
          </div>

          @if ($errors->any())
              <div class="bg-red-50 border border-red-200 text-red-600 rounded-lg px-4 py-3 text-sm">
                  <div class="flex items-start gap-2">
                      <i class="fas fa-exclamation-triangle mt-0.5"></i>
                      <div>
                          <p class="font-semibold mb-1">Please fix the following:</p>
                          <ul class="space-y-1">
                              @foreach ($errors->all() as $error)
                                  <li>• {{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  </div>
              </div>
          @endif

          @if(session('success'))
              <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3 text-sm">
                  <div class="flex items-center gap-2">
                      <i class="fas fa-check-circle"></i>
                      <span>{{ session('success') }}</span>
                  </div>
              </div>
          @endif

          <form method="POST" action="{{ route('register') }}" class="space-y-4">
              @csrf

              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <input type="text" name="name" placeholder="Full Name" class="input" value="{{ old('name') }}" required>
                  <input type="text" name="mobile" placeholder="Mobile Number" class="input" value="{{ old('mobile') }}" required>
              </div>

              <input type="email" name="email" placeholder="Email Address (Optional)" class="input" value="{{ old('email') }}">
              <input type="text" name="address" placeholder="Installation Address" class="input" value="{{ old('address') }}" required>

              <select name="zone" class="input" required>
                  <option value="">Select Your Zone</option>
                  @if(Setting::get('zones'))
                      @foreach(json_decode(Setting::get('zones', '[]'), true) as $zone)
                          <option value="{{ $zone['value'] }}" {{ old('zone') == $zone['value'] ? 'selected' : '' }}>
                              {{ $zone['label'] }}
                          </option>
                      @endforeach
                  @else
                      @foreach(['dhaka'=>'Dhaka','chittagong'=>'Chittagong','rajshahi'=>'Rajshahi','khulna'=>'Khulna','sylhet'=>'Sylhet'] as $k=>$v)
                          <option value="{{ $k }}" {{ old('zone') == $k ? 'selected' : '' }}>{{ $v }}</option>
                      @endforeach
                  @endif
              </select>

              <button type="submit" class="btn-primary py-4 rounded-xl font-semibold text-base shadow-lg">
                  <i class="fas fa-rocket mr-2"></i>Submit Application
              </button>
          </form>

          <div class="text-center pt-4 border-t border-gray-100">
              <p class="text-sm text-gray-600">
                  Already have an account?
                  <a href="javascript:void(0)" onclick="showTab('login')" class="font-semibold hover:underline" style="color:var(--primary-color)">
                      Sign in here
                  </a>
              </p>
          </div>
      </div>

      <!-- LOGIN (VISIBLE BY DEFAULT) -->
      <div id="login" class="p-6 space-y-4 auth-form">
          <div class="mb-2">
              <h2 class="text-xl font-bold text-gray-800">Welcome Back</h2>
              <p class="text-sm text-gray-500 mt-1">{{ Setting::get('login_subtitle', 'Login to your dashboard') }}</p>
          </div>

          @if ($errors->any())
              <div class="bg-red-50 border border-red-200 text-red-600 rounded-lg px-4 py-3 text-sm">
                  <div class="flex items-start gap-2">
                      <i class="fas fa-exclamation-triangle mt-0.5"></i>
                      <div>
                          <p class="font-semibold mb-1">Login failed:</p>
                          <ul class="space-y-1">
                              @foreach ($errors->all() as $error)
                                  <li>• {{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  </div>
              </div>
          @endif

          <form method="POST" action="{{ route('login') }}" class="space-y-4" onsubmit="return debugFormSubmit(this)">
              @csrf

              <input type="text" name="email" placeholder="Email or Mobile" class="input" value="{{ old('email') }}" required>

              <div class="relative">
                  <input type="password" name="password" placeholder="Password" class="input pr-12" required id="loginPassword">
                  <button type="button" onclick="toggleLoginPassword()"
                          class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 transition">
                      <i id="loginPasswordToggle" class="fas fa-eye"></i>
                  </button>
              </div>

              <div class="flex items-center justify-between">
                  <label class="flex items-center">
                      <input name="remember" type="checkbox" class="mr-2 rounded" style="accent-color: var(--primary-color);">
                      <span class="text-sm text-gray-600">Remember me</span>
                  </label>

                  @if (Route::has('password.request'))
                      <a href="{{ route('password.request') }}" class="text-sm font-semibold hover:underline" style="color:var(--primary-color)">
                          Forgot password?
                      </a>
                  @endif
              </div>

              <button type="submit" class="btn-primary py-4 rounded-xl font-semibold text-base shadow-lg">
                  <i class="fas fa-sign-in-alt mr-2"></i>Login to Dashboard
              </button>
          </form>

          <div class="text-center pt-4 border-t border-gray-100">
              <p class="text-sm text-gray-600">
                  Don't have an account?
                  <a href="javascript:void(0)" onclick="showTab('register')" class="font-semibold hover:underline" style="color:var(--primary-color)">
                      Create one now
                  </a>
              </p>
          </div>
      </div>

  </div>
</div>

</div>
</main>

<footer class="w-full border-t border-white/10 bg-black/20 text-gray-200">
    <div class="max-w-7xl mx-auto px-6 py-6 flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="text-sm">
            <span class="font-semibold">© {{ date('Y') }} {{ Setting::get('site_name', 'Gajaghanta Online') }}</span>
            <span class="text-white/70">&nbsp;•&nbsp;{{ Setting::get('tagline', 'Network Management System') }}</span>
        </div>
        <div class="text-sm text-white/80 flex flex-col sm:flex-row gap-3 items-center">
            @if(Setting::get('contact_phone'))
                <a href="tel:{{ Setting::get('contact_phone') }}" class="hover:text-white">
                    <i class="fas fa-phone"></i> {{ Setting::get('contact_phone') }}
                </a>
            @endif
            @if(Setting::get('contact_email'))
                <a href="mailto:{{ Setting::get('contact_email') }}" class="hover:text-white">
                    <i class="fas fa-envelope"></i> {{ Setting::get('contact_email') }}
                </a>
            @endif
        </div>
    </div>
</footer>

<script>
function showTab(tab){
  const reg = document.getElementById('register');
  const log = document.getElementById('login');
  const regTab = document.getElementById('registerTab');
  const logTab = document.getElementById('loginTab');

  reg.classList.add('hidden');
  log.classList.add('hidden');
  regTab.classList.remove('tab-active');
  logTab.classList.remove('tab-active');

  document.getElementById(tab).classList.remove('hidden');
  document.getElementById(tab+'Tab').classList.add('tab-active');
}

function toggleLoginPassword(){
  const input = document.getElementById('loginPassword');
  const icon = document.getElementById('loginPasswordToggle');
  if(!input || !icon) return;

  if(input.type === 'password'){
    input.type = 'text';
    icon.classList.remove('fa-eye');
    icon.classList.add('fa-eye-slash');
  }else{
    input.type = 'password';
    icon.classList.remove('fa-eye-slash');
    icon.classList.add('fa-eye');
  }
}

function debugFormSubmit(form) {
  console.log('=== FORM SUBMISSION DEBUG ===');
  console.log('Form Action:', form.action);
  console.log('Form Method:', form.method);
  
  const formData = new FormData(form);
  console.log('Form Data:');
  for (let [key, value] of formData.entries()) {
    console.log(`  ${key}: ${key === 'password' ? '***' : value}`);
  }
  
  const email = formData.get('email');
  console.log('Email Input:', email);
  
  // Detect field (only email and mobile)
  let field = 'email';
  if (email && email.includes('@')) {
    field = 'email';
  } else if (email) {
    const cleanMobile = email.replace(/[^0-9]/g, '');
    if (cleanMobile.length === 11 && cleanMobile.startsWith('01')) {
      field = 'mobile';
    }
  }
  
  console.log('Detected Field:', field);
  console.log('Expected Credentials:', { [field]: email, password: '***' });
  
  // Allow form to submit normally
  return true;
}

/* ENSURE FIRST LOAD = LOGIN */
document.addEventListener('DOMContentLoaded', function () {
  showTab('login');
});
</script>

</body>
</html>
