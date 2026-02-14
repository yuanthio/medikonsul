@extends('layouts.booking')

@section('title', 'Admin Access')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-50 via-white to-secondary-50 flex items-center justify-center px-4">
    <div class="max-w-md w-full">
        <!-- Admin Access Card -->
        <div class="bg-white rounded-2xl shadow-traveloka-lg overflow-hidden">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-primary-500 to-primary-600 px-8 py-10 text-center">
                <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4 backdrop-blur-sm">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Admin Access</h1>
                <p class="text-primary-100">Service Booking System</p>
            </div>
            
            <!-- Card Content -->
            <div class="p-8">
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-secondary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">Area Terbatas</h2>
                    <p class="text-gray-600 leading-relaxed">
                        Halaman ini hanya dapat diakses oleh administrator yang memiliki otoritas.
                        Silakan login untuk melanjutkan ke dashboard admin.
                    </p>
                </div>
                
                <!-- Action Buttons -->
                <div class="space-y-4">
                    <a href="/admin/login" 
                        class="group relative w-full flex justify-center items-center py-4 px-6 border border-transparent text-base font-semibold rounded-xl text-white bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98] shadow-traveloka">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        <span>Login sebagai Admin</span>
                    </a>
                    
                    <a href="/" 
                        class="group relative w-full flex justify-center items-center py-4 px-6 border-2 border-secondary-200 text-base font-semibold rounded-xl text-secondary-700 bg-white hover:bg-secondary-50 hover:border-secondary-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        <span>Kembali ke Booking</span>
                    </a>
                </div>
                
                <!-- Additional Info -->
                <div class="mt-8 pt-6 border-t border-secondary-100">
                    <div class="flex items-center justify-center text-sm text-secondary-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Butuh bantuan? Hubungi administrator sistem
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer Info -->
        <div class="mt-8 text-center">
            <p class="text-sm text-secondary-500">
                Protected with enterprise-grade security
            </p>
        </div>
    </div>
</div>
@endsection
