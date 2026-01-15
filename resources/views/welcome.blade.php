<?php
use App\Models\Setting;
?>

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>{{ Setting::get('site_name', 'Gajaghanta Online') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Google Fonts for Bangla support -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Noto+Sans+Bengali:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @if(Setting::get('favicon'))
        <link rel="icon" href="{{ asset(Setting::get('favicon')) }}">
    @endif

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome (তোমার আইকন কাজ করানোর জন্য এটা লাগবে) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    <style>
        html { scroll-behavior: smooth; }
        
        /* Font styles for different languages */
        .font-en {
            font-family: 'Inter', sans-serif;
        }
        
        .font-bn {
            font-family: 'Noto Sans Bengali', sans-serif;
        }
        
        /* Auto font selection based on language */
        html[lang="bn"] body {
            font-family: 'Noto Sans Bengali', sans-serif;
        }
        
        html[lang="en"] body {
            font-family: 'Inter', sans-serif;
        }
        
        /* Ensure Bangla numbers display correctly */
        html[lang="bn"] {
            font-variant-numeric: bengali;
        }
    </style>
    
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }
    </script>
</head>

<body class="bg-white text-gray-800">

<!-- ================= HEADER ================= -->
<header class="max-w-7xl mx-auto px-4 sm:px-6 py-4 sm:py-5">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-2">
            <a href="{{ route('welcome') }}">@if(Setting::get('logo'))
                <div class="flex items-center gap-2">
                <img src="{{ asset(Setting::get('logo')) }}" alt="{{ Setting::get('site_name', 'Gajaghanta Online') }}" class="w-8 h-8 sm:w-10 sm:h-10 rounded-full">
                 <h1 class="font-bold text-base sm:text-lg">{{ Setting::get('site_name', 'Gajaghanta Online') }}</h1>
                </div>
            @else
                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-indigo-600 rounded-full"></div>
            @endif
           </a>
        </div>

        <!-- Desktop Navigation -->
        <div>     
            <nav class="hidden md:flex gap-6 lg:gap-8 text-sm font-medium mt-4">
                <a href="{{ route('welcome') }}" class="hover:text-indigo-600">{{ __('messages.home') }}</a>
                <a href="#services" class="hover:text-indigo-600">{{ __('messages.services') }}</a>
                <a href="#packages" class="hover:text-indigo-600">{{ __('messages.packages') }}</a>
                <a href="#contact" class="hover:text-indigo-600">{{ __('messages.contact') }}</a>
            </nav>
        </div>

        <div class="flex items-center gap-3">
            <!-- Language Switcher -->
            <div class="relative group">
                <button class="flex items-center gap-1 text-sm text-gray-600 hover:text-indigo-600 transition">
                    <i class="fas fa-globe"></i>
                    <span>{{ app()->getLocale() === 'bn' ? 'বাংলা' : 'English' }}</span>
                    <i class="fas fa-chevron-down text-xs"></i>
                </button>
                <div class="absolute right-0 mt-2 w-32 bg-white border rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                    <a href="{{ route('language.switch', 'en') }}" class="block px-4 py-2 text-sm hover:bg-gray-50 rounded-t-lg">English</a>
                    <a href="{{ route('language.switch', 'bn') }}" class="block px-4 py-2 text-sm hover:bg-gray-50 rounded-b-lg">বাংলা</a>
                </div>
            </div>

            <div>
                <a href="{{ route('login') }}" class="border px-4 py-2 rounded-lg text-sm hover:bg-gray-50 text-center">{{ __('messages.login') }}</a>
            </div>
            
            <!-- Mobile menu button -->
            <button class="md:hidden p-2" onclick="toggleMobileMenu()">
                <i class="fas fa-bars text-gray-600"></i>
            </button>
        </div>
    </div>


    <!-- Mobile Navigation -->
    <nav id="mobileMenu" class="hidden md:hidden flex flex-col gap-4 text-sm font-medium mt-4 pb-4 border-b">
        <a href="{{ route('welcome') }}" class="hover:text-indigo-600" onclick="toggleMobileMenu()">{{ __('messages.home') }}</a>
        <a href="#services" class="hover:text-indigo-600" onclick="toggleMobileMenu()">{{ __('messages.services') }}</a>
        <a href="#packages" class="hover:text-indigo-600" onclick="toggleMobileMenu()">{{ __('messages.packages') }}</a>
        <a href="#contact" class="hover:text-indigo-600" onclick="toggleMobileMenu()">{{ __('messages.contact') }}</a>
        <div class="flex flex-col gap-3 pt-2">
            <a href="{{ route('login') }}" class="border px-4 py-2 rounded-lg text-sm hover:bg-gray-50 text-center">{{ __('messages.login') }}</a>
            <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700 text-center">{{ __('messages.get_started') }}</a>
        </div>
    </nav>
</header>

<!-- ================= HERO ================= -->
<section id="home" class="max-w-7xl mx-auto px-4 sm:px-6 grid md:grid-cols-2 gap-8 md:gap-12 items-center py-12 md:py-20">
    <div>
        <span class="inline-block bg-indigo-100 text-indigo-600 px-3 sm:px-4 py-1 rounded-full text-xs mb-4">
            ⚡ {{ Setting::get('hero_badge', __('messages.hero_badge')) }}
        </span>

        <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold leading-tight">
            {{ Setting::get('hero_title_line1', __('messages.hero_title_line1')) }} <br>
            <span class="text-indigo-600">{{ Setting::get('hero_title_line2', __('messages.hero_title_line2')) }}</span>
        </h2>

        <p class="mt-4 sm:mt-5 text-gray-600 text-sm sm:text-base">
            {{ Setting::get('hero_description', __('messages.hero_description')) }}
        </p>

        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 mt-6 sm:mt-8">
            <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl hover:bg-indigo-700 transition text-center">
                {{ __('messages.get_started_now') }}
            </a>
            <a href="#packages" class="border px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl hover:bg-gray-50 transition text-center">
                {{ __('messages.view_packages') }}
            </a>
        </div>

        <div class="grid grid-cols-3 gap-4 sm:gap-6 mt-8 sm:mt-12">
            <div class="text-center">
                <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-indigo-600">{{ Setting::get('stat_max_speed', __('messages.stat_max_speed')) }}</h3>
                <p class="text-xs">{{ Setting::get('stat_max_speed_label', __('messages.stat_max_speed_label')) }}</p>
            </div>
            <div class="text-center">
                <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-indigo-600">{{ Setting::get('stat_uptime', __('messages.stat_uptime')) }}</h3>
                <p class="text-xs">{{ Setting::get('stat_uptime_label', __('messages.stat_uptime_label')) }}</p>
            </div>
            <div class="text-center">
                <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-indigo-600">{{ Setting::get('stat_support', __('messages.stat_support')) }}</h3>
                <p class="text-xs">{{ Setting::get('stat_support_label', __('messages.stat_support_label')) }}</p>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-br from-indigo-100 to-purple-200 rounded-2xl sm:rounded-3xl h-48 sm:h-64 md:h-96 flex items-center justify-center order-first md:order-last">
        <img src="{{ asset('uploads/gajaghanta Online.jpg') }}" alt="Hero Image" class="w-full h-full object-cover rounded-2xl sm:rounded-3xl">
    </div>
</section>

<!-- ================= SERVICES ================= -->
<section id="services" class="bg-gray-50 py-20">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <p class="text-indigo-600 text-sm">{{ Setting::get('services_subtitle', __('messages.services_subtitle')) }}</p>
        <h2 class="text-3xl font-bold mt-2">{{ Setting::get('services_title', __('messages.services_title')) }}</h2>
        <p class="text-gray-500 mt-3">
            {{ Setting::get('services_description', __('messages.services_description')) }}
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mt-12">
            @foreach ([
                [__('messages.service_fiber_internet'), __('messages.service_fiber_desc'), 'fa-wifi'],
                [__('messages.service_corporate'), __('messages.service_corporate_desc'), 'fa-building'],
                [__('messages.service_hotspot'), __('messages.service_hotspot_desc'), 'fa-hotspot'],
                [__('messages.service_support'), __('messages.service_support_desc'), 'fa-headset']
            ] as $service)
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-indigo-100 rounded-xl mb-4 flex items-center justify-center">
                        <i class="fas {{ $service[2] }} text-indigo-600"></i>
                    </div>
                    <h3 class="font-semibold">{{ $service[0] }}</h3>
                    <p class="text-sm text-gray-500 mt-2">{{ $service[1] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ================= PACKAGES (ADMIN DATA) ================= -->
<section id="packages" class="py-20">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <p class="text-indigo-600 text-sm">{{ Setting::get('packages_subtitle', __('messages.packages_subtitle')) }}</p>
        <h2 class="text-3xl font-bold mt-2">{{ Setting::get('packages_title', __('messages.packages_title')) }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 mt-12">
            @forelse($packages ?? [] as $pkg)
                <div class="border rounded-2xl p-8 hover:shadow-xl transition text-left bg-white">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="font-semibold text-lg leading-tight">
                                {{ $pkg->name ?? 'Package' }}
                            </h3>
                            <div class="mt-2 flex flex-wrap gap-2">
                                @if(!empty($pkg->type_label))
                                    <span class="text-xs px-2.5 py-1 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-100">
                                        {{ $pkg->type_label }}
                                    </span>
                                @endif
                                @if($loop->first)
                                    <span class="text-xs px-2.5 py-1 rounded-full bg-indigo-600 text-white">{{ __('messages.popular') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="text-right">
                            <div class="text-2xl font-bold text-indigo-600">
                                ৳{{ number_format((float)($pkg->price ?? 0)) }}
                            </div>
                            <div class="text-xs text-gray-500">{{ __('messages.per_month') }}</div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <div class="text-3xl font-bold text-gray-900">
                            {{ $pkg->speed_label ?? ((int)($pkg->download_speed ?? 0)).'Mbps/'.((int)($pkg->upload_speed ?? 0)).'Mbps' }}
                        </div>
                        <div class="text-sm text-gray-500 mt-1">{{ __('messages.download_upload') }}</div>
                    </div>

                    @if(!empty($pkg->description))
                        <p class="text-sm text-gray-600 mt-4">{{ $pkg->description }}</p>
                    @endif

                    <ul class="mt-6 space-y-2 text-sm text-gray-700">
                        <li class="flex items-center gap-2">
                            <span class="text-indigo-600"><i class="fas fa-download"></i></span>
                            <span>{{ __('messages.download') }}: {{ (int)($pkg->download_speed ?? 0) }} Mbps</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-indigo-600"><i class="fas fa-upload"></i></span>
                            <span>{{ __('messages.upload') }}: {{ (int)($pkg->upload_speed ?? 0) }} Mbps</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-indigo-600"><i class="fas fa-calendar-day"></i></span>
                            <span>{{ __('messages.validity') }}: {{ (int)($pkg->validity_days ?? 30) }} {{ __('messages.days') }}</span>
                        </li>
                    </ul>

                    <a href="{{ route('login') }}"
                       class="mt-6 w-full inline-block text-center bg-indigo-600 text-white py-2.5 rounded-xl hover:bg-indigo-700 transition">
                        {{ __('messages.get_started') }}
                    </a>
                </div>
            @empty
                <div class="md:col-span-3 bg-gray-50 border rounded-xl p-10 text-gray-600">
                    {{ __('messages.no_packages') }}
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ================= CONTACT ================= -->
<section id="contact" class="py-20">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <p class="text-indigo-600 text-sm">{{ Setting::get('contact_subtitle', __('messages.contact_subtitle')) }}</p>
        <h2 class="text-3xl font-bold mt-2">{{ Setting::get('contact_title', __('messages.contact_title')) }}</h2>
        <p class="text-gray-500 mt-3">{{ Setting::get('contact_description', __('messages.contact_description')) }}</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left">
            <div class="border rounded-xl p-6">
                <p class="font-semibold">{{ Setting::get('contact_address_title', __('messages.address')) }}</p>
                <p class="text-sm text-gray-600 mt-2">{{ Setting::get('contact_address', 'Dhaka, Bangladesh') }}</p>
            </div>
            <div class="border rounded-xl p-6">
                <p class="font-semibold">{{ __('messages.email') }}</p>
                <p class="text-sm text-gray-600 mt-2">
                    {{ Setting::get('contact_email', 'support@' . str_replace(' ', '', strtolower(Setting::get('site_name', 'Gajaghanta Online'))) . '.com') }}
                </p>
            </div>
            <div class="border rounded-xl p-6">
                <p class="font-semibold">{{ __('messages.phone') }}</p>
                <p class="text-sm text-gray-600 mt-2">{{ Setting::get('contact_phone', '+880 1234 567890') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- ================= CTA ================= -->
<section class="bg-gradient-to-r from-indigo-600 to-purple-600 py-20 text-white text-center">
    <h2 class="text-3xl font-bold">{{ Setting::get('cta_title', __('messages.cta_title')) }}</h2>
    <p class="mt-3">{{ Setting::get('cta_description', __('messages.cta_description')) }}</p>
    <a href="{{ route('register') }}" class="mt-6 bg-white text-indigo-600 px-6 py-3 rounded-xl inline-block hover:bg-gray-100 transition">
        {{ Setting::get('cta_button_text', __('messages.apply_for_connection')) }}
    </a>
</section>

<!-- ================= FOOTER ================= -->
<footer class="bg-gray-900 text-gray-300 py-16">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-10">
        <div>
            <h3 class="font-bold text-white">{{ Setting::get('site_name', 'Gajaghanta Online') }}</h3>
            <p class="text-sm mt-3">
                {{ Setting::get('footer_description', __('messages.footer_description')) }}
            </p>
        </div>

        <div>
            <h4 class="font-semibold text-white mb-3">{{ __('messages.quick_links') }}</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('home') }}" class="hover:text-white">{{ __('messages.home') }}</a></li>
                <li><a href="#services" class="hover:text-white">{{ __('messages.services') }}</a></li>
                <li><a href="#packages" class="hover:text-white">{{ __('messages.packages') }}</a></li>
                <li><a href="{{ route('login') }}" class="hover:text-white">{{ __('messages.login') }}</a></li>
            </ul>
        </div>

        <div>
            <h4 class="font-semibold text-white mb-3">{{ __('messages.footer_services') }}</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="#services" class="hover:text-white">{{ __('messages.home_internet') }}</a></li>
                <li><a href="#services" class="hover:text-white">{{ __('messages.business_solutions') }}</a></li>
                <li><a href="#services" class="hover:text-white">{{ __('messages.wifi_hotspot') }}</a></li>
                <li><a href="#services" class="hover:text-white">{{ __('messages.support_24_7') }}</a></li>
            </ul>
        </div>

        <div>
            <h4 class="font-semibold text-white mb-3">{{ __('messages.footer_contact') }}</h4>
            <p class="text-sm">{{ Setting::get('footer_address', 'Dhaka, Bangladesh') }}</p>
            <p class="text-sm">
                {{ Setting::get('footer_email', 'support@' . str_replace(' ', '', strtolower(Setting::get('site_name', 'Gajaghanta Online'))) . '.com') }}
            </p>
            <p class="text-sm">{{ Setting::get('footer_phone', '+880 1234 567890') }}</p>
        </div>
    </div>

    <p class="text-center text-xs mt-10">
        © {{ date('Y') }} {{ Setting::get('site_name', 'Gajaghanta Online') }}. {{ __('messages.all_rights_reserved') }}.
    </p>
</footer>

</body>
</html>
