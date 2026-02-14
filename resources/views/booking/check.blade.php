@extends('layouts.booking')

@section('title', 'Cek Booking')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header Section -->
    <div class="bg-gradient-to-br from-primary-50 to-white rounded-2xl p-8 mb-8 shadow-traveloka">
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-primary-400 to-primary-600 rounded-2xl mb-6">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Cek Status Booking</h1>
            <p class="text-lg text-secondary-600">Masukkan kode booking dan email Anda untuk melihat detail booking</p>
        </div>
    </div>

    <!-- Form Section -->
    <div class="bg-white rounded-2xl shadow-traveloka-lg p-8">
        <form method="POST" action="{{ route('booking.check') }}" class="space-y-6">
            @csrf
            
            <!-- Booking Code Input -->
            <div>
                <label for="booking_code" class="block text-sm font-semibold text-gray-900 mb-3">
                    Kode Booking
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        name="booking_code" 
                        id="booking_code" 
                        class="block w-full pl-12 pr-4 py-4 border-2 border-secondary-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-lg font-mono transition-colors duration-200"
                        placeholder="Contoh: 123-ABCDEF"
                        value="{{ old('booking_code') }}"
                        required
                    >
                </div>
                @error('booking_code')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
                <p class="mt-2 text-sm text-secondary-500">
                    Format: [ID]-[KODE] (contoh: 123-ABCDEF)
                </p>
            </div>

            <!-- Email Input -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-900 mb-3">
                    Email
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        class="block w-full pl-12 pr-4 py-4 border-2 border-secondary-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-lg transition-colors duration-200"
                        placeholder="email@example.com"
                        value="{{ old('email') }}"
                        required
                    >
                </div>
                @error('email')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
                <p class="mt-2 text-sm text-secondary-500">
                    Email yang digunakan saat booking
                </p>
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button 
                    type="submit" 
                    id="checkBookingBtn"
                    class="w-full flex items-center justify-center px-6 py-4 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-semibold rounded-xl transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg"
                >
                    <svg class="w-5 h-5 mr-2 check-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <span class="check-text">Cek Booking</span>
                    <div class="check-spinner hidden ml-2">
                        <div class="spinner"></div>
                    </div>
                </button>
            </div>
        </form>

        <!-- Help Section -->
        <div class="mt-8 pt-8 border-t border-secondary-100">
            <div class="bg-blue-50 rounded-xl p-6">
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-blue-900 mb-2">Butuh bantuan?</h3>
                        <ul class="text-sm text-blue-700 space-y-1">
                            <li>• Kode booking dikirim ke email Anda setelah booking berhasil</li>
                            <li>• Format kode: [Nomor ID]-[6 Karakter Kode]</li>
                            <li>• Gunakan email yang sama saat melakukan booking</li>
                            <li>• Jika ada masalah, hubungi layanan pelanggan kami</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back to Home -->
        <div class="mt-6 text-center">
            <a href="/" class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkBookingForm = document.querySelector('form[action="{{ route('booking.check') }}"]');
    const checkBookingBtn = document.getElementById('checkBookingBtn');
    
    if (checkBookingForm && checkBookingBtn) {
        checkBookingForm.addEventListener('submit', function(e) {
            // Show loading state on button (same as booking page)
            showCheckBookingLoading();
        });
    }

    function showCheckBookingLoading() {
        const checkBookingBtn = document.getElementById('checkBookingBtn');
        const checkIcon = checkBookingBtn.querySelector('.check-icon');
        const checkText = checkBookingBtn.querySelector('.check-text');
        const checkSpinner = checkBookingBtn.querySelector('.check-spinner');

        // Show loading state (same as booking page)
        checkBookingBtn.classList.add('loading');
        checkText.textContent = 'Memproses...';
        checkIcon.classList.add('hidden');
        checkSpinner.classList.remove('hidden');
        checkBookingBtn.disabled = true;
    }
});
</script>

<style>
/* Same spinner style as booking page */
.check-spinner .spinner {
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

.loading {
    pointer-events: none;
    opacity: 0.7;
}
</style>
@endsection
