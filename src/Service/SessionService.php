<?php

namespace App\Service;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SessionService
{
    private SessionInterface $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function signIn($id, $email)
    {
        $this->session->set('id', $id);
        $this->session->set('email', $email);
        $this->session->start();
    }

    public function logout()
    {
        $this->session->invalidate();
    }

    public function isGuest(): bool
    {
        return !$this->isLoggedIn();
    }

    public function isLoggedIn(): bool
    {
        return $this->session->get('email') ? true : false;
    }

    public function getUserId(): int
    {
        return $this->session->get('id');
    }
}
