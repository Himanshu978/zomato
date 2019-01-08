<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Swift_Events_EventListener;

class EmailTest extends TestCase
{
//
//    protected $emails = [];
//
//
//    /** @before */
//    public function setUpMailTracking()
//    {
//        parent::setUp();
//
//        Mail::getSwiftMailer()
//            ->registerPlugin(new TestingEventMailListener($this));
//
//    }
//
//    /**
//     * A basic test example.
//     *
//     * @return void
//     */
    public function testExample()
  {
//        Mail::raw('Hello World!', function ($message) {
//
//            $message->to('foo@bar.com');
//            $message->from('bar@foo.com');
//
//        });
//
//        $this->seeEmailWasSent()
//             ->seeEmailsSent(1)
//             ->seeEmailTo('foo@bar.com')
//             ->seeEmailFrom('bar@foo.com');
        $this->assertTrue(true);
    }
//
//    public function  addEmail(\Swift_Message $email) {
//
//        $this->emails[] = $email;
//    }
//
//    protected function seeEmailWasSent()
//    {
//        $this->assertNotEmpty(
//            $this->emails, 'No email have been sent!'
//        );
//
//        return $this;
//    }
//
//    protected function seeEmailsSent($count) {
//
//        $emailsSent = count($this->emails);
//
//        $this->assertCount(
//            $count, $this->emails,
//            "Expected $count to have been sent, But $emailsSent were sent."
//        );
//
//       return $this;
//
//    }
//
//    protected  function  seeEmailTo ($recipient, \Swift_Message $message = null) {
//
//        $email = $message?:end($this->emails);
//
//        $this->assertArrayHasKey(
//            $recipient, $email->getTo(),
//            "No email was sent to $recipient"
//        );
//            return $this;
//    }
//
//    protected  function  seeEmailFrom ($sender, \Swift_Message $message = null) {
//
//        $email = $message?:end($this->emails);
//
//        $this->assertArrayHasKey(
//            $sender, $email->getFrom(),
//            "No email was sent from $sender"
//        );
//        return $this;
//    }
}
//
//class TestingEventMailListener implements Swift_Events_EventListener
//{
//
//    protected  $test;
//
//    public function __construct($test) {
//        $this->test = $test;
//    }
//
//    public function beforeSendPerformed($event)
//    {
//        $message = $event->getMessage();
//       // dd(get_class_methods($message));
//        $this->test->addEmail($message);
//    }
//
//}