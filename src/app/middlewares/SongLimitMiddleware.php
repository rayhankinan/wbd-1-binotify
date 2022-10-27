<?php

class SongLimitMiddleware
{
    public function checkSong($csrf_token)
    {
        if ($csrf_token !== $_SESSION['token_limit'])
        {
            if($_SESSION['song_count'] >= MAX_SONG_COUNT) {
                return false;
            }
            $_SESSION['token_limit'] = $csrf_token;
            $_SESSION['song_count'] += 1;
        }
        return true;
    }

    public function makeNewSession($csrf_token)
    {
        $_SESSION['song_count'] = 1;
        $_SESSION['token_limit'] = $csrf_token;
        $_SESSION['date'] = date('Y-m-d');
    }
}
