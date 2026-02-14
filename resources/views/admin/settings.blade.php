@extends('layouts.admin')

@section('title', 'Pengaturan - Admin')

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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        Pengaturan
                    </h1>
                    <p class="text-gray-600 mt-1 text-sm sm:text-base">Kelola konfigurasi sistem booking</p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Settings Form -->
        <div class="bg-white rounded-2xl shadow-traveloka-lg overflow-hidden border border-secondary-100">
            <div class="px-6 py-4 border-b border-secondary-100">
                <h2 class="text-lg font-semibold text-gray-900">Jam Operasional Konsultasi</h2>
                <p class="text-sm text-secondary-600 mt-1">Atur jam buka dan berakhir layanan konsultasi</p>
            </div>
            
            <form method="POST" action="/admin/settings" class="p-6 space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Jam Buka -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                    <div>
                        <label for="opening_time" class="block text-sm font-semibold text-gray-700 mb-2">
                            <svg class="w-4 h-4 inline mr-2 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Jam Buka Konsultasi
                        </label>
                        <div class="relative">
                            <input type="time" 
                                   id="opening_time" 
                                   name="opening_time" 
                                   value="{{ config('booking.opening_time', '09:00') }}"
                                   required
                                   class="w-full px-4 py-3 border border-secondary-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200">
                        </div>
                        <p class="text-xs text-secondary-500 mt-1">Jam mulai layanan konsultasi</p>
                    </div>
                    
                    <!-- Jam Berakhir -->
                    <div>
                        <label for="closing_time" class="block text-sm font-semibold text-gray-700 mb-2">
                            <svg class="w-4 h-4 inline mr-2 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Jam Berakhir Konsultasi
                        </label>
                        <div class="relative">
                            <input type="time" 
                                   id="closing_time" 
                                   name="closing_time" 
                                   value="{{ config('booking.closing_time', '17:00') }}"
                                   required
                                   class="w-full px-4 py-3 border border-secondary-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200">
                        </div>
                        <p class="text-xs text-secondary-500 mt-1">Jam selesai layanan konsultasi</p>
                    </div>
                </div>

                <!-- Durasi Slot -->
                <div>
                    <label for="slot_duration" class="block text-sm font-semibold text-gray-700 mb-2">
                        <svg class="w-4 h-4 inline mr-2 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Durasi per Slot (menit)
                    </label>
                    <div class="relative">
                        <select id="slot_duration" 
                                name="slot_duration" 
                                required
                                class="w-full px-4 py-3 border border-secondary-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200">
                            <option value="15" {{ config('booking.slot_duration', 30) == 15 ? 'selected' : '' }}>15 menit</option>
                            <option value="30" {{ config('booking.slot_duration', 30) == 30 ? 'selected' : '' }}>30 menit</option>
                            <option value="45" {{ config('booking.slot_duration', 30) == 45 ? 'selected' : '' }}>45 menit</option>
                            <option value="60" {{ config('booking.slot_duration', 30) == 60 ? 'selected' : '' }}>60 menit</option>
                        </select>
                    </div>
                    <p class="text-xs text-secondary-500 mt-1">Durasi waktu untuk setiap slot booking</p>
                </div>

                <!-- Preview Jam Operasional -->
                <div class="bg-primary-50 rounded-xl p-4 border border-primary-200">
                    <h3 class="text-sm font-semibold text-primary-900 mb-3 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Preview Jam Operasional
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                        <div class="flex items-center justify-between bg-white rounded-lg p-3">
                            <span class="text-gray-600">Jam Buka:</span>
                            <span id="preview_opening" class="font-semibold text-primary-600">{{ config('booking.opening_time', '09:00') }}</span>
                        </div>
                        <div class="flex items-center justify-between bg-white rounded-lg p-3">
                            <span class="text-gray-600">Jam Berakhir:</span>
                            <span id="preview_closing" class="font-semibold text-primary-600">{{ config('booking.closing_time', '17:00') }}</span>
                        </div>
                        <div class="flex items-center justify-between bg-white rounded-lg p-3">
                            <span class="text-gray-600">Durasi Slot:</span>
                            <span id="preview_duration" class="font-semibold text-primary-600">{{ config('booking.slot_duration', 30) }} menit</span>
                        </div>
                        <div class="flex items-center justify-between bg-white rounded-lg p-3">
                            <span class="text-gray-600">Total Slot:</span>
                            <span id="preview_slots" class="font-semibold text-primary-600">16 slot</span>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-4">
                    <button type="submit" 
                            id="saveButton"
                            disabled
                            class="px-6 py-3 bg-gray-400 text-white font-semibold rounded-xl cursor-not-allowed opacity-60 transition-all duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span id="saveBtnText">Simpan Pengaturan</span>
                        <div id="saveBtnSpinner" class="spinner hidden ml-2"></div>
                    </button>
                </div>
            </form>
        </div>
</div>

<style>
/* Spinner styles */
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

/* Notification styles */
.settings-notification {
    position: fixed;
    top: 4px;
    right: 4px;
    z-index: 50;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.settings-notification.fade-out {
    opacity: 0;
    transform: translateX(100%) scale(0.95);
}
</style>

<script>
// Store initial values
const initialValues = {
    opening_time: document.getElementById('opening_time').value,
    closing_time: document.getElementById('closing_time').value,
    slot_duration: document.getElementById('slot_duration').value
};

// Update preview when form values change
document.getElementById('opening_time').addEventListener('change', function() {
    updatePreview();
    checkForChanges();
});
document.getElementById('closing_time').addEventListener('change', function() {
    updatePreview();
    checkForChanges();
});
document.getElementById('slot_duration').addEventListener('change', function() {
    updatePreview();
    checkForChanges();
});

function checkForChanges() {
    const currentValues = {
        opening_time: document.getElementById('opening_time').value,
        closing_time: document.getElementById('closing_time').value,
        slot_duration: document.getElementById('slot_duration').value
    };
    
    const hasChanges = 
        currentValues.opening_time !== initialValues.opening_time ||
        currentValues.closing_time !== initialValues.closing_time ||
        currentValues.slot_duration !== initialValues.slot_duration;
    
    const saveButton = document.getElementById('saveButton');
    
    if (hasChanges) {
        saveButton.disabled = false;
        saveButton.className = 'px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 text-white font-semibold rounded-xl hover:from-primary-600 hover:to-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200 shadow-sm hover:shadow-md flex items-center';
    } else {
        saveButton.disabled = true;
        saveButton.className = 'px-6 py-3 bg-gray-400 text-white font-semibold rounded-xl cursor-not-allowed opacity-60 transition-all duration-200 flex items-center';
    }
}

function updatePreview() {
    const openingTime = document.getElementById('opening_time').value;
    const closingTime = document.getElementById('closing_time').value;
    const slotDuration = parseInt(document.getElementById('slot_duration').value);
    
    document.getElementById('preview_opening').textContent = openingTime;
    document.getElementById('preview_closing').textContent = closingTime;
    document.getElementById('preview_duration').textContent = slotDuration + ' menit';
    
    // Calculate total slots
    if (openingTime && closingTime) {
        const [openHour, openMin] = openingTime.split(':').map(Number);
        const [closeHour, closeMin] = closingTime.split(':').map(Number);
        
        const openMinutes = openHour * 60 + openMin;
        const closeMinutes = closeHour * 60 + closeMin;
        const totalMinutes = closeMinutes - openMinutes;
        const totalSlots = Math.floor(totalMinutes / slotDuration);
        
        document.getElementById('preview_slots').textContent = totalSlots + ' slot';
    }
}

// Show notification function
function showSettingsNotification(message, type) {
    // Remove any existing notifications first
    const existingNotifications = document.querySelectorAll('.settings-notification');
    existingNotifications.forEach(notification => notification.remove());
    
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `settings-notification fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-300 translate-x-full`;
    
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

// Handle form submission with AJAX
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form[action="/admin/settings"]');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitButton = document.getElementById('saveButton');
            const btnText = document.getElementById('saveBtnText');
            const btnSpinner = document.getElementById('saveBtnSpinner');
            
            // Show loading state
            btnText.textContent = 'Menyimpan...';
            btnSpinner.classList.remove('hidden');
            submitButton.disabled = true;
            
            // Create FormData
            const formData = new FormData(form);
            formData.append('_method', 'PUT');
            
            // Submit via AJAX
            fetch('/admin/settings', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showSettingsNotification('Pengaturan berhasil disimpan!', 'success');
                    
                    // Update initial values to new values
                    initialValues.opening_time = document.getElementById('opening_time').value;
                    initialValues.closing_time = document.getElementById('closing_time').value;
                    initialValues.slot_duration = document.getElementById('slot_duration').value;
                    
                    // Reset button state
                    checkForChanges();
                } else {
                    showSettingsNotification(data.message || 'Gagal menyimpan pengaturan', 'error');
                }
            })
            .catch(error => {
                console.error('Error saving settings:', error);
                showSettingsNotification('Terjadi kesalahan saat menyimpan pengaturan', 'error');
            })
            .finally(() => {
                // Reset button state
                btnText.textContent = 'Simpan Pengaturan';
                btnSpinner.classList.add('hidden');
                submitButton.disabled = false;
            });
        });
    }
});

// Initialize preview on page load
updatePreview();
</script>
@endsection
