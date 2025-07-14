<?php
// app/Http/Controllers/HomeController.php
namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Student;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Guruhlar statistikasi
        $groups = Group::orderBy('start_time')->get();
        $totalGroups = $groups->count();
        $attendanceTakenCount = $groups->where('attendance_taken', true)->count();

        // O‘quvchilar statistikasi
        $students = Student::all();
        $totalStudents = $students->count();
        $activeStudents = $students->where('is_active', true)->count();
        $debtorsCount = $students->where('debt', '>', 0)->count();
        $totalDebt = $students->sum('debt');

        return view('app', compact(
            'groups',
            'totalGroups',
            'attendanceTakenCount',
            'totalStudents',
            'activeStudents',
            'debtorsCount',
            'totalDebt',
            'students' // o‘quvchilar ro‘yxati (foydalanish uchun)
        ));
    }
}
