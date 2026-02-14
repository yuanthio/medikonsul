@extends('layouts.booking')

@section('title', 'MediKonsul')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-primary-50 to-white rounded-2xl p-8 mb-8 shadow-traveloka">
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-white rounded-2xl mb-6 shadow-lg">
                <img src="{{ asset('images/MediKonsul.png') }}" alt="MediKonsul Logo" class="w-20 h-20 object-contain">
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-4">MediKonsul</h1>
            <p class="text-xl text-secondary-600 max-w-2xl mx-auto mb-6">Konsultasi profesional dengan tenaga medis berpengalaman untuk kesehatan terbaik Anda</p>
            
            <!-- Quick Actions -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="/check-booking" class="inline-flex items-center px-8 py-3 bg-white border-2 border-primary-200 hover:border-primary-300 text-primary-600 hover:text-primary-700 font-semibold rounded-xl transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Cek Booking
                </a>
            </div>
        </div>

        <!-- Service Features -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-10">
            <div class="bg-white rounded-xl p-6 text-center shadow-sm border border-secondary-100">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Dokter Berpengalaman</h3>
                <p class="text-sm text-secondary-600">Tenaga medis profesional dengan sertifikasi</p>
            </div>

            <div class="bg-white rounded-xl p-6 text-center shadow-sm border border-secondary-100">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">{{ config('booking.slot_duration', 30) }} Menit Konsultasi</h3>
                <p class="text-sm text-secondary-600">Waktu cukup untuk diskusi mendalam</p>
            </div>

            <div class="bg-white rounded-xl p-6 text-center shadow-sm border border-secondary-100">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Harga Terjangkau</h3>
                <p class="text-sm text-secondary-600">Konsultasi berkualitas dengan harga bersaing</p>
            </div>

            <div class="bg-white rounded-xl p-6 text-center shadow-sm border border-secondary-100">
                <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Fasilitas Lengkap</h3>
                <p class="text-sm text-secondary-600">Peralatan medis modern dan steril</p>
            </div>
        </div>
    </div>

    <!-- Main Booking Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Calendar Section -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-traveloka-lg overflow-hidden">
                <!-- Calendar Header -->
                <div class="bg-gradient-to-r from-primary-500 to-primary-600 px-8 py-6">
                    <div class="flex items-center justify-between mb-4">
                        <button id="prevMonth" class="p-3 hover:bg-white/20 rounded-xl transition-all duration-200 group">
                            <svg class="w-5 h-5 text-white group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <div class="text-center">
                            <h3 id="currentMonth" class="text-xl font-semibold text-white"></h3>
                            <p id="currentYear" class="text-sm text-primary-100"></p>
                        </div>
                        <button id="nextMonth" class="p-3 hover:bg-white/20 rounded-xl transition-all duration-200 group">
                            <svg class="w-5 h-5 text-white group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Calendar Grid -->
                <div class="p-8">
                    <div class="grid grid-cols-7 gap-3 mb-6">
                        <div class="text-center text-sm font-semibold text-secondary-500 py-3">Min</div>
                        <div class="text-center text-sm font-semibold text-secondary-500 py-3">Sen</div>
                        <div class="text-center text-sm font-semibold text-secondary-500 py-3">Sel</div>
                        <div class="text-center text-sm font-semibold text-secondary-500 py-3">Rab</div>
                        <div class="text-center text-sm font-semibold text-secondary-500 py-3">Kam</div>
                        <div class="text-center text-sm font-semibold text-secondary-500 py-3">Jum</div>
                        <div class="text-center text-sm font-semibold text-secondary-500 py-3">Sab</div>
                    </div>
                    <div id="calendarDays" class="grid grid-cols-7 gap-3">
                        <!-- Calendar days will be generated here -->
                    </div>
                </div>
            </div>
            
            <!-- Selected Date Display -->
            <div class="mt-6 bg-gradient-to-r from-primary-50 to-blue-50 rounded-2xl p-6 border border-primary-200">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-primary-500 rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-primary-900 mb-1">Tanggal Dipilih</p>
                        <p id="selectedDateDisplay" class="text-lg font-medium text-primary-700">Belum dipilih</p>
                    </div>
                </div>
            </div>
            
            <!-- Hidden date input for form submission -->
            <input type="hidden" id="date" name="booking_date">
        </div>

        <!-- Right Sidebar -->
        <div class="space-y-6">
            <!-- Time Slots Section -->
            <div class="bg-white rounded-2xl shadow-traveloka-lg p-6">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-2 flex items-center">
                        <svg class="w-5 h-5 text-primary-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Pilih Waktu
                    </h2>
                    <p class="text-sm text-secondary-600 mb-3">Pilih waktu yang tersedia</p>
                    
                    <!-- Keterangan Warna -->
                    <div class="flex flex-wrap gap-4 text-xs">
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4 rounded bg-linear-to-br from-white to-gray-50 border-2 border-gray-300"></div>
                            <span class="text-gray-600">Tersedia</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4 rounded bg-red-100 border-2 border-red-300 opacity-70"></div>
                            <span class="text-red-600">Di Booking</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4 rounded bg-gray-200 border-2 border-gray-300 opacity-50"></div>
                            <span class="text-gray-500">Sudah Lewat</span>
                        </div>
                    </div>
                </div>
                
                <div id="slots" class="calendly-time-slots">
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto mb-4 text-secondary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-secondary-500 text-lg mb-2">Pilih tanggal terlebih dahulu</p>
                        <p class="text-secondary-400 text-sm">Waktu tersedia akan muncul</p>
                    </div>
                </div>
            </div>

            <!-- Booking Form -->
            <div class="bg-white rounded-2xl shadow-traveloka-lg p-6">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-2 flex items-center">
                        <svg class="w-5 h-5 text-primary-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Data Pemesan
                    </h2>
                    <p class="text-sm text-secondary-600">Lengkapi data diri Anda</p>
                </div>

                <form id="bookingForm" method="POST" action="/book" class="space-y-5">
                    @csrf
                    <input type="hidden" name="booking_date" id="booking_date">
                    <input type="hidden" name="booking_time" id="booking_time">

                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Lengkap
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <input type="text" name="name" id="name" required
                                class="w-full pl-10 pr-4 py-3 border border-secondary-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200"
                                placeholder="Masukkan nama lengkap">
                        </div>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nomor HP
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <input type="text" name="phone" id="phone" required
                                class="w-full pl-10 pr-4 py-3 border border-secondary-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200"
                                placeholder="0812-3456-7890">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <input type="email" name="email" id="email" required
                                class="w-full pl-10 pr-12 py-3 border border-secondary-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200"
                                placeholder="email@example.com">
                            <div id="emailValidationIcon" class="absolute inset-y-0 right-0 flex items-center pr-3 hidden">
                                <!-- Icon will be inserted here -->
                            </div>
                        </div>
                        <p id="emailValidationMessage" class="mt-2 text-sm hidden"></p>
                    </div>

                    <div class="pt-4">
                        <button type="submit" id="submitBtn" disabled
                            class="group relative w-full flex justify-center items-center py-4 px-6 border border-transparent text-base font-semibold rounded-xl text-white bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 disabled:from-secondary-300 disabled:to-secondary-400 disabled:cursor-not-allowed transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98]">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span id="btnText">Booking Sekarang</span>
                            <div id="btnSpinner" class="spinner hidden ml-2"></div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.spinner {
    border: 2px solid #f3f3f3;
    border-top: 2px solid #ffffff;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.loading {
    pointer-events: none;
    opacity: 0.7;
}

/* Traveloka-style Calendar */
.calendar-day {
    aspect-ratio: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    font-size: 15px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    border: 2px solid transparent;
    color: #374151;
    position: relative;
    overflow: hidden;
}

.calendar-day::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, transparent, rgba(14, 165, 233, 0.05));
    opacity: 0;
    transition: opacity 0.2s ease;
}

.calendar-day:hover:not(.disabled):not(.selected) {
    background: linear-gradient(135deg, #f8fafc, #f1f5f9);
    border-color: #e2e8f0;
    color: #0284c7;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.calendar-day:hover:not(.disabled):not(.selected)::before {
    opacity: 1;
}

.calendar-day.selected {
    background: linear-gradient(135deg, #0284c7, #0369a1);
    color: white;
    border-color: #0284c7;
    font-weight: 600;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(2, 132, 199, 0.3);
}

.calendar-day.selected::after {
    content: '';
    position: absolute;
    top: 4px;
    right: 4px;
    width: 8px;
    height: 8px;
    background: white;
    border-radius: 50%;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.calendar-day.disabled {
    color: #cbd5e1;
    cursor: not-allowed;
    background: #f8fafc;
    border-color: #f1f5f9;
    opacity: 0.6;
}

.calendar-day.today {
    border-color: #0284c7;
    color: #0284c7;
    font-weight: 600;
    background: rgba(14, 165, 233, 0.05);
}

.calendar-day.today:not(.selected) {
    border-width: 2px;
    background: linear-gradient(135deg, rgba(14, 165, 233, 0.1), rgba(14, 165, 233, 0.05));
}

/* Traveloka-style Time Slots */
.calendly-time-slots {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
    gap: 12px;
    padding: 0;
}

.time-slot {
    padding: 18px 16px;
    border-radius: 16px;
    font-size: 15px;
    font-weight: 600;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 2px solid #e2e8f0;
    background: linear-gradient(135deg, #ffffff, #f8fafc);
    color: #475569;
    position: relative;
    overflow: hidden;
}

.time-slot::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, transparent, rgba(14, 165, 233, 0.05));
    opacity: 0;
    transition: opacity 0.3s ease;
}

.time-slot:hover:not(.disabled):not(.selected) {
    border-color: #0ea5e9;
    background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
    color: #0284c7;
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 8px 25px rgba(14, 165, 233, 0.15);
}

.time-slot:hover:not(.disabled):not(.selected)::before {
    opacity: 1;
}

.time-slot.selected {
    background: linear-gradient(135deg, #0284c7, #0369a1);
    color: white;
    border-color: #0284c7;
    font-weight: 700;
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 12px 35px rgba(2, 132, 199, 0.25);
}

.time-slot.selected::after {
    content: '✓';
    position: absolute;
    top: 4px;
    right: 8px;
    font-size: 12px;
    font-weight: bold;
    color: white;
}

.time-slot.disabled {
    background: linear-gradient(135deg, #f8fafc, #f1f5f9);
    color: #94a3b8;
    cursor: not-allowed;
    border-color: #e2e8f0;
    opacity: 0.5;
    transform: none;
}

.time-slot.disabled:hover {
    transform: none;
    box-shadow: none;
}

.time-slot.booked {
    background: linear-gradient(135deg, #fef2f2, #fee2e2);
    color: #dc2626;
    border-color: #fca5a5;
    opacity: 0.7;
}

.time-slot.booked:hover {
    transform: none;
    box-shadow: none;
    background: linear-gradient(135deg, #fef2f2, #fee2e2);
}

/* Clean Animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(8px); }
    to { opacity: 1; transform: translateY(0); }
}

.calendar-day, .time-slot {
    animation: fadeIn 0.3s ease forwards;
}

/* Enhanced Loading states */
.loading-dots {
    display: inline-flex;
    gap: 6px;
    align-items: center;
}

.loading-dots span {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: linear-gradient(135deg, #0ea5e9, #0284c7);
    animation: bounce 1.4s infinite ease-in-out both;
    box-shadow: 0 2px 8px rgba(14, 165, 233, 0.3);
}

.loading-dots span:nth-child(1) { animation-delay: -0.32s; }
.loading-dots span:nth-child(2) { animation-delay: -0.16s; }

@keyframes bounce {
    0%, 80%, 100% { 
        transform: scale(0.8) translateY(0);
        opacity: 0.5;
    }
    40% { 
        transform: scale(1.2) translateY(-10px);
        opacity: 1;
    }
}

/* Enhanced spinner */
.spinner {
    border: 3px solid rgba(255, 255, 255, 0.2);
    border-top: 3px solid #ffffff;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    animation: spin 1s cubic-bezier(0.68, -0.55, 0.265, 1.55) infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Enhanced Responsive improvements */
@media (max-width: 1024px) {
    .calendly-time-slots {
        grid-template-columns: repeat(auto-fit, minmax(110px, 1fr));
        gap: 10px;
    }
    
    .time-slot {
        padding: 14px 12px;
        font-size: 14px;
    }
}

@media (max-width: 640px) {
    .calendly-time-slots {
        grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        gap: 8px;
    }
    
    .time-slot {
        padding: 12px 8px;
        font-size: 13px;
    }
    
    .calendar-day {
        font-size: 14px;
        border-radius: 8px;
    }
    
    .calendar-day:hover:not(.disabled):not(.selected) {
        transform: translateY(-1px);
    }
    
    .calendar-day.selected {
        transform: translateY(-1px);
    }
    
    .time-slot:hover:not(.disabled):not(.selected) {
        transform: translateY(-2px) scale(1.01);
    }
    
    .time-slot.selected {
        transform: translateY(-2px) scale(1.01);
    }
}
</style>

<script>
// Calendar and Time Slot Management
let currentDate = new Date();
let selectedDate = null;
let selectedTime = null;
let isEmailValid = false;

// DOM Elements
const calendarDays = document.getElementById('calendarDays');
const currentMonth = document.getElementById('currentMonth');
const currentYear = document.getElementById('currentYear');
const selectedDateDisplay = document.getElementById('selectedDateDisplay');
const dateInput = document.getElementById('date');
const slotsDiv = document.getElementById('slots');
const bookingForm = document.getElementById('bookingForm');
const submitBtn = document.getElementById('submitBtn');
const btnText = document.getElementById('btnText');
const btnSpinner = document.getElementById('btnSpinner');
const emailInput = document.getElementById('email');
const emailValidationIcon = document.getElementById('emailValidationIcon');
const emailValidationMessage = document.getElementById('emailValidationMessage');

// Calendar functionality
function initCalendar() {
    renderCalendar();
    setupCalendarNavigation();
}

function renderCalendar() {
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();
    
    // Update header
    currentMonth.textContent = getMonthName(month);
    currentYear.textContent = year;
    
    // Clear calendar days
    calendarDays.innerHTML = '';
    
    // Get first day of month and number of days
    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const today = new Date();
    
    // Add empty cells for days before month starts
    for (let i = 0; i < firstDay; i++) {
        const emptyDay = document.createElement('div');
        calendarDays.appendChild(emptyDay);
    }
    
    // Add days of month
    for (let day = 1; day <= daysInMonth; day++) {
        const dayElement = document.createElement('div');
        dayElement.className = 'calendar-day';
        dayElement.textContent = day;
        
        const currentDateObj = new Date(year, month, day);
        const dateStr = formatDateForInput(currentDateObj);
        
        // Disable past dates
        if (currentDateObj < today.setHours(0, 0, 0, 0)) {
            dayElement.classList.add('disabled');
        } else {
            dayElement.addEventListener('click', () => selectDate(currentDateObj, dayElement));
            
            // Highlight today
            if (currentDateObj.toDateString() === today.toDateString()) {
                dayElement.classList.add('today');
            }
        }
        
        calendarDays.appendChild(dayElement);
    }
}

function setupCalendarNavigation() {
    document.getElementById('prevMonth').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });
    
    document.getElementById('nextMonth').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });
}

function selectDate(date, element) {
    // Remove previous selection
    document.querySelectorAll('.calendar-day.selected').forEach(el => {
        el.classList.remove('selected');
    });
    
    // Add selection to clicked date
    element.classList.add('selected');
    selectedDate = date;
    
    // Update hidden input and display
    dateInput.value = formatDateForInput(date);
    selectedDateDisplay.textContent = formatDateDisplay(date);
    document.getElementById('booking_date').value = formatDateForInput(date);
    
    // Load time slots for selected date
    loadTimeSlots(date);
}

async function loadTimeSlots(date) {
    const dateStr = formatDateForInput(date);
    
    // Show loading state
    slotsDiv.innerHTML = `
        <div class="col-span-full text-center text-gray-500 py-8">
            <div class="loading-dots justify-center mb-3">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <p>Memuat jam tersedia...</p>
        </div>
    `;
    
    selectedTime = null;
    updateSubmitButton();
    
    try {
        const res = await fetch(`/slots?date=${dateStr}`);
        const data = await res.json();
        
        slotsDiv.innerHTML = '';
        
        if (data.slots.length === 0) {
            slotsDiv.innerHTML = `
                <div class="col-span-full text-center text-gray-500 py-8">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p>Tidak ada slot tersedia</p>
                </div>
            `;
            return;
        }
        
        data.slots.forEach((time, index) => {
            const timeSlot = document.createElement('button');
            timeSlot.type = 'button';
            timeSlot.className = 'time-slot';
            timeSlot.style.animationDelay = `${index * 0.05}s`;
            
            if (data.booked.includes(time)) {
                timeSlot.classList.add('disabled', 'booked');
                timeSlot.disabled = true;
                timeSlot.title = 'Sudah di booking';
                timeSlot.textContent = time;
            } else {
                // Check if time slot is in the past for today
                const selectedDateStr = formatDateForInput(selectedDate);
                
                if (selectedDateStr === data.today && time <= data.current_time) {
                    timeSlot.classList.add('disabled');
                    timeSlot.disabled = true;
                    timeSlot.title = 'Waktu sudah lewat';
                    timeSlot.textContent = time;
                } else {
                    timeSlot.textContent = time;
                    timeSlot.addEventListener('click', () => selectTimeSlot(time, timeSlot));
                }
            }
            
            slotsDiv.appendChild(timeSlot);
        });
        
    } catch (error) {
        slotsDiv.innerHTML = `
            <div class="col-span-full text-center text-red-500 py-8">
                <svg class="w-12 h-12 mx-auto mb-3 text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p>Terjadi kesalahan, silakan coba lagi</p>
            </div>
        `;
    }
}

function selectTimeSlot(time, element) {
    // Remove previous selection
    document.querySelectorAll('.time-slot.selected').forEach(el => {
        el.classList.remove('selected');
    });
    
    // Add selection to clicked time slot
    element.classList.add('selected');
    selectedTime = time;
    document.getElementById('booking_time').value = time;
    
    updateSubmitButton();
}

// Email validation function
function validateEmail(email) {
    const legitimateDomains = [
        'gmail.com', 'yahoo.com', 'outlook.com', 'hotmail.com', 'live.com',
        'icloud.com', 'aol.com', 'protonmail.com', 'mail.com', 'gmx.com',
        'yandex.com', 'rocketmail.com', 'ymail.com'
    ];
    
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    
    if (!emailRegex.test(email)) {
        return false;
    }
    
    const domain = email.split('@')[1].toLowerCase();
    return legitimateDomains.includes(domain);
}

// Email validation UI update
function updateEmailValidation(isValid, email) {
    const inputElement = document.getElementById('email');
    
    if (email === '') {
        inputElement.classList.remove('border-red-500', 'border-green-500', 'bg-red-50');
        inputElement.classList.add('border-gray-300');
        emailValidationIcon.classList.add('hidden');
        emailValidationMessage.classList.add('hidden');
        isEmailValid = false;
    } else if (isValid) {
        inputElement.classList.remove('border-red-500', 'bg-red-50');
        inputElement.classList.add('border-green-500');
        emailValidationIcon.classList.remove('hidden');
        emailValidationIcon.innerHTML = `
            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        `;
        emailValidationMessage.classList.remove('hidden', 'text-red-600');
        emailValidationMessage.classList.add('text-green-600');
        emailValidationMessage.textContent = 'Email valid';
        isEmailValid = true;
    } else {
        inputElement.classList.remove('border-green-500');
        inputElement.classList.add('border-red-500', 'bg-red-50');
        emailValidationIcon.classList.remove('hidden');
        emailValidationIcon.innerHTML = `
            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        `;
        emailValidationMessage.classList.remove('hidden', 'text-green-600');
        emailValidationMessage.classList.add('text-red-600');
        
        const domain = email.split('@')[1]?.toLowerCase();
        if (!domain || !domain.includes('.')) {
            emailValidationMessage.textContent = 'Gunakan Gmail, Yahoo, Outlook, atau provider email resmi';
        } else {
            emailValidationMessage.textContent = 'Email tidak valid';
        }
        isEmailValid = false;
    }
    
    updateSubmitButton();
}

// Update submit button state
function updateSubmitButton() {
    const nameFilled = document.getElementById('name').value.trim() !== '';
    const phoneFilled = document.getElementById('phone').value.trim() !== '';
    const emailFilled = emailInput.value.trim() !== '';
    
    submitBtn.disabled = !(nameFilled && phoneFilled && emailFilled && isEmailValid && selectedTime);
}

// Event listeners
emailInput.addEventListener('input', function() {
    const email = this.value.trim();
    const isValid = validateEmail(email);
    updateEmailValidation(isValid, email);
});

emailInput.addEventListener('blur', function() {
    const email = this.value.trim();
    const isValid = validateEmail(email);
    updateEmailValidation(isValid, email);
});

document.getElementById('name').addEventListener('input', updateSubmitButton);
document.getElementById('phone').addEventListener('input', updateSubmitButton);

bookingForm.addEventListener('submit', function(e) {
    if (!selectedTime) {
        e.preventDefault();
        alert('Silakan pilih jam terlebih dahulu');
        return false;
    }

    if (!isEmailValid) {
        e.preventDefault();
        alert('Silakan masukkan email yang valid');
        emailInput.focus();
        return false;
    }

    // Show loading state
    submitBtn.classList.add('loading');
    btnText.textContent = 'Memproses...';
    btnSpinner.classList.remove('hidden');
    submitBtn.disabled = true;
});

// Utility functions
function getMonthName(monthIndex) {
    const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                   'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    return months[monthIndex];
}

function formatDateForInput(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
}

function formatDateDisplay(date) {
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    return date.toLocaleDateString('id-ID', options);
}

// Initialize calendar on page load
document.addEventListener('DOMContentLoaded', function() {
    initCalendar();
    updateSubmitButton();
});
</script>
@endsection