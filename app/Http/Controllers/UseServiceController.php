<?php

namespace App\Http\Controllers;

use App\Course;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class UseServiceController extends Controller
{


    private $_client    = null;
    private $apiURL     = "localhost:8009/api/course/";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        if($this->_client == null){

            return $this->_client = new Client();

        }
        else{

            return $this->_client;

        }

    }


    public function testGuzzle(){

        $response = $this->_client->request('GET', 'https://api.github.com/repos/guzzle/guzzle');

        //echo $response->getStatusCode(); # 200
        //echo $response->getHeaderLine('content-type'); # 'application/json; charset=utf8'


        if($response->getStatusCode() == 200){

            $data = json_decode($response->getBody());

            //echo $data->id;

            $this->_client = null;

            //echo gettype($this->_client);


            /*$response = $this->_client->request('GET', 'https://api.github.com/repos/guzzle/guzzle');

            echo $response->getStatusCode();*/

            $ary = ["status" => $response->getStatusCode(),"text" => "Guzzle Test Başarılı"];

            return json_encode($ary);
        }

    }

    public function getAllCourses(){

        $response = $this->_client->request('GET', $this->apiURL."list");

        return $response->getBody();

    }

    public function addNewCourse(){

        $data = [
            "form_params" => [
                "title"         => "Api test",
                "couponCode"    => "APIC",
                "price"         => 25.00
            ]
        ];

        $response = $this->_client->request('POST', $this->apiURL."add",$data);


        return $response->getBody();

    }

    public function updateCourse(){

        $data = [
            "form_params" => [
                "courseID"         => 10,
                "title"         => "Api test güncellendi",
                "couponCode"    => "APICG",
                "price"         => 35.00
            ]
        ];

        $response = $this->_client->request('PUT', $this->apiURL."update",$data);


        return $response->getBody();

    }

    public function deleteCourse(){

        $data = [
            "form_params" => [
                "courseID"         => 10,
            ]
        ];

        $response = $this->_client->request('DELETE', $this->apiURL."delete",$data);

        return $response->getBody();

    }

}


