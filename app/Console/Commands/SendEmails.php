<?php

namespace App\Console\Commands;

use App\Mail\NewCuisineNotifyMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:cuisine-added {user?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to user on every new cuisine added to restaurant';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
//        $name = $this->ask('What is your name?');
//
//        $password = $this->secret('Please enter the password:');
//
//        if($password == "123"){
//
//            if ($this->confirm('Do you wish to continue?')) {
//                Mail::to("shimanshu12596@gmail.com")->send(new NewCuisineNotifyMail());
//                $this->info("Mail sent to user!");
//            }
//
//        }else {
//            $this->error("Oops! Wrong password.");
//        }

        Mail::to("shimanshu12596@gmail.com")->send(new NewCuisineNotifyMail());
        $this->info("Mail sent to user!");

        $userId = $this->argument('user');

    }


}
