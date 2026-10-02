<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - {{ config('puskesmas.name') }}</title>
  
</head>
<body class="flex min-h-screen items-center justify-center bg-slate-100 px-4">
    <form method="POST" action="{{ route('login.attempt') }}" class="w-full max-w-sm space-y-4 rounded-2xl bg-white p-8 shadow">
        @csrf
        <h1 class="text-xl font-bold text-slate-900">Login Admin</h1>
        <p class="text-sm text-slate-500">{{ config('puskesmas.name') }}</p>

        <div>
            <label class="mb-1 block text-sm font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-emerald-500 focus:outline-none">
            @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium">Password</label>
            <input type="password" name="password" required
                   class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-emerald-500 focus:outline-none">
        </div>
        <label class="flex items-center gap-2 text-sm text-slate-600">
            <input type="checkbox" name="remember" value="1"> Ingat saya
        </label>
        <button class="w-full rounded-lg bg-emerald-600 py-2 font-semibold text-white hover:bg-emerald-700">Masuk</button>
    </form>
</body>
</html>