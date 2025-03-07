<?php
use Exception;
use Firebase\JWT\JWT;
class JWTToken{
    public static function CreateToken($user_id, $user_email):string{
        $key = env('JWT_KEY');
        $payload = [
            'iss' => 'laravel-token',
            'iat' => time(),
            'exp' => time() + 60 * 60*24 * 30,
            'user_id' => $user_id,
            'user_email' => $user_email,

        ];
        return JWT::encode($payload, $key, alg:'HS256');

}


}
