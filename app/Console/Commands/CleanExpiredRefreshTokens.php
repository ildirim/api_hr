<?php

namespace App\Console\Commands;

use App\Interfaces\Common\RefreshToken\RefreshTokenServiceInterface;
use Illuminate\Console\Command;

class CleanExpiredRefreshTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:clean-refresh-tokens';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up expired and revoked refresh tokens from the database';

    /**
     * Execute the console command.
     */
    public function handle(RefreshTokenServiceInterface $refreshTokenService): int
    {
        $this->info('Cleaning expired and revoked refresh tokens...');

        $deletedCount = $refreshTokenService->cleanExpiredTokens();

        $this->info("Successfully deleted {$deletedCount} expired/revoked refresh tokens.");

        return Command::SUCCESS;
    }
}
