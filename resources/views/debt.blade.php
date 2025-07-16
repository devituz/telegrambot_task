@extends('layouts')

@section('content')

    <div class="bg-white p-4 border-b border-gray-200">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center">
                <!-- Back Button -->
                <button onclick="history.back()" class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 hover:bg-gray-200 transition-colors duration-200 mr-3">
                    <i class="fas fa-arrow-left text-gray-600"></i>
                </button>

                <i class="fas fa-users text-blue-500 mr-2"></i>
                <h6 class="text-lg font-semibold text-gray-800">{{ $group->name }}</h6>

            </div>
            <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-medium">
            {{ $groupStudents->count() }}
        </span>
        </div>

        <!-- Status Cards -->
        <div class="flex gap-3">
            <div class="flex-1 bg-gray-50 rounded-lg p-3">
                <div class="flex items-center mb-1">
                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                    <span class="text-sm text-gray-600">Faol</span>
                </div>
                <div class="text-sm font-bold text-gray-800">
                    {{ $groupStudents->where('student.is_active', true)->count() }}
                </div>
            </div>
            <div class="flex-1 bg-gray-50 rounded-lg p-3">
                <div class="flex items-center mb-1">
                    <div class="w-2 h-2 bg-red-500 rounded-full mr-2"></div>
                    <span class="text-sm text-gray-600">Qarzdor</span>
                </div>
                <div class="text-sm font-bold text-gray-800">
                    {{ $groupStudents->whereNotNull('debt')->count() }}
                </div>
            </div>
            <div class="flex-1 bg-gray-50 rounded-lg p-3">
                <div class="flex items-center mb-1">
                    <div class="w-2 h-2 bg-orange-500 rounded-full mr-2"></div>
                    <span class="text-sm text-gray-600">Umumiy qarz</span>
                </div>
                <div class="text-sm font-bold text-gray-800">
                    {{ number_format($groupStudents->sum(fn($gs) => $gs->debt->debt ?? 0), 0, ',', ' ') }} uzs
                </div>
            </div>
        </div>
    </div>


            <div class="space-y-3">
                @foreach ($groupStudents as $groupStudent)
                    @php $student = $groupStudent->student; @endphp
                    <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center flex-1">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                <span class="text-blue-600 font-bold text-sm">
{{ $student->initials }}
                                </span>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-800 mb-1">
                                        {{ $student->first_name }} {{ $student->last_name }}
                                    </h3>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <i class="fas fa-phone mr-1"></i>
                                        <span>{{ $student->phone }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                @if ($groupStudent->debt)
                                    <div class="text-red-500 font-semibold text-sm mb-1">
                                        -{{ number_format($groupStudent->debt->debt, 0, ',', ' ') }} uzs
                                    </div>
                                    <div class="w-3 h-3 bg-red-500 rounded-full mx-auto"></div>
                                @else
                                    <span class="text-green-500 text-sm">Qarzdorlik yo'q</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


@endsection
