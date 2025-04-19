<?php

namespace App\Http\Controllers;

use App\Mail\SendEmailUserMail;
use App\Models\NoticeBoard;
use App\Models\NoticeBoardMessage;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CommunicationController extends Controller
{

    public function commentBank()
    {      
        $data['header_title'] = 'Comment Bank';
        return view('teacher.comment_bank', $data);
    }



    public function newsLetter()
    {
        $data['header_title'] = 'News Letter';
        return view('admin.communication.news_letter', $data);    
    }



    public function newsLetterUser(Request $request)
    {


        if (!empty($request->user_id)) {
            $user = User::getSingle($request->user_id);
            $user->send_message = $request->message;
            $user->send_subject = $request->subject;
            $user->document = $request->document ? $request->file('document')->store('documents') : null;
            Mail::to($user->email)->send(new SendEmailUserMail($user));
        }

        if (!empty($request->message_to)) {
            foreach ($request->message_to as $user_type) {
                $getUser = User::getUser($user_type);

                foreach ($getUser as $user) {
                    $user->send_message = $request->message;
                    $user->send_subject = $request->subject;
                    $user->document = $request->document ? $request->file('document')->store('documents') : null;
                    Mail::to($user->email)->send(new SendEmailUserMail($user));
                }
            }
        }


        return redirect()->back()->with('success', 'Newsletter Successfully Sent!');
    }



    public function searchUser(Request $request)
    {   
        $json = array();
        if(!empty($request->search))
        {
            $getUser = User::searchUser($request->search);
            foreach($getUser as $value)
            {
                $type = '';
                if($value->user_type == 1 || $value->user_type == "Super Admin")
                {
                    $type = 'Admin';
                }

                elseif($value->user_type == 2)
                {
                    $type = 'Teacher';
                }

                elseif($value->user_type == 3)
                {
                    $type = 'Student';
                }

                elseif($value->user_type == 4)
                {
                    $type = 'Parent';
                }

                $name = $value->name.' '.$value->last_name.' '.$value->other_name.' - '.$type;
                $json[] = ['id' => $value->id, 'text' => $name];
            }
        }

        echo json_encode($json);
    }

    




    //====FOR SENDING OF EMAIL TO A SINGLE INPUTTED MAIL===////
    public function sendEmail()
    {
        $data['header_title'] = 'Send Email';
        return view('admin.communication.send_email', $data);    
    }



    public function sendEmailUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'document' => 'nullable|file|mimes:pdf,doc,docx,txt,jpg,jpeg,png'
        ]);

        $emailDetails = [
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'document' => $request->file('document') ? $request->file('document')->store('documents') : null
        ];

        Mail::to($emailDetails['email'])->send(new SendEmailUserMail($emailDetails));

        return redirect()->back()->with('success', 'Email Successfully Sent!');
    }





    public function sendReportCard()
    {
        $data['header_title'] = "Send Report Card";
        return view('admin.communication.send_report_card', $data);
    }


    public function sendReportCardNow()
    {
        //Not working yet
        return redirect()->back()->with('success'. 'Report Cards Sent Successfully!');
    }









    /*
        Publish_date = The day the news should appear on the users' dashboard.
        
        Notice date = The date th

    */


    public function noticeBoard()
    {
        $data['getRecord'] = NoticeBoard::getRecord();
        $data['header_title'] = 'Notice Board';
        return view('admin.communication.notice_board.list', $data);
    }



    public function addNoticeBoard()
    {
        $data['header_title'] = 'Add New Notice Board';
        return view('admin.communication.notice_board.add', $data);
    }


    public function insertNoticeBoard(Request $request)
    {
        $save = new NoticeBoard;
        $save->title = $request->title;
        $save->notice_date = $request->notice_date;
        $save->publish_date = $request->publish_date;
        $save->message = $request->message;
        $save->created_by = Auth::user()->id;
        $save->save();

        if(!empty($request->message_to))
        {
            foreach($request->message_to as $message_to)
            {
                $message = new NoticeBoardMessage;
                $message->notice_board_id = $save->id;
                $message->message_to = $message_to;
                $message->save();
            }
        }
        

        return redirect()->route('communication.notice_board.list')->with('success', 'Notice Board Successfully Created');


    }


    public function editNoticeBoard($id)
    {
        $data['getRecord'] = NoticeBoard::getSingle($id);
        $data['header_title'] = 'Edit Notice Board';
        return view('admin.communication.notice_board.edit', $data);
    }



    public function updateNoticeBoard(Request $request, $id)
    {
        $save = NoticeBoard::getSingle($id);
        $save->title = $request->title;
        $save->notice_date = $request->notice_date;
        $save->publish_date = $request->publish_date;
        $save->message = $request->message;
        $save->save();

        NoticeBoardMessage::deleteRecord($id);

        if(!empty($request->message_to))
        {
            foreach($request->message_to as $message_to)
            {
                $message = new NoticeBoardMessage;
                $message->notice_board_id = $save->id;
                $message->message_to = $message_to;
                $message->save();
            }
        }
        

        return redirect()->route('communication.notice_board.list')->with('success', 'Notice Board Successfully Updated');


    }


    public function deleteNoticeBoard($id)
    {
        $data = NoticeBoard::findOrFail($id);
        $data->delete();

        NoticeBoardMessage::deleteRecord($id); 
        
        return redirect()->back()->with('success', 'Notice Board Successfully Deleted');
    }



    //Student Side
    public function myNoticeBoardStudent()
    {
        $data['getRecord'] = NoticeBoard::getRecordUser(Auth::user()->user_type);
        $data['header_title'] = 'My Notice Board';
        return view('student.my_notice_board', $data);
    }



    //Teacher Side
    public function myNoticeBoardTeacher()
    {
        $data['getRecord'] = NoticeBoard::getRecordUser(Auth::user()->user_type);
        $data['header_title'] = 'My Notice Board';
        return view('teacher.my_notice_board', $data);
    }



    ///Parent Side
    public function myNoticeBoardParent()
    {
        $data['getRecord'] = NoticeBoard::getRecordUser(Auth::user()->user_type);
        $data['header_title'] = 'My Notice Board';
        return view('parent.my_notice_board', $data);
    }



    public function myStudentNoticeBoardParent()
    {
        $data['getRecord'] = NoticeBoard::getRecordUser(3);
        $data['header_title'] = 'My Notice Board';
        return view('parent.my_student_notice_board', $data);
    }


   




    








}
