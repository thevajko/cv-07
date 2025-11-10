<?php
namespace App\Auth;
use App\Models\User;
use Framework\Auth\DummyAuthenticator;
use Framework\Core\App;
use Framework\Core\IAuthenticator;
use Framework\Core\IIdentity;
use Framework\Http\Session;

class SimpleAuthenticator extends DummyAuthenticator {

    private App $app;
    private Session $session;

    function __construct(App $app)
    {
        $this->app = $app;
        $this->session = $this->app->getSession();
    }

    public function login($username, $password): bool
    {
        // user is logged in when login equals password
         if ($username == $password) {
             $this->session->set('user', new User(username: $username, name: $username));
             return true;
         } else {
             return false;
         }
    }

    public function logout(): void
    {
        $this->session->destroy();
    }

    public function isLogged(): bool
    {
        return $this->getUser() instanceof IIdentity;
    }

    public function getUser(): ?IIdentity
    {
        return $this->session->get('user');
    }
}