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



               {{-- SIDEBAR FOR ADMIN --}}
               @if (Auth::user()->user_type == 1 || Auth::user()->user_type == 'Super Admin')
                {
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
                      <a href="{{ url('admin/admin/list') }}" class="nav-link @if(Request::segment(2) == 'admin') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          Admin
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


                    <li class="nav-item @if(Request::segment(2) == 'class' || Request::segment(2) == 'subject' || Request::segment(2) == 'assign_subject' || Request::segment(2) == 'assign_student' || Request::segment(2) == 'subject_teacher' || Request::segment(2) == 'assign_class_teacher' || Request::segment(2) == 'class_timetable' || Request::segment(2) == 'promote_students') menu-is-opening menu-open @endif">
                      <a href="#" class="nav-link @if(Request::segment(2) == 'class' || Request::segment(2) == 'subject' || Request::segment(2) == 'assign_subject' || Request::segment(2) == 'assign_student' || Request::segment(2) == 'subject_teacher' || Request::segment(2) == 'assign_class_teacher' || Request::segment(2) == 'class_timetable' || Request::segment(2) == 'promote_students') active @endif">
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
                            <p>Subject Teacher</p>
                          </a>
                        </li>


                        <li class="nav-item">
                          <a href="{{ url('admin/assign_class_teacher/list') }}" class="nav-link @if(Request::segment(2) == 'assign_class_teacher') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Assign Class Teacher</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/promote_students') }}" class="nav-link @if(Request::segment(2) == 'promote_students') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Promote Students</p>
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
                            <p>Exam</p>
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
                          <a href="{{ url('admin/examinations/marks_grade') }}" class="nav-link @if(Request::segment(3) == 'marks_grade') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Marks Grade</p>
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
                      <a href="{{ url('admin/report_card') }}" class="nav-link @if(Request::segment(2) == 'report_card') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          Report Card
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

                }




               {{-- SIDEBAR FOR SCHOOL ADMIN AND SCHOOL ICT--}}
               @elseif (Auth::user()->user_type == 'School Admin')
                {
                    <li class="nav-item">
                      <a href="{{ url('admin/dashboard') }}"  class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                          Dashboard 
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


                    <li class="nav-item @if(Request::segment(2) == 'class' || Request::segment(2) == 'subject' || Request::segment(2) == 'assign_subject' || Request::segment(2) == 'assign_class_teacher' || Request::segment(2) == 'class_timetable') menu-is-opening menu-open @endif">
                      <a href="#" class="nav-link @if(Request::segment(2) == 'class' || Request::segment(2) == 'subject' || Request::segment(2) == 'assign_subject' || Request::segment(2) == 'assign_class_teacher' || Request::segment(2) == 'class_timetable') active @endif">
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
                            <p>Subject Teacher</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/class_timetable/list') }}" class="nav-link @if(Request::segment(2) == 'class_timetable') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Class Timetable</p>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{ url('admin/assign_class_teacher/list') }}" class="nav-link @if(Request::segment(2) == 'assign_class_teacher') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Assign Class Teacher</p>
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
                            <p>Exam</p>
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
                          <a href="{{ url('admin/examinations/marks_grade') }}" class="nav-link @if(Request::segment(3) == 'marks_grade') active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Marks Grade</p>
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
                      <a href="{{ url('admin/report_card') }}" class="nav-link @if(Request::segment(2) == 'report_card') active @endif">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                          Report Card
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

                }




               
                {{-- SIDEBAR FOR TEACHER --}}
               @elseif (Auth::user()->user_type == 2)
               {
                  <li class="nav-item">
                    <a href="{{ url('teacher/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>
                        Dashboard
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

                  <li class="nav-item">
                    <a href="{{ url('teacher/my_class_subject') }}" class="nav-link @if(Request::segment(2) == 'my_class_subject') active @endif">
                      <i class="nav-icon far fa-user"></i>
                      <p>
                        My Class & Subjects
                      </p>
                    </a>
                  </li>


                  <li class="nav-item">
                    <a href="{{ url('teacher/marks_register') }}" class="nav-link @if(Request::segment(2) == 'marks_register') active @endif">
                      <i class="nav-icon far fa-user"></i>
                      <p>
                        Class Teacher
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
                    <a href="{{ url('teacher/my_notice_board') }}" class="nav-link @if(Request::segment(2) == 'my_notice_board') active @endif">
                      <i class="nav-icon far fa-user"></i>
                      <p>
                        My Notice Board
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
               }





               {{-- SIDEBAR FOR STUDENT --}}
               @elseif (Auth::user()->user_type == 3)
               {
                <li class="nav-item">
                  <a href="{{ url('student/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Dashboard
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
                  <a href="{{ url('student/my_exam_result') }}" class="nav-link @if(Request::segment(2) == 'my_exam_result') active @endif">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                      My Exam Result
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


               }



               {{-- SIDEBAR FOR PARENT --}}
               @elseif (Auth::user()->user_type == 4)
               {
                <li class="nav-item">
                  <a href="{{ url('parent/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Dashboard
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


               }


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