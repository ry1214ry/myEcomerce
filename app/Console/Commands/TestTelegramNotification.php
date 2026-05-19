<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TestTelegramNotification extends Command
{
    protected $signature   = 'telegram:test';
    protected $description = 'Test Telegram bot connection';

    public function handle(): void
    {
        $this->info('');
        $this->info('════════════════════════════════');
        $this->info('  Telegram Bot Debug Test');
        $this->info('════════════════════════════════');
        $this->info('');

        $token  = config('services.telegram.token');
        $chatId = config('services.telegram.chat_id');

        $this->info('📋 Checking .env values...');
        $this->info('   TOKEN  : ' . ($token  ? '✅ Set (' . substr($token, 0, 10) . '...)' : '❌ EMPTY'));
        $this->info('   CHAT ID: ' . ($chatId ? '✅ Set (' . $chatId . ')'                  : '❌ EMPTY'));
        $this->info('');

        if (empty($token) || empty($chatId)) {
            $this->error('❌ Token or Chat ID is empty. Fix your .env file.');
            return;
        }

        // ── Step 1: Validate token ────────────────────────────────
        $this->info('🤖 Validating bot token...');
        try {
            // ✅ withoutVerifying() = fix SSL error on localhost
            $response = Http::withoutVerifying()
                ->timeout(10)
                ->get("https://api.telegram.org/bot{$token}/getMe");

            $data = $response->json();

            if ($data['ok'] ?? false) {
                $this->info('   ✅ Bot valid: @' . $data['result']['username']);
            } else {
                $this->error('   ❌ Invalid token: ' . json_encode($data));
                return;
            }
        } catch (\Exception $e) {
            $this->error('   ❌ Error: ' . $e->getMessage());
            return;
        }
        $this->info('');

        // ── Step 2: Send test message ─────────────────────────────
        $this->info('📨 Sending test message to Telegram...');
        try {
            $response = Http::withoutVerifying()
                ->timeout(10)
                ->post("https://api.telegram.org/bot{$token}/sendMessage", [
                    'chat_id'    => $chatId,
                    'text'       =>
                        "✅ <b>LuxeShop Test</b>\n\n" .
                        "🎉 Telegram bot is working!\n" .
                        "🕐 " . now()->format('d M Y H:i:s') . "\n" .
                        "🌐 " . config('app.url'),
                    'parse_mode' => 'HTML',
                ]);

            $data = $response->json();

            if ($data['ok'] ?? false) {
                $this->info('   ✅ Message sent! Check your Telegram now 📱');
            } else {
                $this->error('   ❌ Failed: ' . json_encode($data));

                $errCode = $data['error_code'] ?? 0;
                if ($errCode === 400) {
                    $this->warn('');
                    $this->warn('💡 Fix: Chat not found. Do this:');
                    $this->warn('   1. Open Telegram');
                    $this->warn('   2. Search your bot');
                    $this->warn('   3. Press START and send "hello"');
                    $this->warn('   4. Visit: https://api.telegram.org/bot' . $token . '/getUpdates');
                    $this->warn('   5. Copy chat.id to TELEGRAM_CHAT_ID in .env');
                }
            }
        } catch (\Exception $e) {
            $this->error('   ❌ Exception: ' . $e->getMessage());
        }

        $this->info('');
        $this->info('════════════════════════════════');
    }
}