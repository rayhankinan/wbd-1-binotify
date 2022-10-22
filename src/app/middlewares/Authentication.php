<?php

class Authentication
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function isAuthenticated()
    {
        $query = 'SELECT user_id FROM user WHERE user_id = :user_id LIMIT 1';

        $this->database->query($query);
        $this->database->bind('user_id', $_SESSION['user_id']);

        $user = $this->database->fetch();

        if (!property_exists($user, 'user_id')) {
            throw new LoggedException('Unauthorized', 401);
        }
    }

    public function isAdmin()
    {
        $query = 'SELECT is_admin FROM user WHERE user_id = :user_id LIMIT 1';

        $this->database->query($query);
        $this->database->bind('user_id', $_SESSION['user_id']);

        $user = $this->database->fetch();

        if (!property_exists($user, 'is_admin') || !$user->is_admin) {
            throw new LoggedException('Unauthorized', 401);
        }
    }
}
