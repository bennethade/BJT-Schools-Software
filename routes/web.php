<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssignClassTeacherController;
use App\Http\Controllers\AssignStudentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CBTController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\ClassTimetableController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\CommunicationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExaminationsController;
use App\Http\Controllers\FeesCollectionController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\HumanresourceController;
use App\Http\Controllers\IDCardController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\ProcurementController;
use App\Http\Controllers\PTCController;
use App\Http\Controllers\ReportcardController;
use App\Http\Controllers\RoleManagementController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentSubjectController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubjectTeacherController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('', [AuthController::class, 'login'])->name('login');

Route::post('login', [AuthController::class, 'authLogin'])->name('authLogin');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
Route::post('forgot-password', [AuthController::class, 'postForgotPassword'])->name('post.forgot-password');
Route::get('reset/{token}', [AuthController::class, 'reset'])->name('reset');
Route::post('reset/{token}', [AuthController::class, 'postReset'])->name('postReset');




//===COMMON ROUTE GROUP===///
Route::group(['middleware' => 'common'], function(){
    Route::get('chat', [ChatController::class,'chat'])->name('chat');
    Route::get('under_development', [DashboardController::class,'underDevelopment'])->name('under_development');



    Route::get('/cobena', function(){
        return view('report_card.cobena_nursery_report_card');
    });



    // Route::get('/cobena', function(){
    //     return view('report_card.cobena_primary_report_card');
    // });

    // Route::get('/fees-breakdown', function(){
    //     return view('report_card.fees_breakdown');
    // });

});




//===ADMIN ROUTE GROUP===///
Route::group(['middleware' => 'admin'], function(){


    Route::get('admin/dashboard', [DashboardController::class,'dashboard'])->name('admin.dashboard');


    Route::get('admin/comment_bank', [DashboardController::class,'commentBank'])->name('admin.comment_bank');

    Route::get('admin/report_card', [ReportcardController::class,'reportCard'])->name('admin.report_card');





    Route::get('admin/admin/list', [AdminController::class,'list'])->name('admin.list');
    Route::get('admin/admin/add', [AdminController::class,'add'])->name('admin.add');
    Route::post('admin/admin/add', [AdminController::class,'insert'])->name('admin.insert');
    Route::get('admin/admin/edit/{id}', [AdminController::class,'edit'])->name('admin.edit');
    Route::post('admin/admin/edit/{id}', [AdminController::class,'update'])->name('admin.update');
    Route::delete('admin/admin/delete/{id}', [AdminController::class,'delete'])->name('admin.delete');




    //DESIGNATION ROUTES
    Route::get('admin/designation/list', [AdminController::class,'designationList'])->name('designation.list');
    Route::get('admin/designation/add', [AdminController::class,'designationAdd'])->name('designation.add');
    Route::post('admin/designation/insert', [AdminController::class,'designationInsert'])->name('designation.insert');
    Route::get('admin/designation/edit/{id}', [AdminController::class,'designationEdit'])->name('designation.edit');
    Route::post('admin/designation/edit/{id}', [AdminController::class,'designationUpdate'])->name('designation.update');
    Route::delete('admin/designation/delete/{id}', [AdminController::class,'designationDelete'])->name('designation.delete');

    

    //TEACHER ROUTES
    Route::get('admin/teacher/list', [TeacherController::class,'list'])->name('teacher.list');
    Route::get('admin/teacher/add', [TeacherController::class,'add'])->name('teacher.add');
    Route::post('admin/teacher/add', [TeacherController::class,'insert'])->name('teacher.insert');
    Route::get('admin/teacher/edit/{id}', [TeacherController::class,'edit'])->name('teacher.edit');
    Route::post('admin/teacher/edit/{id}', [TeacherController::class,'update'])->name('teacher.update');
    Route::delete('admin/teacher/delete/{id}', [TeacherController::class,'delete'])->name('teacher.delete');




    
    //STUDENT ROUTES
    Route::get('admin/student/list', [StudentController::class,'list'])->name('student.list');
    Route::get('admin/student/add', [StudentController::class,'add'])->name('student.add');
    Route::post('admin/student/add', [StudentController::class,'insert'])->name('student.insert');
    Route::get('admin/student/edit/{id}', [StudentController::class,'edit'])->name('student.edit');
    Route::post('admin/student/edit/{id}', [StudentController::class,'update'])->name('student.update');
    Route::delete('admin/student/delete/{id}', [StudentController::class,'delete'])->name('student.delete');




    //PARENT ROUTES
    Route::get('admin/parent/list', [ParentController::class,'list'])->name('parent.list');
    Route::get('admin/parent/add', [ParentController::class,'add'])->name('parent.add');
    Route::post('admin/parent/add', [ParentController::class,'insert'])->name('parent.insert');
    Route::get('admin/parent/edit/{id}', [ParentController::class,'edit'])->name('parent.edit');
    Route::post('admin/parent/edit/{id}', [ParentController::class,'update'])->name('parent.update');
    Route::delete('admin/parent/delete/{id}', [ParentController::class,'delete'])->name('parent.delete');
    Route::get('admin/parent/my-student/{id}', [ParentController::class,'myStudent'])->name('parent.my.student');
    Route::get('admin/parent/assign_student_to_parent/{student_id}/{parent_id}', [ParentController::class,'assignStudentToParent'])->name('parent.assign.student');
    Route::get('admin/parent/delete_assign_student_to_parent/{student_id}', [ParentController::class,'deleteAssignStudentToParent'])->name('delete.parent.assigned.student');


    



    // ClASS ROUTES
    Route::get('admin/class/list', [ClassController::class,'list'])->name('class.list');
    Route::get('admin/class/add', [ClassController::class,'add'])->name('class.add');
    Route::post('admin/class/add', [ClassController::class,'insert'])->name('class.insert');
    Route::get('admin/class/edit/{id}', [ClassController::class,'edit'])->name('class.edit');
    Route::post('admin/class/edit/{id}', [ClassController::class,'update'])->name('class.update');
    Route::delete('admin/class/delete/{id}', [ClassController::class,'delete'])->name('class.delete');



    //SUBJECT ROUTES
    Route::get('admin/subject/list', [SubjectController::class,'list'])->name('subject.list');
    Route::get('admin/subject/add', [SubjectController::class,'add'])->name('subject.add');
    Route::post('admin/subject/add', [SubjectController::class,'insert'])->name('subject.insert');
    Route::get('admin/subject/edit/{id}', [SubjectController::class,'edit'])->name('subject.edit');
    Route::post('admin/subject/edit/{id}', [SubjectController::class,'update'])->name('subject.update');
    Route::delete('admin/subject/delete/{id}', [SubjectController::class,'delete'])->name('subject.delete');




    //SUBJECT CATEGORY ROUTES
    Route::get('admin/subject_category/list', [SubjectController::class,'categoryList'])->name('subject.category.list');
    Route::get('admin/subject_category/add', [SubjectController::class,'categoryAdd'])->name('subject.category.add');
    Route::post('admin/subject_category/add', [SubjectController::class,'categoryInsert'])->name('subject.category.insert');
    Route::get('admin/subject_category/edit/{id}', [SubjectController::class,'categoryEdit'])->name('subject.category.edit');
    Route::post('admin/subject_category/edit/{id}', [SubjectController::class,'categoryUpdate'])->name('subject.category.update');
    Route::delete('admin/subject_category/delete/{id}', [SubjectController::class,'categoryDelete'])->name('subject.category.delete');




    //ASSIGN SUBJECT ROUTES
    Route::get('admin/assign_subject/list', [ClassSubjectController::class,'list'])->name('assign_subject.list');
    Route::get('admin/assign_subject/add', [ClassSubjectController::class,'add'])->name('assign_subject.add');
    Route::post('admin/assign_subject/add', [ClassSubjectController::class,'insert'])->name('assign_subject.insert');

    Route::get('admin/assign_subject/edit_single/{id}', [ClassSubjectController::class,'editSingle'])->name('assign_subject.edit_single');
    Route::post('admin/assign_subject/edit_single/{id}', [ClassSubjectController::class,'updateSingle'])->name('assign_subject.update_single');

    Route::get('admin/assign_subject/mass_edit/{id}', [ClassSubjectController::class,'massEdit'])->name('assign_subject.mass_edit');
    Route::post('admin/assign_subject/mass_edit/{id}', [ClassSubjectController::class,'massUpdate'])->name('assign_subject.mass_update');

    Route::delete('admin/assign_subject/delete/{id}', [ClassSubjectController::class,'delete'])->name('assign_subject.delete');







    //ASSIGN STUDENT TO CLASS ROUTES
    Route::get('admin/assign_student', [AssignStudentController::class,'view'])->name('assign_student');
    Route::get('admin/assign_student/term_list/{class_id}', [AssignStudentController::class,'termList'])->name('assign_student.term_list');
    Route::get('admin/assign_student/student_list/{class_id}/{exam_id}', [AssignStudentController::class,'studentList'])->name('assign_student.student_list');
    Route::get('admin/assign_student/student_list/{class_id}/{exam_id}/{student_id}', [AssignStudentController::class,'assignNow'])->name('assign_student.assign_now');
    Route::get('admin/assign_student/edit/{student_id}', [AssignStudentController::class,'editClassStudent'])->name('assign_student.edit.student');
    Route::post('admin/assign_student/edit/{student_id}', [AssignStudentController::class,'updateClassStudent'])->name('assign_student.update.student');
    Route::get('admin/assign_student/student_list/remove/{class_id}/{exam_id}/{student_id}', [AssignStudentController::class,'removeAssignedStudent'])->name('assign_student.remove');


    

    //CREATE NURSERY SUBJECT ROUTES
    Route::get('admin/nursery_subjects/view/{class_id}/{exam_id}', [SubjectController::class,'nurserySubjectView'])->name('nursery.subject.view');
    Route::post('admin/nursery_subjects/view/{class_id}/{exam_id}', [SubjectController::class,'nurserySubjectSubmit'])->name('nursery.subject.submit');
    Route::put('admin/nursery_subjects/view/{id}', [SubjectController::class, 'nurserySubjectUpdate'])->name('nursery.subject.update');
    
    


    //MID TERM NURSERY SUBJECT ROUTES
    Route::get('admin/midterm/nursery_subjects/view/{class_id}/{exam_id}', [SubjectController::class,'midtermNurserySubjectView'])->name('midterm.nursery.subject.view');
    Route::post('admin/midterm/nursery_subjects/view/{class_id}/{exam_id}', [SubjectController::class,'midtermNurserySubjectSubmit'])->name('midterm.nursery.subject.submit');
    Route::put('admin/midterm/nursery_subjects/view/{id}', [SubjectController::class, 'midtermNurserySubjectUpdate'])->name('midterm.nursery.subject.update');







    //VIEW STUDENT'S SUBJECTS
    Route::get('admin/student_subject/subject_list/view_subjects/{class_id}/{exam_id}/{student_id}', [StudentSubjectController::class,'view'])->name('student_subject.view');
    Route::post('admin/student_subject/subject_list/view_subjects/{class_id}/{exam_id}/{student_id}', [StudentSubjectController::class,'assignAllSubjects'])->name('student_subject.assign_all_subjects');
    Route::get('admin/student_subject/subject_list/delete_subject/{assign_subject_id}', [StudentSubjectController::class,'deleteSubjects'])->name('student_subject.delete.subject');
    Route::get('admin/student_subject/subject_list/delete_all_subject/{class_id}/{exam_id}/{student_id}', [StudentSubjectController::class,'deleteAllSubjects'])->name('student_subject.delete.all.subject');




    //LOCK OR UNLOCK STUDENT
    Route::get('admin/assign_student/student_list/unlock_student/{class_id}/{exam_id}/{student_id}', [AssignStudentController::class,'unlockStudent'])->name('assign_student.unlock_student');
    Route::get('admin/assign_student/student_list/lock_student/{class_id}/{exam_id}/{student_id}', [AssignStudentController::class,'lockStudent'])->name('assign_student.lock_student');




    
    //FOR SEARCH BAR
    Route::get('/autoComplete',[AssignStudentController::class,'autoComplete'])->name('autoComplete');
    Route::post('admin/assign_student/student_list',[AssignStudentController::class,'searchService'])->name('searchService');
    //NOT IN USE YET





    //SUBJECT TEACHER ROUTES
    Route::get('admin/subject_teacher', [SubjectTeacherController::class,'view'])->name('subject_teacher.view');
    Route::get('admin/subject_teacher/add', [SubjectTeacherController::class,'add'])->name('subject_teacher.add');
    Route::post('admin/subject_teacher/add', [SubjectTeacherController::class,'insert'])->name('subject_teacher.insert');
    Route::get('admin/subject_teacher/mass_edit/{id}', [SubjectTeacherController::class,'massEdit'])->name('subject_teacher.mass_edit');
    Route::post('admin/subject_teacher/mass_edit/{id}', [SubjectTeacherController::class,'massUpdate'])->name('subject_teacher.mass_update');
    Route::delete('admin/subject_teacher/delete/{id}', [SubjectTeacherController::class,'delete'])->name('subject_teacher.delete');



    
    
    //STUDENT PROMOTION
    Route::get('admin/promote_students', [AssignStudentController::class,'promotionView'])->name('promote_students.view');
    Route::post('admin/promote_students', [AssignStudentController::class,'promotionSubmit'])->name('promote_students.submit');
    




    //CLASS TIMETABLE ROUTES
    Route::get('admin/class_timetable/list', [ClassTimetableController::class,'list'])->name('class_timetable.list');
    Route::post('admin/class_timetable/get_subject', [ClassTimetableController::class,'getSubject'])->name('class_timetable.get_subject');
    Route::post('admin/class_timetable/add', [ClassTimetableController::class,'insert_update'])->name('class_timetable.insert');




    //STUDENTS IN TERM ROUTES
    Route::get('admin/students_in_term', [AssignStudentController::class,'studentsInTerm'])->name('students_in_term');




    // PTC ROUTES
    Route::get('admin/ptc', [PTCController::class, 'ptcView'])->name('ptc.view');
    Route::post('admin/ptc/single_submit_ptc', [PTCController::class, 'saveSinglePTC'])->name('ptc.submit');
    Route::get('admin/ptc/view_single/{class_id}/{exam_id}/{student_id}', [PTCController::class, 'ptcViewSingle'])->name('ptc.view_single');
    Route::post('admin/ptc/view_single/{class_id}/{exam_id}/{student_id}', [PTCController::class, 'ptcViewSingleUpdate'])->name('ptc.view_single.update');
    Route::get('admin/ptc/print_single', [PTCController::class, 'ptcPrintSingle'])->name('ptc.print_single');


    


    //MY ACCOUNT
    Route::get('admin/account', [UserController::class,'myAccount'])->name('admin.account');
    Route::post('admin/account', [UserController::class,'updateMyAdminAccount'])->name('update.admin.account');

    Route::get('admin/setting', [UserController::class,'setting'])->name('admin.setting');
    Route::post('admin/setting', [UserController::class,'updateSetting'])->name('admin.setting.update');



    //CHANGE PASSWORD
    Route::get('admin/change_password', [UserController::class,'changePassword'])->name('change_password');
    Route::post('admin/change_password', [UserController::class,'updatePassword'])->name('update_password');
    



    //ASSIGN CLASS TEACHER ROUTES
    Route::get('admin/assign_class_teacher/list', [AssignClassTeacherController::class,'list'])->name('assign_class_teacher.list');
    Route::get('admin/assign_class_teacher/add', [AssignClassTeacherController::class,'add'])->name('assign_class_teacher.add');
    Route::post('admin/assign_class_teacher/add', [AssignClassTeacherController::class,'insert'])->name('assign_class_teacher.insert');
    Route::get('admin/assign_class_teacher/mass_edit/{id}', [AssignClassTeacherController::class,'massEdit'])->name('assign_class_teacher.mass_edit');
    Route::post('admin/assign_class_teacher/mass_edit/{id}', [AssignClassTeacherController::class,'massUpdate'])->name('assign_class_teacher.mass_update');
    Route::get('admin/assign_class_teacher/edit_single/{id}', [AssignClassTeacherController::class,'editSingle'])->name('assign_class_teacher.edit_single');
    Route::post('admin/assign_class_teacher/edit_single/{id}', [AssignClassTeacherController::class,'updateSingle'])->name('assign_class_teacher.update_single');
    Route::delete('admin/assign_class_teacher/delete/{id}', [AssignClassTeacherController::class,'delete'])->name('assign_class_teacher.delete');




    ///EXAMINATION ROUTES
    Route::get('admin/examinations/exam/list', [ExaminationsController::class,'examList'])->name('examinations.list');
    Route::get('admin/examinations/exam/add', [ExaminationsController::class,'examAdd'])->name('examinations.add');
    Route::post('admin/examinations/exam/add', [ExaminationsController::class,'examInsert'])->name('examinations.insert');
    Route::get('admin/examinations/exam/edit/{id}', [ExaminationsController::class,'examEdit'])->name('examinations.edit');
    Route::post('admin/examinations/exam/edit/{id}', [ExaminationsController::class,'examUpdate'])->name('examinations.update');
    Route::delete('admin/examinations/exam/delete/{id}', [ExaminationsController::class,'examDelete'])->name('examinations.delete');


    //Exam Schedule
    Route::get('admin/examinations/exam_schedule', [ExaminationsController::class,'examSchedule'])->name('examinations.exam_schedule');
    Route::post('admin/examinations/exam_schedule_insert', [ExaminationsController::class,'examScheduleInsert'])->name('examinations.exam_schedule.insert');


    //Marks Register
    Route::get('admin/examinations/marks_register', [ExaminationsController::class,'marksRegister'])->name('examinations.marks_register');
    Route::POST('admin/examinations/submit_marks_register', [ExaminationsController::class,'submitMarksRegister'])->name('examinations.submit_marks_register');
    Route::POST('admin/examinations/single_submit_marks_register', [ExaminationsController::class,'singleSubmitMarksRegister'])->name('examinations.single_submit_marks_register');

    Route::get('admin/my_exam_result/print', [ExaminationsController::class,'myExamResultPrint'])->name('admin.my_exam_result.print');

    Route::get('admin/my_ca_result/print', [ExaminationsController::class,'myCaResultPrint'])->name('admin.my_ca_result.print');

    Route::get('admin/examinations/cumulative_exam_result/print', [ExaminationsController::class,'myCumulativeExamResultPrint'])->name('admin.my_exam_result.cumulative.print');



    //Behavior Chart
    Route::get('admin/examinations/behavior_chart', [ExaminationsController::class,'behaviorChart'])->name('examinations.behavior_chart');
    Route::post('admin/examinations/behavior_chart', [ExaminationsController::class,'behaviorChartSubmit'])->name('examinations.behavior_chart.submit');




    //Nursery Exam Goals Radio Buttons
    Route::get('admin/examinations/nursery_goals', [ExaminationsController::class,'nurseryGoals'])->name('examinations.nursery_goals');
    Route::post('admin/ajax_get_student', [ExaminationsController::class,'ajax_get_student'])->name('examinations.ajax_get_student');
    Route::post('admin/examinations/save_subject_goal', [ExaminationsController::class, 'saveSubjectGoal'])->name('examinations.save_subject_goal');



    //Nursery Midterm Goal Radio Buttons
    Route::get('admin/examinations/nursery_midterm', [ExaminationsController::class,'nurseryMidtermGoal'])->name('examinations.nursery_midterm.goals');
    Route::post('admin/ajax_get_student', [ExaminationsController::class,'ajax_get_student'])->name('examinations.ajax_get_student');
    Route::post('admin/examinations/save_midterm_goal', [ExaminationsController::class, 'saveMidtermGoal'])->name('examinations.save_midterm.goal');




    //Nursery Result Print
    Route::get('admin/examinations/print_nursery_goals', [ExaminationsController::class, 'printNurseryGoal'])->name('examinations.nursery_goals.print');

    
    //Nursery Mid Term Result Print
    Route::get('admin/examinations/print_nursery_midterm_goals', [ExaminationsController::class, 'printNurseryMidtermGoal'])->name('examinations.nursery_midterm_goals.print');




    //Nursery Subject Comment
    Route::get('admin/examinations/subject_comment', [ExaminationsController::class,'subjectComment'])->name('examinations.subject_comment');
    Route::post('admin/examinations/single_submit_subject_comment', [ExaminationsController::class, 'saveSingleSubjectComment'])->name('examinations.save_single_subject_comment');


    


    //Marks Grade
    Route::get('admin/examinations/marks_grade', [ExaminationsController::class,'marksGrade'])->name('examinations.marks_grade');
    Route::get('admin/examinations/marks_grade/add', [ExaminationsController::class,'marksGradeAdd'])->name('examinations.marks_grade.add');
    Route::post('admin/examinations/marks_grade/add', [ExaminationsController::class,'marksGradeInsert'])->name('examinations.marks_grade.insert');
    Route::get('admin/examinations/marks_grade/edit/{id}', [ExaminationsController::class,'marksGradeEdit'])->name('examinations.marks_grade.edit');
    Route::post('admin/examinations/marks_grade/edit/{id}', [ExaminationsController::class,'marksGradeUpdate'])->name('examinations.marks_grade.update');
    Route::get('admin/examinations/marks_grade/delete/{id}', [ExaminationsController::class,'marksGradeDelete'])->name('examinations.marks_grade.delete');





    //ATTENDANCE ROUTES
    
    //Teacher Attendance
    Route::get('admin/attendance/teacher', [AttendanceController::class,'teacherAttendance'])->name('attendance.teacher.view');
    Route::get('admin/attendance/teacher/add', [AttendanceController::class,'addTeacherAttendance'])->name('attendance.teacher.add');
    Route::post('admin/attendance/teacher/add', [AttendanceController::class,'submitTeacherAttendance'])->name('attendance.teacher.submit');

    Route::get('admin/attendance/teacher_report', [AttendanceController::class,'teacherAttendanceReport'])->name('attendance.teacher.report');

    Route::get('admin/attendance/teacher_report/today', [AttendanceController::class,'todayReport'])->name('attendance.teacher.today_report');
    Route::get('admin/attendance/teacher_report/weekly', [AttendanceController::class,'weeklyReport'])->name('attendance.teacher.weekly_report');
    Route::get('admin/attendance/teacher_report/monthly', [AttendanceController::class,'monthlyReport'])->name('attendance.teacher.monthly_report');

    Route::get('admin/attendance/teacher_report/today_late_comers', [AttendanceController::class,'todayLateComers'])->name('attendance.teacher.today_late_comers');
    Route::get('admin/attendance/teacher_report/weekly_late_comers', [AttendanceController::class,'weeklyLateComers'])->name('attendance.teacher.weekly_late_comers');
    Route::get('admin/attendance/teacher_report/monthly_late_comers', [AttendanceController::class,'monthlyLateComers'])->name('attendance.teacher.monthly_late_comers');

    Route::get('admin/attendance/teacher_report/today_early_leavers', [AttendanceController::class,'todayEarlyLeavers'])->name('attendance.teacher.today_early_leavers');
    Route::get('admin/attendance/teacher_report/weekly_early_leavers', [AttendanceController::class,'weeklyEarlyLeavers'])->name('attendance.teacher.weekly_early_leavers');
    Route::get('admin/attendance/teacher_report/monthly_early_leavers', [AttendanceController::class,'monthlyEarlyLeavers'])->name('attendance.teacher.monthly_early_leavers');


    //Student Attendance
    Route::get('admin/attendance/student', [AttendanceController::class,'studentAttendance'])->name('attendance.student');
    Route::post('admin/attendance/student/save', [AttendanceController::class,'studentAttendanceSubmit'])->name('attendance.student.submit');

    Route::get('admin/attendance/report', [AttendanceController::class,'attendanceReport'])->name('attendance.report');






    //COMMUNICATION ROUTES

    //Notice Board
    Route::get('admin/communication/notice_board', [CommunicationController::class,'noticeBoard'])->name('communication.notice_board.list');
    Route::get('admin/communication/notice_board/add', [CommunicationController::class,'addNoticeBoard'])->name('communication.notice_board.add');
    Route::post('admin/communication/notice_board/add', [CommunicationController::class,'insertNoticeBoard'])->name('communication.notice_board.insert');
    Route::get('admin/communication/notice_board/edit/{id}', [CommunicationController::class,'editNoticeBoard'])->name('communication.notice_board.edit');
    Route::post('admin/communication/notice_board/edit/{id}', [CommunicationController::class,'updateNoticeBoard'])->name('communication.notice_board.update');
    Route::get('admin/communication/notice_board/delete/{id}', [CommunicationController::class,'deleteNoticeBoard'])->name('communication.notice_board.delete');


    //Send Email
    Route::get('admin/communication/send_email', [CommunicationController::class,'sendEmail'])->name('communication.send_email');
    Route::post('admin/communication/send_email', [CommunicationController::class,'sendEmailUser'])->name('communication.send_email_user');

    Route::get('admin/communication/news_letter', [CommunicationController::class,'newsLetter'])->name('communication.news_letter');
    Route::post('admin/communication/news_letter', [CommunicationController::class,'newsLetterUser'])->name('communication.news_letter_user');

    
    Route::post('admin/communication/send-report-card', [CommunicationController::class,'sendReportCard'])->name('communication.send_report_card');

    Route::get('admin/communication/search_user', [CommunicationController::class,'searchUser'])->name('communication.search_user');





    //HOMEWORK ROUTES
    Route::get('admin/homework/homework', [HomeworkController::class,'homework'])->name('homework.homework');
    Route::get('admin/homework/homework/add', [HomeworkController::class,'add'])->name('homework.add');
    Route::post('admin/ajax_get_subject', [HomeworkController::class,'ajax_get_subject'])->name('ajax_get_subject');
    Route::post('admin/homework/homework/add', [HomeworkController::class,'insert'])->name('homework.insert');
    Route::get('admin/homework/homework/edit/{id}', [HomeworkController::class,'edit'])->name('homework.edit');
    Route::post('admin/homework/homework/edit/{id}', [HomeworkController::class,'update'])->name('homework.update');
    Route::get('admin/homework/homework/delete/{id}', [HomeworkController::class,'delete'])->name('homework.delete');

    Route::get('admin/homework/homework/submitted/{id}', [HomeworkController::class,'submitted'])->name('homework.submitted');
    
    Route::get('admin/homework/homework_report', [HomeworkController::class,'homeworkReport'])->name('homework.homework_report');





    //FEES COLLECTION ROUTES
    Route::get('admin/fees_collection/collect_fees', [FeesCollectionController::class,'collectFees'])->name('fees_collection.collect_fees');
    Route::get('admin/fees_collection/collect_fees/add_fees/{student_id}', [FeesCollectionController::class,'addFeesCollection'])->name('fees_collection.add_collect_fees');
    Route::post('admin/fees_collection/collect_fees/add_fees/{student_id}', [FeesCollectionController::class,'addFeesInsert'])->name('fees_collection.add_collect_fees.insert');
    Route::get('admin/fees_collection/collect_fees_repot', [FeesCollectionController::class,'collectFeesReport'])->name('fees_collection.collect_fees_repot');

    //Fees Breakdown
    Route::get('admin/fees_collection/fees_breakdown', [FeesCollectionController::class,'feesBreakdown'])->name('fees_collection.fees_breakdown');

    //Class Fee
    Route::get('admin/fees_collection/class_fees', [FeesCollectionController::class,'classFeeView'])->name('fees_collection.class_fee.view');
    Route::post('admin/fees_collection/class_fees', [FeesCollectionController::class,'classFeeSubmit'])->name('fees_collection.class_fee.submit');


    //Fee Extras
    Route::get('admin/fees_collection/extra_fees', [FeesCollectionController::class,'extraFeesView'])->name('fees_collection.extra_fees.view');
    Route::post('admin/fees_collection/extra_fees', [FeesCollectionController::class,'extraFeesSubmit'])->name('fees_collection.extra_fees.submit');







    //ID CARD ROUTES
    Route::get('admin/id_card/student', [IDCardController::class,'studentIDList'])->name('student.id_list');
    Route::get('admin/id_card/student/print/{student_id}', [IDCardController::class,'studentIDPrint'])->name('student.id_print');
    Route::get('admin/id_card/teacher', [IDCardController::class,'teacherIDList'])->name('teacher.id_list');
    Route::get('admin/id_card/teacher/print/{teacher_id}', [IDCardController::class,'teacherIDPrint'])->name('teacher.id_print');





    //LOGIN DETAILS ROUTES
    Route::get('admin/login_details/student', [UserController::class,'studentLoginDetails'])->name('student.login.details');
    Route::get('admin/login_details/teacher', [UserController::class,'teacherLoginDetails'])->name('teacher.login.details');
    Route::get('admin/login_details/parent', [UserController::class,'parentLoginDetails'])->name('parent.login.details');





    //PROCUREMENT ROUTES
    Route::get('admin/procurement/item_list', [ProcurementController::class,'itemList'])->name('procurement.item.list');
    Route::get('admin/procurement/item_add', [ProcurementController::class,'itemAdd'])->name('procurement.item.add');
    Route::post('admin/procurement/item_add', [ProcurementController::class,'itemStore'])->name('procurement.item.store');
    Route::get('admin/procurement/item_edit/{id}', [ProcurementController::class,'itemEdit'])->name('procurement.item.edit');
    Route::post('admin/procurement/item_edit/{id}', [ProcurementController::class,'itemUpdate'])->name('procurement.item.update');
    Route::get('admin/procurement/item_delete/{id}', [ProcurementController::class,'itemDelete'])->name('procurement.item.delete');




    
    //HUMAN RESOURCE ROUTES
    Route::get('admin/human_resource/employee_leave', [HumanresourceController::class,'leaveList'])->name('employee.leave.list');
    Route::get('admin/human_resource/employee_leave/add', [HumanresourceController::class,'leaveAdd'])->name('employee.leave.add');
    Route::post('admin/human_resource/employee_leave/add', [HumanresourceController::class,'leaveStore'])->name('employee.leave.store');
    Route::get('admin/human_resource/employee_leave/edit/{id}', [HumanresourceController::class,'leaveEdit'])->name('employee.leave.edit');
    Route::post('admin/human_resource/employee_leave/edit/{id}', [HumanresourceController::class,'leaveUpdate'])->name('employee.leave.upload');
    Route::get('admin/human_resource/employee_leave/delete/{id}', [HumanresourceController::class,'leaveDelete'])->name('employee.leave.delete');

    Route::get('admin/human_resource/leave_requests', [HumanresourceController::class,'leaveRequests'])->name('employee.leave.requests');
    Route::get('admin/human_resource/leave_request/approve/{id}', [HumanresourceController::class,'leaveRequestApprove'])->name('employee.leave.request.approve');
    Route::get('admin/human_resource/leave_request/reject/{id}', [HumanresourceController::class,'leaveRequestReject'])->name('employee.leave.request.reject');







    //ROLE MANAGEMENT ROUTES
    Route::get('admin/role_management', [RoleManagementController::class,'show'])->name('role.management.view');
    Route::post('admin/role_management', [RoleManagementController::class,'store'])->name('role.management.store');
 
 
    




    //CBT ROUTES
    Route::get('admin/cbt/all_cbt', [CBTController::class,'viewAll'])->name('cbt.view.all');
    Route::post('admin/cbt/all_cbt', [CBTController::class,'CBTSubmit'])->name('cbt.submit');
    Route::get('admin/cbt/cbt_edit/{id}', [CBTController::class,'editCBT'])->name('cbt.edit');
    Route::post('admin/cbt/cbt_edit/{id}', [CBTController::class, 'updateCBT'])->name('cbt.update');
    Route::delete('admin/cbt/delete/{id}', [CBTController::class,'deleteCBT'])->name('cbt.delete');


    Route::get('admin/cbt/view_questions/{id}', [CBTController::class,'viewQuestions'])->name('cbt.view_questions');
    Route::post('admin/cbt/view_questions/{id}', [CBTController::class, 'storeQuestions'])->name('cbt.questions.store');

    Route::get('admin/assigned_list/list', [CBTController::class,'assignedList'])->name('cbt.assigned.list');


    Route::get('admin/cbt/assign/{id}', [CBTController::class,'assignCBT'])->name('cbt.assign');
    Route::post('admin/cbt/assign/{cbt_exam_id}', [CBTController::class, 'storeAssignCBT'])->name('cbt.assign.store');

    Route::get('admin/assigned_list/edit/{id}', [CBTController::class, 'editAssignCBT'])->name('cbt.assigned_list.edit');
    Route::put('admin/assigned_list/update/{id}', [CBTController::class, 'updateAssignCBT'])->name('cbt.assigned_list.update');

    Route::delete('admin/cbt/assign/delete/{id}', [CBTController::class,'deleteAssignedCBT'])->name('cbt.assign.delete');

    Route::get('admin/cbt_score/view', [CBTController::class,'cbtScoreView'])->name('cbt.score.view');
    Route::get('admin/cbt_score/list/{class_id}/{exam_id}/{cbt_exam_id}', [CBTController::class,'cbtScoreList'])->name('cbt.score.list');

    Route::delete('admin/student/cbt/reset/{class_id}/{exam_id}/{cbt_exam_id}/{student_id}', [CBTController::class,'singleStudentCBTReset'])->name('single.student.cbt.reset');
    Route::delete('admin/student/cbt/resetAll/{class_id}/{exam_id}/{cbt_exam_id}', [CBTController::class,'studentCBTResetAll'])->name('single.student.cbt.resetAll');







    // SCHOOL CLUB ROUTES
    Route::get('admin/school_club/list',[ClubController::class, 'list'])->name('club.list');
    Route::get('admin/school_club/add',[ClubController::class, 'add'])->name('club.add');
    Route::post('admin/school_club/insert',[ClubController::class, 'insert'])->name('club.insert');
    Route::get('admin/school_club/edit/{id}',[ClubController::class, 'edit'])->name('club.edit');
    Route::post('admin/school_club/edit/{id}',[ClubController::class, 'update'])->name('club.update');
    Route::delete('admin/school_club/delete/{id}',[ClubController::class, 'delete'])->name('club.delete');
    




    //SUGGESTION ROUTES
    
    Route::get('admin/suggestion/list',[SuggestionController::class, 'list'])->name('suggestion.list');
    Route::get('admin/suggestion/add',[SuggestionController::class, 'add'])->name('suggestion.add');
    Route::post('admin/suggestion/insert',[SuggestionController::class, 'insert'])->name('suggestion.insert');
    Route::get('admin/suggestion/edit/{id}',[SuggestionController::class, 'edit'])->name('suggestion.edit');
    Route::post('admin/suggestion/update/{id}',[SuggestionController::class, 'update'])->name('suggestion.update');








    //AWARD ROUTES
    Route::get('admin/award/view',[AwardController::class, 'view'])->name('award.view');
    Route::post('admin/award/view', [AwardController::class,'awardSubmit'])->name('award.submit');
    Route::get('admin/award/view_single/{class_id}/{exam_id}/{student_id}', [AwardController::class,'viewSingle'])->name('award.view.single');
    Route::get('admin/award/print_single/early_bird', [AwardController::class,'printEarlyBird'])->name('award.print.early_bird');
    Route::get('admin/award/print_single/neatest_pupil', [AwardController::class,'printNeatestPupil'])->name('award.print.neatest_pupil');
    Route::get('admin/award/print_single/best_behaved_pupil', [AwardController::class,'printBestBehavedPupil'])->name('award.print.best_behaved_pupil');















    



});
//===ADMIN ROUTE GROUP END===///










//===OTHER ROLES DASHBOARD ROUTE GROUP===///
Route::group(['middleware' => 'other_roles'], function(){

    Route::get('other_roles/dashboard', [DashboardController::class,'dashboard'])->name('other_roles.dashboard');

    Route::get('other_roles/change_password', [UserController::class,'changePassword'])->name('other_roles.change_password');
    Route::post('other_roles/change_password', [UserController::class,'updatePassword'])->name('other_roles.update_password');


    Route::get('other_roles/account', [UserController::class,'myAccount'])->name('other_roles.account');
    Route::post('other_roles/account', [UserController::class,'updateMyAccount'])->name('update.other_roles.account');




    Route::get('other_roles/my_notice_board', [CommunicationController::class,'myNoticeBoardTeacher'])->name('other_roles.my_notice_board');

    Route::get('other_roles/comment_bank', [CommunicationController::class,'commentBank'])->name('other_roles.comment_bank');




    //SUBJECT TEACHER
    Route::get('other_roles/subject_teacher', [SubjectTeacherController ::class,'show'])->name('other_roles.subject_teacher.view');
    


    
    //Marks Register
    Route::get('other_roles/examinations/marks_register', [ExaminationsController::class,'marksRegister'])->name('other_roles.marks_register');
    Route::POST('other_roles/examinations/submit_marks_register', [ExaminationsController::class,'submitMarksRegister'])->name('other_roles.submit_marks_register');
    Route::POST('other_roles/single_submit_marks_register', [ExaminationsController::class,'singleSubmitMarksRegister'])->name('other_roles.single_submit_marks_register');

    Route::get('other_roles/my_exam_result/print', [ExaminationsController::class,'myExamResultPrint'])->name('other_roles.my_exam_result.print');



    //Behavior Chart
    Route::get('other_roles/examinations/behavior_chart', [ExaminationsController::class,'behaviorChart'])->name('other_roles.behavior_chart');
    Route::post('other_roles/examinations/behavior_chart', [ExaminationsController::class,'behaviorChartSubmit'])->name('other_roles.behavior_chart.submit');
    



    //ATTENDANCE ROUTES
    
    //Teacher Attendance
    Route::get('other_roles/attendance/teacher', [AttendanceController::class,'teacherAttendance'])->name('other_roles.attendance.teacher.view');
    Route::get('other_roles/attendance/teacher/add', [AttendanceController::class,'addTeacherAttendance'])->name('other_roles.attendance.teacher.add');
    Route::post('other_roles/attendance/teacher/add', [AttendanceController::class,'submitTeacherAttendance'])->name('other_roles.attendance.teacher.submit');

    Route::get('other_roles/attendance/teacher_report', [AttendanceController::class,'teacherAttendanceReport'])->name('other_roles.attendance.teacher.report');

    Route::get('other_roles/attendance/teacher_report/today', [AttendanceController::class,'todayReport'])->name('other_roles.attendance.teacher.today_report');
    Route::get('other_roles/attendance/teacher_report/weekly', [AttendanceController::class,'weeklyReport'])->name('other_roles.attendance.teacher.weekly_report');
    Route::get('other_roles/attendance/teacher_report/monthly', [AttendanceController::class,'monthlyReport'])->name('other_roles.attendance.teacher.monthly_report');

    Route::get('other_roles/attendance/teacher_report/today_late_comers', [AttendanceController::class,'todayLateComers'])->name('other_roles.attendance.teacher.today_late_comers');
    Route::get('other_roles/attendance/teacher_report/weekly_late_comers', [AttendanceController::class,'weeklyLateComers'])->name('other_roles.attendance.teacher.weekly_late_comers');
    Route::get('other_roles/attendance/teacher_report/monthly_late_comers', [AttendanceController::class,'monthlyLateComers'])->name('other_roles.attendance.teacher.monthly_late_comers');

    Route::get('other_roles/attendance/teacher_report/today_early_leavers', [AttendanceController::class,'todayEarlyLeavers'])->name('other_roles.attendance.teacher.today_early_leavers');
    Route::get('other_roles/attendance/teacher_report/weekly_early_leavers', [AttendanceController::class,'weeklyEarlyLeavers'])->name('other_roles.attendance.teacher.weekly_early_leavers');
    Route::get('other_roles/attendance/teacher_report/monthly_early_leavers', [AttendanceController::class,'monthlyEarlyLeavers'])->name('other_roles.attendance.teacher.monthly_early_leavers');


    
    //HOMEWORK ROUTES
    Route::get('other_roles/homework/homework', [HomeworkController::class,'homework'])->name('other_roles.homework.homework');
    Route::get('other_roles/homework/homework/add', [HomeworkController::class,'add'])->name('other_roles.homework.add');
    Route::post('other_roles/ajax_get_subject', [HomeworkController::class,'ajax_get_subject'])->name('other_roles.ajax_get_subject');
    Route::post('other_roles/homework/homework/add', [HomeworkController::class,'insert'])->name('other_roles.homework.insert');
    Route::get('other_roles/homework/homework/edit/{id}', [HomeworkController::class,'edit'])->name('other_roles.homework.edit');
    Route::post('other_roles/homework/homework/edit/{id}', [HomeworkController::class,'update'])->name('other_roles.homework.update');
    Route::get('other_roles/homework/homework/delete/{id}', [HomeworkController::class,'delete'])->name('other_roles.homework.delete');

    Route::get('other_roles/homework/homework/submitted/{id}', [HomeworkController::class,'submitted'])->name('other_roles.homework.submitted');
    
    Route::get('other_roles/homework/homework_report', [HomeworkController::class,'homeworkReport'])->name('other_roles.homework.homework_report');




    
    //LEAVE REQUEST ROUTES
    Route::get('other_roles/leave_list', [HumanresourceController::class,'teacherLeaveList'])->name('other_roles.leave.list');
    Route::get('other_roles/leave/request', [HumanresourceController::class,'teacherLeaveRequest'])->name('other_roles.leave.request');
    Route::post('other_roles/leave/request', [HumanresourceController::class,'teacherLeaveRequestStore'])->name('other_roles.leave.request.store');









    
});
//===OTHER ROLES ROUTE GROUP END===///














//===TEACHER DASHBOARD ROUTE GROUP===///
Route::group(['middleware' => 'teacher'], function(){

    Route::get('teacher/dashboard', [DashboardController::class,'dashboard'])->name('teacher.dashboard');
    
    Route::get('teacher/change_password', [UserController::class,'changePassword'])->name('change_password');
    Route::post('teacher/change_password', [UserController::class,'updatePassword'])->name('update_password');


    Route::get('teacher/account', [UserController::class,'myAccount'])->name('teacher.account');
    Route::post('teacher/account', [UserController::class,'updateMyAccount'])->name('update.teacher.account');


    // Route::get('teacher/my_student', [StudentController::class,'myStudent'])->name('teacher.my_student');

    // Route::get('teacher/my_student/edit/{id}', [StudentController::class,'edit'])->name('teacher.my_student.edit');
    // Route::post('teacher/my_student/edit/{id}', [StudentController::class,'updateStudent'])->name('teacher.my_student.update');


    Route::get('teacher/my_class_subject', [AssignClassTeacherController::class,'myClassSubject'])->name('teacher.my_class_subject');

    Route::get('teacher/my_class_subject/class_timetable/{class_id}/{subject_id}', [ClassTimetableController::class,'myTimetableTeacher'])->name('teacher.my_timetable');

    Route::get('teacher/my_exam_timetable', [ExaminationsController::class,'myExamTimetableTeacher'])->name('teacher.my_exam_timetable');

    


    //SUBJECT TEACHER
    Route::get('teacher/subject_teacher', [SubjectTeacherController ::class,'show'])->name('teacher.subject_teacher.view');
    



    
    
    //ASSIGN STUDENT ROUTES
    Route::get('teacher/assign_student', [AssignStudentController::class,'teacherAssignStudentClassList'])->name('teacher.assign_student.class_list');
    Route::get('teacher/assign_student/{class_id}', [AssignStudentController::class,'teacherAssignStudentTermList'])->name('teacher.assign_student.term_list');
    Route::get('teacher/assign_student/{class_id}/{exam_id}', [AssignStudentController::class,'teacherAssignStudentList'])->name('teacher.assign_student.student_list');
    Route::get('teacher/assign_student/{class_id}/{exam_id}/{student_id}', [AssignStudentController::class,'teacherAssignStudentNow'])->name('teacher.assign_student.now');
    Route::get('teacher/assign_student/remove/{class_id}/{exam_id}/{student_id}', [AssignStudentController::class,'teacherRemoveAssignedStudent'])->name('teacher.remove.assigned_student');

    Route::get('teacher/new/assign_student/edit/{student_id}', [AssignStudentController::class,'teacherEditAssignedStudent'])->name('teacher.assign_student.edit.student');
    Route::post('teacher/new/assign_student/edit/{student_id}', [AssignStudentController::class,'teacherUpdateAssignedStudent'])->name('teacher.assign_student.update.student');




    //CREATE NURSERY SUBJECT ROUTES
    Route::get('teacher/nursery_subjects/view/{class_id}/{exam_id}', [SubjectController::class,'nurserySubjectView'])->name('teacher.nursery.subject.view');
    Route::post('teacher/nursery_subjects/view/{class_id}/{exam_id}', [SubjectController::class,'nurserySubjectSubmit'])->name('teacher.nursery.subject.submit');
    Route::put('teacher/nursery_subjects/view/{id}', [SubjectController::class, 'nurserySubjectUpdate'])->name('teacher.nursery.subject.update');




    //VIEW STUDENT'S SUBJECTS
    Route::get('teacher/student-subject/view_subjects/{class_id}/{exam_id}/{student_id}', [StudentSubjectController::class,'view'])->name('teacher.student_subject.view');
    Route::post('teacher/student-subject/view_subjects/{class_id}/{exam_id}/{student_id}', [StudentSubjectController::class,'assignAllSubjects'])->name('teacher.student_subject.assign_all_subjects');
    Route::get('teacher/view_subjects/delete_subject/{assign_subject_id}', [StudentSubjectController::class,'deleteSubjects'])->name('teacher.student_subject.delete.subject');






    //Marks Register
    Route::get('teacher/marks_register', [ExaminationsController::class,'marksRegisterTeacher'])->name('teacher.marks_register');
    Route::POST('teacher/submit_marks_register', [ExaminationsController::class,'submitMarksRegister'])->name('examinations.submit_marks_register');
    Route::POST('teacher/single_submit_marks_register', [ExaminationsController::class,'singleSubmitMarksRegister'])->name('examinations.single_submit_marks_register');

    Route::get('teacher/my_exam_result/print', [ExaminationsController::class,'myExamResultPrint'])->name('teacher.my_exam_result.print');

    Route::get('teacher/my_ca_result/print', [ExaminationsController::class,'myCaResultPrint'])->name('teacher.my_ca_result.print');


    
    //BEHAVIOR CHART
    Route::get('teacher/behavior_chart', [ExaminationsController::class,'behaviorChartTeacher'])->name('teacher.behavior_chart');
    Route::post('teacher/behavior_chart', [ExaminationsController::class,'behaviorChartSubmit'])->name('teacher.behavior_chart.submit');




    //Nursery Goals Register 
    Route::get('teacher/goals_register', [ExaminationsController::class,'nurseryGoalsTeacher'])->name('teacher.goals.register');
    Route::post('teacher/ajax_get_student', [ExaminationsController::class,'ajax_get_student'])->name('teacher.goals.ajax_get_student');
    Route::post('teacher/goals_register/save_subject_goal', [ExaminationsController::class, 'saveSubjectGoal'])->name('teacher.goals.save_subject_goal');






    //Nursery Midterm Goal Radio Buttons
    Route::get('teacher/nursery_midterm_register', [ExaminationsController::class,'nurseryMidtermGoalTeacher'])->name('teacher.nursery_midterm.goals');
    Route::post('teacher/ajax_get_student', [ExaminationsController::class,'ajax_get_student'])->name('teacher.ajax_get_student');
    Route::post('teacher/save_midterm_goal', [ExaminationsController::class, 'saveMidtermGoal'])->name('teacher.save_midterm.goal');



    //NURSERY MID TERM SUBJECT ROUTES
    Route::get('teacher/midterm/nursery_subjects/view/{class_id}/{exam_id}', [SubjectController::class,'midtermNurserySubjectView'])->name('teacher.midterm.nursery.subject.view');
    Route::post('teacher/midterm/nursery_subjects/view/{class_id}/{exam_id}', [SubjectController::class,'midtermNurserySubjectSubmit'])->name('teacher.midterm.nursery.subject.submit');
    Route::put('teacher/midterm/nursery_subjects/view/{id}', [SubjectController::class, 'midtermNurserySubjectUpdate'])->name('teacher.midterm.nursery.subject.update');


    

    //Nursery Result Print
    Route::get('teacher/examinations/print_nursery_goals', [ExaminationsController::class, 'printNurseryGoal'])->name('teacher.nursery_goals.print');


    //Nursery Mid Term Result Print
    Route::get('teacher/print_nursery_midterm_goals', [ExaminationsController::class, 'printNurseryMidtermGoal'])->name('teacher.nursery_midterm_goals.print');




    //ATTENDANCE ROUTES
    Route::get('teacher/attendance/clock_in', [AttendanceController::class,'clockInView'])->name('teacher.attendance.clock_in');
    Route::get('teacher/attendance/clock_in_now', [AttendanceController::class,'clockInNow'])->name('teacher.attendance.clock_in_now');
    Route::post('teacher/attendance/clock_in_now', [AttendanceController::class,'submitClockIn'])->name('teacher.attendance.submit_clock_in');



    Route::get('teacher/attendance/student', [AttendanceController::class,'teacherStudentAttendance'])->name('teacher.attendance.student');
    Route::post('teacher/attendance/student/save', [AttendanceController::class,'studentAttendanceSubmit'])->name('teacher.attendance.student.submit');
    Route::get('teacher/attendance/report', [AttendanceController::class,'attendanceReportTeacher'])->name('teacher.attendance.report');





    Route::get('teacher/my_notice_board', [CommunicationController::class,'myNoticeBoardTeacher'])->name('teacher.my_notice_board');

    Route::get('teacher/comment_bank', [CommunicationController::class,'commentBank'])->name('teacher.comment_bank');




    //HOMEWORK ROUTES
    Route::get('teacher/homework/homework', [HomeworkController::class,'homeworkTeacher'])->name('teacher.homework');
    Route::get('teacher/homework/homework/add', [HomeworkController::class,'addHomeworkTeacher'])->name('teacher.homework.add');
    Route::post('teacher/ajax_get_subject', [HomeworkController::class,'ajax_get_subject'])->name('ajax_get_subject');
    Route::post('teacher/homework/homework/add', [HomeworkController::class,'insertTeacher'])->name('teacher.homework.insert');
    Route::get('teacher/homework/homework/edit/{id}', [HomeworkController::class,'editTeacher'])->name('teacher.homework.edit');
    Route::post('teacher/homework/homework/edit/{id}', [HomeworkController::class,'updateTeacher'])->name('teacher.homework.update');
    Route::get('teacher/homework/homework/delete/{id}', [HomeworkController::class,'delete'])->name('teacher.homework.delete');


    //submitted Homework
    Route::get('teacher/homework/homework/submitted/{id}', [HomeworkController::class,'submittedTeacher'])->name('teacher.homework.submitted');





    //LEAVE REQUEST ROUTES
    Route::get('teacher/leave_list', [HumanresourceController::class,'teacherLeaveList'])->name('teacher.leave.list');
    Route::get('teacher/leave/request', [HumanresourceController::class,'teacherLeaveRequest'])->name('teacher.leave.request');
    Route::post('teacher/leave/request', [HumanresourceController::class,'teacherLeaveRequestStore'])->name('teacher.leave.request.store');




    //NURSERY SUBJECT COMMENT ROUTES
    Route::get('teacher/subject_comment', [ExaminationsController::class,'subjectComment'])->name('teacher.subject_comment');
    Route::post('teacher/single_submit_subject_comment', [ExaminationsController::class, 'saveSingleSubjectComment'])->name('teacher.save_single_subject_comment');




    // PTC ROUTES
    Route::get('teacher/ptc', [PTCController::class, 'ptcView'])->name('teacher.ptc.view');
    Route::post('teacher/ptc/single_submit_ptc', [PTCController::class, 'saveSinglePTC'])->name('teacher.ptc.submit');
    Route::get('teacher/ptc/view_single/{class_id}/{exam_id}/{student_id}', [PTCController::class, 'ptcViewSingle'])->name('teacher.ptc.view_single');
    Route::post('teacher/ptc/view_single/{class_id}/{exam_id}/{student_id}', [PTCController::class, 'ptcViewSingleUpdate'])->name('teacher.ptc.view_single.update');
    Route::get('teacher/ptc/print_single', [PTCController::class, 'ptcPrintSingle'])->name('teacher.ptc.print_single');




    //SUGGESTION ROUTES
    
    Route::get('teacher/suggestion/list',[SuggestionController::class, 'userSuggestionList'])->name('teacher.suggestion.list');
    Route::get('teacher/suggestion/add',[SuggestionController::class, 'userSuggestionAdd'])->name('teacher.suggestion.add');
    Route::post('teacher/suggestion/insert',[SuggestionController::class, 'userSuggestionInsert'])->name('teacher.suggestion.insert');
    




    //AWARD ROUTES
    Route::get('teacher/award/view',[AwardController::class, 'view'])->name('teacher.award.view');
    Route::post('teacher/award/view', [AwardController::class,'awardSubmit'])->name('teacher.award.submit');
    Route::get('teacher/award/view_single/{class_id}/{exam_id}/{student_id}', [AwardController::class,'viewSingle'])->name('teacher.award.view.single');
    Route::get('teacher/award/print_single/early_bird', [AwardController::class,'printEarlyBird'])->name('teacher.award.print.early_bird');
    Route::get('teacher/award/print_single/neatest_pupil', [AwardController::class,'printNeatestPupil'])->name('teacher.award.print.neatest_pupil');
    Route::get('teacher/award/print_single/best_behaved_pupil', [AwardController::class,'printBestBehavedPupil'])->name('teacher.award.print.best_behaved_pupil');



    ///CUMULATIVE RESULT PRINTING
    Route::get('teacher/cumulative_exam_result/print', [ExaminationsController::class,'myCumulativeExamResultPrint'])->name('teacher.my_exam_result.cumulative.print');





    //CBT ROUTES

    /////Class Teacher
    Route::get('teacher/cbt/class_teacher_cbt_questions', [CBTController::class,'teacherViewAll'])->name('teacher.cbt.view.all');
    Route::post('teacher/cbt/class_teacher_cbt_questions', [CBTController::class,'CBTSubmit'])->name('teacher.cbt.submit');
    Route::get('teacher/cbt/cbt_edit/{id}/{class_id}', [CBTController::class,'teacherEditCBT'])->name('teacher.cbt.edit');
    Route::post('teacher/cbt/cbt_edit/{id}', [CBTController::class, 'updateCBT'])->name('teacher.cbt.update');
    Route::delete('teacher/cbt/delete/{id}', [CBTController::class,'deleteCBT'])->name('teacher.cbt.delete');


    Route::get('teacher/cbt/view_questions/{id}', [CBTController::class,'viewQuestions'])->name('teacher.cbt.view_questions');
    Route::post('teacher/cbt/view_questions/{id}', [CBTController::class, 'storeQuestions'])->name('teacher.cbt.questions.store');

    Route::get('teacher/cbt/assigned_class_cbt', [CBTController::class,'teacherAssignedCbtList'])->name('teacher.cbt.assigned.list');


    Route::get('teacher/cbt/assign/{id}', [CBTController::class,'teacherAssignCBT'])->name('teacher.cbt.assign');
    Route::post('teacher/cbt/assign/{cbt_exam_id}', [CBTController::class, 'storeAssignCBT'])->name('teacher.cbt.assign.store');

    Route::get('teacher/cbt/assigned_list/edit/{id}', [CBTController::class, 'teacherEditAssignCBT'])->name('teacher.cbt.assigned_list.edit');
    Route::put('teacher/cbt/assigned_list/update/{id}', [CBTController::class, 'updateAssignCBT'])->name('teacher.cbt.assigned_list.update');

    Route::delete('teacher/cbt/assign/delete/{id}', [CBTController::class,'deleteAssignedCBT'])->name('teacher.cbt.assign.delete');

    Route::get('teacher/cbt/class_cbt_scores', [CBTController::class,'teacherCbtScoreView'])->name('teacher.cbt.class_score.view');
    Route::get('teacher/cbt/class_score/list/{class_id}/{exam_id}/{cbt_exam_id}', [CBTController::class,'teacherCbtScoreList'])->name('teacher.cbt.class_score.list');






    //////Subject Teacher CBT
    Route::get('teacher/cbt/subject_teacher_cbt_questions', [CBTController::class,'subjectTeacherViewAll'])->name('subject_teacher.cbt.view.all');
    Route::get('teacher/cbt/subject_teacher_cbt_edit/{id}/{class_id}', [CBTController::class,'subjectTeacherEditCBT'])->name('subject_teacher.cbt.edit');
    Route::post('teacher/cbt/subject_teacher_cbt_edit/{id}', [CBTController::class, 'subjectTeacherUpdateCBT'])->name('subject_teacher.cbt.update');


    Route::get('teacher/cbt/assigned_subject_cbt', [CBTController::class,'subjectTeacherAssignedCbtList'])->name('subject_teacher.cbt.assigned.list');
    Route::get('teacher/cbt/subject_cbt_assign/{id}', [CBTController::class,'subjectTeacherAssignCBT'])->name('subject_teacher.cbt.assign');
    Route::post('teacher/cbt/subject_cbt_assign/{cbt_exam_id}', [CBTController::class, 'subjectTeacherStoreAssignCBT'])->name('subject_teacher.cbt.assign.store');

    Route::get('teacher/cbt/assigned_subject_list/edit/{id}', [CBTController::class, 'subjectTeacherEditAssignCBT'])->name('subject_teacher.cbt.assigned_list.edit');
    Route::put('teacher/cbt/assigned_list/update/{id}', [CBTController::class, 'subjectTeacherUpdateAssignCBT'])->name('subject_teacher.cbt.assigned_list.update');

    Route::get('teacher/cbt/subject_cbt_scores', [CBTController::class,'subjectTeacherCbtScoreView'])->name('subject_teacher.cbt.class_score.view');
    Route::get('teacher/cbt/subject_score/list/{class_id}/{exam_id}/{cbt_exam_id}', [CBTController::class,'teacherCbtScoreList'])->name('teacher.cbt.class_score.list');

















    
});
//===TEACHER ROUTE GROUP END===///








//===STUDENT ROUTE GROUP===///
Route::group(['middleware' => 'student'], function(){

    Route::get('student/dashboard', [DashboardController::class,'dashboard'])->name('student.dashboard');

    Route::get('student/account', [UserController::class,'myAccount'])->name('student.account');
    Route::post('student/account', [UserController::class,'updateMyStudentAccount'])->name('update.student.account');

    Route::get('student/change_password', [UserController::class,'changePassword'])->name('change_password');
    Route::post('student/change_password', [UserController::class,'updatePassword'])->name('update_password');


    Route::get('student/my_subject', [SubjectController::class,'mySubject'])->name('student.my_subject');
    
    Route::get('student/my_timetable', [ClassTimetableController::class,'myTimetable'])->name('student.my_timetable');

    Route::get('student/my_exam_timetable', [ExaminationsController::class,'myExamTimetable'])->name('student.my_exam_timetable');

    Route::get('student/my_calendar', [CalendarController::class,'myCalendar'])->name('student.my_calendar');


    Route::get('student/my_exam_result', [ExaminationsController::class,'myExamResult'])->name('student.my_exam_result');

    Route::get('student/my_exam_result/print', [ExaminationsController::class,'myExamResultPrint'])->name('student.my_exam_result.print');

    Route::get('student/my_attendance', [AttendanceController::class,'myAttendanceStudent'])->name('student.my_attendance');

    Route::get('student/my_notice_board', [CommunicationController::class,'myNoticeBoardStudent'])->name('student.my_notice_board');

    Route::get('student/my_homework', [HomeworkController::class,'studentHomework'])->name('student.my_homework');

    Route::get('student/my_homework/submit_homework/{id}', [HomeworkController::class,'submitHomework'])->name('student.submit.homework');

    Route::post('student/my_homework/submit_homework/{id}', [HomeworkController::class,'submitHomeworkInsert'])->name('student.submit.homework_insert');

    Route::get('student/my_submitted_homework', [HomeworkController::class,'studentSubmittedHomework'])->name('student.my_submitted_homework');
    
    Route::get('student/fees_collection', [FeesCollectionController::class,'collectFeesStudent'])->name('student.fees_collection');

    Route::post('student/fees_collection', [FeesCollectionController::class,'collectFeesStudentPayment'])->name('student.fees_collection.payment');

    Route::post('student/paypal/payment-error', [FeesCollectionController::class,'paymentError'])->name('student.payment.error');

    Route::post('student/paypal/payment-success', [FeesCollectionController::class,'paymentSuccess'])->name('student.payment.success');






    //SUGGESTION ROUTES
    
    Route::get('student/suggestion/list',[SuggestionController::class, 'userSuggestionList'])->name('student.suggestion.list');
    Route::get('student/suggestion/add',[SuggestionController::class, 'userSuggestionAdd'])->name('student.suggestion.add');
    Route::post('student/suggestion/insert',[SuggestionController::class, 'userSuggestionInsert'])->name('student.suggestion.insert');
    





    //CBT ROUTES
    Route::get('student/cbt/cbt_list', [CBTController::class,'studentCbtList'])->name('student.cbt.list');
    Route::get('student/cbt/take_cbt/{class_id}/{exam_id}/{subject_id}/{cbt_exam_id}', [CBTController::class,'studentTakeCBT'])->name('student.cbt.take_cbt');
    Route::get('student/cbt/take_cbt/{class_id}/{exam_id}/{subject_id}/{cbt_exam_id}/begin_test', [CBTController::class,'studentTakeCBTBegin'])->name('student.cbt.take_cbt.begin');
    
    // Handles saving responses via AJAX
    Route::post('student/cbt/save_response', [CBTController::class, 'saveResponse'])->name('student.cbt.save_response');

    // Handles final exam submission (calculates score, saves to attempt, returns JSON with attempt ID)
    Route::post('student/cbt/submit', [CBTController::class, 'submitExam'])->name('student.cbt.submit_exam');

    // New: Displays result page after submission
    Route::get('student/cbt/result/{attempt}', [CBTController::class, 'viewResult'])->name('cbt.view_result');

    Route::get('student/cbt_scores/list', [CBTController::class, 'studentCbtScores'])->name('student.cbt.scores');
    









    ///CUMULATIVE RESULT PRINT
    Route::get('student/cumulative_exam_result/print', [ExaminationsController::class,'myCumulativeExamResultPrint'])->name('parent.my_exam_result.cumulative.print');





    








});
//===STUDENT ROUTE GROUP END===///










//===PARENT ROUTE GROUP===///
Route::group(['middleware' => 'parent'], function(){
    
    Route::get('parent/dashboard', [DashboardController::class,'dashboard'])->name('parent.dashboard');

    Route::get('parent/account', [UserController::class,'myAccount'])->name('parent.account');
    Route::post('parent/account', [UserController::class,'updateMyParentAccount'])->name('update.parent.account');
    

    Route::get('parent/change_password', [UserController::class,'changePassword'])->name('change_password');
    Route::post('parent/change_password', [UserController::class,'updatePassword'])->name('update_password');


    Route::get('parent/my_student/subject/{student_id}', [SubjectController::class,'parentStudentSubject'])->name('parent.student.subject');

    Route::get('parent/my_student/exam_timetable/{student_id}', [ExaminationsController::class,'parentMyExamTimetable'])->name('parent.student.exam_timetable');

    Route::get('parent/my_student/exam_result/{student_id}', [ExaminationsController::class,'parentMyExamResult'])->name('parent.student.exam_result');



    //School Result Print
    Route::get('parent/my_exam_result/print', [ExaminationsController::class,'myExamResultPrint'])->name('parent.my_exam_result.print');

    Route::get('parent/my_ca_result/print', [ExaminationsController::class,'myCaResultPrint'])->name('parent.my_ca_result.print');


    
    Route::get('parent/my_student/class_timetable/{class_id}/{subject_id}/{student_id}', [ClassTimetableController::class,'myTimetableParent'])->name('parent.my_timetable');    


    Route::get('parent/my_student', [ParentController::class,'myStudentParentSide'])->name('parent.my_student');


    Route::get('parent/my_student/attendance/{student_id}', [AttendanceController::class,'myAttendanceParent'])->name('parent.student.attendance');


    Route::get('parent/my_student_notice_board', [CommunicationController::class,'myStudentNoticeBoardParent'])->name('parent.my_student_notice_board');

    Route::get('parent/my_notice_board', [CommunicationController::class,'myNoticeBoardParent'])->name('parent.my_notice_board');

    Route::get('parent/my_student/homework/{student_id}', [HomeworkController::class,'homeworkStudentParent'])->name('parent.student.homework');

    Route::get('parent/my_student/submitted_homework/{student_id}', [HomeworkController::class,'submittedHomeworkStudentParent'])->name('parent.student.submitted_homework');


    //Student Fees
    Route::get('parent/my_student_fees', [ParentController::class,'myStudentFeesParentSide'])->name('parent.my_student_fees');
    Route::get('parent/my_student_fees/print', [FeesCollectionController::class,'feesBreakdown'])->name('parent.my_student_fees.print');


    //Student Results Page
    Route::get('parent/my_student_results', [ExaminationsController::class,'myStudentResultParentSide'])->name('parent.my_student_results');

    //Nursery Result Print
    Route::get('parent/print_nursery_goals', [ExaminationsController::class, 'printNurseryGoal'])->name('parent.nursery_goals.print');


    //Nursery Mid Term Result Print
    Route::get('parent/print_nursery_midterm_goals', [ExaminationsController::class, 'printNurseryMidtermGoal'])->name('parent.nursery_midterm_goals.print');


    // Route::get('parent/my_student_results/print', [ExaminationsController::class,'resultPrint'])->name('parent.my_student_results.print');




    
    // PTC ROUTES
    Route::get('parent/ptc', [PTCController::class, 'parentPtcView'])->name('parent.ptc.view');
    Route::get('parent/ptc/view_single/{class_id}/{exam_id}/{student_id}', [PTCController::class, 'ptcViewSingle'])->name('parent.ptc.view_single');
    Route::post('parent/ptc/view_single/{class_id}/{exam_id}/{student_id}', [PTCController::class, 'parentUpdatePTC'])->name('parent.ptc.view_single.update');
    Route::get('parent/ptc/print_single', [PTCController::class, 'ptcPrintSingle'])->name('parent.ptc.print_single');



    // SCHOOL CLUB ROUTES
    Route::get('parent/school_club', [ClubController::class, 'parentClubView'])->name('parent.club.view');



    //SUGGESTION ROUTES
    
    Route::get('parent/suggestion/list',[SuggestionController::class, 'userSuggestionList'])->name('parent.suggestion.list');
    Route::get('parent/suggestion/add',[SuggestionController::class, 'userSuggestionAdd'])->name('parent.suggestion.add');
    Route::post('parent/suggestion/insert',[SuggestionController::class, 'userSuggestionInsert'])->name('parent.suggestion.insert');
    



    //AWARD ROUTES
    Route::get('parent/award/view',[AwardController::class, 'view'])->name('parent.award.view');
    Route::get('parent/award/view_single/{class_id}/{exam_id}/{student_id}', [AwardController::class,'viewSingle'])->name('parent.award.view.single');
    Route::get('parent/award/print_single/early_bird', [AwardController::class,'printEarlyBird'])->name('parent.award.print.early_bird');
    Route::get('parent/award/print_single/neatest_pupil', [AwardController::class,'printNeatestPupil'])->name('parent.award.print.neatest_pupil');
    Route::get('parent/award/print_single/best_behaved_pupil', [AwardController::class,'printBestBehavedPupil'])->name('parent.award.print.best_behaved_pupil');




    ///CUMULATIVE RESULT PRINT
    Route::get('parent/cumulative_exam_result/print', [ExaminationsController::class,'myCumulativeExamResultPrint'])->name('parent.my_exam_result.cumulative.print');




    //CBT ROUTES
    Route::get('parent/cbt_scores/list', [CBTController::class, 'parentStudentCbtList'])->name('parent.student.cbt.list');
    Route::get('parent/cbt_scores/scores/{class_id}/{exam_id}/{student_id}', [CBTController::class, 'parentStudentCbtScores'])->name('parent.student.cbt.scores');




    





});

//===PARENT ROUTE GROUP END===///



