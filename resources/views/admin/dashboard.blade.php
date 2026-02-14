@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-50 via-white to-secondary-50">
    <!-- Header Section -->
    <div class="bg-white shadow-sm border-b border-secondary-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 flex items-center">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-r from-primary-500 to-primary-600 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                        Dashboard Admin
                    </h1>
                    <p class="text-gray-600 mt-1 text-sm sm:text-base">
                        @if($selectedDate === $today)
                            Hari Ini ({{ \Carbon\Carbon::parse($selectedDate)->locale('id')->translatedFormat('l, d F Y') }})
                        @else
                            {{ \Carbon\Carbon::parse($selectedDate)->locale('id')->translatedFormat('l, d F Y') }}
                        @endif
                    </p>
                </div>
                
                <!-- Date Filter & Manual Booking -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center space-y-3 sm:space-y-0 sm:space-x-3">
                    <button onclick="showManualBookingModal()" 
                        class="px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white text-sm font-medium rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-200 shadow-sm flex items-center justify-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>Booking Manual</span>
                    </button>
                    
                    <div class="bg-white px-4 py-2 rounded-xl border border-secondary-200 shadow-sm">
                        <form id="dateFilterForm" method="GET" action="/admin/dashboard" class="flex flex-col sm:flex-row items-center space-y-2 sm:space-y-0 sm:space-x-3">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <input type="date" 
                                    id="dateFilter" 
                                    name="date" 
                                    value="{{ $selectedDate }}"
                                    class="border-0 text-sm font-medium text-gray-700 focus:outline-none focus:ring-0">
                            </div>
                            <div class="flex items-center space-x-2">
                                <button type="submit" id="filterBtn" class="px-4 py-2 bg-gradient-to-r from-primary-500 to-primary-600 text-white text-sm font-medium rounded-lg hover:from-primary-600 hover:to-primary-700 transition-all duration-200 shadow-sm flex items-center space-x-2">
                                    <svg class="w-4 h-4 filter-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                    </svg>
                                    <span class="filter-text">Filter</span>
                                    <div class="filter-spinner hidden">
                                        <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </div>
                                </button>
                                @if($selectedDate !== $today)
                                <button type="button" id="todayBtn" onclick="handleTodayClick()" class="px-4 py-2 bg-secondary-100 text-secondary-700 text-sm font-medium rounded-lg hover:bg-secondary-200 transition-colors duration-200 flex items-center space-x-2">
                                    <svg class="w-4 h-4 today-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="today-text">Hari Ini</span>
                                    <div class="today-spinner hidden">
                                        <svg class="animate-spin h-4 w-4 text-secondary-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </div>
                                </button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @if($bookings->isEmpty())
            <div class="bg-white rounded-2xl shadow-traveloka-lg p-12 text-center">
                <div class="w-20 h-20 bg-secondary-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">
                    @if($selectedDate === $today)
                        Tidak ada booking hari ini
                    @else
                        Tidak ada booking pada tanggal ini
                    @endif
                </h3>
                <p class="text-gray-500 max-w-md mx-auto">
                    @if($selectedDate === $today)
                        Belum ada pasien yang melakukan booking untuk hari ini.
                    @else
                        Tidak ada pasien yang melakukan booking pada tanggal ini.
                    @endif
                </p>
            </div>
        @else
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-8">
                <div class="bg-white rounded-2xl shadow-traveloka-lg p-6 border border-secondary-100 hover:shadow-traveloka-lg transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-secondary-600 mb-1">Total Pasien</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $bookings->count() }}</p>
                            <p class="text-xs text-secondary-500 mt-1">Booking terdaftar</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-traveloka-lg p-6 border border-secondary-100 hover:shadow-traveloka-lg transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-secondary-600 mb-1">Jam Pertama</p>
                            <p class="text-3xl font-bold text-gray-900">{{ substr($bookings->first()->booking_time, 0, 5) }}</p>
                            <p class="text-xs text-secondary-500 mt-1">Booking dimulai</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-traveloka-lg p-6 border border-secondary-100 hover:shadow-traveloka-lg transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-secondary-600 mb-1">Jam Terakhir</p>
                            <p class="text-3xl font-bold text-gray-900">{{ substr($bookings->last()->booking_time, 0, 5) }}</p>
                            <p class="text-xs text-secondary-500 mt-1">Booking berakhir</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bookings Table -->
            <div class="bg-white rounded-2xl shadow-traveloka-lg overflow-hidden border border-secondary-100">
                <div class="px-4 sm:px-6 py-4 border-b border-secondary-100">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                        <h2 class="text-lg font-semibold text-gray-900">Daftar Booking</h2>
                        
                        <!-- Search Bar -->
                        <div class="relative w-full sm:max-w-md">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" 
                                   id="searchInput" 
                                   placeholder="Cari nama, kode booking, atau nomor HP..." 
                                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        </div>
                    </div>
                </div>
                
                <!-- Responsive Table with Horizontal Scroll -->
                <div class="overflow-x-auto relative">
                    <!-- Scroll indicator for mobile -->
                    <div class="sm:hidden absolute top-0 right-0 bottom-0 w-8 bg-gradient-to-l from-white to-transparent pointer-events-none z-10 flex items-center justify-end pr-2">
                        <svg class="w-4 h-4 text-gray-400 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                    
                    <div class="min-w-full">
                        <table class="min-w-[800px] w-full divide-y divide-secondary-100">
                            <thead class="bg-secondary-50">
                                <tr>
                                    <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-secondary-700 uppercase tracking-wider whitespace-nowrap">
                                        No
                                    </th>
                                    <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-secondary-700 uppercase tracking-wider whitespace-nowrap">
                                        Kode Booking
                                    </th>
                                    <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-secondary-700 uppercase tracking-wider whitespace-nowrap">
                                        Jam
                                    </th>
                                    <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-secondary-700 uppercase tracking-wider whitespace-nowrap">
                                        Nama Pasien
                                    </th>
                                    <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-secondary-700 uppercase tracking-wider whitespace-nowrap">
                                        Nomor HP
                                    </th>
                                    <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-secondary-700 uppercase tracking-wider whitespace-nowrap">
                                        Status
                                    </th>
                                    <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-secondary-700 uppercase tracking-wider whitespace-nowrap">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                        <tbody id="bookingTableBody" class="bg-white divide-y divide-secondary-100">
                            @foreach($bookings as $index => $booking)
                            <tr class="hover:bg-secondary-50 transition-colors duration-150 searchable-row" 
                                data-name="{{ strtolower($booking->name) }}" 
                                data-code="{{ strtolower($booking->id . '-' . strtoupper(substr(md5($booking->id . $booking->booking_date), 0, 6))) }}" 
                                data-phone="{{ strtolower($booking->phone) }}"
                                data-time="{{ substr($booking->booking_time, 0, 5) }}">
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-2">
                                        <span class="px-2 sm:px-3 py-1 text-xs font-mono font-semibold rounded-full bg-blue-100 text-blue-800 border border-blue-200">
                                            {{ $booking->id }}-{{ strtoupper(substr(md5($booking->id . $booking->booking_date), 0, 6)) }}
                                        </span>
                                        <button onclick="copyBookingCode('{{ $booking->id }}-{{ strtoupper(substr(md5($booking->id . $booking->booking_date), 0, 6)) }}')" 
                                            class="text-secondary-400 hover:text-blue-600 transition-colors duration-200 flex-shrink-0" 
                                            title="Salin Kode Booking">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm font-semibold text-gray-900">
                                            {{ substr($booking->booking_time, 0, 5) }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 sm:h-10 sm:w-10 shrink-0">
                                            <div class="h-8 w-8 sm:h-10 sm:w-10 rounded-full bg-primary-100 flex items-center justify-center border-2 border-white shadow-sm">
                                                <span class="text-xs sm:text-sm font-semibold text-primary-600">
                                                    {{ strtoupper(substr($booking->name, 0, 1)) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="ml-2 sm:ml-3">
                                            <div class="text-sm font-semibold text-gray-900">
                                                {{ $booking->name }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-600">
                                        {{ $booking->phone }}
                                    </div>
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 sm:px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 border border-green-200">
                                        Terdaftar
                                    </span>
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm">
                                    @php
                                        $bookingDateTime = \Carbon\Carbon::parse($booking->booking_date . ' ' . $booking->booking_time);
                                        $isPastBooking = $bookingDateTime->isPast();
                                    @endphp
                                    <div class="flex space-x-2">
                                        @if($isPastBooking)
                                            <button disabled
                                                class="inline-flex items-center px-2 sm:px-3 py-1.5 border border-gray-300 text-xs font-semibold rounded-lg text-gray-400 bg-gray-100 cursor-not-allowed transition-all duration-200">
                                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                <span class="hidden sm:inline">Edit</span>
                                            </button>
                                        @else
                                            <button onclick="showEditModal({{ $booking->id }})"
                                                class="inline-flex items-center px-2 sm:px-3 py-1.5 border border-transparent text-xs font-semibold rounded-lg text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-sm hover:shadow-md">
                                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                <span class="hidden sm:inline">Edit</span>
                                            </button>
                                        @endif
                                        
                                        @if($isPastBooking)
                                            <button disabled
                                                class="inline-flex items-center px-2 sm:px-3 py-1.5 border border-gray-300 text-xs font-semibold rounded-lg text-gray-400 bg-gray-100 cursor-not-allowed transition-all duration-200">
                                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                <span class="hidden sm:inline">Batal</span>
                                            </button>
                                        @else
                                            <button onclick="showCancelModal({{ $booking->id }}, '{{ $booking->name }}', '{{ $booking->booking_time }}')"
                                                class="inline-flex items-center px-2 sm:px-3 py-1.5 border border-transparent text-xs font-semibold rounded-lg text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200 shadow-sm hover:shadow-md">
                                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                <span class="hidden sm:inline">Batal</span>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        </div>
    </div>

    <!-- Include Modals from Components -->
    @include('components.admin-manual-booking-modal')
    @include('components.admin-cancel-modal')
    @include('components.admin-edit-booking-modal')
</div>

<style>
/* Modal animations */
.modal-enter {
    animation: modalFadeIn 0.3s ease-out;
}

.modal-leave {
    animation: modalFadeOut 0.3s ease-in;
}

@keyframes modalFadeIn {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes modalFadeOut {
    from {
        opacity: 1;
        transform: scale(1);
    }
    to {
        opacity: 0;
        transform: scale(0.9);
    }
}

/* Fade in animation for new table rows */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Custom scrollbar for table */
.overflow-x-auto::-webkit-scrollbar {
    height: 6px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 3px;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 3px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

/* Custom scrollbar for modal */
.max-h-96::-webkit-scrollbar {
    width: 6px;
}

.max-h-96::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.max-h-96::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

.max-h-96::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

/* Traveloka-style Time Slots for Manual Booking */
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
    background: linear-gradient(135deg, transparent, rgba(34, 197, 94, 0.05));
    opacity: 0;
    transition: opacity 0.3s ease;
}

.time-slot:hover:not(.disabled):not(.selected):not(.booked):not(.past) {
    border-color: #22c55e;
    background: linear-gradient(135deg, #f0fdf4, #dcfce7);
    color: #16a34a;
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 8px 25px rgba(34, 197, 94, 0.15);
}

.time-slot:hover:not(.disabled):not(.selected):not(.booked):not(.past)::before {
    opacity: 1;
}

.time-slot.selected {
    background: linear-gradient(135deg, #16a34a, #15803d);
    color: white;
    border-color: #16a34a;
    font-weight: 700;
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 12px 35px rgba(22, 163, 74, 0.25);
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

/* Booked and Past slots */
.time-slot.booked {
    background: linear-gradient(135deg, #fee2e2, #fecaca);
    border-color: #ef4444;
    color: #dc2626;
    opacity: 0.7;
    cursor: not-allowed;
    position: relative;
}

.time-slot.booked::after {
    content: '×';
    position: absolute;
    top: 4px;
    right: 8px;
    font-size: 12px;
    font-weight: bold;
    color: #dc2626;
}

.time-slot.past {
    background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
    border-color: #9ca3af;
    color: #6b7280;
    opacity: 0.5;
    cursor: not-allowed;
    position: relative;
}

.time-slot.past::after {
    content: '○';
    position: absolute;
    top: 4px;
    right: 8px;
    font-size: 12px;
    font-weight: bold;
    color: #6b7280;
}

/* Loading dots animation */
.loading-dots {
    display: inline-flex;
    gap: 6px;
    align-items: center;
}

.loading-dots span {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: linear-gradient(135deg, #22c55e, #16a34a);
    animation: bounce 1.4s infinite ease-in-out both;
    box-shadow: 0 2px 8px rgba(34, 197, 94, 0.3);
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

/* Clean Animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(8px); }
    to { opacity: 1; transform: translateY(0); }
}

.time-slot {
    animation: fadeIn 0.3s ease forwards;
}

/* Notification fade out animation */
.manual-booking-notification {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    transform-origin: top right;
}

.manual-booking-notification.fade-out {
    opacity: 0;
    transform: translateX(100%) scale(0.95);
}
</style>

<script>
// Manual Booking Functions
let isEmailValid = false;

// Search Functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchRows = document.querySelectorAll('.searchable-row');
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            
            searchRows.forEach(row => {
                const name = row.getAttribute('data-name');
                const code = row.getAttribute('data-code');
                const phone = row.getAttribute('data-phone');
                const time = row.getAttribute('data-time');
                
                const isMatch = name.includes(searchTerm) || 
                               code.includes(searchTerm) || 
                               phone.includes(searchTerm) || 
                               time.includes(searchTerm);
                
                if (isMatch) {
                    row.style.display = '';
                    row.classList.remove('opacity-50');
                } else {
                    row.style.display = 'none';
                }
            });
            
            // Show/hide no results message
            const visibleRows = Array.from(searchRows).filter(row => row.style.display !== 'none');
            const tbody = document.getElementById('bookingTableBody');
            const existingNoResults = tbody.querySelector('.no-search-results');
            
            if (existingNoResults) {
                existingNoResults.remove();
            }
            
            if (visibleRows.length === 0 && searchTerm !== '') {
                const noResultsRow = document.createElement('tr');
                noResultsRow.className = 'no-search-results';
                noResultsRow.innerHTML = `
                    <td colspan="7" class="px-6 py-8 text-center">
                        <div class="text-gray-500">
                            <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <p class="text-sm">Tidak ada booking yang cocok dengan pencarian "${searchTerm}"</p>
                        </div>
                    </td>
                `;
                tbody.appendChild(noResultsRow);
            }
        });
    }

    // Date Filter Loading Effect
    const dateFilterForm = document.getElementById('dateFilterForm');
    const dateFilterInput = document.getElementById('dateFilter');
    const filterBtn = document.getElementById('filterBtn');
    const filterIcon = filterBtn.querySelector('.filter-icon');
    const filterText = filterBtn.querySelector('.filter-text');
    const filterSpinner = filterBtn.querySelector('.filter-spinner');

    if (dateFilterForm && dateFilterInput) {
        // Handle form submission only when button is clicked
        dateFilterForm.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent immediate form submission
            
            // Show loading first
            showFilterLoading();
            
            // Wait for entrance animation to complete, then start exit and submit
            setTimeout(() => {
                // Start exit animation
                const overlay = document.querySelector('.date-filter-overlay');
                if (overlay) {
                    const modal = overlay.querySelector('div');
                    
                    // Smooth exit animation
                    overlay.classList.remove('bg-opacity-30');
                    overlay.classList.add('bg-opacity-0');
                    
                    modal.classList.remove('scale-100', 'opacity-100');
                    modal.classList.add('scale-95', 'opacity-0');
                    
                    // Submit form after exit animation starts
                    setTimeout(() => {
                        this.submit();
                    }, 150); // Submit in the middle of exit animation
                } else {
                    // Fallback: submit immediately if overlay not found
                    this.submit();
                }
            }, 500); // Let entrance animation complete first
        });

        // Remove auto-submit on date change - just let user choose date then click filter
        dateFilterInput.addEventListener('change', function() {
            // Just enable the filter button and show it's ready
            filterBtn.classList.remove('opacity-50');
            filterBtn.classList.add('ring-2', 'ring-primary-300');
        });

        // Handle Today button click
        const todayBtn = document.getElementById('todayBtn');
        if (todayBtn) {
            todayBtn.addEventListener('click', function() {
                handleTodayClick();
            });
        }
    }

    function handleTodayClick() {
        const todayBtn = document.getElementById('todayBtn');
        const todayIcon = todayBtn.querySelector('.today-icon');
        const todayText = todayBtn.querySelector('.today-text');
        const todaySpinner = todayBtn.querySelector('.today-spinner');

        // Disable button and show loading state
        todayBtn.disabled = true;
        todayBtn.classList.add('opacity-75', 'cursor-not-allowed');
        todayIcon.classList.add('hidden');
        todayText.classList.add('hidden');
        todaySpinner.classList.remove('hidden');

        // Show loading overlay
        addLoadingOverlay();

        // Wait for entrance animation to complete, then start exit and navigate
        setTimeout(() => {
            // Start exit animation
            const overlay = document.querySelector('.date-filter-overlay');
            if (overlay) {
                const modal = overlay.querySelector('div');
                
                // Smooth exit animation
                overlay.classList.remove('bg-opacity-30');
                overlay.classList.add('bg-opacity-0');
                
                modal.classList.remove('scale-100', 'opacity-100');
                modal.classList.add('scale-95', 'opacity-0');
                
                // Navigate after exit animation starts
                setTimeout(() => {
                    window.location.href = '/admin/dashboard';
                }, 150); // Navigate in the middle of exit animation
            } else {
                // Fallback: navigate immediately if overlay not found
                window.location.href = '/admin/dashboard';
            }
        }, 500); // Let entrance animation complete first
    }

    function showFilterLoading() {
        // Disable button and show loading state
        filterBtn.disabled = true;
        filterBtn.classList.add('opacity-75', 'cursor-not-allowed');
        filterBtn.classList.remove('ring-2', 'ring-primary-300');
        filterIcon.classList.add('hidden');
        filterText.classList.add('hidden');
        filterSpinner.classList.remove('hidden');
        
        // Add overlay to main content
        addLoadingOverlay();
    }

    function addLoadingOverlay() {
        // Remove existing overlay if any
        const existingOverlay = document.querySelector('.date-filter-overlay');
        if (existingOverlay) {
            existingOverlay.remove();
        }

        // Create overlay with smooth animation
        const overlay = document.createElement('div');
        overlay.className = 'date-filter-overlay fixed inset-0 bg-black bg-opacity-0 flex items-center justify-center z-50 transition-all duration-300 ease-in-out';
        overlay.innerHTML = `
            <div class="bg-white rounded-lg p-6 shadow-xl flex items-center space-x-3 transform scale-95 opacity-0 transition-all duration-300 ease-in-out">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary-600"></div>
                <span class="text-gray-700 font-medium">Memuat data booking...</span>
            </div>
        `;
        document.body.appendChild(overlay);

        // Trigger smooth entrance animation
        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                overlay.classList.remove('bg-opacity-0');
                overlay.classList.add('bg-opacity-30');
                
                const modal = overlay.querySelector('div');
                modal.classList.remove('scale-95', 'opacity-0');
                modal.classList.add('scale-100', 'opacity-100');
            });
        });
    }

    function hideLoadingOverlay() {
        const overlay = document.querySelector('.date-filter-overlay');
        if (overlay) {
            const modal = overlay.querySelector('div');
            
            // Smooth exit animation
            overlay.classList.remove('bg-opacity-30');
            overlay.classList.add('bg-opacity-0');
            
            modal.classList.remove('scale-100', 'opacity-100');
            modal.classList.add('scale-95', 'opacity-0');
            
            // Remove from DOM after animation completes
            setTimeout(() => {
                if (overlay.parentNode) {
                    overlay.parentNode.removeChild(overlay);
                }
            }, 300);
        }
    }
});

function showManualBookingModal() {
    const modal = document.getElementById('manualBookingModal');
    const modalContent = document.getElementById('manualBookingModalContent');
    
    // Load time slots first
    loadTimeSlots();
    
    // Show modal with animation
    modal.classList.remove('hidden');
    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function hideManualBookingModal() {
    const modal = document.getElementById('manualBookingModal');
    const modalContent = document.getElementById('manualBookingModalContent');
    
    // Hide modal with animation
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        // Reset form
        document.getElementById('manualBookingForm').reset();
    }, 300);
}

// Initialize date change listener when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    const bookingDateInput = document.getElementById('bookingDate');
    if (bookingDateInput) {
        bookingDateInput.addEventListener('change', function() {
            // Clear selected time when date changes
            document.getElementById('bookingTime').value = '';
            
            // Remove any previous selection
            document.querySelectorAll('.time-slot.selected').forEach(el => {
                el.classList.remove('selected');
            });
            
            // Load new time slots for selected date
            loadTimeSlots();
        });
    }
    
    // Initialize email validation
    const emailInput = document.getElementById('patientEmail');
    const emailValidationIcon = document.getElementById('emailValidationIcon');
    const emailValidationMessage = document.getElementById('emailValidationMessage');
    
    if (emailInput) {
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
    }
});

// Email validation function
function validateEmail(email) {
    const legitimateDomains = [
        'gmail.com', 'yahoo.com', 'outlook.com', 'hotmail.com', 'live.com',
        'icloud.com', 'aol.com', 'mail.com', 'protonmail.com', 'zoho.com'
    ];
    
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) return false;
    
    const domain = email.split('@')[1]?.toLowerCase();
    return legitimateDomains.includes(domain);
}

// Email validation UI update
function updateEmailValidation(isValid, email) {
    const inputElement = document.getElementById('patientEmail');
    const emailValidationIcon = document.getElementById('emailValidationIcon');
    const emailValidationMessage = document.getElementById('emailValidationMessage');
    
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
}

function loadTimeSlots() {
    const bookingDate = document.getElementById('bookingDate').value;
    const timeSlotsContainer = document.getElementById('timeSlotsContainer');
    
    if (!bookingDate) {
        timeSlotsContainer.innerHTML = `
            <div class="text-center py-8">
                <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-gray-500 text-sm">Pilih tanggal terlebih dahulu</p>
                <p class="text-gray-400 text-xs">Waktu tersedia akan muncul</p>
            </div>
        `;
        return;
    }

    timeSlotsContainer.innerHTML = `
        <div class="text-center py-8">
            <div class="spinner mx-auto mb-3"></div>
            <p class="text-gray-500 text-sm">Memuat waktu...</p>
        </div>
    `;

    fetch(`/admin/bookings/create?date=${bookingDate}`)
        .then(response => response.json())
        .then(data => {
            timeSlotsContainer.innerHTML = '';
            
            if (data.slots && data.slots.length > 0) {
                data.slots.forEach((slot, index) => {
                    const timeSlot = document.createElement('button');
                    timeSlot.type = 'button';
                    timeSlot.className = 'time-slot';
                    timeSlot.style.animationDelay = `${index * 0.05}s`;
                    timeSlot.textContent = slot.time;
                    
                    // Apply different styles based on status
                    if (slot.status === 'booked') {
                        timeSlot.classList.add('booked');
                        timeSlot.disabled = true;
                        timeSlot.title = 'Sudah dibooking';
                    } else if (slot.status === 'past') {
                        timeSlot.classList.add('past');
                        timeSlot.disabled = true;
                        timeSlot.title = 'Sudah lewat';
                    } else {
                        timeSlot.addEventListener('click', () => selectTimeSlot(slot.time, timeSlot));
                    }
                    
                    timeSlotsContainer.appendChild(timeSlot);
                });
            } else {
                timeSlotsContainer.innerHTML = `
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-gray-500 text-sm">Tidak ada slot tersedia</p>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error loading slots:', error);
            timeSlotsContainer.innerHTML = `
                <div class="text-center py-8">
                    <svg class="w-12 h-12 mx-auto mb-3 text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-red-500 text-sm">Gagal memuat waktu</p>
                </div>
            `;
        });
}

function selectTimeSlot(time, element) {
    // Remove previous selection
    document.querySelectorAll('.time-slot.selected').forEach(el => {
        el.classList.remove('selected');
    });
    
    // Add selection to clicked time slot
    element.classList.add('selected');
    document.getElementById('bookingTime').value = time;
}

function submitManualBooking(event) {
    event.preventDefault();
    
    const form = document.getElementById('manualBookingForm');
    const formData = new FormData(form);
    
    // Check email validation
    const email = formData.get('email').trim();
    if (!isEmailValid || email === '') {
        showNotification('Email tidak valid. Gunakan provider email resmi.', 'error');
        return;
    }
    
    // Show loading state
    const submitButton = document.querySelector('button[form="manualBookingForm"]');
    const btnText = document.getElementById('manualBtnText');
    const btnSpinner = document.getElementById('manualBtnSpinner');
    
    if (!submitButton) {
        console.error('Submit button not found');
        return;
    }
    
    btnText.textContent = 'Memproses...';
    btnSpinner.classList.remove('hidden');
    submitButton.disabled = true;
    
    fetch('/admin/bookings', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log('Response data:', data); // Debug log
        if (data.success) {
            showNotification('Booking berhasil dibuat!', 'success');
            hideManualBookingModal();
            
            // Add the new booking to the table dynamically (like cancel)
            if (data.booking) {
                console.log('Adding booking to table:', data.booking); // Debug log
                addNewBookingToTable(data.booking);
            } else {
                console.log('No booking data received'); // Debug log
            }
        } else {
            showNotification(data.message || 'Terjadi kesalahan.', 'error');
        }
    })
    .catch(error => {
        console.error('Error submitting booking:', error);
        showNotification('Terjadi kesalahan saat membuat booking.', 'error');
    })
    .finally(() => {
        // Reset button state
        btnText.textContent = 'Buat Booking';
        btnSpinner.classList.add('hidden');
        submitButton.disabled = false;
    });
}

// Add new booking to table dynamically
function addNewBookingToTable(booking) {
    console.log('addNewBookingToTable called with:', booking); // Debug log
    
    // Check if we need to show the table first (when there were no bookings before)
    const mainContent = document.querySelector('.max-w-7xl.mx-auto.px-4.sm\\:px-6.lg\\:px-8.py-8');
    const noBookingsMessage = document.querySelector('.bg-white.rounded-2xl.shadow-traveloka-lg.p-12.text-center');
    
    if (noBookingsMessage && mainContent) {
        // Replace no bookings message with table and summary cards
        const selectedDate = document.getElementById('dateFilter')?.value || new Date().toISOString().split('T')[0];
        const today = new Date().toISOString().split('T')[0];
        const isToday = selectedDate === today;
        
        mainContent.innerHTML = `
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-2xl shadow-traveloka-lg p-6 border border-secondary-100 hover:shadow-traveloka-lg transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-secondary-600 mb-1">Total Pasien</p>
                            <p class="text-3xl font-bold text-gray-900">1</p>
                            <p class="text-xs text-secondary-500 mt-1">Booking terdaftar</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-traveloka-lg p-6 border border-secondary-100 hover:shadow-traveloka-lg transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-secondary-600 mb-1">Jam Pertama</p>
                            <p class="text-3xl font-bold text-gray-900">${booking.booking_time.substring(0, 5)}</p>
                            <p class="text-xs text-secondary-500 mt-1">Booking dimulai</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-traveloka-lg p-6 border border-secondary-100 hover:shadow-traveloka-lg transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-secondary-600 mb-1">Jam Terakhir</p>
                            <p class="text-3xl font-bold text-gray-900">${booking.booking_time.substring(0, 5)}</p>
                            <p class="text-xs text-secondary-500 mt-1">Booking berakhir</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bookings Table -->
            <div class="bg-white rounded-2xl shadow-traveloka-lg overflow-hidden border border-secondary-100">
                <div class="px-6 py-4 border-b border-secondary-100">
                    <h2 class="text-lg font-semibold text-gray-900">Daftar Booking</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-secondary-100">
                        <thead class="bg-secondary-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-secondary-700 uppercase tracking-wider">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-secondary-700 uppercase tracking-wider">
                                    Kode Booking
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-secondary-700 uppercase tracking-wider">
                                    Jam
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-secondary-700 uppercase tracking-wider">
                                    Nama Pasien
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-secondary-700 uppercase tracking-wider">
                                    Nomor HP
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-secondary-700 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-secondary-700 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-secondary-100">
                        </tbody>
                    </table>
                </div>
            </div>
        `;
    }
    
    const tableBody = document.querySelector('tbody');
    if (!tableBody) {
        console.log('Table body not found'); // Debug log
        return;
    }
    
    console.log('Table body found, current rows:', tableBody.children.length); // Debug log
    
    // Generate booking code (simplified version)
    const bookingCode = `${booking.id}-${Math.random().toString(36).substr(2, 6).toUpperCase()}`;
    
    // Create new row
    const newRow = document.createElement('tr');
    newRow.className = 'hover:bg-secondary-50 transition-colors duration-150';
    newRow.style.animation = 'fadeIn 0.5s ease forwards';
    
    // Get current row count for new number
    const rowCount = tableBody.children.length;
    
    console.log('Creating row with booking data:', { booking, bookingCode, rowCount }); // Debug log
    
    newRow.innerHTML = `
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
            ${rowCount + 1}
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center space-x-2">
                <span class="px-3 py-1 text-xs font-mono font-semibold rounded-full bg-blue-100 text-blue-800 border border-blue-200">
                    ${bookingCode}
                </span>
                <button onclick="copyBookingCode('${bookingCode}')" 
                    class="text-secondary-400 hover:text-blue-600 transition-colors duration-200" 
                    title="Salin Kode Booking">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h10a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                </button>
            </div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
                <div class="text-sm font-semibold text-gray-900">
                    ${booking.booking_time.substring(0, 5)}
                </div>
            </div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
                <div class="h-10 w-10 shrink-0">
                    <div class="h-10 w-10 rounded-full bg-primary-100 flex items-center justify-center border-2 border-white shadow-sm">
                        <span class="text-sm font-semibold text-primary-600">
                            ${booking.name.substring(0, 1).toUpperCase()}
                        </span>
                    </div>
                </div>
                <div class="ml-3">
                    <div class="text-sm font-semibold text-gray-900">
                        ${booking.name}
                    </div>
                </div>
            </div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900 font-medium">${booking.phone}</div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 border border-green-200">
                Terdaftar
            </span>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <button onclick="showCancelModal(${booking.id}, '${booking.name}', '${booking.booking_time}')"
                class="inline-flex items-center px-3 py-2 border border-transparent text-xs font-semibold rounded-lg text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200 shadow-sm hover:shadow-md">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span>Cancel</span>
            </button>
        </td>
    `;
    
    // Add to table
    tableBody.appendChild(newRow);
    console.log('Row added to table'); // Debug log
    
    // Update summary cards if they exist
    console.log('Updating summary cards'); // Debug log
    updateSummaryCards();
}

// Update summary cards
function updateSummaryCards() {
    // Update total patients count
    const totalPatientsElements = document.querySelectorAll('.text-3xl.font-bold.text-gray-900');
    totalPatientsElements.forEach(element => {
        if (element.textContent.match(/^\d+$/)) { // Only update if it's a number
            const currentCount = parseInt(element.textContent);
            element.textContent = currentCount + 1;
        }
    });
    
    // Hide "no bookings" message if it exists
    const noBookingsMessage = document.querySelector('.bg-white.rounded-2xl.shadow-traveloka-lg.p-12.text-center');
    if (noBookingsMessage) {
        noBookingsMessage.style.display = 'none';
    }
    
    // Show bookings table and summary cards if they were hidden
    const bookingsContainer = document.querySelector('.grid.grid-cols-1.md\\:grid-cols-3.gap-6');
    if (bookingsContainer) {
        bookingsContainer.style.display = 'grid';
    }
    
    const tableContainer = document.querySelector('.bg-white.rounded-2xl.shadow-traveloka-lg.overflow-hidden');
    if (tableContainer) {
        tableContainer.style.display = 'block';
    }
}

function showNotification(message, type) {
    // Remove any existing notifications first
    const existingNotifications = document.querySelectorAll('.manual-booking-notification');
    existingNotifications.forEach(notification => notification.remove());
    
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `manual-booking-notification fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-300 ease-out translate-x-full`;
    
    if (type === 'success') {
        notification.className += ' bg-green-500 text-white';
    } else {
        notification.className += ' bg-red-500 text-white';
    }
    
    notification.innerHTML = `
        <div class="flex items-center space-x-2">
            ${type === 'success' 
                ? '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>'
                : '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>'
            }
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
        notification.classList.add('translate-x-0');
    }, 100);
    
    // Smooth fade out after 3 seconds
    setTimeout(() => {
        notification.classList.add('fade-out');
        
        // Remove from DOM after fade out animation completes
        setTimeout(() => {
            if (notification.parentNode) {
                document.body.removeChild(notification);
            }
        }, 300);
    }, 3000);
}

// Load slots when date changes
document.addEventListener('DOMContentLoaded', function() {
    const bookingDateInput = document.getElementById('bookingDate');
    if (bookingDateInput) {
        bookingDateInput.addEventListener('change', function() {
            // Clear selected time when date changes
            document.getElementById('bookingTime').value = '';
            
            // Remove any previous selection
            document.querySelectorAll('.time-slot.selected').forEach(el => {
                el.classList.remove('selected');
            });
            
            // Load new time slots for selected date
            loadTimeSlots();
        });
    }
});

// Close modal when clicking outside
window.onclick = function(event) {
    const manualBookingModal = document.getElementById('manualBookingModal');
    const cancelModal = document.getElementById('cancelModal');
    
    if (event.target == manualBookingModal) {
        hideManualBookingModal();
    }
    if (event.target == cancelModal) {
        hideCancelModal();
    }
}

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        hideManualBookingModal();
        hideCancelModal();
    }
});

function copyBookingCode(bookingCode) {
    // Try modern clipboard API first
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(bookingCode).then(function() {
            showCopyNotification('Kode booking berhasil disalin!', 'success');
        }).catch(function(err) {
            // Fallback to older method
            fallbackCopyToClipboard(bookingCode);
        });
    } else {
        // Fallback for older browsers
        fallbackCopyToClipboard(bookingCode);
    }
}

function fallbackCopyToClipboard(text) {
    try {
        // Create temporary textarea element
        const textArea = document.createElement("textarea");
        textArea.value = text;
        textArea.style.position = "fixed";
        textArea.style.left = "-999999px";
        textArea.style.top = "-999999px";
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        
        const successful = document.execCommand('copy');
        document.body.removeChild(textArea);
        
        if (successful) {
            showCopyNotification('Kode booking berhasil disalin!', 'success');
        } else {
            showCopyNotification('Gagal menyalin kode booking!', 'error');
        }
    } catch (err) {
        showCopyNotification('Gagal menyalin kode booking!', 'error');
    }
}

function showCopyNotification(message, type) {
    // Remove any existing notifications first
    const existingNotifications = document.querySelectorAll('.copy-notification');
    existingNotifications.forEach(notification => notification.remove());
    
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `copy-notification fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-300 translate-x-full`;
    
    if (type === 'success') {
        notification.className += ' bg-green-500 text-white';
    } else {
        notification.className += ' bg-red-500 text-white';
    }
    
    notification.innerHTML = `
        <div class="flex items-center space-x-2">
            ${type === 'success' 
                ? '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>'
                : '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>'
            }
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
        notification.classList.add('translate-x-0');
    }, 100);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.classList.remove('translate-x-0');
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            if (notification.parentNode) {
                document.body.removeChild(notification);
            }
        }, 300);
    }, 3000);
}

// Remove booking row dynamically
function removeBookingRow(bookingId) {
    // Find and remove the booking row
    const rows = document.querySelectorAll('tbody tr');
    rows.forEach(row => {
        const cancelButton = row.querySelector(`button[onclick*="${bookingId}"]`);
        if (cancelButton) {
            // Add fade out animation
            row.style.transition = 'all 0.3s ease-out';
            row.style.opacity = '0';
            row.style.transform = 'translateX(-20px)';
            
            // Remove after animation
            setTimeout(() => {
                row.remove();
                
                // Update row numbers
                updateRowNumbers();
                
                // Update summary cards
                updateSummaryCardsAfterCancel();
            }, 300);
        }
    });
}

// Update row numbers after deletion
function updateRowNumbers() {
    const rows = document.querySelectorAll('tbody tr');
    rows.forEach((row, index) => {
        const numberCell = row.querySelector('td:first-child');
        if (numberCell) {
            numberCell.textContent = index + 1;
        }
    });
}

// Update summary cards after cancel
function updateSummaryCardsAfterCancel() {
    // Update total patients count
    const totalPatientsElements = document.querySelectorAll('.text-3xl.font-bold.text-gray-900');
    totalPatientsElements.forEach(element => {
        if (element.textContent.match(/^\d+$/)) { // Only update if it's a number
            const currentCount = parseInt(element.textContent);
            element.textContent = Math.max(0, currentCount - 1);
        }
    });
    
    // Show "no bookings" message if table is empty
    const tableBody = document.querySelector('tbody');
    if (tableBody && tableBody.children.length === 0) {
        showNoBookingsMessage();
    }
}

// Show no bookings message
function showNoBookingsMessage() {
    const mainContent = document.querySelector('.max-w-7xl.mx-auto.px-4.sm\\:px-6.lg\\:px-8.py-8');
    if (mainContent) {
        const selectedDate = document.getElementById('dateFilter')?.value || new Date().toISOString().split('T')[0];
        const today = new Date().toISOString().split('T')[0];
        const isToday = selectedDate === today;
        
        const noBookingsHtml = `
            <div class="bg-white rounded-2xl shadow-traveloka-lg p-12 text-center">
                <div class="w-20 h-20 bg-secondary-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">
                    ${isToday ? 'Tidak ada booking hari ini' : 'Tidak ada booking pada tanggal ini'}
                </h3>
                <p class="text-gray-500 max-w-md mx-auto">
                    ${isToday ? 'Belum ada pasien yang melakukan booking untuk hari ini.' : 'Tidak ada pasien yang melakukan booking pada tanggal ini.'}
                </p>
            </div>
        `;
        
        // Clear existing content and show no bookings message
        mainContent.innerHTML = noBookingsHtml;
    }
}

function showCancelModal(id, name, time) {
    const modal = document.getElementById('cancelModal');
    const modalContent = document.getElementById('modalContent');
    const cancelForm = document.getElementById('cancelForm');
    
    document.getElementById('cancelName').textContent = name;
    document.getElementById('cancelTime').textContent = time;
    
    // Set the correct action URL
    const actionUrl = '/admin/bookings/' + id;
    cancelForm.action = actionUrl;
    
    console.log('Cancel form action set to:', actionUrl);
    
    // Show modal with animation
    modal.classList.remove('hidden');
    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function hideCancelModal() {
    const modal = document.getElementById('cancelModal');
    const modalContent = document.getElementById('modalContent');
    
    // Hide modal with animation
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

// Handle cancel form submission with spinner
document.addEventListener('DOMContentLoaded', function() {
    const cancelForm = document.getElementById('cancelForm');
    if (cancelForm) {
        cancelForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitButton = this.querySelector('button[type="submit"]');
            const btnText = document.getElementById('cancelBtnText');
            const btnSpinner = document.getElementById('cancelBtnSpinner');
            
            // Show loading state
            btnText.textContent = 'Membatalkan...';
            btnSpinner.classList.remove('hidden');
            submitButton.disabled = true;
            
            // Submit the form
            const formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            formData.append('_method', 'DELETE');
            
            fetch(this.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    showNotification('Booking berhasil dibatalkan!', 'success');
                    hideCancelModal();
                    
                    // Remove the booking row dynamically instead of reloading
                    const bookingId = this.action.split('/').pop();
                    removeBookingRow(bookingId);
                    
                    // Reset button state
                    btnText.textContent = 'Ya, Batalkan';
                    btnSpinner.classList.add('hidden');
                    submitButton.disabled = false;
                } else {
                    showNotification('Gagal membatalkan booking', 'error');
                    // Reset button state
                    btnText.textContent = 'Ya, Batalkan';
                    btnSpinner.classList.add('hidden');
                    submitButton.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error canceling booking:', error);
                showNotification('Terjadi kesalahan saat membatalkan booking', 'error');
                // Reset button state
                btnText.textContent = 'Ya, Batalkan';
                btnSpinner.classList.add('hidden');
                submitButton.disabled = false;
            })
            .finally(() => {
                // Always reset button state
                btnText.textContent = 'Ya, Batalkan';
                btnSpinner.classList.add('hidden');
                submitButton.disabled = false;
            });
        });
    }
});

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('cancelModal');
    if (event.target == modal) {
        hideCancelModal();
    }
}

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        hideCancelModal();
    }
});
</script>
@endsection
