<!-- Custom Confirmation Modal -->
<div id="cancelModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-[70] hidden transition-all duration-300 ease-in-out">
    <div class="relative top-20 mx-auto p-6 border w-96 shadow-traveloka-lg rounded-2xl bg-white transform transition-all duration-300 ease-in-out scale-95 opacity-0" id="modalContent">
        <div class="text-center">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-6">
                <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">
                Konfirmasi Pembatalan
            </h3>
            <div class="mb-6">
                <p class="text-sm text-gray-500 mb-3">
                    Apakah Anda yakin ingin membatalkan booking ini?
                </p>
                <div class="text-sm text-gray-600 space-y-1">
                    <p><strong>Nama:</strong> <span id="cancelName"></span></p>
                    <p><strong>Jam:</strong> <span id="cancelTime"></span></p>
                </div>
            </div>
            <div class="flex space-x-3">
                <button type="button" onclick="hideCancelModal()"
                    class="flex-1 px-4 py-3 bg-secondary-100 text-secondary-700 font-medium rounded-xl hover:bg-secondary-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary-500 transition-colors duration-200">
                    Batal
                </button>
                <form id="cancelForm" method="POST" action="" class="flex-1" onsubmit="console.log('Form submitting to:', this.action); return true;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-full px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-medium rounded-xl hover:from-red-600 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200 shadow-sm hover:shadow-md flex items-center justify-center">
                        <span id="cancelBtnText">Ya, Batalkan</span>
                        <div id="cancelBtnSpinner" class="spinner hidden ml-2"></div>
                    </button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
