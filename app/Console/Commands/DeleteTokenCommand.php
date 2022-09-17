<?php

namespace App\Console\Commands;

use App\Models\Token;
use Illuminate\Console\Command;

class DeleteTokenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:delete {token}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete access token';

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
        $token = $this->argument('token');

        $findToken = Token::query()->where('token', $token)->first();

        if ($findToken) {
            $findToken->delete();
            $this->info('Your token has been deleted.');
        } else {
            $this->error('Token is not found.');
        }

        return 0;
    }
}
