<div class="bg-white p-4 border-b border-gray-200">
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center">
            <i class="fas fa-users text-blue-500 mr-2"></i>
            <h1 class="text-lg font-semibold text-gray-800">O'quvchilar</h1>
            <span class="ml-2 text-sm text-gray-500">{{ $totalStudents }} ta</span>
        </div>
        <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-medium">{{ $totalStudents }}</span>
    </div>

    <!-- Status Cards -->
    <div class="flex gap-3">
        <div class="flex-1 bg-gray-50 rounded-lg p-3">
            <div class="flex items-center mb-1">
                <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                <span class="text-sm text-gray-600">Faol</span>
            </div>
            <div class="text-sm font-bold text-gray-800">{{ $activeStudents }}</div>
        </div>
        <div class="flex-1 bg-gray-50 rounded-lg p-3">
            <div class="flex items-center mb-1">
                <div class="w-2 h-2 bg-red-500 rounded-full mr-2"></div>
                <span class="text-sm text-gray-600">Qarzdor</span>
            </div>
            <div class="text-sm font-bold text-gray-800">{{ $debtorsCount }}</div>
        </div>
        <div class="flex-1 bg-gray-50 rounded-lg p-3">
            <div class="flex items-center mb-1">
                <div class="w-2 h-2 bg-orange-500 rounded-full mr-2"></div>
                <span class="text-sm text-gray-600">Umumiy qarz</span>
            </div>
            <div class="text-sm font-bold text-gray-800">{{ number_format($totalDebt, 0, ',', ' ') }} uzs</div>
        </div>
    </div>

</div>

<div class="p-4 pb-20">
    <div class="space-y-3">
        @foreach($students as $student)
            <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <div class="flex items-center flex-1">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <span class="text-blue-600 font-bold text-sm">
                                {{ strtoupper(Str::substr($student->full_name, 0, 1)) }}{{ strtoupper(Str::substr(Str::after($student->full_name, ' '), 0, 1)) }}
                            </span>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800 mb-1">{{ $student->full_name }}</h3>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-phone mr-1"></i>
                                <span>{{ $student->phone }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-red-500 font-semibold text-sm mb-1">
                            -{{ number_format($student->debt, 0, ',', ' ') }} uzs
                        </div>
                        @if($student->debt > 0)
                            <div class="w-3 h-3 bg-red-500 rounded-full mx-auto"></div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
