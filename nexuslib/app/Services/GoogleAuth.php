<?php

namespace App\Services;

use Google\Client;
use Google\Service\Oauth2;
use App\Adapters\MySQLLocalAdapter;

class GoogleAuth
{
    private Client $client;
    private MySQLLocalAdapter $dbAdapter;
    
    public function __construct(MySQLLocalAdapter $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
        $this->client = new Client();
        $this->client->setClientId($_ENV['GOOGLE_CLIENT_ID'] ?? '');
        $this->client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET'] ?? '');
        $this->client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI'] ?? '');
        $this->client->addScope('email');
        $this->client->addScope('profile');
    }
    
    public function getLoginUrl(): string
    {
        return $this->client->createAuthUrl();
    }
    
    public function authenticate(string $code): ?array
    {
        try {
            $token = $this->client->fetchAccessTokenWithAuthCode($code);
            $this->client->setAccessToken($token);
            
            $oauth2 = new Oauth2($this->client);
            $userInfo = $oauth2->userinfo->get();
            $googleId = isset($userInfo->id) ? (string) $userInfo->id : null;
            
            $existingUser = $this->dbAdapter->getUserByEmail($userInfo->email);
            
            if (!$existingUser) {
                $userId = $this->dbAdapter->createUser($userInfo->email, $userInfo->name, $googleId);
                $existingUser = $this->dbAdapter->getUserById($userId);
            } elseif (!empty($googleId) && (($existingUser['google_id'] ?? null) !== $googleId)) {
                $this->dbAdapter->updateUserGoogleId((int) $existingUser['id_usuario'], $googleId);
                $existingUser['google_id'] = $googleId;
            }
            
            return $existingUser;
        } catch (\Exception $e) {
            error_log('Google Auth Error: ' . $e->getMessage());
            return null;
        }
    }
}
