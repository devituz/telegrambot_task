@extends('layouts')

@section('content')

    <div class="max-w-md mx-auto bg-white min-h-screen">
        <!-- Header -->
        <div class="bg-white px-4 py-6 border-b border-gray-200">
            <div class="flex justify-between items-start mb-2">
                <button onclick="history.back()" class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 hover:bg-gray-200 transition-colors duration-200 mr-3">
                    <i class="fas fa-arrow-left text-gray-600"></i>
                </button>
                <div>
                    <h1 class="text-lg font-semibold text-gray-800">Davomat - {{ $group->name }}</h1>
                    <p class="text-sm text-gray-500">{{ $today }}</p>
                </div>
                <div class="text-right">
                    <div class="text-sm text-gray-500">
                        {{ $groupStudents->where('evaluation_status', '✅ Keldi')->count() }}/{{ $groupStudents->count() }}
                    </div>
                    <div class="text-sm text-gray-500">
                        {{ floor($groupStudents->where('evaluation_status', '✅ Keldi')->count() / max($groupStudents->count(),1) * 100) }}%
                    </div>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="px-4 py-4">

            <input type="hidden" name="group_id" value="{{ $group->id }}">

            <div class="space-y-4">
                @foreach ($groupStudents as $groupStudent)
                    @php $student = $groupStudent->student; @endphp

                    <div class="bg-white rounded-lg border border-gray-200 p-4">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 bg-{{ $groupStudent->evaluation_status == '✅ Keldi' ? 'success' : 'danger' }} text-white rounded-full flex items-center justify-center font-medium">
                                    {{ $student->initials }}
                                </div>
                                <div>
                                    <div class="font-medium text-gray-800">{{ $student->full_name }}</div>
                                    <div class="text-sm text-gray-500">ID: {{ $student->id }}</div>
                                </div>
                            </div>
                            <span class="bg-{{ $groupStudent->evaluation_status == '✅ Keldi' ? 'green-100 text-success' : 'red-100 text-danger' }} px-3 py-1 rounded-full text-sm font-medium">
                                {{ $groupStudent->evaluation_status }}
                            </span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-sm text-gray-500 mb-1">Baho</label>
                                <input type="text"   placeholder="Baho..."
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm text-gray-500 mb-1">Izoh</label>
                                <input type="text"
                                       placeholder="Izoh..."
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-5 pb-7">
                <button type="submit"
                        class="w-full bg-blue-500 text-white py-4 px-4 rounded-lg font-medium hover:bg-blue-600 transition-colors flex items-center justify-center gap-2">
                    <span>📋</span>
                    Davomatini saqlash
                </button>
            </div>
        </div>
    </div>

@endsection
