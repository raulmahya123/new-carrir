<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register • AAP Mining Careers</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center bg-slate-900 relative overflow-hidden">

  <!-- Accent blobs -->
  <div class="absolute -top-40 -left-40 w-96 h-96 bg-[#00A86B]/30 rounded-full blur-3xl"></div>
  <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-[#0077B6]/30 rounded-full blur-3xl"></div>

  <!-- Register Card -->
  <div class="relative w-full max-w-md px-6 py-10 bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl shadow-2xl text-white">

    <!-- Logo -->
    <div class="flex justify-center mb-6">
      <img src="{{ asset('assets/images/logo.jpg') }}" 
           alt="Logo AAP Mining" 
           class="h-16 w-16 object-contain rounded-full shadow-md ring-2 ring-white/30 bg-white">
    </div>

    <!-- Title -->
    <h2 class="text-2xl font-bold text-center tracking-tight">Create an Account</h2>
    <p class="mt-1 text-center text-sm text-gray-300">Join AAP Mining Careers 🚀</p>

    <!-- Form -->
    <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-5">
      @csrf

      <!-- Name -->
      <div>
        <label for="name" class="block text-sm text-gray-200">Name</label>
        <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name"
               class="block mt-1 w-full text-black rounded-lg border-gray-300 focus:border-[#00A86B] focus:ring-[#00A86B] px-3 py-2">
        @error('name')
          <p class="mt-1 text-red-300 text-sm">{{ $message }}</p>
        @enderror
      </div>

      <!-- Email -->
      <div>
        <label for="email" class="block text-sm text-gray-200">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="username"
               class="block mt-1 w-full text-black rounded-lg border-gray-300 focus:border-[#0077B6] focus:ring-[#0077B6] px-3 py-2">
        @error('email')
          <p class="mt-1 text-red-300 text-sm">{{ $message }}</p>
        @enderror
      </div>

      <!-- Password -->
      <div>
        <label for="password" class="block text-sm text-gray-200">Password</label>
        <input id="password" name="password" type="password" required autocomplete="new-password"
               class="block mt-1 w-full text-black rounded-lg border-gray-300 focus:border-[#00A86B] focus:ring-[#00A86B] px-3 py-2">
        @error('password')
          <p class="mt-1 text-red-300 text-sm">{{ $message }}</p>
        @enderror
      </div>

      <!-- Confirm Password -->
      <div>
        <label for="password_confirmation" class="block text-sm text-gray-200">Confirm Password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
               class="block mt-1 w-full text-black rounded-lg border-gray-300 focus:border-[#0077B6] focus:ring-[#0077B6] px-3 py-2">
        @error('password_confirmation')
          <p class="mt-1 text-red-300 text-sm">{{ $message }}</p>
        @enderror
      </div>

      <!-- Action -->
      <div class="flex items-center justify-between mt-6">
        <a href="{{ route('login') }}" class="underline text-sm text-gray-300 hover:text-[#00A86B]">
          Already registered?
        </a>
        <button type="submit"
                class="px-5 py-2 rounded-lg bg-[#00A86B] hover:bg-[#0077B6] text-white font-semibold shadow-lg transition">
          Register
        </button>
      </div>
    </form>
  </div>
</body>
</html>
