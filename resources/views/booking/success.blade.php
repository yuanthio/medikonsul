@extends('layouts.booking')

@section('title', 'Booking Berhasil')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Success Hero Section -->
    <div class="bg-gradient-to-br from-primary-50 to-white rounded-2xl p-8 mb-8 shadow-traveloka">
        <div class="text-center">
            <!-- Success Animation -->
            <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-green-400 to-green-600 rounded-3xl mb-6 relative overflow-hidden">
                <div class="absolute inset-0 bg-white opacity-20 animate-pulse"></div>
                <svg class="w-12 h-12 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Booking Berhasil!</h1>
            <p class="text-xl text-secondary-600 max-w-2xl mx-auto">Terima kasih telah melakukan booking layanan kami. Kode booking telah dikirim ke email Anda.</p>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Booking Ticket (Main Content) -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-traveloka-lg overflow-hidden">
                <!-- Ticket Header -->
                <div class="bg-gradient-to-r from-primary-500 to-primary-600 px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-white mb-1">📋 E-Ticket</h2>
                            <p class="text-primary-100 text-sm">Kode Booking Resmi Anda</p>
                        </div>
                        <div class="bg-white/20 backdrop-blur-sm rounded-xl px-4 py-2">
                            <p class="text-white text-xs font-medium">Layanan</p>
                            <p class="text-white font-bold">Konsultasi Kesehatan</p>
                        </div>
                    </div>
                </div>
                
                <!-- Booking Code Section -->
                <div class="p-8">
                    <div class="bg-gradient-to-r from-primary-50 to-blue-50 rounded-2xl p-6 border border-primary-200">
                        <div class="text-center mb-4">
                            <h3 class="text-lg font-semibold text-primary-900 mb-3">Kode Booking</h3>
                            <div class="bg-white rounded-xl p-6 border-2 border-dashed border-primary-300 shadow-sm">
                                <div class="flex items-center justify-center space-x-4">
                                    <div class="text-3xl font-mono font-bold text-primary-600 tracking-wider" id="bookingCode">
                                        {{ $booking->id }}-{{ strtoupper(substr(md5($booking->id . $booking->booking_date), 0, 6)) }}
                                    </div>
                                    <button onclick="copyBookingCode(event)" class="group p-3 hover:bg-primary-50 rounded-xl transition-all duration-200" title="Salin Kode Booking">
                                        <svg class="w-6 h-6 text-secondary-500 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <p class="text-sm text-secondary-600 mt-3">Simpan kode booking ini untuk check-in</p>
                        </div>

                        <!-- Booking Details Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                            <div class="bg-white rounded-xl p-4 border border-secondary-100">
                                <div class="flex items-center mb-2">
                                    <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-secondary-500">Tanggal</span>
                                </div>
                                <div class="font-semibold text-gray-900 ml-11">{{ \Carbon\Carbon::parse($booking->booking_date)->locale('id')->translatedFormat('l, d F Y') }}</div>
                            </div>
                            
                            <div class="bg-white rounded-xl p-4 border border-secondary-100">
                                <div class="flex items-center mb-2">
                                    <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-secondary-500">Jam</span>
                                </div>
                                <div class="font-semibold text-gray-900 ml-11">{{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }}</div>
                            </div>
                            
                            <div class="bg-white rounded-xl p-4 border border-secondary-100">
                                <div class="flex items-center mb-2">
                                    <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-secondary-500">Nama</span>
                                </div>
                                <div class="font-semibold text-gray-900 ml-11">{{ $booking->name }}</div>
                            </div>
                            
                            <div class="bg-white rounded-xl p-4 border border-secondary-100">
                                <div class="flex items-center mb-2">
                                    <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-secondary-500">Telepon</span>
                                </div>
                                <div class="font-semibold text-gray-900 ml-11">{{ $booking->phone }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="space-y-6">
            <!-- Important Information Card -->
            <div class="bg-white rounded-2xl shadow-traveloka-lg p-6">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2 flex items-center">
                        <div class="w-8 h-8 bg-yellow-100 rounded-xl flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.314 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        Informasi Penting
                    </h3>
                    <p class="text-sm text-secondary-600">Persiapkan hal berikut</p>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Datang 10 menit lebih awal</p>
                            <p class="text-xs text-secondary-600">Hindari keterlambatan untuk pelayanan maksimal</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Bawa kode booking</p>
                            <p class="text-xs text-secondary-600">Perlihatkan kode ini saat check-in</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Durasi {{ config('booking.slot_duration', 30) }} menit</p>
                            <p class="text-xs text-secondary-600">Waktu konsultasi dengan dokter</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Email konfirmasi</p>
                            <p class="text-xs text-secondary-600">Dikirim ke {{ $booking->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl shadow-traveloka-lg p-6">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2 flex items-center">
                        <div class="w-8 h-8 bg-primary-100 rounded-xl flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        Aksi Cepat
                    </h3>
                    <p class="text-sm text-secondary-600">Lanjutkan aktivitas Anda</p>
                </div>
                
                <div class="space-y-3">
                    <a href="/" class="group w-full flex items-center justify-center px-6 py-4 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-semibold rounded-xl transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98]">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Booking Lagi
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyBookingCode(event) {
    console.log('Copy function called');
    event.preventDefault();
    event.stopPropagation();
    
    const bookingCodeElement = document.getElementById('bookingCode');
    const bookingCode = bookingCodeElement.textContent.trim();
    console.log('Booking code to copy:', bookingCode);
    
    // Get the button element
    const button = event.currentTarget;
    const originalHTML = button.innerHTML;
    
    // Try modern clipboard API first
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(bookingCode).then(function() {
            console.log('Copy successful');
            showSuccessFeedback(button, originalHTML);
        }).catch(function(err) {
            console.error('Clipboard API failed:', err);
            // Fallback to older method
            fallbackCopyToClipboard(bookingCode, button, originalHTML);
        });
    } else {
        // Fallback for older browsers
        fallbackCopyToClipboard(bookingCode, button, originalHTML);
    }
}

function showSuccessFeedback(button, originalHTML) {
    // Show success feedback on icon
    button.innerHTML = `
        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
    `;
    button.title = 'Tersalin!';
    
    // Show alert notification
    showAlert('Kode booking berhasil disalin!', 'success');
    
    setTimeout(() => {
        button.innerHTML = originalHTML;
        button.title = 'Salin Kode Booking';
    }, 2000);
}

function fallbackCopyToClipboard(text, button, originalHTML) {
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
            console.log('Fallback copy successful');
            showSuccessFeedback(button, originalHTML);
        } else {
            throw new Error('execCommand failed');
        }
    } catch (err) {
        console.error('Fallback copy failed:', err);
        // Show error feedback
        button.classList.add('text-red-600');
        button.title = 'Gagal menyalin';
        
        // Show error alert
        showAlert('Gagal menyalin kode booking!', 'error');
        
        setTimeout(() => {
            button.classList.remove('text-red-600');
            button.title = 'Salin Kode Booking';
        }, 2000);
    }
}

function showAlert(message, type) {
    console.log('Show alert called:', message, type);
    
    // Remove any existing alerts first
    const existingAlerts = document.querySelectorAll('.custom-alert');
    existingAlerts.forEach(alert => alert.remove());
    
    // Create alert element
    const alert = document.createElement('div');
    alert.className = `custom-alert fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-300 translate-x-full`;
    
    if (type === 'success') {
        alert.className += ' bg-green-500 text-white';
    } else {
        alert.className += ' bg-red-500 text-white';
    }
    
    alert.innerHTML = `
        <div class="flex items-center space-x-2">
            ${type === 'success' 
                ? '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>'
                : '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>'
            }
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(alert);
    console.log('Alert added to DOM');
    
    // Animate in
    setTimeout(() => {
        alert.classList.remove('translate-x-full');
        alert.classList.add('translate-x-0');
        console.log('Alert animated in');
    }, 100);
    
    // Remove after 3 seconds
    setTimeout(() => {
        alert.classList.remove('translate-x-0');
        alert.classList.add('translate-x-full');
        setTimeout(() => {
            if (alert.parentNode) {
                document.body.removeChild(alert);
            }
        }, 300);
    }, 3000);
}

// Auto-hide success message after 5 seconds
setTimeout(() => {
    const messages = document.querySelectorAll('.fixed.bottom-4');
    messages.forEach(msg => {
        msg.style.transition = 'opacity 0.5s';
        msg.style.opacity = '0';
        setTimeout(() => msg.remove(), 500);
    });
}, 5000);
</script>
@endsection
