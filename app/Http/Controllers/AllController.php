<?php
// app/Http/Controllers/AllController.php
namespace App\Http\Controllers;

use App\Models\BotUser;
use App\Models\Evaluation;
use App\Models\Group;
use App\Models\GroupStudent;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllController extends Controller
{
    public function index()
    {
        $phone = request()->query('phone', '+998889442402');
        $normalizedPhone = preg_replace('/[^0-9]/', '', $phone);

        $botUser = BotUser::whereRaw("REPLACE(REPLACE(REPLACE(phone, '+', ''), ' ', ''), '-', '') = ?", [$normalizedPhone])->first();

        if (!$botUser) {
            return view('home', [
                'error' => 'Foydalanuvchi topilmadi.',
                'fullname' => '',
                'groups' => collect(),
                'totalGroups' => 0,
                'attendanceTakenCount' => 0,
                'totalStudents' => 0,
                'activeStudents' => 0,
                'debtorsCount' => 0,
                'totalDebt' => 0,
                'students' => collect(),
            ]);
        }

        $groupCounts = GroupStudent::select('group_id', DB::raw('count(*) as students_count'))
            ->groupBy('group_id')
            ->pluck('students_count', 'group_id');

        $groups = Group::where('bot_user_id', $botUser->id)
            ->orderBy('start_time')
            ->get();

        foreach ($groups as $group) {
            $group->students_count = $groupCounts[$group->id] ?? 0;

            $groupStudentIds = GroupStudent::where('group_id', $group->id)->pluck('id');

            $group->attendance_taken = $groupStudentIds->every(function ($groupStudentId) {
                return Evaluation::where('group_student_id', $groupStudentId)
                    ->where('score', '>', 0)
                    ->exists();
            });
        }

        $students = $botUser->groups->flatMap->students->unique('id');

        return view('home', [
            'fullname' => $botUser->fullname, // ✅ model accessor orqali yuborilyapti
            'groups' => $groups,
            'totalGroups' => $groups->count(),
            'attendanceTakenCount' => $groups->where('attendance_taken', true)->count(),
            'totalStudents' => $students->count(),
            'activeStudents' => $students->where('is_active', true)->count(),
            'debtorsCount' => $students->where('debt', '>', 0)->count(),
            'totalDebt' => $students->sum('debt'),
            'students' => $students,
        ]);
    }




    public function group()
    {
        $phone = request()->query('phone', '+998889442402');
        $normalizedPhone = preg_replace('/[^0-9]/', '', $phone);

        $botUser = BotUser::whereRaw("REPLACE(REPLACE(REPLACE(phone, '+', ''), ' ', ''), '-', '') = ?", [$normalizedPhone])->first();

        if (!$botUser) {
            return view('app', [
                'error' => 'Foydalanuvchi topilmadi.',
                'groups' => collect(),
                'totalGroups' => 0,
                'attendanceTakenCount' => 0,
                'totalStudents' => 0,
                'activeStudents' => 0,
                'debtorsCount' => 0,
                'totalDebt' => 0,
                'students' => collect(),
            ]);
        }

        $groupCounts = GroupStudent::select('group_id', DB::raw('count(*) as students_count'))
            ->groupBy('group_id')
            ->pluck('students_count', 'group_id');


        $groups = Group::where('bot_user_id', $botUser->id)
            ->orderBy('start_time')
            ->get();

        foreach ($groups as $group) {
            $group->students_count = $groupCounts[$group->id] ?? 0;

            $groupStudentIds = GroupStudent::where('group_id', $group->id)->pluck('id');

            $group->attendance_taken = $groupStudentIds->every(function ($groupStudentId) {
                return Evaluation::where('group_student_id', $groupStudentId)
                    ->where('score', '>', 0)
                    ->exists();
            });
        }

        $students = $botUser->groups->flatMap->students->unique('id');

        return view('group', [
            'groups' => $groups,
            'totalGroups' => $groups->count(),
            'attendanceTakenCount' => $groups->where('attendance_taken', true)->count(),
            'totalStudents' => $students->count(),
            'activeStudents' => $students->where('is_active', true)->count(),
            'debtorsCount' => $students->where('debt', '>', 0)->count(),
            'totalDebt' => $students->sum('debt'),
            'students' => $students,
        ]);
    }



    public function debt(Request $request)
    {
        $groupId = $request->query('id');

        $group = Group::find($groupId);
        if (!$group) {
            abort(404, 'Guruh topilmadi');
        }

        $groupStudents = GroupStudent::with(['student', 'debt'])
            ->where('group_id', $groupId)
            ->get();

        return view('Debt', [
            'group' => $group,
            'groupStudents' => $groupStudents,
        ]);
    }

    public function attendance(Request $request)
    {
        $groupId = $request->query('id');

        $group = Group::find($groupId);
        if (!$group) {
            abort(404, 'Guruh topilmadi');
        }

        $today = Carbon::now()->format('Y-m-d');

        $groupStudents = GroupStudent::with(['student'])->where('group_id', $groupId)->get();

        foreach ($groupStudents as $groupStudent) {
            // Bugungi kunga mos Evaluation tekshiriladi
            $evaluationExists = Evaluation::where('group_student_id', $groupStudent->id)
                ->where('date', $today)
                ->where('score', '>', 0)
                ->exists();

            $groupStudent->attendance_status = $evaluationExists ? '✅ Keldi' : '❌ Kelmadi';
        }

        return view('attendance', [
            'group' => $group,
            'groupStudents' => $groupStudents,
            'today' => $today,
        ]);
    }


    public function settings(Request $request)
    {
        $phone = $request->query('phone', '+998889442402');

        $normalizedPhone = preg_replace('/[^0-9]/', '', $phone);

        $botUser = BotUser::whereRaw("
        REPLACE(REPLACE(REPLACE(phone, '+', ''), ' ', ''), '-', '') = ?
    ", [$normalizedPhone])->first();

        if (!$botUser) {
            abort(404, 'Foydalanuvchi topilmadi.');
        }

        return view('settings', [
            'botUser' => $botUser
        ]);
    }

}
