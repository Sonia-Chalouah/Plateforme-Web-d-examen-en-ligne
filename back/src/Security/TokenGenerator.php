<?php

namespace App\Security;

class TokenGenerator
{

    public function getRandomSecureToken(int $length = 32): string
    {
        $token = '';
        try {
            $token = rtrim(strtr(base64_encode(random_bytes($length)), '+/', '-_'), '=');
        } catch (\Exception $e) {
            dump($e->getMessage());
        };

        return $token;
    }
}
