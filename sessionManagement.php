<?php
/**
 * MIT License

Copyright (c) 2019 Tekin

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

 **/


require ('session.php');


$pData = json_decode(file_get_contents('php://input'), true);

$username = htmlspecialchars( $pData['username']);
$password = htmlspecialchars( $pData['password']);

// login and start session
if(isset($pData['login']) && $pData['login']===true && !empty($username) && !empty($password)) {

    /**
     *
     * Here you can insert DB-connection or something like that to get user from database
     * After that change 'PASSWORD' and 'USERNAME'
     *
     */
        if($password=='PASSWORD' && $username=='USERNAME' ) {
            $session = Session::getInstance();
            $session->username = $username;
            $session->id = $session->getID();
            $session->status = "success";
            // return SESSION
            echo json_encode($_SESSION, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }else{
            // return error if failed to login
            echo json_encode(array("status"=>"error"));
        }




}

// check for valid session
else if(isset($pData['loginStatus']) && $pData['loginStatus']===true) {

    $sessID = htmlspecialchars($pData['loginID']);
    $session = Session::getInstance();
    // CHECK
    if(!empty($sessID) && $session->id == $sessID) {
        $session->status = "success";
    }else{
        $session->status = "error";
    }

    echo json_encode($_SESSION, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

}

// end session
else if(isset($pData['logout']) && $pData['logout']==true) {

    $sessID = htmlspecialchars($pData['loginID']);
    $session = Session::getInstance();

    if(!empty($sessID) && $session->id == $sessID) {
        $session->destroy();
        echo json_encode(array("status"=>"success"));
    }else{
        echo json_encode(array("status"=>"error"));
    }

}
