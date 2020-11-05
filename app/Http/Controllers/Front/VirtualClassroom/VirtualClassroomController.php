<?php

namespace App\Http\Controllers\Front\VirtualClassroom;

use App\Models\StudentsSubjects;
use Illuminate\Support\Facades\DB;
use Validator;
use mikemix\Wiziq;
use App\Lecture;
use App\Subject;
use App\Major;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AcademicYear;
use Carbon\Carbon;
use MacsiDigital\Zoom\Zoom;

class VirtualClassroomController extends Controller
{

    // wiziq
    private function wiziqConfig()
    {
//        echo config('wiziq.secret_Key');
//        exit;
        $auth    = new Wiziq\API\Auth(config('wiziq.secret_Key'), config('wiziq.access_key'));
        $gateway = new Wiziq\API\Gateway($auth);
        $api     = new Wiziq\API\ClassroomApi($gateway);

        return $api;
    }

    private function createWiziqClass($request)
    {
//        $lecture = Lecture::findOrFail($request->lecture_id);
//        $teacher = $lecture->teacher->user;
//        $classTitle = $request->title;

        $startTime = '2020-10-29 23:37:7';
        $classTitle = 'test class title';
        $teacherId = 1;
        $teacherName = 'Ahmed Abdullah';
        $attendeeLimit = 10; // max in free us 10
        $createRecording = false; // false non recording, true recording

        $api = $this->wiziqConfig();
        $startTimeWiziq = Carbon::parse(/*$request->start_time*/ $startTime)->format("m/d/Y H:i");

        try {
            $classroom = Wiziq\Entity\Classroom::build($classTitle, new \DateTime($startTimeWiziq))
                ->withPresenter(/*$teacher->id*/$teacherId, /*$teacher->full_name*/ $teacherName)
                ->withDuration(300)
                ->withAttendeeLimit(/*$request->attendee_limit*/$attendeeLimit)
                ->withCreateRecording(/*$request->create_recording*/ $createRecording)
                ->withTimeZone('Asia/Jerusalem');

            $response  = $api->create($classroom);
            return $response;
            // printf('Class %s created: %s', $classroom, var_export($response, true));
        } catch (Wiziq\Common\Api\Exception\CallException $e) {
            die($e->getMessage()); // change to return false
        } catch (Wiziq\Common\Http\Exception\InvalidResponseException $e) {
            die($e->getMessage()); // change to return false
        }
    }

    private function addAttendees($classID, $students)
    {
        $api = $this->wiziqConfig();

        try {
            $classroomId = $classID;

            $attendees = Wiziq\Entity\Attendees::build();

            foreach($students as $student){
//                $attendees = $attendees->add($student->id, $student->user->full_name, 'ar-SA');
                $attendees = $attendees->add($student->id, $student->fullname, 'ar-SA');
            }

            $response = $api->addAttendeesToClass($classroomId, $attendees);
             return $response;
            // printf('Attendees to class %d added: %s', $classroomId, var_export($response, true));
        } catch (Wiziq\Common\Api\Exception\CallException $e) {
            die($e->getMessage());
        } catch (Wiziq\Common\Http\Exception\InvalidResponseException $e) {
            die($e->getMessage());
        }
    }

    public function wiziq()
    {

        if(auth()->user()->hasRole('teacher')){
            $subjects = Subject::whereHas('teachers',function($q){
                $q->where("teacher_id",auth()->user()->teacher->id);
            })->where('is_active', 1)->get();
        }else{
            $subjects = Subject::where('is_active', 1)->get();
        }

        return view('dashboard.wiziq', compact('subjects'));
    }

    public function storeWiziq(Request $request)
    {
//        $virtualClassroom = new VirtualClassroom;
//        $virtualClassroom->title = $request->title;
//        $virtualClassroom->lecture_id = $request->lecture_id;
//        $virtualClassroom->start_time = $request->start_time;
//        $virtualClassroom->user_id = auth()->id();

//        $students = DB::table('student_subjects')->select('vendors.id')
//            ->join('vendors', 'student_subjects.student_id', '=', 'vendors.id')
//            ->where('subject_id', '=', 10)->get();
//        var_dump($students);
//        exit;
        // ---------------------------------------------------------------------------------------------------
//        $auth    = new Wiziq\API\Auth('kc9hG9vEv+FcCvEt0IXfnA==', 'PRvGVbt+NgY=');
//        $gateway = new Wiziq\API\Gateway($auth);
//        $api     = new Wiziq\API\ClassroomApi($gateway);
//
//        try {
//            $classroom = Wiziq\Entity\Classroom::build('Class title', new \DateTime('now'))
//                ->withPresenter(100, 'Presenter Name');
//
//            $response  = $api->create($classroom);
//
//            printf('Class %s created: %s', $classroom, var_export($response, true));
//        } catch (Wiziq\Common\Api\Exception\CallException $e) {
//            die($e->getMessage());
//        } catch (Wiziq\Common\Http\Exception\InvalidResponseException $e) {
//            die($e->getMessage());
//        }
//        exit;
        // ---------------------------------------------------------------------------------------------------
        if($wiziqResponse = $this->createWiziqClass($request)){
//            echo '<pre>';
//                var_dump($wiziqResponse);
//            echo '</pre>';
//            exit;
//            $virtualClassroom->class_id = $wiziqResponse['class_id'];
//            $virtualClassroom->recording_url = $wiziqResponse['recording_url'];
//            $virtualClassroom->presenter_url = $wiziqResponse['presenter_url'];

//            if($virtualClassroom->save()){
//                $subject = Subject::findOrFail($request->subject_id);
//                $students = $subject->students;
            $students = DB::table('student_subjects')->select('vendors.id', 'vendors.fullname')
                ->join('vendors', 'student_subjects.student_id', '=', 'vendors.id')
                ->where('subject_id', '=', 10)->get();
                $wiziqResponse = $this->addAttendees($wiziqResponse['class_id'], $students);

                if(!empty($wiziqResponse)){
                    $studentClassData = [];
                    foreach($wiziqResponse as $user){
                        $studentClassData[] = [
                            "virtual_classroom_id"=>/*$virtualClassroom->id,*/ 1,
                            "url"=>$user["url"],
                            "student_id"=>$user["id"],
                        ];
                    }
                    var_dump($studentClassData);
//                    StudentClass::insert($studentClassData);
                }
//            }
        }

        session()->flash('success', __('dashboard.statuses.virtual_classroom_created'));
        if(auth()->user()->hasRole('teacher')){
            return response()->json(["redir"=>route('dashboard.home')]);
        }

        return response()->json(["redir"=>route('virtual-classroom.index')]);
    }

}
