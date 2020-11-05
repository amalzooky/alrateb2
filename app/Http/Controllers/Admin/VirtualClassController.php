<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Groups;
use App\Models\Lecture;
use App\Models\MainCategory;
use App\Models\Major;
use App\Models\StudentClass;
use App\Models\Subjects;
use App\Models\VirtualClassroom;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MacsiDigital\Zoom\Support\Entry;
use MacsiDigital\Zoom\Zoom;
use mikemix\Wiziq;
use Validator;


class VirtualClassController extends Controller
{

    // zoom
    public function createZoom()
    {
        $categories = MainCategory::where('translation_of', 0)->active()->get();
        $majors = Major::all()->where('translation_lang', get_default_lang())->sortByDesc('id');
        $subjects = Subjects::all()->where('translation_lang', get_default_lang())->sortByDesc('id');
        $groups = Groups::all()->where('translation_lang', get_default_lang())->sortByDesc('id');
        return view('admin.zoom.create', compact('categories', 'majors', 'subjects', 'groups'));

    }

    public function storeZOOM(Request $request)
    {
        $zoom = new Entry;
        // $user = new \MacsiDigital\Zoom\User($zoom);
        // $zoom = new Zoom;
//        $user = $zoom->user->find('amal_zooky@yahoo.com');
        $user = $zoom->user->find('black6805120@gmail.com');
        $meeting = $user->meetings()->create([
            'type' => 2,
            'start_time' => $request->start_time,
            'topic' => $request->title
        ]);

//
        $virtualClassroom = new VirtualClassroom;
        $virtualClassroom->title = $request->title;
        $virtualClassroom->group_id = $request->group_id;
        $virtualClassroom->subject_id = $request->subject_id;
        $virtualClassroom->start_time = $request->start_time;
        $virtualClassroom->join_url = $meeting->join_url;
        $virtualClassroom->user_id = auth()->id();
        $virtualClassroom->save();

        // session()->flash('success', __('dashboard.statuses.virtual_classroom_created'));
        // if(auth()->user()->hasRole('teacher')){
        //     return response()->json(["redir"=>route('dashboard.home')]);
        // }

        // return response()->json(["redir"=>route('virtual-classroom.index')]);
        echo "Link of meeting is: $meeting->join_url";
    }

    // index ???
    public function index()
    {
        Bigbluebutton::create([
            'meetingID' => 'tamku',
            'meetingName' => 'test meeting',
            'attendeePW' => 'attendee',
            'moderatorPW' => 'moderator',
            'bbb-recording-ready-url' => 'https://example.com/api/v1/recording_status',
        ]);
        // // dd(\Bigbluebutton::isConnect()); //default
        // // dd(\Bigbluebutton::server('server1')->isConnect()); //for specific server
        // dd(bigbluebutton()->isConnect()); //using helper method
    }

    // wiziq
    public function createWiziq()
    {
        $categories = MainCategory::where('translation_of', 0)->active()->get();
        $majors = Major::all()->where('translation_lang', get_default_lang())->sortByDesc('id');
        $subjects = Subjects::all()->where('translation_lang', get_default_lang())->sortByDesc('id');
        $lectures = Lecture::all()->where('translation_lang', get_default_lang())->sortByDesc('id');

        return view('admin.wiziq.create', compact('categories', 'majors', 'subjects', 'lectures'));

    }

    private function wiziqConfig()
    {
        $auth = new Wiziq\API\Auth(config('wiziq.secret_Key'), config('wiziq.access_key'));
        $gateway = new Wiziq\API\Gateway($auth);
        $api = new Wiziq\API\ClassroomApi($gateway);

        return $api;
    }

    private function createWiziqClass($request)
    {
        $lecture = Lecture::findOrFail($request->lecture_id);
        $teacher = $lecture->teacher;
        $classTitle = $request->title;

//        $startTime = '2020-10-29 23:37:7';
//        $classTitle = 'test class title';
//        $teacherId = 1;
//        $teacherName = 'Ahmed Abdullah';
//        $attendeeLimit = 10; // max in free us 10
//        $createRecording = false; // false non recording, true recording

        $api = $this->wiziqConfig();
        $startTimeWiziq = Carbon::parse($request->start_time)->format("m/d/Y H:i");

        try {
            $classroom = Wiziq\Entity\Classroom::build($classTitle, new DateTime($startTimeWiziq))
                ->withPresenter($teacher->id, $teacher->fullname)
                ->withDuration(300)
                ->withAttendeeLimit($request->attendee_limit)
                ->withCreateRecording(!empty($request->create_recording))
                ->withTimeZone('Asia/Jerusalem');

            $response = $api->create($classroom);
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

            foreach ($students as $student) {
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

    public function storeWiziq(Request $request)
    {
        $virtualClassroom = new VirtualClassroom;
        $virtualClassroom->title = $request->title;
        $virtualClassroom->subject_id = $request->subject_id;
        $virtualClassroom->group_id = $request->lecture_id;
        $virtualClassroom->start_time = $request->start_time;
        $virtualClassroom->user_id = auth()->id();

        if ($wiziqResponse = $this->createWiziqClass($request)) {
            $virtualClassroom->class_id = $wiziqResponse['class_id'];
            $virtualClassroom->recording_url = $wiziqResponse['recording_url'];
            $virtualClassroom->presenter_url = $wiziqResponse['presenter_url'];
            $virtualClassroom->join_url = $wiziqResponse['presenter_url']; // join_url same presenter_url, you can delete anyone

            if ($virtualClassroom->save()) {
                $students = DB::table('student_subjects')->select('vendors.id', 'vendors.fullname')
                    ->join('vendors', 'student_subjects.student_id', '=', 'vendors.id')
                    ->where('subject_id', '=', 10)->get();
                $wiziqResponse = $this->addAttendees($wiziqResponse['class_id'], $students);

                if (!empty($wiziqResponse)) {
                    $studentClassData = [];
                    foreach ($wiziqResponse as $user) {
                        $studentClassData[] = [
                            "virtual_classroom_id" => $virtualClassroom->id,
                            "url" => $user["url"],
                            "student_id" => $user["id"],
                        ];
                    }
                    StudentClass::insert($studentClassData);
                }
            }
        }

        session()->flash('success', 'تم انشاء الدرس');
        return redirect('admin.virtualclass.wiziq.create');
    }

    // webinar
    public function createWebinarPage()
    {
        $categories = MainCategory::where('translation_of', 0)->active()->get();
        $majors = Major::all()->where('translation_lang', get_default_lang())->sortByDesc('id');
        $subjects = Subjects::all()->where('translation_lang', get_default_lang())->sortByDesc('id');
        $lectures = Lecture::all()->where('translation_lang', get_default_lang())->sortByDesc('id');

        return view('admin.webinar.create', compact('categories', 'majors', 'subjects', 'lectures'));

    }

    private function webinarConfig($account){

        $api_version = config("gotowebinar.{$account}.api_version");
        switch ($api_version) {
            case '2':
                return [
                    'form_params' => [
                        "grant_type"=>"password",
                        "user_id"=>config("gotowebinar.{$account}.user_id"),
                        "password"=>config("gotowebinar.{$account}.password"),
                        "client_id"=>config("gotowebinar.{$account}.client_id"),
                        'api_version' => config("gotowebinar.{$account}.api_version")
                    ]
                ];
            case '3':
                return [
                    'form_params' => [
                        "grant_type"=>"password",
                        "username"=>config("gotowebinar.{$account}.user_id"),
                        "password"=>config("gotowebinar.{$account}.password"),
                        'api_version' => config("gotowebinar.{$account}.api_version")
                    ]
                ];

            default:
                return false;
                break;
        }

    }

    private function headers($access_token)
    {
        return $headers = [
            'headers' => [
                'content-type' => 'application/json',
                'accept' => 'application/json',
                'Authorization' => $access_token
            ]
        ];
    }

    private function createWebinar($request){
        $config = $this->webinarConfig($request->webinar_account);
        if($config['form_params']['api_version'] == 2){
            $client = new \GuzzleHttp\Client();
            $res = $client->request('POST', 'https://api.getgo.com/oauth/access_token', $config);
        }else if($config['form_params']['api_version'] == 3){
            $client = new \GuzzleHttp\Client([
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Authorization' => 'Basic SFVEYXNDTklrN0FNSUNRRTVCdW1Sc05KeHhsbWg1aTE6d1psRDVYN3VzNnRpUjUyTQ==',
                ]
            ]);

            $res = $client->request('POST', 'https://api.getgo.com/oauth/v2/token', $config);
        }


        $auth = json_decode($res->getBody());
        $access_token = $auth->access_token;
        $organizer_key = $auth->organizer_key;
//        echo '<pre>';
//        var_dump($config);
//        echo '</pre>';
//        exit;
//        if(settings()->time == 1){
            $startTime = Carbon::parse($request->start_time)/*->subHour(3)*/->format('Y-m-d\TH:i:s\Z');
            $endTime = Carbon::parse($request->webinar_end_time)/*->subHour(3)*/->format('Y-m-d\TH:i:s\Z');
//        }else if(settings()->time == 2){
//            $startTime = Carbon::parse('2020-11-02 0:37:42'/*$request->start_time*/)->subHour(2)->format('Y-m-d\TH:i:s\Z');
//            $endTime = Carbon::parse('2020-11-02 2:37:42'/*$request->webinar_end_time*/)->subHour(2)->format('Y-m-d\TH:i:s\Z');
//        }else{
//            $startTime = Carbon::parse('2020-11-02 0:37:42'/*$request->start_time*/)->subHour(2)->format('Y-m-d\TH:i:s\Z');
//            $endTime = Carbon::parse('2020-11-02 2:37:42'/*$request->webinar_end_time*/)->subHour(2)->format('Y-m-d\TH:i:s\Z');
//        }



        $arr = [
            'subject' => 'test title'/*$request->title*/,
            'description' => 'test description'/*$request->description*/,
            'times' => [
                [
                    "startTime" => $startTime,
                    "endTime" => $endTime
                ]
            ],
            "timeZone" => "Asia/Jerusalem"
        ];



        $client2 = new \GuzzleHttp\Client($this->headers($access_token));
        $res2 = $client2->post("https://api.getgo.com/G2W/rest/organizers/{$organizer_key}/webinars",['json' => $arr]);

        $webinarKey = json_decode($res2->getBody(), true)['webinarKey'];

        return [
            'webinarKey' => $webinarKey,
            'access_token' => $access_token,
            'organizer_key' => $organizer_key

        ];
    }

    private function getWebinar($webinarKey, $accessToken, $organizerKey)
    {
        $client = new \GuzzleHttp\Client($this->headers($accessToken));
        $res = $client->get("https://api.getgo.com/G2W/rest/organizers/{$organizerKey}/webinars/{$webinarKey}");

        $webinar = json_decode($res->getBody(), true);
        return $webinar['registrationUrl'];
    }

    public function webinar()
    {


        if(auth()->user()->hasRole('teacher')){
            $subjects = Subject::whereHas('teachers',function($q){
                $q->where("teacher_id",auth()->user()->teacher->id);
            })->where('is_active', 1)->get();
        }else{
            $subjects = Subject::where('is_active', 1)->get();
        }

        return view('dashboard.webinar', compact('subjects'));
    }

    public function storeWebinar(Request $request)
    {

        $virtualClassroom = new VirtualClassroom;
        $virtualClassroom->title = $request->title;
//        $virtualClassroom->lecture_id = $request->lecture_id;
        $virtualClassroom->group_id = $request->lecture_id;
        $virtualClassroom->subject_id = $request->subject_id;
        $virtualClassroom->start_time = $request->start_time;
        $virtualClassroom->webinar_description  = $request->webinar_description;
        $virtualClassroom->webinar_end_time  = $request->webinar_end_time;
        $virtualClassroom->user_id = auth()->id();

        if($webinarResponse = $this->createWebinar($request)){
            $webinarKey = $webinarResponse['webinarKey'];
            $accessToken = $webinarResponse['access_token'];
            $organizerKey = $webinarResponse['organizer_key'];

            if($webinarUrl = $this->getWebinar($webinarKey, $accessToken, $organizerKey)){
//                echo '<pre>';
//                var_dump($webinarUrl);
//                echo '</pre>';
//                exit;
                $virtualClassroom->webinar_url  = $webinarUrl;
                $virtualClassroom->save();
            }// end getWebinar if
        }// end createWebinar if

//        session()->flash('success', __('dashboard.statuses.virtual_classroom_created'));
        session()->flash('success', 'تم انشاء البث بنجاح');
//        if(auth()->user()->hasRole('teacher')){
//            return response()->json(["redir"=>route('dashboard.home')]);
//        }

//        return response()->json(["redir"=>route('virtual-classroom.index')]);
        return redirect()->back();

    }

    // zoom and wiziq
    public function createZoomWiziq()
    {
        $categories = MainCategory::where('translation_of', 0)->active()->get();
        $majors = Major::all()->where('translation_lang', get_default_lang())->sortByDesc('id');
        $subjects = Subjects::all()->where('translation_lang', get_default_lang())->sortByDesc('id');
        $lectures = Lecture::all()->where('translation_lang', get_default_lang())->sortByDesc('id');

        return view('admin.zoomwiziq.create', compact('categories', 'majors', 'subjects', 'lectures'));

    }

    public function storeZoomWiziq(Request $request){
        try{
            // zoom
            $zoom = new Entry;
            $user = $zoom->user->find('black6805120@gmail.com'); // zoom account that you login with it
            $meeting = $user->meetings()->create([
                'type' => 2,
                'start_time' => $request->start_time,
                'topic' => $request->title
            ]);

            $virtualClassroom = new VirtualClassroom;
            $virtualClassroom->title = $request->title;
            $virtualClassroom->group_id = $request->lecture_id;
            $virtualClassroom->subject_id = $request->subject_id;
            $virtualClassroom->start_time = $request->start_time;
            $virtualClassroom->join_url = $meeting->join_url;
            $virtualClassroom->user_id = auth()->id();
            if ($virtualClassroom->save()){ // wiziq
                $virtualClassroom = new VirtualClassroom;
                $virtualClassroom->title = $request->title;
                $virtualClassroom->subject_id = $request->subject_id;
                $virtualClassroom->group_id = $request->lecture_id;
                $virtualClassroom->start_time = $request->start_time;
                $virtualClassroom->user_id = auth()->id();

//                echo '<pre>';
//                var_dump($this->createWiziqClass($request));
//                echo '</pre>';
//                exit;

                if ($wiziqResponse = $this->createWiziqClass($request)) {
                    $virtualClassroom->class_id = $wiziqResponse['class_id'];
                    $virtualClassroom->recording_url = $wiziqResponse['recording_url'];
                    $virtualClassroom->presenter_url = $wiziqResponse['presenter_url'];
                    $virtualClassroom->join_url = $wiziqResponse['presenter_url']; // join_url same presenter_url, you can delete anyone

                    if ($virtualClassroom->save()) {
                        $students = DB::table('student_subjects')->select('vendors.id', 'vendors.fullname')
                            ->join('vendors', 'student_subjects.student_id', '=', 'vendors.id')
                            ->where('subject_id', '=', 10)->get();
                        $wiziqResponse = $this->addAttendees($wiziqResponse['class_id'], $students);

                        if (!empty($wiziqResponse)) {
                            $studentClassData = [];
                            foreach ($wiziqResponse as $user) {
                                $studentClassData[] = [
                                    "virtual_classroom_id" => $virtualClassroom->id,
                                    "url" => $user["url"],
                                    "student_id" => $user["id"],
                                ];
                            }
                            StudentClass::insert($studentClassData);
                        }
                    }
                }
            }
            session()->flash('success', 'تم إنشاء البث بنجاح');
        } catch (\Exception $e){
            session()->flash('error', 'حدث خطأ ما، حاول مره اخرى');
        }
        return redirect()->back();
    }
}
