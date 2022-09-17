<?php

namespace App\Console\Commands;

use App\Models\Token;
use Illuminate\Console\Command;
use Ramsey\Uuid\Uuid;

class GenerateTokenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate access token';

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
        $token = Uuid::uuid4()->toString();

        Token::query()->create([
            'token' => $token
        ]);

        $this->info('Your token is generated: ' . $token);
        return 0;
    }
}
