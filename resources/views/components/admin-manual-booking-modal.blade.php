<!-- Manual Booking Modal -->
<div id="manualBookingModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-[60] transition-all duration-300 ease-in-out hidden">
    <div class="flex items-center justify-center min-h-full p-4">
        <div class="relative w-full max-w-md mx-auto p-6 border shadow-traveloka-lg rounded-2xl bg-white transform transition-all duration-300 ease-in-out scale-95 opacity-0" id="manualBookingModalContent">
        <div class="text-left">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-semibold text-gray-900">
                    Booking Manual Pasien
                </h3>
                <button onclick="hideManualBookingModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <div class="max-h-[60vh] overflow-y-auto p-2">
                <form id="manualBookingForm" onsubmit="submitManualBooking(event)">
                    @csrf
                    <div class="space-y-4">
                    <div>
                        <label for="bookingDate" class="block text-sm font-medium text-gray-700 mb-1">
                            Tanggal Booking
                        </label>
                        <input type="date" 
                            id="bookingDate" 
                            name="booking_date" 
                            required
                            min="{{ Carbon\Carbon::today()->toDateString() }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                            value="{{ $selectedDate }}">
                    </div>
                    
                    <div>
                        <label for="bookingTime" class="block text-sm font-medium text-gray-700 mb-1">
                            Jam Booking
                        </label>
                        <p class="text-sm text-gray-500 mb-3">Pilih waktu yang tersedia</p>
                        
                        <!-- Keterangan Warna -->
                        <div class="flex flex-wrap gap-4 text-xs mb-4">
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
                        
                        <div id="timeSlotsContainer" class="calendly-time-slots">
                            <div class="text-center py-8">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-gray-500 text-sm">Pilih tanggal terlebih dahulu</p>
                                <p class="text-gray-400 text-xs">Waktu tersedia akan muncul</p>
                            </div>
                        </div>
                        <input type="hidden" id="bookingTime" name="booking_time" required>
                    </div>
                    
                    <div>
                        <label for="patientName" class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Pasien
                        </label>
                        <input type="text" 
                            id="patientName" 
                            name="name" 
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                            placeholder="Masukkan nama pasien">
                    </div>
                    
                    <div>
                        <label for="patientPhone" class="block text-sm font-medium text-gray-700 mb-1">
                            Nomor HP
                        </label>
                        <input type="text" 
                            id="patientPhone" 
                            name="phone" 
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                            placeholder="0812-3456-7890">
                    </div>
                    
                    <div>
                        <label for="patientEmail" class="block text-sm font-medium text-gray-700 mb-1">
                            Email
                        </label>
                        <div class="relative">
                            <input type="email" 
                                id="patientEmail" 
                                name="email" 
                                required
                                class="w-full px-3 py-2 pr-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                placeholder="email@example.com">
                            <div id="emailValidationIcon" class="absolute inset-y-0 right-0 flex items-center pr-3 hidden">
                                <!-- Icon will be inserted here -->
                            </div>
                        </div>
                        <p id="emailValidationMessage" class="mt-2 text-sm hidden"></p>
                    </div>
                    </div>
                </form>
            </div>
            
            <!-- Fixed Footer Buttons -->
            <div class="pt-4 border-t mt-4">
                <div class="flex space-x-3">
                    <button type="button" onclick="hideManualBookingModal()"
                        class="flex-1 px-4 py-3 bg-secondary-100 text-secondary-700 font-medium rounded-xl hover:bg-secondary-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary-500 transition-colors duration-200">
                        Batal
                    </button>
                    <button type="submit"
                        form="manualBookingForm"
                        class="flex-1 px-4 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-medium rounded-xl hover:from-green-600 hover:to-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 shadow-sm hover:shadow-md flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span id="manualBtnText">Buat Booking</span>
                        <div id="manualBtnSpinner" class="spinner hidden ml-2"></div>
                    </button>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
