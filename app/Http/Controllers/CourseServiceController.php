<?php

namespace App\Http\Controllers;

use App\Course;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CourseServiceController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /* Set Dynamic JSON Response */

    public function setResponse($statusCode,$success,$message,$responseData = null){

        $data = [
            "StatusCode"    => $statusCode,
            "Success"       => $success,
            "Message"       => $message,
            "Data"          => $responseData
        ];

        return $data;

    }

    /* Add New Course */

    public function addNewCourse(Request $request){

        //dd($request);

        $title = $request->title;
        $couponCode = $request->couponCode;
        $price = (double)$request->price;

        if(!empty($title) && !empty($couponCode) && !empty($price)){


            try{

                $course = new Course();

                $course->title      = $title;
                $course->couponCode = $couponCode;
                $course->price      = $price;

                if($course->save()){

                    $data = $this->setResponse(200,true,"New Course Added.",$course);

                    return response()->json($data)->header("Content-Type","application-json");

                }

            }
            catch (\Exception $exception){

                $data = $this->setResponse(400,false,$exception->getMessage());

                return response()->json($data)->header("Content-Type","application-json");

            }


        }
        else{

            $data = $this->setResponse(400,false,"Fill all fields.");

            return response()->json($data)->header("Content-Type","Application*Json");
        }

    }


    /* List All Course */

    public function getAllCourseList(){

        try{

            $courses = Course::all();

            if(count($courses) > 0){

                $data = $this->setResponse(200,true,"All Courses Listed.",$courses);

                return response()->json($data)->header("Content-Type","application-json");

            }
            else{

                $data = $this->setResponse(200,true,"There is no data.",$courses);

                return response()->json($data)->header("Content-Type","application-json");

            }

        }
        catch (\Exception $exception){

            $data = $this->setResponse(400,false,$exception->getMessage());

            return response()->json($data)->header("Content-Type","application-json");

        }

    }


    /* Update Course */

    public function updateCourse(Request $request){

        $courseID = (integer)$request->courseID;

        $title = $request->title;
        $couponCode = $request->couponCode;
        $price = (double)$request->price;


        if(!empty($courseID)){


            try{

                $course = Course::find($courseID);


                if(is_null($course)){

                    $data = $this->setResponse(400,false,"No matches found");

                    return response()->json($data)->header("Content-Type","application-json");

                }

                if(!empty($title)) $course->title           = $title;
                if(!empty($couponCode)) $course->couponCode = $couponCode;
                if(!empty($price)) $course->price           = $price;

                if($course->save()){

                    $data = $this->setResponse(200,true,"Update Process Successful.",$course);

                    return response()->json($data)->header("Content-Type","application-json");

                }


            }
            catch (\Exception $exception){

                $data = $this->setResponse(400,false,$exception->getMessage());

                return response()->json($data)->header("Content-Type","application-json");

            }


        }
        else{

            $data = $this->setResponse(400,false,"Fill all fields.");

            return response()->json($data)->header("Content-Type","Application*Json");
        }

    }


    /* Delete Course */

    public function deleteCourse(Request $request){

        $courseID = (integer)$request->courseID;

        if(!empty($courseID)){

            try{

                $course = Course::find($courseID);

                if(is_null($course)){

                    $data = $this->setResponse(400,false,"No matches found");

                    return response()->json($data)->header("Content-Type","application-json");

                }

                $course->delete();

                $data = $this->setResponse(200,true,"Delete Process Successful.",$course);

                return response()->json($data)->header("Content-Type","application-json");


            }
            catch (\Exception $exception){

                $data = $this->setResponse(400,false,$exception->getMessage());

                return response()->json($data)->header("Content-Type","application-json");

            }

        }
        else{

            $data = $this->setResponse(400,false,"Fill all fields.");

            return response()->json($data)->header("Content-Type","Application*Json");

        }

    }

}

