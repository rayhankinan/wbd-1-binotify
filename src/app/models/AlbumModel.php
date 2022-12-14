<?php

class AlbumModel
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getAlbums($page)
    {
        $query = 'SELECT album_id, judul, penyanyi, total_duration, image_path, tanggal_terbit, genre FROM album ORDER BY judul ASC LIMIT :limit OFFSET :offset';

        $this->database->query($query);
        $this->database->bind('limit', ROWS_PER_PAGE);
        $this->database->bind('offset', ($page - 1) * ROWS_PER_PAGE);
        $albums = $this->database->fetchAll();

        $query = 'SELECT CEIL(COUNT(album_id) / :rows_per_page) AS page_count FROM album';

        $this->database->query($query);
        $this->database->bind('rows_per_page', ROWS_PER_PAGE);
        $album = $this->database->fetch();
        $pagesCount = $album->page_count;

        $returnArr = ['albums' => $albums, 'pages' => $pagesCount];
        return $returnArr;
    }

    public function getAllAlbum()
    {
        $query = 'SELECT album_id, judul FROM album';
        $this->database->query($query);
        $albumArr = $this->database->fetchAll();

        return $albumArr;
    }

    public function getAlbumFromPenyanyi($penyanyi)
    {
        $query = 'SELECT * from album WHERE penyanyi = :penyanyi';

        $this->database->query($query);
        $this->database->bind('penyanyi', $penyanyi);
        $album = $this->database->fetchAll();

        return $album;
    }
    public function getAlbumFromID($albumID)
    {
        $query = 'SELECT album_id, judul, penyanyi, total_duration, image_path, tanggal_terbit, genre FROM album WHERE album_id = :album_id LIMIT 1';

        $this->database->query($query);
        $this->database->bind('album_id', $albumID);

        $album = $this->database->fetch();

        return $album;
    }

    public function createAlbum($title, $singer, $image_path, $published_date, $genre)
    {
        $query = 'INSERT INTO album (judul, penyanyi, total_duration, image_path, tanggal_terbit, genre) VALUES (:judul, :penyanyi, 0, :image_path, :tanggal_terbit, :genre)';

        $this->database->query($query);
        $this->database->bind('judul', $title);
        $this->database->bind('penyanyi', $singer);
        $this->database->bind('image_path', $image_path);
        $this->database->bind('tanggal_terbit', $published_date);
        $this->database->bind('genre', $genre);

        $this->database->execute();

        return $this->database->lastInsertID();
    }

    public function changeAlbumTitle($albumID, $newTitle)
    {
        $query = 'UPDATE album SET judul = :judul WHERE album_id = :album_id';

        $this->database->query($query);
        $this->database->bind('judul', $newTitle);
        $this->database->bind('album_id', $albumID);
        $this->database->execute();
    }

    public function changeAlbumArtist($albumID, $newArtist)
    {
        $query = 'UPDATE album SET penyanyi = :penyanyi WHERE album_id = :album_id';

        $this->database->query($query);
        $this->database->bind('penyanyi', $newArtist);
        $this->database->bind('album_id', $albumID);
        $this->database->execute();
    }

    public function changeAlbumDate($albumID, $newDate)
    {
        $query = 'UPDATE album SET tanggal_terbit = :tanggal_terbit WHERE album_id = :album_id';

        $this->database->query($query);
        $this->database->bind('tanggal_terbit', $newDate);
        $this->database->bind('album_id', $albumID);
        $this->database->execute();
    }

    public function changeAlbumGenre($albumID, $newGenre)
    {
        $query = 'UPDATE album SET genre = :genre WHERE album_id = :album_id';

        $this->database->query($query);
        $this->database->bind('genre', $newGenre);
        $this->database->bind('album_id', $albumID);
        $this->database->execute();
    }

    public function changeAlbumPath($albumID, $newPath)
    {
        $query = 'UPDATE album SET image_path = :image_path WHERE album_id = :album_id';

        $this->database->query($query);
        $this->database->bind('image_path', $newPath);
        $this->database->bind('album_id', $albumID);
        $this->database->execute();
    }

    public function deleteAlbum($albumID)
    {
        $query = 'DELETE FROM album WHERE album_id = :album_id';

        $this->database->query($query);
        $this->database->bind('album_id', $albumID);
        $this->database->execute();
    }

    public function addDuration($albumID, $duration)
    {
        $query = 'UPDATE album SET total_duration = total_duration + :duration WHERE album_id = :album_id';
        $this->database->query($query);
        $this->database->bind('duration', (int) $duration);
        $this->database->bind('album_id', (int) $albumID);
        $this->database->execute();
    }

    public function substractDuration($albumID, $duration)
    {
        $query = 'UPDATE album SET total_duration = total_duration - :duration WHERE album_id = :album_id';
        $this->database->query($query);
        $this->database->bind('duration', (int) $duration);
        $this->database->bind('album_id', (int) $albumID);
        $this->database->execute();
    }
}
