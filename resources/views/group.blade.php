<!-- Header -->
@extends('layouts')
@section('content')
    <div id="groups-page" class="page">
        <header class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-md mx-auto px-4 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-users text-gray-600 text-lg"></i>
                        <h1 class="text-lg font-semibold text-gray-900">Guruhlar</h1>
                        {{--                    <span class="text-sm text-gray-500">{{ $totalGroups }} ta guruh</span>--}}
                    </div>
                    <div class="bg-gray-100 rounded-full w-8 h-8 flex items-center justify-center">
                        <span class="text-sm font-medium text-gray-700">{{ $totalGroups }}</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-md mx-auto px-4 py-6 pb-20">
            <!-- Status Cards -->
            <div class="grid grid-cols-3 gap-4 mb-6">
                <!-- Active -->
                <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <span class="text-sm text-gray-600">Aktiv</span>
                    </div>
                    <div class="text-2xl font-bold text-gray-900 mt-2">{{ $groups->where('active', true)->count() }}</div>
                </div>

                <!-- Demo -->
                <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        <span class="text-sm text-gray-600">Demo</span>
                    </div>
                    <div class="text-2xl font-bold text-gray-900 mt-2">
                        {{ $groups->where('name', 'like', '%demo%')->count() }}
                    </div>
                </div>

                <!-- Tugagan -->
                <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
                        <span class="text-sm text-gray-600">Tugagan</span>
                    </div>
                    <div class="text-2xl font-bold text-gray-900 mt-2">
                        {{ $groups->where('active', false)->count() }}
                    </div>
                </div>
            </div>

            <!-- Guruhlar ro'yxati -->

            @foreach ($groups as $group)
                <a href="{{ route('debt', ['id' => $group->id]) }}" class="block mb-3">
                    <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-book-open text-green-600 text-sm"></i>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">{{ $group->name }}</h3>
                                    <p class="text-sm text-gray-500 flex items-center space-x-1">
                                        <i class="fas fa-users text-xs"></i>
                                        <span>{{ $group->students_count }} o'quvchi</span>
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="flex items-center space-x-1">
                                    <div class="w-2 h-2 {{ $group->active ? 'bg-green-500' : 'bg-gray-400' }} rounded-full"></div>
                                    <span class="text-xs text-gray-600">
                                {{ $group->active ? 'Aktiv' : 'Tugagan' }}
                            </span>
                                </div>
                                <i class="fas fa-chevron-right text-gray-400 text-sm"></i>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach


        </main>

    </div>
@endsection

