<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\InsightController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AcademicController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ScheduleController;


// Public routes
Route::post('/login', [AuthController::class, 'login']);

// Health check
Route::get('/health', function () {
    return response()->json([
        'status' => 'healthy',
        'db' => 'connected',
        'timestamp' => now()
    ]);
});

// Protected routes
Route::middleware('auth.cookie')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::put('/profile', [AuthController::class, 'updateProfile']);

    // Admin Only
    Route::middleware('role:admin')->group(function () {
        Route::post('/users/register', [AuthController::class, 'register']);
        Route::apiResource('/classes', ClassController::class);
        Route::apiResource('/subjects', SubjectController::class);
        Route::apiResource('/teachers', TeacherController::class);
        Route::apiResource('/parents', ParentController::class);
        Route::apiResource('/students', StudentController::class);
        Route::get('/academic-hierarchy', [AcademicController::class, 'index']);
        Route::post('/academic/grade-subject', [AcademicController::class, 'storeGradeSubject']);
        Route::post('/academic/grade', [AcademicController::class, 'storeGrade']);
        Route::post('/academic/section', [AcademicController::class, 'storeSection']);
        Route::delete('/academic/grade', [AcademicController::class, 'destroyGrade']);
        Route::delete('/academic/section/{id}', [AcademicController::class, 'destroySection']);
        Route::delete('/academic/grade-subject', [AcademicController::class, 'destroyGradeSubject']);
        Route::put('/academic/grade', [AcademicController::class, 'updateGrade']);
        Route::put('/academic/section/{id}', [AcademicController::class, 'updateSection']);
        Route::put('/academic/subject/{id}', [AcademicController::class, 'updateSubject']);
        Route::apiResource('/schedules', ScheduleController::class);
    });







    // Admin & Teacher
    Route::middleware('role:admin,teacher')->group(function () {
        Route::get('/classes/{id}', [ClassController::class, 'show']);
        Route::get('/teacher/classes', [ClassController::class, 'teacherClasses']);
        Route::post('/attendance', [AttendanceController::class, 'store']);
        Route::post('/grades', [GradeController::class, 'store']);
        Route::apiResource('/homework', HomeworkController::class);
        Route::apiResource('/exams', ExamController::class);
        Route::post('/announcements', [AnnouncementController::class, 'store']);
    });

    // Student & Parent
    Route::middleware('role:student,parent,teacher,admin')->group(function () {
        Route::get('/attendance/my', [AttendanceController::class, 'myAttendance']);
        Route::get('/grades/my', [GradeController::class, 'myGrades']);
        Route::get('/homework/my', [HomeworkController::class, 'myHomework']);
        Route::get('/announcements', [AnnouncementController::class, 'index']);
    });

    // Parent Specific
    Route::middleware('role:parent')->group(function () {
        Route::get('/parent/children', [ParentController::class, 'getChildren']);
        Route::get('/parent/recommendations', [ParentController::class, 'getRecommendations']);
        Route::post('/parent/recommendations', [ParentController::class, 'storeRecommendation']);
    });

    // Analytics
    Route::prefix('analytics')->group(function () {
        Route::get('/admin/overview', [AnalyticsController::class, 'adminOverview'])->middleware('role:admin');
        Route::get('/classes', [ClassController::class, 'index']);
        Route::get('/teachers', [TeacherController::class, 'index'])->middleware('role:admin');
        Route::get('/students', [StudentController::class, 'index'])->middleware('role:admin');
        Route::get('/parents', [ParentController::class, 'index'])->middleware('role:admin');
        Route::get('/teacher/overview', [AnalyticsController::class, 'teacherOverview'])->middleware('role:teacher');
    });

    // Insights
    Route::get('/insights', [InsightController::class, 'index']);

    // Feedback
    Route::apiResource('/feedback', FeedbackController::class);
});