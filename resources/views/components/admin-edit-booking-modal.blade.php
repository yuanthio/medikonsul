<!-- Edit Booking Modal -->
<div id="editBookingModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-[60] transition-all duration-300 ease-in-out hidden">
    <div class="flex items-center justify-center min-h-full p-4">
        <div class="relative w-full max-w-md mx-auto p-6 border shadow-traveloka-lg rounded-2xl bg-white transform transition-all duration-300 ease-in-out scale-95 opacity-0" id="editBookingModalContent">
        <div class="text-left">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-semibold text-gray-900">
                    Edit Data Booking
                </h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <div class="max-h-[60vh] overflow-y-auto p-2">
                <form id="editBookingForm" onsubmit="submitEditBooking(event)">
                    @csrf
                    <input type="hidden" id="editBookingId" name="booking_id">
                    <div class="space-y-4">
                    <div>
                        <label for="editBookingDate" class="block text-sm font-medium text-gray-700 mb-1">
                            Tanggal Booking
                        </label>
                        <input type="date" 
                            id="editBookingDate" 
                            name="booking_date" 
                            required
                            min="{{ Carbon\Carbon::today()->toDateString() }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label for="editBookingTime" class="block text-sm font-medium text-gray-700 mb-1">
                            Jam Booking
                        </label>
                        <p class="text-sm text-gray-500 mb-3">Pilih waktu yang tersedia</p>
                        
                        <!-- Current booking info -->
                        <div id="currentBookingInfo" class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg hidden">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-sm text-blue-800">
                                    <strong>Jadwal saat ini:</strong> <span id="currentSlotTime"></span>
                                </span>
                            </div>
                        </div>
                        
                        <!-- Keterangan Warna -->
                        <div class="flex flex-wrap gap-4 text-xs mb-4">
                            <div class="flex items-center gap-2">
                                <div class="w-4 h-4 rounded bg-linear-to-br from-white to-gray-50 border-2 border-gray-300"></div>
                                <span class="text-gray-600">Tersedia</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-4 h-4 rounded bg-blue-100 border-2 border-blue-300"></div>
                                <span class="text-blue-600">Jadwal Saat Ini</span>
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
                        
                        <div id="editTimeSlotsContainer" class="calendly-time-slots">
                            <div class="text-center py-8">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-gray-500 text-sm">Pilih tanggal terlebih dahulu</p>
                                <p class="text-gray-400 text-xs">Waktu tersedia akan muncul</p>
                            </div>
                        </div>
                        <input type="hidden" id="editBookingTime" name="booking_time" required>
                    </div>
                    
                    <div>
                        <label for="editPatientName" class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Pasien
                        </label>
                        <input type="text" 
                            id="editPatientName" 
                            name="name" 
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Masukkan nama pasien">
                    </div>
                    
                    <div>
                        <label for="editPatientPhone" class="block text-sm font-medium text-gray-700 mb-1">
                            Nomor HP
                        </label>
                        <input type="text" 
                            id="editPatientPhone" 
                            name="phone" 
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="0812-3456-7890">
                    </div>
                    
                    <div>
                        <label for="editPatientEmail" class="block text-sm font-medium text-gray-700 mb-1">
                            Email
                        </label>
                        <div class="relative">
                            <input type="email" 
                                id="editPatientEmail" 
                                name="email" 
                                required
                                class="w-full px-3 py-2 pr-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="email@example.com">
                            <div id="editEmailValidationIcon" class="absolute inset-y-0 right-0 flex items-center pr-3 hidden">
                                <!-- Icon will be inserted here -->
                            </div>
                        </div>
                        <p id="editEmailValidationMessage" class="mt-2 text-sm hidden"></p>
                    </div>
                    </div>
                </form>
            </div>
            
            <!-- Fixed Footer Buttons -->
            <div class="pt-4 border-t mt-4">
                <div class="flex space-x-3">
                    <button type="button" onclick="closeEditModal()"
                        class="flex-1 px-4 py-3 bg-secondary-100 text-secondary-700 font-medium rounded-xl hover:bg-secondary-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary-500 transition-colors duration-200">
                        Batal
                    </button>
                    <button type="submit"
                        form="editBookingForm"
                        class="flex-1 px-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-xl hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-sm hover:shadow-md flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span id="editBtnText">Simpan</span>
                        <div id="editBtnSpinner" class="spinner hidden ml-2"></div>
                    </button>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

<script>
let currentEditBooking = null;

function showEditModal(bookingId) {
    fetch(`/admin/bookings/${bookingId}/edit`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                currentEditBooking = data.booking;
                
                // Populate form
                document.getElementById('editBookingId').value = currentEditBooking.id;
                document.getElementById('editPatientName').value = currentEditBooking.name;
                document.getElementById('editPatientPhone').value = currentEditBooking.phone;
                document.getElementById('editPatientEmail').value = currentEditBooking.email;
                document.getElementById('editBookingDate').value = currentEditBooking.booking_date;
                document.getElementById('editBookingTime').value = currentEditBooking.booking_time;
                
                // Show current booking info
                const currentBookingInfo = document.getElementById('currentBookingInfo');
                const currentSlotTime = document.getElementById('currentSlotTime');
                currentBookingInfo.classList.remove('hidden');
                currentSlotTime.textContent = currentEditBooking.booking_time;
                
                // Load available slots for selected date
                loadEditTimeSlots(currentEditBooking.booking_date, currentEditBooking.booking_time);
                
                // Show modal
                const modal = document.getElementById('editBookingModal');
                const content = document.getElementById('editBookingModalContent');
                modal.classList.remove('hidden');
                setTimeout(() => {
                    content.classList.remove('scale-95', 'opacity-0');
                    content.classList.add('scale-100', 'opacity-100');
                }, 10);
            } else {
                showNotification(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Terjadi kesalahan saat mengambil data booking', 'error');
        });
}

function closeEditModal() {
    const modal = document.getElementById('editBookingModal');
    const content = document.getElementById('editBookingModalContent');
    
    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        document.getElementById('editBookingForm').reset();
        currentEditBooking = null;
    }, 300);
}

function loadEditTimeSlots(date, currentTime = null) {
    const container = document.getElementById('editTimeSlotsContainer');
    const hiddenInput = document.getElementById('editBookingTime');
    
    if (!date) {
        container.innerHTML = `
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

    container.innerHTML = `
        <div class="text-center py-8">
            <div class="spinner mx-auto mb-3"></div>
            <p class="text-gray-500 text-sm">Memuat waktu...</p>
        </div>
    `;

    fetch(`/admin/bookings/create?date=${date}`)
        .then(response => response.json())
        .then(data => {
            container.innerHTML = '';
            
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
                        // Check if this is the current booking time
                        if (currentTime && slot.time === currentTime) {
                            timeSlot.classList.add('current-slot', 'selected');
                            hiddenInput.value = currentTime;
                        }
                        timeSlot.addEventListener('click', () => selectEditTimeSlot(slot.time, timeSlot));
                    }
                    
                    container.appendChild(timeSlot);
                });
            } else {
                container.innerHTML = `
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
            container.innerHTML = `
                <div class="text-center py-8">
                    <svg class="w-12 h-12 mx-auto mb-3 text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-red-500 text-sm">Gagal memuat waktu</p>
                </div>
            `;
        });
}

function selectEditTimeSlot(time, element) {
    // Remove previous selection
    document.querySelectorAll('.time-slot.selected').forEach(el => {
        el.classList.remove('selected');
    });
    
    // Add selection to clicked time slot
    element.classList.add('selected');
    document.getElementById('editBookingTime').value = time;
}

// Handle date change
document.getElementById('editBookingDate').addEventListener('change', function() {
    loadEditTimeSlots(this.value);
});

// Handle form submission
function submitEditBooking(event) {
    event.preventDefault();
    
    const formData = new FormData(event.target);
    const bookingId = document.getElementById('editBookingId').value;
    
    // Show loading
    document.getElementById('editBtnText').textContent = 'Menyimpan...';
    document.getElementById('editBtnSpinner').classList.remove('hidden');
    
    fetch(`/admin/bookings/${bookingId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            name: formData.get('name'),
            phone: formData.get('phone'),
            email: formData.get('email'),
            booking_date: formData.get('booking_date'),
            booking_time: formData.get('booking_time')
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification(data.message, 'success');
            closeEditModal();
            // Reload page to show updated data
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        } else {
            showNotification(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan saat memperbarui booking', 'error');
    })
    .finally(() => {
        // Hide loading
        document.getElementById('editBtnText').textContent = 'Simpan Perubahan';
        document.getElementById('editBtnSpinner').classList.add('hidden');
    });
}

// Email validation (optional enhancement)
document.getElementById('editPatientEmail').addEventListener('input', function() {
    const email = this.value;
    const iconContainer = document.getElementById('editEmailValidationIcon');
    const messageElement = document.getElementById('editEmailValidationMessage');
    
    if (email.length > 0) {
        const isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        
        iconContainer.classList.remove('hidden');
        messageElement.classList.remove('hidden');
        
        if (isValid) {
            iconContainer.innerHTML = `
                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
            `;
            messageElement.textContent = 'Email valid';
            messageElement.className = 'mt-2 text-sm text-green-600';
        } else {
            iconContainer.innerHTML = `
                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
            `;
            messageElement.textContent = 'Email tidak valid';
            messageElement.className = 'mt-2 text-sm text-red-600';
        }
    } else {
        iconContainer.classList.add('hidden');
        messageElement.classList.add('hidden');
    }
});
</script>

<style>
/* Custom styles for edit modal current slot indicator */
.time-slot.current-slot {
    background: linear-gradient(135deg, #dbeafe, #bfdbfe);
    border-color: #3b82f6;
    color: #1d4ed8;
    position: relative;
    overflow: hidden;
}

.time-slot.current-slot::after {
    content: '⏰';
    position: absolute;
    top: 4px;
    right: 4px;
    font-size: 12px;
    color: #1d4ed8;
}

.time-slot.current-slot.selected {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
    border-color: #3b82f6;
    box-shadow: 0 12px 35px rgba(59, 130, 246, 0.25);
}

.time-slot.current-slot.selected::after {
    content: '✓';
    color: white;
}
</style>
