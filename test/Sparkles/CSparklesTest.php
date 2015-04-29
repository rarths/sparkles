<?php

namespace Rarths\Sparkles;

/**
* A testclass for Sparkles module
* 
*/
class CSparklesTest extends \PHPUnit_Framework_TestCase {
    
    // DI Service object
    private $di = null;

    /**
    * Costructor sets instance of $di
    *
    * @return void
    *
    */
    public function __construct() {
        $this->di = new \Anax\DI\CDIFactoryDefault();
    }


    /**
    * Initialise session service to class object
    *
    * @return void
    *
    */
    private function initSessionService($class) {
        $class->setDI($this->di);
        $this->di->setShared('session', function () {
            $session = new \Anax\Session\CSession();
            $session->configure(ANAX_APP_PATH . 'config/session.php');
            $session->name();
            //$session->start();
            return $session;
        });
        return $class;
    }


    /**
    * Test to add a message.
    *
    * @return void
    *
    */
    public function testFlashing() {

        $sparkles = new \Rarths\Sparkles\CSparkles();
        $sparkles = $this->initSessionService($sparkles);

        $type = 'error';
        $message = 'This is a test message';
        $sparkles->flash($type, $message); // send message

        $output = $sparkles->output(); // get message
        $exp = "<span class='error'><p>This is a test message</p></span>";
        $this->assertEquals($exp, $output[0], "Test message arrived not as aspected");
    }


    /**
    * Tests to instantiate Sparkles object with CSS classes parameters.
    *
    * @return void
    *
    */
    public function testClassParamters() {
        // Custom CSS classes
        $css = array(
            'error'     => 'custom-error',
            'success'   => 'custom-success',
            'notice'    => 'custom-notice'
            );
        // Create object with custom CSS classes
        $module = new \Rarths\Sparkles\CSparkles($css);

        $initClasses = array(
            'error'     => $module->error,
            'success'   => $module->success,
            'notice'    => $module->notice
            );
        // Test CSS classes with the created object
        $this->assertEquals($css, $initClasses, "Instantiated CSS classes does not match.");
    }


    /**
    * Tests set data to session.
    *
    * @return void
    *
    */
    public function testSetToSession() {
        $sparkles = new \Rarths\Sparkles\CSparklesSession();
        $sparkles = $this->initSessionService($sparkles);
        
        $exp = 'this is a test message';
        $sparkles->setToSession($exp);
        $messages = $sparkles->session->get('flash');
        $res = $messages['message'][0];
        $this->assertEquals($res, $exp, "Session data does not match.");
    }


    /**
    * Tests get data from session.
    *
    * @return void
    *
    */
    public function testGetFromSession() {
        $sparkles = new \Rarths\Sparkles\CSparklesSession();
        $sparkles = $this->initSessionService($sparkles);
        
        $sparkles->session->set('flash', ['message' => ['this is a test message']]);
        $message = $sparkles->getFromSession();
        $exp = ['message' => ['this is a test message']];
        $this->assertEquals($message, $exp, "Session data does not match.");
    }


    /**
    * Tests remove data in session.
    *
    * @return void
    *
    */
    public function testCleanSession() {
        $sparkles = new \Rarths\Sparkles\CSparklesSession();
        $sparkles = $this->initSessionService($sparkles);

        $sparkles->session->set('flash', ['message' => 'this is a test message']);
        $sparkles->cleanSession();

        $res = $sparkles->session->get('flash');
        $exp = [];
        $this->assertEquals($res, $exp, "Session data was not removed.");
    }
}