<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Dashboard') — VDUH 2026 CMS</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/vietduc-logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --admin-primary: #ed680e;
            --admin-dark: #1e293b;
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 min-h-screen flex flex-col font-sans" x-data="{ sidebar: false }">

    <!-- Top Admin Header -->
    <header class="bg-slate-900 text-white sticky top-0 z-40 border-b border-slate-800 shadow-md">
        <div class="px-4 sm:px-6 flex items-center justify-between h-16">
            <div class="flex items-center gap-3">
                <button @click="sidebar = !sidebar" class="md:hidden p-2 rounded text-slate-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5">
                    <img src="{{ asset('assets/images/vietduc-logo.png') }}" alt="VDUH" class="h-8 w-auto">
                    <div>
                        <span class="font-extrabold text-sm tracking-wide text-white">VDUH 2026 CMS</span>
                        <span class="text-[10px] bg-[#ed680e] text-white font-bold px-1.5 py-0.5 rounded ml-1.5">ADMIN</span>
                    </div>
                </a>
            </div>

            <div class="flex items-center gap-4 text-xs">
                <a href="{{ route('conference.home', ['locale' => 'vi']) }}" target="_blank" class="hidden sm:inline-flex items-center gap-1 text-slate-400 hover:text-white">
                    <span>Xem Website Công Khai</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                </a>
                <span class="text-slate-500 hidden sm:inline">|</span>
                <span class="text-slate-300 font-semibold">{{ Auth::user()->name ?? 'Administrator' }}</span>
                <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-2.5 py-1.5 rounded bg-slate-800 hover:bg-rose-900 text-rose-300 transition font-bold">
                        Đăng xuất
                    </button>
                </form>
            </div>
        </div>
    </header>

    <div class="flex-grow flex">
        <!-- Sidebar Navigation -->
        <aside :class="sidebar ? 'block' : 'hidden md:block'" class="w-64 bg-slate-900 text-slate-300 shrink-0 border-r border-slate-800 p-4 space-y-6">
            <div class="space-y-1 text-xs">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-bold transition {{ request()->routeIs('admin.dashboard') ? 'bg-[#ed680e] text-white shadow-sm' : 'hover:bg-slate-800 hover:text-white' }}">
                    <span>📊</span>
                    <span>Bảng Điều Khiển</span>
                </a>
                <a href="{{ route('admin.registrations') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-bold transition {{ request()->routeIs('admin.registrations*') ? 'bg-[#ed680e] text-white shadow-sm' : 'hover:bg-slate-800 hover:text-white' }}">
                    <span>👥</span>
                    <span>Đại Biểu Đăng Ký</span>
                </a>
                <a href="{{ route('admin.abstracts') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-bold transition {{ request()->routeIs('admin.abstracts*') ? 'bg-[#ed680e] text-white shadow-sm' : 'hover:bg-slate-800 hover:text-white' }}">
                    <span>📝</span>
                    <span>Báo Cáo Tóm Tắt (Abstracts)</span>
                </a>
                <a href="{{ route('admin.speakers') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-bold transition {{ request()->routeIs('admin.speakers*') ? 'bg-[#ed680e] text-white shadow-sm' : 'hover:bg-slate-800 hover:text-white' }}">
                    <span>🎙️</span>
                    <span>Quản Lý Diễn Giả</span>
                </a>
                <a href="{{ route('admin.checkin') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-bold transition {{ request()->routeIs('admin.checkin') ? 'bg-emerald-600 text-white shadow-sm' : 'hover:bg-slate-800 hover:text-white' }}">
                    <span>📱</span>
                    <span>Quét QR Check-in Tại Chỗ</span>
                </a>
                <a href="{{ route('admin.settings') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-bold transition {{ request()->routeIs('admin.settings*') ? 'bg-[#ed680e] text-white shadow-sm' : 'hover:bg-slate-800 hover:text-white' }}">
                    <span>⚙️</span>
                    <span>Cấu Hình Hội Nghị</span>
                </a>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-grow p-6 md:p-8 max-w-7xl mx-auto w-full">
            @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-100 border border-emerald-300 text-emerald-900 text-xs font-bold flex items-center justify-between">
                <span>✓ {{ session('success') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-rose-100 border border-rose-300 text-rose-900 text-xs font-bold">
                @foreach($errors->all() as $err)
                    <div>⚠️ {{ $err }}</div>
                @endforeach
            </div>
            @endif

            @yield('admin_content')
        </main>
    </div>

</body>
</html>
