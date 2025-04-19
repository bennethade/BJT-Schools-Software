{{-- Sidebar --}}
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('login') }}" class="brand-link" style="text-align: center;">
      {{-- @if (!empty($getHeaderSetting->getLogo()))
        <img src="{{ $getHeaderSetting->getLogo() }}" alt="" style="width:auto; height:40px; border-radius: 5px;" class="brand-image img-rounded elevation-3" style="opacity: .8">
        <span class="brand-text" style="font-size: 20px; font-weight:bold;">SMS</span>
      @else
        <img src="{{ asset('dist/img/benjas_logo_white.png') }}" alt="Benjas Logo" class="brand-image img-rounded elevation-3" style="opacity: .8"> 
        <span class="brand-text" style="font-size: 20px; font-weight:bold;">SMS</span>
      @endif --}}
      <img src="{{ asset('dist/img/benjas_logo_white.png') }}" alt="Benjas Logo" class="brand-image img-rounded elevation-3" style="opacity: .8"> 
        <span class="brand-text" style="font-size: 20px; font-weight:bold;">SMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ Auth::user()->getProfileDirect() }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
          {{-- @if (!empty(Auth::user()->profile_picture))
              <img src="{{ asset('upload/profile') }}/{{ Auth::user()->profile_picture }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
          @else
              <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
          @endif
           --}}
        </div>
        <div class="info">
          <a href="{{ route('login') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->



               {{-- SIDEBAR FOR SUPER ADMIN --}}
               @if (Auth::user()->user_type == 1 || Auth::user()->user_type == 'Super Admin')
                
                  {{-- <li class="nav-header">Dashboard</li> --}}
                    <li class="nav-item">
                      <a href="{{ url('admin/dashboard') }}"  class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                          Dashboard 
                        </p>
                      </a>
                    </li>

                    <li class="nav-item">
                      <a href="{{ url('/message') }}" class="nav-link @if(Request::segment(2) == 'message') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          Messages
                        </p>
                      </a>
                    </li>

                    <li class="nav-item">
                      <a href="{{ url('admin/admin/list') }}" class="nav-link @if(Request::segment(2) == 'admin') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          Admin
                        </p>
                      </a>
                    </li>


                    <li class="nav-item">
                      <a href="{{ url('admin/designation/list') }}" class="nav-link @if(Request::segment(2) == 'designation') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          Designation
                        </p>
                      </a>
                    </li>


                    <li class="nav-item">
                      <a href="{{ url('admin/teacher/list') }}" class="nav-link @if(Request::segment(2) == 'teacher') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          Teacher
                        </p>
                      </a>
                    </li>


                    <li class="nav-item">
                      <a href="{{ url('admin/student/list') }}" class="nav-link @if(Request::segment(2) == 'student') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          Student
                        </p>
                      </a>
                    </li>


                    <li class="nav-item">
                      <a href="{{ url('admin/parent/list') }}" class="nav-link @if(Request::segment(2) == 'parent') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          Parent
                        </p>
                      </a>
                    </li>


                    <li class="nav-item @if(Request::segment(2) == 'class' || Request::segment(2) == 'subject' || Request::segment(2) == 'assign_subject' || Request::segment(2) == 'assign_student' || Request::segment(2) == 'subject_teacher' || Request::segment(2) == 'assign_class_teacher' || Request::segment(2) == 'class_timetable' || Request::segment(2) == 'promote_students' || Request::segment(2) == 'students_in_term' || Request::segment(2) == 'subject_category' || Request::segment(2) == 'ptc' || Request::segment(2) == 'academic_calendar' || Request::segment(2) == 'school_club') menu-is-opening menu-open @endif">
                      <a href="#" class="nav-link @if(Request::segment(2) == 'class' || Request::segment(2) == 'subject' || Request::segment(2) == 'assign_subject' || Request::segment(2) == 'assign_student' || Request::segment(2) == 'subject_teacher' || Request::segment(2) == 'assign_class_teacher' || Request::segment(2) == 'class_timetable' || Request::segment(2) == 'promote_students' || Request::segment(2) == 'students_in_term' || Request::segment(2) == 'subject_category' || Request::segment(2) == 'ptc' || Request::segment(2) == 'academic_calendar' || Request::segment(2) == 'school_club') active @endif">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          Academics
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">

                        <li class="nav-item">
                          <a href="{{ url('admin/class/list') }}" class="nav-link @if(Request::segment(2) == 'class') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Classes</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/subject/list') }}" class="nav-link @if(Request::segment(2) == 'subject') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Subjects</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/subject_category/list') }}" class="nav-link @if(Request::segment(2) == 'subject_category') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Subject Category</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/assign_subject/list') }}" class="nav-link @if(Request::segment(2) == 'assign_subject') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Assign Subject</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/assign_student') }}" class="nav-link @if(Request::segment(2) == 'assign_student') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Assign Student</p>
                          </a>
                        </li>


                        <li class="nav-item">
                          <a href="{{ url('admin/subject_teacher') }}" class="nav-link @if(Request::segment(2) == 'subject_teacher') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Subject Teachers</p>
                          </a>
                        </li>


                        <li class="nav-item">
                          <a href="{{ url('admin/assign_class_teacher/list') }}" class="nav-link @if(Request::segment(2) == 'assign_class_teacher') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Class Tutors</p>
                          </a>
                        </li>


                        <li class="nav-item">
                          <a href="{{ url('admin/academic_calendar/view') }}" class="nav-link @if(Request::segment(2) == 'academic_calender') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Acacdemic Calender</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/school_club/list') }}" class="nav-link @if(Request::segment(2) == 'school_club') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>School Club</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/promote_students') }}" class="nav-link @if(Request::segment(2) == 'promote_students') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Promote Students</p>
                          </a>
                        </li>

                        
                        <li class="nav-item">
                          <a href="{{ route('ptc.view') }}" class="nav-link @if(Request::segment(2) == 'ptc') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>PTC</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ route('students_in_term') }}" class="nav-link @if(Request::segment(2) == 'students_in_term') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Students in term</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/class_timetable/list') }}" class="nav-link @if(Request::segment(2) == 'class_timetable') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Class Timetable</p>
                          </a>
                        </li>


                      </ul>
                    </li>



                    <li class="nav-item @if(Request::segment(2) == 'examinations') menu-is-opening menu-open @endif">
                      <a href="#" class="nav-link @if(Request::segment(2) == 'examinations') active @endif">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          Examinations
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">

                        <li class="nav-item">
                          <a href="{{ url('admin/examinations/exam/list') }}" class="nav-link @if(Request::segment(3) == 'exam') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Term</p>
                          </a>
                        </li>


                        <li class="nav-item">
                          <a href="{{ url('admin/examinations/exam_schedule') }}" class="nav-link @if(Request::segment(3) == 'exam_schedule') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Exam Schedule</p>
                          </a>
                        </li>


                        <li class="nav-item">
                          <a href="{{ url('admin/examinations/marks_register') }}" class="nav-link @if(Request::segment(3) == 'marks_register') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Marks Register</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/examinations/behavior_chart') }}" class="nav-link @if(Request::segment(3) == 'behavior_chart') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Behavior Chart</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/examinations/nursery_goals') }}" class="nav-link @if(Request::segment(3) == 'nursery_goals') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Early Years Exam</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/examinations/nursery_midterm') }}" class="nav-link @if(Request::segment(3) == 'nursery_midterm') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Early Years Midterm</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/examinations/subject_comment') }}" class="nav-link @if(Request::segment(3) == 'subject_comment') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>EYFS Subject Comment</p>
                          </a>
                        </li>


                        <li class="nav-item">
                          <a href="{{ url('admin/examinations/marks_grade') }}" class="nav-link @if(Request::segment(3) == 'marks_grade') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Marks Grade</p>
                          </a>
                        </li> 

                      </ul>
                    </li>


                    <li class="nav-item @if(Request::segment(2) == 'fees_collection') menu-is-opening menu-open @endif">
                      <a href="#" class="nav-link @if(Request::segment(2) == 'fees_collection') active @endif">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          School Fees 
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">

                        <li class="nav-item">
                          <a href="{{ url('admin/fees_collection/class_fees') }}" class="nav-link @if(Request::segment(3) == 'class_fees') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Class Fee</p>
                          </a>
                        </li>


                        <li class="nav-item">
                          <a href="{{ url('admin/fees_collection/extra_fees') }}" class="nav-link @if(Request::segment(3) == 'extra_fees') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Extra Fees</p>
                          </a>
                        </li>

                        {{-- <li class="nav-item">
                          <a href="{{ url('admin/fees_collection/fees_breakdown') }}" class="nav-link @if(Request::segment(3) == 'fees_breakdown') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Fees Breakdown</p>
                          </a>
                        </li> --}}

                        {{-- <li class="nav-item">
                          <a href="{{ url('admin/fees_collection/collect_fees') }}" class="nav-link @if(Request::segment(3) == 'collect_fees') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Student Fees</p>
                          </a>
                        </li> --}}


                        {{-- <li class="nav-item">
                          <a href="{{ url('admin/fees_collection/collect_fees_repot') }}" class="nav-link @if(Request::segment(3) == 'collect_fees_repot') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Student Fees Report</p>
                          </a>
                        </li> --}}

                      </ul>
                    </li>



                    <li class="nav-item @if(Request::segment(2) == 'attendance') menu-is-opening menu-open @endif">
                      <a href="#" class="nav-link @if(Request::segment(2) == 'attendance') active @endif">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          Attendance 
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">

                        <li class="nav-item">
                          <a href="{{ url('admin/attendance/teacher') }}" class="nav-link @if(Request::segment(3) == 'teacher') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Teacher Attendance</p>
                          </a>
                        </li>


                        <li class="nav-item">
                          <a href="{{ url('admin/attendance/teacher_report') }}" class="nav-link @if(Request::segment(3) == 'teacher_report') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Teacher Attdnce Report</p>
                          </a>
                        </li>


                        <li class="nav-item">
                          <a href="{{ url('admin/attendance/student') }}" class="nav-link @if(Request::segment(3) == 'student') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Student Attendance</p>
                          </a>
                        </li>


                        <li class="nav-item">
                          <a href="{{ url('admin/attendance/report') }}" class="nav-link @if(Request::segment(3) == 'report') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Student Attdnce Report</p>
                          </a>
                        </li>

                      </ul>
                    </li>


                    
                    <li class="nav-item @if(Request::segment(2) == 'award') menu-is-opening menu-open @endif">
                      <a href="#" class="nav-link @if(Request::segment(2) == 'award') active @endif">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          End of Term Activities
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">

                        <li class="nav-item">
                          <a href="{{ url('admin/award/view') }}" class="nav-link @if(Request::segment(2) == 'award') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Awards</p>
                          </a>
                        </li>

                      </ul>
                    </li>





                    <li class="nav-item @if(Request::segment(2) == 'communication') menu-is-opening menu-open @endif">
                      <a href="#" class="nav-link @if(Request::segment(2) == 'communication') active @endif">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          Communication 
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">

                        <li class="nav-item">
                          <a href="{{ url('admin/communication/notice_board') }}" class="nav-link @if(Request::segment(3) == 'notice_board') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Notice Board</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ route('communication.send_email') }}" class="nav-link @if(Request::segment(3) == 'send_email') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Send Email</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ route('communication.news_letter') }}" class="nav-link @if(Request::segment(3) == 'news_letter') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Send Newsletter</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ route('communication.send_report_card') }}" class="nav-link @if(Request::segment(3) == 'send_report_card') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Send Report Card</p>
                          </a>
                        </li>

                      </ul>
                    </li>



                    <li class="nav-item @if(Request::segment(2) == 'homework') menu-is-opening menu-open @endif">
                      <a href="#" class="nav-link @if(Request::segment(2) == 'homework') active @endif">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          Assignment 
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">

                        <li class="nav-item">
                          <a href="{{ url('admin/homework/homework') }}" class="nav-link @if(Request::segment(3) == 'homework') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Homework</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/homework/homework_report') }}" class="nav-link @if(Request::segment(3) == 'homework_report') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Homework Report</p>
                          </a>
                        </li>

                      </ul>
                    </li>


                    <li class="nav-item @if(Request::segment(2) == 'procurement') menu-is-opening menu-open @endif">
                      <a href="#" class="nav-link @if(Request::segment(2) == 'procurement') active @endif">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          Procurement 
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">

                        <li class="nav-item">
                          <a href="{{ url('admin/procurement/item_list') }}" class="nav-link @if(Request::segment(2) == 'procurement') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Item List</p>
                          </a>
                        </li>

                      </ul>
                    </li>


                    <li class="nav-item @if(Request::segment(2) == 'human_resource') menu-is-opening menu-open @endif">
                      <a href="#" class="nav-link @if(Request::segment(2) == 'human_resource') active @endif">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          Human Resource 
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">

                        <li class="nav-item">
                          <a href="{{ url('admin/human_resource/employee_leave') }}" class="nav-link @if(Request::segment(2) == 'human_resource') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Staff Leave</p>
                          </a>
                        </li>

                      </ul>
                    </li>
                    
                    


                    <li class="nav-item @if(Request::segment(2) == 'cbt' || Request::segment(2) == 'assigned_list') menu-is-opening menu-open @endif">
                      <a href="#" class="nav-link @if(Request::segment(2) == 'cbt' || Request::segment(2) == 'assigned_list') active @endif">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          CBT 
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">

                        <li class="nav-item">
                          <a href="{{ url('admin/cbt/all_cbt') }}" class="nav-link @if(Request::segment(2) == 'cbt') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All CBT Questions</p>
                          </a>
                        </li>


                        <li class="nav-item">
                          <a href="{{ url('admin/assigned_list/list') }}" class="nav-link @if(Request::segment(2) == 'assigned_list') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View Assigned CBT(s)</p>
                          </a>
                        </li>

                      </ul>
                    </li>



                    <li class="nav-item">
                      <a href="{{ url('under_development') }}" class="nav-link @if(Request::segment(2) == 'under_development') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          Transportation
                        </p>
                      </a>
                    </li>

                    <li class="nav-item">
                      <a href="{{ url('under_development') }}" class="nav-link @if(Request::segment(2) == 'under_development') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          Library Management
                        </p>
                      </a>
                    </li>


                    <li class="nav-item">
                      <a href="{{ url('under_development') }}" class="nav-link @if(Request::segment(2) == 'under_development') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          Hostel Management
                        </p>
                      </a>
                    </li>

                    
                    <li class="nav-item">
                      <a href="{{ url('admin/role_management') }}" class="nav-link @if(Request::segment(2) == 'role_management') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          Role Management
                        </p>
                      </a>
                    </li>


                    <li class="nav-item @if(Request::segment(2) == 'id_card') menu-is-opening menu-open @endif">
                      <a href="#" class="nav-link @if(Request::segment(2) == 'id_card') active @endif">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          ID Card 
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">

                        <li class="nav-item">
                          <a href="{{ url('admin/id_card/student') }}" class="nav-link @if(Request::segment(3) == 'student') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Student ID Card</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/id_card/teacher') }}" class="nav-link @if(Request::segment(3) == 'teacher') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Teacher ID Card</p>
                          </a>
                        </li>

                      </ul>
                    </li>

                    <li class="nav-item @if(Request::segment(2) == 'login_details') menu-is-opening menu-open @endif">
                      <a href="#" class="nav-link @if(Request::segment(2) == 'login_details') active @endif">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          Login Details 
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">

                        <li class="nav-item">
                          <a href="{{ url('admin/login_details/student') }}" class="nav-link @if(Request::segment(3) == 'student') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Student Login Details</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/login_details/teacher') }}" class="nav-link @if(Request::segment(3) == 'teacher') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Teacher Login Details</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/login_details/parent') }}" class="nav-link @if(Request::segment(3) == 'parent') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Parent Login Details</p>
                          </a>
                        </li>

                      </ul>
                    </li>


                    <li class="nav-item">
                      <a href="{{ url('admin/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          My Account
                        </p>
                      </a>
                    </li>


                    <li class="nav-item">
                      <a href="{{ url('admin/comment_bank') }}" class="nav-link @if(Request::segment(2) == 'comment_bank') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          Comment Bank
                        </p>
                      </a>
                    </li>

                    <li class="nav-item">
                      <a href="{{ url('admin/report_card') }}" class="nav-link @if(Request::segment(2) == 'report_card') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          Report Card
                        </p>
                      </a>
                    </li>


                    <li class="nav-item">
                      <a href="{{ url('admin/suggestion/list') }}" class="nav-link @if(Request::segment(2) == 'suggestion') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          Suggestion Box
                        </p>
                      </a>
                    </li>



                    <li class="nav-item">
                      <a href="{{ url('admin/setting') }}" class="nav-link @if(Request::segment(2) == 'setting') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          Setting
                        </p>
                      </a>
                    </li>



                    <li class="nav-item">
                      <a href="{{ url('admin/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          Change Password
                        </p>
                      </a>
                    </li>

                




               {{-- SIDEBAR FOR SCHOOL ADMIN AND SCHOOL ICT--}}
               @elseif (Auth::user()->user_type == 'School Admin')
                
                    <li class="nav-item">
                      <a href="{{ url('admin/dashboard') }}"  class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                          Dashboard 
                        </p>
                      </a>
                    </li>

                    <li class="nav-item">
                      <a href="{{ url('/message') }}" class="nav-link @if(Request::segment(2) == 'message') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          Messages
                        </p>
                      </a>
                    </li>


                    <li class="nav-item">
                      <a href="{{ url('admin/designation/list') }}" class="nav-link @if(Request::segment(2) == 'designation') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          Designation
                        </p>
                      </a>
                    </li>


                    <li class="nav-item">
                      <a href="{{ url('admin/teacher/list') }}" class="nav-link @if(Request::segment(2) == 'teacher') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          Teacher
                        </p>
                      </a>
                    </li>


                    <li class="nav-item">
                      <a href="{{ url('admin/student/list') }}" class="nav-link @if(Request::segment(2) == 'student') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          Student
                        </p>
                      </a>
                    </li>


                    <li class="nav-item">
                      <a href="{{ url('admin/parent/list') }}" class="nav-link @if(Request::segment(2) == 'parent') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          Parent
                        </p>
                      </a>
                    </li>


                    <li class="nav-item @if(Request::segment(2) == 'class' || Request::segment(2) == 'subject' || Request::segment(2) == 'assign_subject' || Request::segment(2) == 'assign_student' || Request::segment(2) == 'subject_teacher' || Request::segment(2) == 'assign_class_teacher' || Request::segment(2) == 'class_timetable' || Request::segment(2) == 'promote_students' || Request::segment(2) == 'students_in_term' || Request::segment(2) == 'subject_category' || Request::segment(2) == 'ptc' || Request::segment(2) == 'academic_calendar' || Request::segment(2) == 'school_club') menu-is-opening menu-open @endif">
                      <a href="#" class="nav-link @if(Request::segment(2) == 'class' || Request::segment(2) == 'subject' || Request::segment(2) == 'assign_subject' || Request::segment(2) == 'assign_student' || Request::segment(2) == 'subject_teacher' || Request::segment(2) == 'assign_class_teacher' || Request::segment(2) == 'class_timetable' || Request::segment(2) == 'promote_students' || Request::segment(2) == 'students_in_term' || Request::segment(2) == 'subject_category' || Request::segment(2) == 'ptc' || Request::segment(2) == 'academic_calendar' || Request::segment(2) == 'school_club') active @endif">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          Academics
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">

                        <li class="nav-item">
                          <a href="{{ url('admin/class/list') }}" class="nav-link @if(Request::segment(2) == 'class') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Classes</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/subject/list') }}" class="nav-link @if(Request::segment(2) == 'subject') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Subjects</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/subject_category/list') }}" class="nav-link @if(Request::segment(2) == 'subject_category') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Subject Category</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/assign_subject/list') }}" class="nav-link @if(Request::segment(2) == 'assign_subject') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Assign Subject</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/assign_student') }}" class="nav-link @if(Request::segment(2) == 'assign_student') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Assign Student</p>
                          </a>
                        </li>


                        <li class="nav-item">
                          <a href="{{ url('admin/subject_teacher') }}" class="nav-link @if(Request::segment(2) == 'subject_teacher') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Subject Teachers</p>
                          </a>
                        </li>


                        <li class="nav-item">
                          <a href="{{ url('admin/assign_class_teacher/list') }}" class="nav-link @if(Request::segment(2) == 'assign_class_teacher') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Class Tutors</p>
                          </a>
                        </li>


                        <li class="nav-item">
                          <a href="{{ url('admin/academic_calendar/view') }}" class="nav-link @if(Request::segment(2) == 'academic_calender') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Acacdemic Calender</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/school_club/list') }}" class="nav-link @if(Request::segment(2) == 'school_club') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>School Club</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/promote_students') }}" class="nav-link @if(Request::segment(2) == 'promote_students') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Promote Students</p>
                          </a>
                        </li>

                        
                        <li class="nav-item">
                          <a href="{{ route('ptc.view') }}" class="nav-link @if(Request::segment(2) == 'ptc') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>PTC</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ route('students_in_term') }}" class="nav-link @if(Request::segment(2) == 'students_in_term') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Students in term</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/class_timetable/list') }}" class="nav-link @if(Request::segment(2) == 'class_timetable') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Class Timetable</p>
                          </a>
                        </li>


                      </ul>
                    </li>


                    <li class="nav-item @if(Request::segment(2) == 'examinations') menu-is-opening menu-open @endif">
                      <a href="#" class="nav-link @if(Request::segment(2) == 'examinations') active @endif">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          Examinations
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">

                        <li class="nav-item">
                          <a href="{{ url('admin/examinations/exam/list') }}" class="nav-link @if(Request::segment(3) == 'exam') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Term</p>
                          </a>
                        </li>


                        <li class="nav-item">
                          <a href="{{ url('admin/examinations/exam_schedule') }}" class="nav-link @if(Request::segment(3) == 'exam_schedule') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Exam Schedule</p>
                          </a>
                        </li>


                        <li class="nav-item">
                          <a href="{{ url('admin/examinations/marks_register') }}" class="nav-link @if(Request::segment(3) == 'marks_register') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Marks Register</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/examinations/nursery_goals') }}" class="nav-link @if(Request::segment(3) == 'nursery_goals') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Early Years Exam</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/examinations/nursery_midterm') }}" class="nav-link @if(Request::segment(3) == 'nursery_midterm') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Early Years Midterm</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/examinations/subject_comment') }}" class="nav-link @if(Request::segment(3) == 'subject_comment') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>EYFS Subject Comment</p>
                          </a>
                        </li>


                        <li class="nav-item">
                          <a href="{{ url('admin/examinations/behavior_chart') }}" class="nav-link @if(Request::segment(3) == 'behavior_chart') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Behavior Chart</p>
                          </a>
                        </li>


                        <li class="nav-item">
                          <a href="{{ url('admin/examinations/marks_grade') }}" class="nav-link @if(Request::segment(3) == 'marks_grade') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Marks Grade</p>
                          </a>
                        </li> 

                      </ul>
                    </li>



                    <li class="nav-item @if(Request::segment(2) == 'fees_collection') menu-is-opening menu-open @endif">
                      <a href="#" class="nav-link @if(Request::segment(2) == 'fees_collection') active @endif">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          School Fees 
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">

                        <li class="nav-item">
                          <a href="{{ url('admin/fees_collection/class_fees') }}" class="nav-link @if(Request::segment(3) == 'class_fees') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Class Fee</p>
                          </a>
                        </li>


                        <li class="nav-item">
                          <a href="{{ url('admin/fees_collection/extra_fees') }}" class="nav-link @if(Request::segment(3) == 'extra_fees') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Extra Fees</p>
                          </a>
                        </li>

                        {{-- <li class="nav-item">
                          <a href="{{ url('admin/fees_collection/fees_breakdown') }}" class="nav-link @if(Request::segment(3) == 'fees_breakdown') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Fees Breakdown</p>
                          </a>
                        </li> --}}

                        {{-- <li class="nav-item">
                          <a href="{{ url('admin/fees_collection/collect_fees') }}" class="nav-link @if(Request::segment(3) == 'collect_fees') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Student Fees</p>
                          </a>
                        </li> --}}


                        {{-- <li class="nav-item">
                          <a href="{{ url('admin/fees_collection/collect_fees_repot') }}" class="nav-link @if(Request::segment(3) == 'collect_fees_repot') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Student Fees Report</p>
                          </a>
                        </li> --}}

                      </ul>
                    </li>



                    <li class="nav-item @if(Request::segment(2) == 'attendance') menu-is-opening menu-open @endif">
                      <a href="#" class="nav-link @if(Request::segment(2) == 'attendance') active @endif">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          Attendance 
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">

                        <li class="nav-item">
                          <a href="{{ url('admin/attendance/teacher') }}" class="nav-link @if(Request::segment(3) == 'teacher') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Teacher Attendance</p>
                          </a>
                        </li>


                        <li class="nav-item">
                          <a href="{{ url('admin/attendance/teacher_report') }}" class="nav-link @if(Request::segment(3) == 'teacher_report') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Teacher Attdnce Report</p>
                          </a>
                        </li>


                        <li class="nav-item">
                          <a href="{{ url('admin/attendance/student') }}" class="nav-link @if(Request::segment(3) == 'student') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Student Attendance</p>
                          </a>
                        </li>


                        <li class="nav-item">
                          <a href="{{ url('admin/attendance/report') }}" class="nav-link @if(Request::segment(3) == 'report') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Student Attdnce Report</p>
                          </a>
                        </li>

                      </ul>
                    </li>



                    <li class="nav-item @if(Request::segment(2) == 'award') menu-is-opening menu-open @endif">
                      <a href="#" class="nav-link @if(Request::segment(2) == 'award') active @endif">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          End of Term Activities
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">

                        <li class="nav-item">
                          <a href="{{ url('admin/award/view') }}" class="nav-link @if(Request::segment(2) == 'award') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Awards</p>
                          </a>
                        </li>

                      </ul>
                    </li>



                    <li class="nav-item @if(Request::segment(2) == 'communication') menu-is-opening menu-open @endif">
                      <a href="#" class="nav-link @if(Request::segment(2) == 'communication') active @endif">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          Communication 
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">

                        <li class="nav-item">
                          <a href="{{ url('admin/communication/notice_board') }}" class="nav-link @if(Request::segment(3) == 'notice_board') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Notice Board</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ route('communication.send_email') }}" class="nav-link @if(Request::segment(3) == 'send_email') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Send Email</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ route('communication.news_letter') }}" class="nav-link @if(Request::segment(3) == 'news_letter') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Send Newsletter</p>
                          </a>
                        </li>

                        {{-- <li class="nav-item">
                          <a href="{{ route('communication.send_report_card') }}" class="nav-link @if(Request::segment(3) == 'send_report_card') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Send Report Card</p>
                          </a>
                        </li> --}}

                      </ul>
                    </li>



                    <li class="nav-item @if(Request::segment(2) == 'homework') menu-is-opening menu-open @endif">
                      <a href="#" class="nav-link @if(Request::segment(2) == 'homework') active @endif">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          Assignment 
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">

                        <li class="nav-item">
                          <a href="{{ url('admin/homework/homework') }}" class="nav-link @if(Request::segment(3) == 'homework') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Homework</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/homework/homework_report') }}" class="nav-link @if(Request::segment(3) == 'homework_report') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Homework Report</p>
                          </a>
                        </li>

                      </ul>
                    </li>


                    <li class="nav-item @if(Request::segment(2) == 'procurement') menu-is-opening menu-open @endif">
                      <a href="#" class="nav-link @if(Request::segment(2) == 'procurement') active @endif">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          Procurement 
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">

                        <li class="nav-item">
                          <a href="{{ url('admin/procurement/item_list') }}" class="nav-link @if(Request::segment(2) == 'procurement') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Item List</p>
                          </a>
                        </li>

                      </ul>
                    </li>


                    <li class="nav-item @if(Request::segment(2) == 'human_resource') menu-is-opening menu-open @endif">
                      <a href="#" class="nav-link @if(Request::segment(2) == 'human_resource') active @endif">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          Human Resource 
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">

                        <li class="nav-item">
                          <a href="{{ url('admin/human_resource/employee_leave') }}" class="nav-link @if(Request::segment(2) == 'human_resource') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Staff Leave</p>
                          </a>
                        </li>

                      </ul>
                    </li>

                    <li class="nav-item @if(Request::segment(2) == 'cbt' || Request::segment(2) == 'assigned_list') menu-is-opening menu-open @endif">
                      <a href="#" class="nav-link @if(Request::segment(2) == 'cbt' || Request::segment(2) == 'assigned_list') active @endif">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          CBT 
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">

                        <li class="nav-item">
                          <a href="{{ url('admin/cbt/all_cbt') }}" class="nav-link @if(Request::segment(2) == 'cbt') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All CBT Questions</p>
                          </a>
                        </li>


                        <li class="nav-item">
                          <a href="{{ url('admin/assigned_list/list') }}" class="nav-link @if(Request::segment(2) == 'assigned_list') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View Assigned CBT(s)</p>
                          </a>
                        </li>

                      </ul>
                    </li>
                    

                    
                    <li class="nav-item">
                      <a href="{{ url('admin/role_management') }}" class="nav-link @if(Request::segment(2) == 'role_management') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          Role Management
                        </p>
                      </a>
                    </li>


                    
                    <li class="nav-item @if(Request::segment(2) == 'id_card') menu-is-opening menu-open @endif">
                      <a href="#" class="nav-link @if(Request::segment(2) == 'id_card') active @endif">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          ID Card 
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">

                        <li class="nav-item">
                          <a href="{{ url('admin/id_card/student') }}" class="nav-link @if(Request::segment(3) == 'student') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Student ID Card</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/id_card/teacher') }}" class="nav-link @if(Request::segment(3) == 'teacher') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Teacher ID Card</p>
                          </a>
                        </li>

                      </ul>
                    </li>


                    <li class="nav-item @if(Request::segment(2) == 'login_details') menu-is-opening menu-open @endif">
                      <a href="#" class="nav-link @if(Request::segment(2) == 'login_details') active @endif">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          Login Details 
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">

                        <li class="nav-item">
                          <a href="{{ url('admin/login_details/student') }}" class="nav-link @if(Request::segment(3) == 'student') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Student Login Details</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/login_details/teacher') }}" class="nav-link @if(Request::segment(3) == 'teacher') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Teacher Login Details</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/login_details/parent') }}" class="nav-link @if(Request::segment(3) == 'parent') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Parent Login Details</p>
                          </a>
                        </li>

                      </ul>
                    </li>


                    <li class="nav-item">
                      <a href="{{ url('admin/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          My Account
                        </p>
                      </a>
                    </li>


                    <li class="nav-item">
                      <a href="{{ url('admin/comment_bank') }}" class="nav-link @if(Request::segment(2) == 'comment_bank') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          Comment Bank
                        </p>
                      </a>
                    </li>

                    <li class="nav-item">
                      <a href="{{ url('admin/report_card') }}" class="nav-link @if(Request::segment(2) == 'report_card') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          Report Card
                        </p>
                      </a>
                    </li>

                    <li class="nav-item">
                      <a href="{{ url('admin/suggestion/list') }}" class="nav-link @if(Request::segment(2) == 'suggestion') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          Suggestion Box
                        </p>
                      </a>
                    </li>

                    <li class="nav-item">
                      <a href="{{ url('admin/setting') }}" class="nav-link @if(Request::segment(2) == 'setting') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          Setting
                        </p>
                      </a>
                    </li>


                    <li class="nav-item">
                      <a href="{{ url('admin/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          Change Password
                        </p>
                      </a>
                    </li>

                










                {{-- SIDEBAR FOR PRINCIPAL, VICE PRINCIPAL AND OTHER ROLES--}}
               @elseif (Auth::user()->user_type == 'Principal' || Auth::user()->user_type == 'Vice Principal')
               
                  <li class="nav-item">
                    <a href="{{ url('other_roles/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>
                        Dashboard
                      </p>
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="{{ url('message') }}" class="nav-link @if(Request::segment(2) == 'message') active @endif">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>
                        Messages
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ url('other_roles/subject_teacher') }}" class="nav-link @if(Request::segment(2) == 'subject_teacher') active @endif">
                      <i class="nav-icon far fa-user"></i>
                      <p>
                        Subject Teacher
                      </p>
                    </a>
                  </li>


                  <li class="nav-item">
                    <a href="{{ url('other_roles/examinations/marks_register') }}" class="nav-link @if(Request::segment(3) == 'marks_register') active @endif">
                      <i class="nav-icon far fa-user"></i>
                      <p>
                        Marks Register
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ url('other_roles/examinations/behavior_chart') }}" class="nav-link @if(Request::segment(2) == 'behavior_chart') active @endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Behavior Chart</p>
                    </a>
                  </li>


                  <li class="nav-item @if(Request::segment(2) == 'attendance') menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link @if(Request::segment(2) == 'attendance') active @endif">
                      <i class="nav-icon fas fa-table"></i>
                      <p>
                        Attendance 
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">

                      {{-- <li class="nav-item">
                        <a href="{{ url('teacher/attendance/clock_in') }}" class="nav-link @if(Request::segment(3) == 'clock_in') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>My Clock In</p>
                        </a>
                      </li> --}}
                

                      <li class="nav-item">
                        <a href="{{ url('other_roles/attendance/teacher') }}" class="nav-link @if(Request::segment(3) == 'attendance') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Teacher Attendance</p>
                        </a>
                      </li>

                    </ul>
                  </li>


                  <li class="nav-item @if(Request::segment(2) == 'award') menu-is-opening menu-open @endif">
                      <a href="#" class="nav-link @if(Request::segment(2) == 'award') active @endif">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          End of Term Activities
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">

                        <li class="nav-item">
                          <a href="{{ url('other_roles/award/view') }}" class="nav-link @if(Request::segment(2) == 'award') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Awards</p>
                          </a>
                        </li>

                      </ul>
                    </li>


                  <li class="nav-item @if(Request::segment(2) == 'homework') menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link @if(Request::segment(2) == 'homework') active @endif">
                      <i class="nav-icon fas fa-table"></i>
                      <p>
                        Assignment 
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>

                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ url('other_roles/homework/homework') }}" class="nav-link @if(Request::segment(3) == 'homework') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Home Fun</p>
                        </a>
                      </li>

                    </ul>
                  </li>


                  <li class="nav-item">
                    <a href="{{ url('other_roles/my_notice_board') }}" class="nav-link @if(Request::segment(2) == 'my_notice_board') active @endif">
                      <i class="nav-icon far fa-user"></i>
                      <p>
                        My Notice Board
                      </p>
                    </a>
                  </li>


                  <li class="nav-item">
                    <a href="{{ url('other_roles/leave_list') }}" class="nav-link @if(Request::segment(2) == 'leave_list') active @endif">
                      <i class="nav-icon far fa-user"></i>
                      <p>
                        Leave Request
                      </p>
                    </a>
                  </li>


                  <li class="nav-item">
                    <a href="{{ url('other_roles/comment_bank') }}" class="nav-link @if(Request::segment(2) == 'comment_bank') active @endif">
                      <i class="nav-icon far fa-user"></i>
                      <p>
                        Comment Bank
                      </p>
                    </a>
                  </li>


                  <li class="nav-item">
                    <a href="{{ url('other_roles/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
                      <i class="nav-icon far fa-user"></i>
                      <p>
                        My Account
                      </p>
                    </a>
                  </li>



                  <li class="nav-item">
                    <a href="{{ url('other_roles/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
                      <i class="nav-icon far fa-user"></i>
                      <p>
                        Change Password
                      </p>
                    </a>
                  </li>
               









               
                {{-- SIDEBAR FOR TEACHER --}}
               @elseif (Auth::user()->user_type == 2)
               
                  <li class="nav-item">
                    <a href="{{ url('teacher/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>
                        Dashboard
                      </p>
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="{{ url('message') }}" class="nav-link @if(Request::segment(2) == 'message') active @endif">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>
                        Messages
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ url('teacher/subject_teacher') }}" class="nav-link @if(Request::segment(2) == 'subject_teacher') active @endif">
                      <i class="nav-icon far fa-user"></i>
                      <p>
                        Subject Teacher
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ url('teacher/assign_student') }}" class="nav-link @if(Request::segment(2) == 'assign_student') active @endif">
                      <i class="nav-icon far fa-user"></i>
                      <p>
                        My Class Students
                      </p>
                    </a>
                  </li>


                  <!--<li class="nav-item">
                    <a href="{{ url('teacher/my_student') }}" class="nav-link @if(Request::segment(2) == 'my_student') active @endif">
                      <i class="nav-icon far fa-user"></i>
                      <p>
                        My Students
                      </p>
                    </a>
                  </li>-->


                  <li class="nav-item">
                    <a href="{{ url('teacher/my_class_subject') }}" class="nav-link @if(Request::segment(2) == 'my_class_subject') active @endif">
                      <i class="nav-icon far fa-user"></i>
                      <p>
                        My Class Subjects
                      </p>
                    </a>
                  </li>


                  <li class="nav-item">
                    <a href="{{ url('teacher/my_exam_timetable') }}" class="nav-link @if(Request::segment(2) == 'my_exam_timetable') active @endif">
                      <i class="nav-icon far fa-user"></i>
                      <p>
                        My Exam Timetable
                      </p>
                    </a>
                  </li>



                  <li class="nav-item">
                    <a href="{{ url('teacher/marks_register') }}" class="nav-link @if(Request::segment(2) == 'marks_register') active @endif">
                      <i class="nav-icon far fa-user"></i>
                      <p>
                        Marks Register
                      </p>
                    </a>
                  </li>
                  

                  <li class="nav-item">
                    <a href="{{ url('teacher/behavior_chart') }}" class="nav-link @if(Request::segment(2) == 'behavior_chart') active @endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Behavior Chart</p>
                    </a>
                  </li>

                  
                  <li class="nav-item">
                    <a href="{{ url('teacher/goals_register') }}" class="nav-link @if(Request::segment(2) == 'goals_register') active @endif">
                      <i class="nav-icon far fa-user"></i>
                      <p>
                        Early Years Exam
                      </p>
                    </a>
                  </li>


                  <li class="nav-item">
                    <a href="{{ url('teacher/nursery_midterm_register') }}" class="nav-link @if(Request::segment(2) == 'nursery_midterm_register') active @endif">
                      <i class="nav-icon far fa-user"></i>
                      <p>
                        Early Years Midterm
                      </p>
                    </a>
                  </li>


                  <li class="nav-item">
                    <a href="{{ url('teacher/subject_comment') }}" class="nav-link @if(Request::segment(2) == 'subject_comment') active @endif">
                      <i class="nav-icon far fa-user"></i>
                      <p>
                        EYFS Subject Comment
                      </p>
                    </a>
                  </li>


                  <li class="nav-item">
                    <a href="{{ url('teacher/ptc') }}" class="nav-link @if(Request::segment(2) == 'ptc') active @endif">
                      <i class="nav-icon far fa-user"></i>
                      <p>
                        PTC
                      </p>
                    </a>
                  </li>


                  <li class="nav-item @if(Request::segment(2) == 'attendance') menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link @if(Request::segment(2) == 'attendance') active @endif">
                      <i class="nav-icon fas fa-table"></i>
                      <p>
                        Attendance 
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">

                      {{-- <li class="nav-item">
                        <a href="{{ url('teacher/attendance/clock_in') }}" class="nav-link @if(Request::segment(3) == 'clock_in') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>My Clock In</p>
                        </a>
                      </li> --}}


                      <li class="nav-item">
                        <a href="{{ url('teacher/attendance/student') }}" class="nav-link @if(Request::segment(3) == 'student') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Student Attendance</p>
                        </a>
                      </li>


                      <li class="nav-item">
                        <a href="{{ url('teacher/attendance/report') }}" class="nav-link @if(Request::segment(3) == 'report') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Student Attndnce Report</p>
                        </a>
                      </li>

                    </ul>
                  </li>


                  <li class="nav-item @if(Request::segment(2) == 'homework') menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link @if(Request::segment(2) == 'homework') active @endif">
                      <i class="nav-icon fas fa-table"></i>
                      <p>
                        Assignment 
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>

                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ url('teacher/homework/homework') }}" class="nav-link @if(Request::segment(3) == 'homework') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Home Fun</p>
                        </a>
                      </li>

                    </ul>
                  </li>


                  <li class="nav-item @if(Request::segment(2) == 'award') menu-is-opening menu-open @endif">
                      <a href="#" class="nav-link @if(Request::segment(2) == 'award') active @endif">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          End of Term Activities
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">

                        <li class="nav-item">
                          <a href="{{ url('teacher/award/view') }}" class="nav-link @if(Request::segment(2) == 'award') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Awards</p>
                          </a>
                        </li>

                      </ul>
                    </li>


                  <li class="nav-item">
                    <a href="{{ url('teacher/my_notice_board') }}" class="nav-link @if(Request::segment(2) == 'my_notice_board') active @endif">
                      <i class="nav-icon far fa-user"></i>
                      <p>
                        My Notice Board
                      </p>
                    </a>
                  </li>


                  <li class="nav-item">
                    <a href="{{ url('teacher/leave_list') }}" class="nav-link @if(Request::segment(2) == 'leave_list') active @endif">
                      <i class="nav-icon far fa-user"></i>
                      <p>
                        Leave Request
                      </p>
                    </a>
                  </li>


                  <li class="nav-item">
                    <a href="{{ url('teacher/comment_bank') }}" class="nav-link @if(Request::segment(2) == 'comment_bank') active @endif">
                      <i class="nav-icon far fa-user"></i>
                      <p>
                        Comment Bank
                      </p>
                    </a>
                  </li>


                  <li class="nav-item">
                    <a href="{{ url('teacher/suggestion/list') }}" class="nav-link @if(Request::segment(2) == 'suggestion') active @endif">
                      <i class="nav-icon far fa-user"></i>
                      <p>
                        Make Suggestion
                      </p>
                    </a>
                  </li>


                  <li class="nav-item">
                    <a href="{{ url('teacher/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
                      <i class="nav-icon far fa-user"></i>
                      <p>
                        My Account
                      </p>
                    </a>
                  </li>



                  <li class="nav-item">
                    <a href="{{ url('teacher/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
                      <i class="nav-icon far fa-user"></i>
                      <p>
                        Change Password
                      </p>
                    </a>
                  </li>
               





               {{-- SIDEBAR FOR STUDENT --}}
               @elseif (Auth::user()->user_type == 3)
               
                <li class="nav-item">
                  <a href="{{ url('student/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Dashboard
                    </p>
                  </a>
                </li>


                <li class="nav-item">
                  <a href="{{ url('message') }}" class="nav-link @if(Request::segment(2) == 'message') active @endif">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Messages
                    </p>
                  </a>
                </li>


                {{-- <li class="nav-item">
                  <a href="{{ url('student/fees_collection') }}" class="nav-link @if(Request::segment(2) == 'fees_collection') active @endif">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                      Student Fees
                    </p>
                  </a> --}}
                </li>


                <li class="nav-item">
                  <a href="{{ url('student/my_calendar') }}" class="nav-link @if(Request::segment(2) == 'my_calendar') active @endif">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                      My Calendar
                    </p>
                  </a>
                </li>



                <li class="nav-item">
                  <a href="{{ url('student/my_subject') }}" class="nav-link @if(Request::segment(2) == 'my_subject') active @endif">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                      My Subjects
                    </p>
                  </a>
                </li>


                <li class="nav-item">
                  <a href="{{ url('student/my_timetable') }}" class="nav-link @if(Request::segment(2) == 'my_timetable') active @endif">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                      My Timetable
                    </p>
                  </a>
                </li>



                <li class="nav-item">
                  <a href="{{ url('student/my_exam_timetable') }}" class="nav-link @if(Request::segment(2) == 'my_exam_timetable') active @endif">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                      My Exam Timetable
                    </p>
                  </a>
                </li>


                <li class="nav-item">
                  <a href="{{ url('student/my_exam_result') }}" class="nav-link @if(Request::segment(2) == 'my_exam_result') active @endif">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                      My Exam Result
                    </p>
                  </a>
                </li>


                <li class="nav-item">
                  <a href="{{ url('student/my_attendance') }}" class="nav-link @if(Request::segment(2) == 'my_attendance') active @endif">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                      My Attendance
                    </p>
                  </a>
                </li>


                <li class="nav-item">
                  <a href="{{ url('student/my_notice_board') }}" class="nav-link @if(Request::segment(2) == 'my_notice_board') active @endif">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                      My Notice Board
                    </p>
                  </a>
                </li>


                <li class="nav-item @if(Request::segment(2) == 'cbt' || Request::segment(2) == 'cbt_scores') menu-is-opening menu-open @endif">
                  <a href="#" class="nav-link @if(Request::segment(2) == 'cbt' || Request::segment(2) == 'cbt_scores') active @endif">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                      CBT 
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">

                    <li class="nav-item">
                      <a href="{{ url('student/cbt/cbt_list') }}" class="nav-link @if(Request::segment(2) == 'cbt') active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View CBT</p>
                      </a>
                    </li>


                    <li class="nav-item">
                      <a href="{{ url('student/cbt_scores/list') }}" class="nav-link @if(Request::segment(2) == 'cbt_scores') active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>CBT Scores</p>
                      </a>
                    </li>

                  </ul>
                </li>


                <li class="nav-item">
                  <a href="{{ url('student/my_homework') }}" class="nav-link @if(Request::segment(2) == 'my_homework') active @endif">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                      My Homework
                    </p>
                  </a>
                </li>


                <li class="nav-item">
                  <a href="{{ url('student/my_submitted_homework') }}" class="nav-link @if(Request::segment(2) == 'my_submitted_homework') active @endif">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                      Submitted Homework
                    </p>
                  </a>
                </li>


                <li class="nav-item @if(Request::segment(2) == 'award') menu-is-opening menu-open @endif">
                  <a href="#" class="nav-link @if(Request::segment(2) == 'award') active @endif">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                      End of Term Activities
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">

                    <li class="nav-item">
                      <a href="{{ url('student/award/view') }}" class="nav-link @if(Request::segment(2) == 'award') active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Awards</p>
                      </a>
                    </li>

                  </ul>
                </li>


                <li class="nav-item">
                  <a href="{{ url('student/suggestion/list') }}" class="nav-link @if(Request::segment(2) == 'suggestion') active @endif">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                      Make Suggestion
                    </p>
                  </a>
                </li>


                <li class="nav-item">
                  <a href="{{ url('student/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                      My Account
                    </p>
                  </a>
                </li>



                <li class="nav-item">
                  <a href="{{ url('student/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                      Change Password
                    </p>
                  </a>
                </li>


               



               {{-- SIDEBAR FOR PARENT --}}
               @elseif (Auth::user()->user_type == 4)
               
                <li class="nav-item">
                  <a href="{{ url('parent/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Dashboard
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ url('message') }}" class="nav-link @if(Request::segment(2) == 'message') active @endif">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Messages
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ url('parent/my_student') }}" class="nav-link @if(Request::segment(2) == 'my_student') active @endif">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                      My Student(s)
                    </p>
                  </a>
                </li>


                <li class="nav-item">
                  <a href="{{ url('parent/my_student_fees') }}" class="nav-link @if(Request::segment(2) == 'my_student_fees') active @endif">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                      Student Fees
                    </p>
                  </a>
                </li>


                <li class="nav-item">
                  <a href="{{ url('parent/my_student_results') }}" class="nav-link @if(Request::segment(2) == 'my_student_results') active @endif">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                      Student Results
                    </p>
                  </a>
                </li>


                <li class="nav-item">
                  <a href="{{ url('parent/my_student_notice_board') }}" class="nav-link @if(Request::segment(2) == 'my_student_notice_board') active @endif">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                      Student Notice Board
                    </p>
                  </a>
                </li>


                <li class="nav-item">
                  <a href="{{ url('parent/my_notice_board') }}" class="nav-link @if(Request::segment(2) == 'my_notice_board') active @endif">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                      Parent Notice Board
                    </p>
                  </a>
                </li>


                <li class="nav-item">
                  <a href="{{ url('parent/ptc') }}" class="nav-link @if(Request::segment(2) == 'ptc') active @endif">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                      PTC
                    </p>
                  </a>
                </li>


                <li class="nav-item">
                  <a href="{{ url('parent/school_club') }}" class="nav-link @if(Request::segment(2) == 'school_club') active @endif">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                      School Clubs
                    </p>
                  </a>
                </li>


                <li class="nav-item @if(Request::segment(2) == 'award') menu-is-opening menu-open @endif">
                  <a href="#" class="nav-link @if(Request::segment(2) == 'award') active @endif">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                      End of Term Activities
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">

                    <li class="nav-item">
                      <a href="{{ url('parent/award/view') }}" class="nav-link @if(Request::segment(2) == 'award') active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Awards</p>
                      </a>
                    </li>

                  </ul>
                </li>


                <li class="nav-item">
                  <a href="{{ url('parent/suggestion/list') }}" class="nav-link @if(Request::segment(2) == 'suggestion') active @endif">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                      Make Suggestion
                    </p>
                  </a>
                </li>


                <li class="nav-item">
                  <a href="{{ url('parent/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                      My Account
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ url('parent/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                      Change Password
                    </p>
                  </a>
                </li>


               


               @endif
          
          

          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link">
              <i class="nav-icon far fa-user"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>