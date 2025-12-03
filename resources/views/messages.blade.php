@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 px-4 sm:px-0">Messages</h1>
    <p class="text-gray-600 mb-6 px-4 sm:px-0">Chat with other farmers in your community</p>

    <!-- Daftar Percakapan -->
    <div class="bg-white rounded-lg shadow divide-y divide-gray-200">
        <!-- Contoh Percakapan 1 -->
        <div class="flex items-center p-4 hover:bg-gray-50 cursor-pointer" onclick="document.getElementById('chatModal').classList.remove('hidden')">
            <img class="h-12 w-12 rounded-full mr-4" src="https://images.unsplash.com/photo-1535713875002-d1d0cf8c95b1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Pak Budi Avatar">
            <div class="flex-1">
                <div class="flex justify-between items-center">
                    <p class="font-semibold text-gray-800">Pak Budi</p>
                    <p class="text-xs text-gray-500">10 min ago</p>
                </div>
                <p class="text-sm text-gray-600 truncate">Thank you! The rice seeds you recommended are growing well.</p>
            </div>
            <div class="flex items-center ml-4 space-x-2">
                <span class="px-2 py-0.5 rounded-full bg-red-500 text-white text-xs font-semibold">2</span>
                <button class="text-gray-400 hover:text-green-700 p-2 rounded-full hover:bg-gray-100">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                </button>
                <button class="text-gray-400 hover:text-green-700 p-2 rounded-full hover:bg-gray-100">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                </button>
            </div>
        </div>

        <!-- Contoh Percakapan 2 -->
        <div class="flex items-center p-4 hover:bg-gray-50 cursor-pointer" onclick="document.getElementById('chatModal').classList.remove('hidden')">
            <img class="h-12 w-12 rounded-full mr-4" src="https://images.unsplash.com/photo-1494790108377-be9c29b29329?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Ibu Sri Avatar">
            <div class="flex-1">
                <div class="flex justify-between items-center">
                    <p class="font-semibold text-gray-800">Ibu Sri</p>
                    <p class="text-xs text-gray-500">2 hours ago</p>
                </div>
                <p class="text-sm text-gray-600 truncate">Can we arrange a meeting next week?</p>
            </div>
            <div class="flex items-center ml-4 space-x-2">
                <button class="text-gray-400 hover:text-green-700 p-2 rounded-full hover:bg-gray-100">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                </button>
                <button class="text-gray-400 hover:text-green-700 p-2 rounded-full hover:bg-gray-100">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                </button>
            </div>
        </div>

        <!-- Contoh Percakapan 3 -->
        <div class="flex items-center p-4 hover:bg-gray-50 cursor-pointer" onclick="document.getElementById('chatModal').classList.remove('hidden')">
            <img class="h-12 w-12 rounded-full mr-4" src="https://images.unsplash.com/photo-1570295999919-c6552ed2a87e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Pak Ahmad Avatar">
            <div class="flex-1">
                <div class="flex justify-between items-center">
                    <p class="font-semibold text-gray-800">Pak Ahmad</p>
                    <p class="text-xs text-gray-500">1 day ago</p>
                </div>
                <p class="text-sm text-gray-600 truncate">Your vegetables look great!</p>
            </div>
            <div class="flex items-center ml-4 space-x-2">
                <button class="text-gray-400 hover:text-green-700 p-2 rounded-full hover:bg-gray-100">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                </button>
                <button class="text-gray-400 hover:text-green-700 p-2 rounded-full hover:bg-gray-100">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Chat Detail (disembunyikan secara default) -->
    <div id="chatModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-10 mx-auto p-5 border w-full max-w-md shadow-lg rounded-lg bg-white">
            <div class="flex items-center justify-between pb-4 border-b border-gray-200">
                <div class="flex items-center">
                    <img class="h-10 w-10 rounded-full mr-3" src="https://images.unsplash.com/photo-1535713875002-d1d0cf8c95b1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Pak Budi Avatar">
                    <h3 class="text-lg font-medium text-gray-900">Pak Budi</h3>
                </div>
                <div class="flex items-center space-x-2">
                    <button class="text-gray-500 hover:text-green-700 p-2 rounded-full hover:bg-gray-100" onclick="document.getElementById('audioCallModal').classList.remove('hidden'); document.getElementById('chatModal').classList.add('hidden');">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    </button>
                    <button class="text-gray-500 hover:text-green-700 p-2 rounded-full hover:bg-gray-100" onclick="document.getElementById('videoCallModal').classList.remove('hidden'); document.getElementById('chatModal').classList.add('hidden');">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                    </button>
                    <button onclick="document.getElementById('chatModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 p-2 rounded-full hover:bg-gray-100">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>

            <!-- Chat Bubbles -->
            <div class="py-4 space-y-4 h-80 overflow-y-auto">
                <!-- Pesan dari pengguna lain -->
                <div class="flex justify-start">
                    <img class="h-8 w-8 rounded-full mr-3" src="https://images.unsplash.com/photo-1535713875002-d1d0cf8c95b1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Pak Budi Avatar">
                    <div class="bg-gray-200 p-3 rounded-lg max-w-xs">
                        <p class="text-sm text-gray-800">Hello! How is your harvest going?</p>
                        <p class="text-xs text-gray-500 text-right mt-1">Yesterday</p>
                    </div>
                </div>
                <!-- Pesan dari Anda -->
                <div class="flex justify-end">
                    <div class="btn-primary text-white p-3 rounded-lg max-w-xs"> {{-- Menggunakan btn-primary untuk bubble chat Anda --}}
                        <p class="text-sm">It's going great! The new irrigation system is working well.</p>
                        <p class="text-xs text-right mt-1">Yesterday</p>
                    </div>
                </div>
                <!-- Pesan dari pengguna lain -->
                <div class="flex justify-start">
                    <img class="h-8 w-8 rounded-full mr-3" src="https://images.unsplash.com/photo-1535713875002-d1d0cf8c95b1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Pak Budi Avatar">
                    <div class="bg-gray-200 p-3 rounded-lg max-w-xs">
                        <p class="text-sm text-gray-800">Thank you! The rice seeds you recommended are growing well.</p>
                        <p class="text-xs text-gray-500 text-right mt-1">10 min ago</p>
                    </div>
                </div>
            </div>

            <!-- Input Pesan -->
            <div class="pt-4 border-t border-gray-200">
                <div class="flex items-center">
                    <input type="text" placeholder="Type your message..." class="flex-1 rounded-full border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50 py-2 px-4">
                    <button class="ml-2 btn-primary p-3 rounded-full">
                        <svg class="h-5 w-5 rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Audio Call (disembunyikan secara default) -->
    <div id="audioCallModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden flex items-center justify-center">
        <div class="relative p-5 border w-80 shadow-lg rounded-md bg-white text-center">
            <div class="flex justify-between items-center mb-4">
                <span class="font-semibold text-green-700 flex items-center">
                    <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Starting audio call with Pak Budi...
                </span>
                <button onclick="document.getElementById('audioCallModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <img class="h-24 w-24 rounded-full mx-auto mb-4" src="https://images.unsplash.com/photo-1535713875002-d1d0cf8c95b1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Pak Budi Avatar">
            <p class="font-semibold text-xl text-gray-800">Pak Budi</p>
            <p class="text-gray-500 mb-6">00:01</p>
            <div class="flex justify-center space-x-4">
                <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 p-4 rounded-full">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </button>
                <button class="bg-red-500 hover:bg-red-600 text-white p-4 rounded-full">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0h4"></path></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Video Call (disembunyikan secara default) -->
    <div id="videoCallModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden flex items-center justify-center">
        <div class="relative p-5 border w-full max-w-md shadow-lg rounded-md bg-white text-center">
            <div class="flex justify-between items-center mb-4">
                <span class="font-semibold text-green-700 flex items-center">
                    <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Starting video call with Pak Budi...
                </span>
                <button onclick="document.getElementById('videoCallModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <div class="relative w-full h-48 bg-gray-300 rounded-lg mb-4 flex items-center justify-center text-gray-500">
                Your video
                <div class="absolute bottom-2 right-2 w-24 h-16 bg-gray-400 rounded-md border border-white">
                    <img class="w-full h-full object-cover rounded-md" src="https://images.unsplash.com/photo-1535713875002-d1d0cf8c95b1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Pak Budi Video">
                </div>
            </div>
            <p class="font-semibold text-xl text-gray-800">Pak Budi</p>
            <p class="text-gray-500 mb-6">00:01</p>
            <div class="flex justify-center space-x-4">
                <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 p-4 rounded-full">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </button>
                <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 p-4 rounded-full">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                </button>
                <button class="bg-red-500 hover:bg-red-600 text-white p-4 rounded-full">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection