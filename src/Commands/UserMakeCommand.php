<?php

namespace TheRealJanJanssens\Pakka\Commands;

use Illuminate\Console\Command;
use TheRealJanJanssens\Pakka\Models\User;

class UserMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

    protected $rolesMap = [];

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        //$this->rolesMap = Role::all()->pluck('title', 'id')->toArray();

        do {
            $details  = $this->askForUserDetails($details ?? null);
            $name     = $details['name'];
            $email    = $details['email'];
            $password = $details['password'];
            $role     = $details['role'];
        } while (!$this->confirm("Create user {$name} <{$email}>?", true));

        $user = User::forceCreate(['name' => $name, 'email' => $email, 'password' => $password, 'role' => $role]);
        //$user->roles()->attach(array_flip($this->rolesMap)[$role]);
        $this->info("Created new user #{$user->id}");
    }

	/**
	 * @param null $defaults
	 * @return array
	 */
    protected function askForUserDetails($defaults = null)
    {
        $name     = $this->ask('Full name of user?', $defaults['name'] ?? null);
        $email    = $this->askUniqueEmail('Email Address for user?', $defaults['email'] ?? null);
        $password = $this->ask('Password for user? (will be visible)', $defaults['password'] ?? null);
        $role     = ($this->confirm('Is this user a admin?', true) ? 10 : 5);

        return compact('name', 'email', 'password', 'role');
    }

	/**
	 * @param      $message
	 * @param null $default
	 * @return string
	 */
    protected function askUniqueEmail($message, $default = null)
    {
        do {
            $email = $this->ask($message, $default);
        } while (!$this->checkEmailIsValid($email) || !$this->checkEmailIsUnique($email));

        return $email;
    }

	/**
	 * @param $email
	 * @return bool
	 */
    protected function checkEmailIsValid($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('Sorry, "' . $email . '" is not a valid email address!');
            return false;
        }

        return true;
    }

	/**
	 * @param $email
	 * @return bool
	 */
    public function checkEmailIsUnique($email)
    {
        if ($existingUser = User::whereEmail($email)->first()) {
            $this->error('Sorry, "' . $existingUser->email . '" is already in use by ' . $existingUser->name . '!');
            return false;
        }

        return true;
    }
}