<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login • AAP Mining Careers</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center bg-slate-900 relative overflow-hidden">

  <!-- Accent blobs -->
  <div class="absolute -top-40 -left-40 w-96 h-96 bg-[#00A86B]/30 rounded-full blur-3xl"></div>
  <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-[#0077B6]/30 rounded-full blur-3xl"></div>

  <!-- Login Card -->
  <div class="relative w-full max-w-md px-6 py-10 bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl shadow-2xl text-white">

    <!-- Logo -->
    <div class="flex justify-center mb-6">
      <img src="{{ asset('assets/images/logo.jpg') }}" 
           alt="Logo AAP Mining" 
           class="h-16 w-16 object-contain rounded-full shadow-md ring-2 ring-white/30 bg-white">
    </div>

    <!-- Title -->
    <h2 class="text-2xl font-bold text-center tracking-tight">Welcome Back!</h2>
    <p class="mt-1 text-center text-sm text-gray-300">Log in to continue your journey 🚀</p>

    <!-- Session Status -->
    @if (session('status'))
      <div class="mt-4 p-3 bg-[#00A86B]/20 border border-[#00A86B]/40 text-[#00FF7F] rounded-lg text-sm">
        {{ session('status') }}
      </div>
    @endif

    <!-- Form -->
    <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-5">
      @csrf

      <!-- Email -->
      <div>
        <label for="email" class="block text-sm text-gray-200">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username"
               class="block mt-1 w-full text-black rounded-lg border-gray-300 focus:border-[#00A86B] focus:ring-[#00A86B] px-3 py-2">
        @error('email')
          <p class="mt-1 text-red-300 text-sm">{{ $message }}</p>
        @enderror
      </div>

      <!-- Password -->
      <div>
        <label for="password" class="block text-sm text-gray-200">Password</label>
        <input id="password" name="password" type="password" required autocomplete="current-password"
               class="block mt-1 w-full text-black rounded-lg border-gray-300 focus:border-[#0077B6] focus:ring-[#0077B6] px-3 py-2">
        @error('password')
          <p class="mt-1 text-red-300 text-sm">{{ $message }}</p>
        @enderror
      </div>

      <!-- Remember me + Forgot -->
      <div class="flex items-center justify-between text-sm">
        <label for="remember_me" class="flex items-center">
          <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#00A86B] focus:ring-[#00A86B]" name="remember">
          <span class="ml-2 text-gray-200">Remember me</span>
        </label>
        @if (Route::has('password.request'))
          <a href="{{ route('password.request') }}" class="underline hover:text-[#00A86B]">Forgot password?</a>
        @endif
      </div>

      <!-- Button -->
      <button type="submit"
              class="w-full justify-center bg-[#00A86B] hover:bg-[#0077B6] text-white font-semibold py-2 px-4 rounded-lg shadow-lg transition">
        Log in
      </button>
    </form>
  </div>
</body>
</html>
