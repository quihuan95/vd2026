<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng Nhập Quản Trị — VDUH 2026</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/vietduc-logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-4 font-sans">

    <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-2xl max-w-md w-full border border-slate-700">
        <div class="text-center mb-8">
            <img src="{{ asset('assets/images/vietduc-logo.png') }}" alt="VDUH Logo" class="h-16 w-auto mx-auto mb-3">
            <h1 class="text-xl font-extrabold text-slate-900 tracking-tight">HỆ THỐNG QUẢN TRỊ CMS</h1>
            <p class="text-xs text-slate-500 mt-1">Hội nghị Khoa học Quốc tế Bệnh viện Việt Đức 2026</p>
        </div>

        @if($errors->any())
        <div class="mb-4 p-3 rounded-lg bg-rose-50 border border-rose-200 text-rose-700 text-xs font-semibold">
            {{ $errors->first() }}
        </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Email Quản Trị Viên</label>
                <input type="email" name="email" value="{{ old('email', 'admin@vduh.org') }}" required class="form-input text-xs sm:text-sm">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Mật Khẩu</label>
                <input type="password" name="password" value="vduh2026@admin" required class="form-input text-xs sm:text-sm">
            </div>

            <div class="flex items-center justify-between text-xs pt-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded text-[#ed680e] focus:ring-[#ed680e]">
                    <span class="text-slate-600">Ghi nhớ đăng nhập</span>
                </label>
            </div>

            <button type="submit" class="w-full py-3 rounded-xl bg-[#ed680e] hover:bg-[#d55b0a] text-white font-bold text-sm shadow-md transition">
                Đăng Nhập CMS →
            </button>
        </form>

        <div class="mt-6 text-center text-xs text-slate-400">
            Mặc định: <code>admin@vduh.org</code> / <code>vduh2026@admin</code>
        </div>
    </div>

</body>
</html>
