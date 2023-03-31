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
        if (strtolower($updates->getMessage()->getText() === '.start')) {
            return Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => "Gunakan command .redeem <token> untuk klaim token \nContoh: .redeem 123456",
            ]);
        }

        if (strpos($request, 'GACHA') !== false) {
            $request = $this->getUserInput($request);

            $token = $this->checkTokenExist($request);

            if (blank($token)) {
                $text = "Token {$request} tidak ditemukan";

                return Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => $text,
                ]);
            }

            if ($token->is_claimed) {
                $text = "Token $token->token sudah digunakan";

                return Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => $text,
                ]);
            }

            $prizes = collect([]);

            foreach ($token->drawbox->boxItems as $boxItem) {
                $prizes->push($boxItem->id);
            }

            $prizeId = $prizes->random();

            $prize = BoxItem::where('id', $prizeId)->first();

            $photo = url('/') . '/' . $prize->image;
            $caption = 'Selamat ' . $username . ' anda mendapatkan ' . $prize->item;

            $this->tokenUpdate($token);

            TokenReport::create([
                'token_id' => $token->id,
                'box_item_id' => $prize->id,
            ]);

            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => $caption,
            ]);

            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => $photo,
            ]);

            if (!$token->is_claimed) {
                $text = "Token $token->token digunakan $token->used dari $token->chance \nSilahkan redeem lagi untuk mendapatkan hadiah lainnya";

                return Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => $text,
                ]);
            } else {
                $text = "Token $token->token digunakan $token->used dari $token->chance \nToken sudah habis digunakan";

                return Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => $text,
                ]);
            }
        }

        // command .redeem
        if (strpos(strtolower($request), '.redeem') !== false) {
            $request = $this->getUserInput($request);

            if (blank($request)) {
                $text = "Masukan token anda \ncontoh: .redeem 123456";

                return Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => $text,
                ]);
            }

            $token = $this->checkTokenExist($request);

            if (blank($token)) {
                $text = "Token {$request} tidak ditemukan";

                return Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => $text,
                ]);
            }

            if ($token->is_claimed) {
                $text = "Token $token->token sudah digunakan";

                return Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => $text,
                ]);
            }

            $keyboard = [
                ["GACHA {$token->token}"],
            ];

            $reply_markup = Keyboard::make([
                "keyboard" => $keyboard,
                "resize_keyboard" => true,
                "one_time_keyboard" => true
            ]);

            return Telegram::sendMessage([
                "chat_id" => $chatId,
                "text" => "Klik tombol dibawah ini untuk mengklaim token",
                "reply_markup" => $reply_markup
            ]);
        }
    }

    protected function getUserInput($input)
    {
        $words = explode(" ", $input);
        array_shift($words);
        $request = implode(" ", $words);

        return $request;
    }

    protected function checkTokenExist($token)
    {
        $token = Token::whereRaw("BINARY token = '{$token}'")->first();

        return $token;
    }

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
}
