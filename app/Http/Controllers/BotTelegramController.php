<?php

namespace App\Http\Controllers;

use App\Models\Token;
use App\Models\BoxItem;
use App\Models\TokenReport;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;

class BotTelegramController extends Controller
{
    public function setWebhook()
    {
        $response = Telegram::setWebhook(['url' => env('TELEGRAM_WEBHOOK_URL')]);
        dd($response);
    }

    public function commandHandlerWebhook()
    {
        $updates = Telegram::commandsHandler(true);
        $chatId = $updates->getChat()->getId();
        $username = $updates->getChat()->getFirstName();
        $request = $updates->getMessage()->getText();

        // command .start
        if ($updates->getMessage()->getText() === 'MAIN LAGI' || strtolower($updates->getMessage()->getText() === '.start' || $updates->getMessage()->getText() === '/start')) {
            $text = "Gunakan command .redeem <token> untuk klaim token \nContoh: .redeem 123456";
            return $this->sendMessage($chatId, $text);
        }

        // comman GACHA -nomer token-
        if (strpos($request, 'GACHA') !== false) {
            $request = $this->getUserInput($request);

            $token = $this->checkTokenExist($request);

            if (blank($token)) {
                $text = "Token {$request} tidak ditemukan!\nCoba periksa kemabali token anda.";
                return $this->sendMessage($chatId, $text);
            }

            if ($token->is_claimed) {
                $text = "Kesempatan untuk menggunakan token $token->token sudah habis";
                return $this->sendMessage($chatId, $text);
            }

            $prizes = collect([]);

            foreach ($token->drawbox->boxItems as $boxItem) {
                $prizes->push($boxItem->id);
            }

            $prizeId = $prizes->random();

            $prize = BoxItem::where('id', $prizeId)->first();

            $this->tokenUpdate($token);

            TokenReport::create([
                'token_id' => $token->id,
                'box_item_id' => $prize->id,
            ]);

            $text = 'Selamat ' . $username . ' anda mendapatkan ' . $prize->item;
            $this->sendMessage($chatId, $text);

            $photo = url('/') . '/' . $prize->image;
            $this->sendMessage($chatId, $photo);

            if (!$token->is_claimed) {
                $button  = "GACHA {$token->token}";
                $reply_markup = $this->createButton($button);

                $text = "Token $token->token digunakan $token->used dari $token->chance \nSilahkan GACHA lagi untuk mendapatkan hadiah lainnya";
                return $this->sendMessage($chatId, $text, $reply_markup);
            } else {
                $text = "Token $token->token digunakan $token->used kali dari $token->chance kesempatan \nToken sudah habis tidak bisa digunakan lagi";
                $this->sendMessage($chatId, $text);

                $button = 'MAIN LAGI';
                $reply_markup = $this->createButton($button);

                $text = 'tekan MAIN LAGI untuk melanjutkan';
                return $this->sendMessage($chatId, $text, $reply_markup);
            }
        }

        // command .redeem
        if (strpos(strtolower($request), '.redeem') !== false) {
            $request = $this->getUserInput($request);

            if (blank($request)) {
                $text = "Masukan token anda \nContoh: .redeem 123456";
                return $this->sendMessage($chatId, $text);
            }

            $token = $this->checkTokenExist($request);

            if (blank($token)) {
                $text = "Token {$request} tidak ditemukan";
                return $this->sendMessage($chatId, $text);
            }

            if ($token->is_claimed) {
                $text = "Kesempatan untuk menggunakan token $token->token sudah habis";
                return $this->sendMessage($chatId, $text);
            }

            $button = "GACHA {$token->token}";
            $reply_markup = $this->createButton($button);

            $text = "Klik GACHA untuk mengklaim token";
            return $this->sendMessage($chatId, $text, $reply_markup);
        }
    }

    // untuk get inputan user
    protected function getUserInput($input)
    {
        $words = explode(" ", $input);
        array_shift($words);
        $request = implode(" ", $words);

        return $request;
    }

    // untuk cek apakah token yang dimasukan ada di database
    protected function checkTokenExist($token)
    {
        $token = Token::whereRaw("BINARY token = '{$token}'")->first();

        return $token;
    }

    // untuk update token di database
    protected function tokenUpdate(Token $token)
    {
        $used = $token->used + 1;

        if ($used >= $token->chance) {
            $token->update([
                'is_claimed' => true,
            ]);
        }

        $token->update([
            'used' => $used,
        ]);
    }

    // untuk mengirim pesan
    protected function sendMessage($chatId, $text, $reply_markup = null)
    {
        return Telegram::sendMessage([
            "chat_id" => $chatId,
            "text" => $text,
            "reply_markup" => $reply_markup
        ]);
    }

    // untuk membuat tombol 
    protected function createButton($button)
    {
        $keyboard = [
            [$button],
        ];

        return Keyboard::make([
            "keyboard" => $keyboard,
            "resize_keyboard" => true,
            "one_time_keyboard" => true
        ]);
    }
}
