@extends('layouts')
@section('content')

    <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-4 pb-6">
        <div class="flex items-center mb-4">
            <div class="w-8 h-8 bg-orange-400 rounded-full flex items-center justify-center mr-3">
                <i class="fas fa-user text-white text-sm"></i>
            </div>
            <div>
                <div class="flex items-center">
                    <i class="fas fa-crown text-yellow-400 mr-2"></i>
                    <span class="font-semibold">Xayrli tong</span>
                </div>
                <div class="text-blue-100 text-sm" id="user-fullname">{{ $fullname }} </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="flex gap-3">
            <div class="flex-1 bg-blue-400 bg-opacity-50 rounded-lg p-3">
                <div class="text-blue-100 text-xs mb-1">Bugungi guruhlar</div>
                <div class="flex items-center">
                    <i class="fas fa-flag text-orange-400 mr-2"></i>
                    <span class="text-xl font-bold">{{ $totalGroups }}</span>
                </div>
            </div>
            <div class="flex-1 bg-blue-400 bg-opacity-50 rounded-lg p-3">
                <div class="text-blue-100 text-xs mb-1">Davomat olingan</div>
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-400 mr-2"></i>
                    <span class="text-xl font-bold">{{ $attendanceTakenCount }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="p-4 pb-20">
        <!-- Section Header -->
        <div class="flex items-center mb-4">
            <i class="fas fa-book text-gray-500 mr-2"></i>
            <h2 class="text-gray-800 font-semibold">Bugungi darslar</h2>
        </div>

        <!-- Lesson Cards -->
        <div class="space-y-3">
            @foreach ($groups as $group)
                <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center flex-1">
                            <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-graduation-cap text-white"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-800">{{ $group->name }}</h3>
                                <div class="flex items-center text-sm text-gray-500">
                                    @if ($group->attendance_taken)
                                        <i class="fas fa-check-circle text-green-500 mr-1"></i>
                                        <span>Davomat olingan</span>
                                    @else
                                        <i class="fas fa-times-circle text-red-500 mr-1"></i>
                                        <span>Davomat olinmagan</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-blue-500 font-semibold text-lg">
                                {{ \Carbon\Carbon::parse($group->start_time)->format('H:i') }}
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between mt-3">
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-users mr-1"></i>
                            <span>{{ $group->students_count }}</span>
                        </div>
                        <a href="{{route('attendance',['id' => $group->id])}}"
                            class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-medium hover:bg-blue-600 transition-colors">
                            {{ $group->attendance_taken ? "Ko'rish" : "Davomat olish" }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Advice Card -->
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mt-6">
            <div class="flex items-start">
                <div class="w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center mr-3 mt-1">
                    <i class="fas fa-lightbulb text-white text-sm"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-800 mb-1">Maslahat</h4>
                    <p class="text-sm text-gray-600">
                        Darsdan keyingi o'quvchilar bilan individual ish olib boring
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection

