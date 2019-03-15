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

class Session
{
    const SESSION_ACTIVE = TRUE;
    const SESSION_NOT_ACTIVE = FALSE;

    private $sessionState = self::SESSION_NOT_ACTIVE;

    private static $instance;


    private function __construct() {}

    public static function getInstance()
    {
        if ( !isset(self::$instance))
        {
            self::$instance = new self;
        }

        self::$instance->startSession();

        return self::$instance;
    }

    public function startSession()
    {
        if ( $this->sessionState == self::SESSION_NOT_ACTIVE )
        {
            $this->sessionState = session_start();
        }

        return $this->sessionState;
    }


    public function __set( $key , $value )
    {
        $_SESSION[$key] = $value;
    }


    public function __get( $key )
    {
        if ( isset($_SESSION[$key]))
        {
            return $_SESSION[$key];
        }
        return null;
    }

    public function getID()
    {
        if ( $this->sessionState == self::SESSION_ACTIVE )
        {
            return session_id();
        }

        return FALSE;
    }

    public function __isset( $name )
    {
        return isset($_SESSION[$name]);
    }

    public function __unset( $name )
    {
        unset( $_SESSION[$name] );
    }

    public function destroy()
    {
        if ( $this->sessionState == self::SESSION_ACTIVE )
        {
            $this->sessionState = !session_destroy();
            unset( $_SESSION );

            return !$this->sessionState;
        }

        return FALSE;
    }


}
