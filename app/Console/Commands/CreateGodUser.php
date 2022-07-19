<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateGodUser extends Command
{
    /**
     * @var User
     */
    private $user;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:god';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create god';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        parent::__construct();
        $this->user = $user;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $username = $this->ask('username');
        $password = $this->secret('password');

        if ($this->confirm('Are you sur to create god ?')) {
            try {
                $this->user->createGodUser([
                    'username' => $username,
                    'password' => $password
                ]);
            } catch (\Error $error) {
                return $this->error($error->getMessage());
            }
        }

        return $this->info('God created !');
    }
}
