<?php
class DirectorModel
{
    private $db;
    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=simsonmania;charset=utf8', 'root', '');
    }
    function getDirectors()
    {
        $query = $this->db->prepare('SELECT * FROM director');
        $query->execute();
        $directors = $query->fetchAll(PDO::FETCH_OBJ);
        return $directors;
    }
    function addDirector($nombre, $biografia)
    {
        $query = $this->db->prepare('INSERT INTO director(nombre_director, biografia) VALUES (?,?)');
        $query->execute(array($nombre, $biografia));
    }
    function deleteDirectorFromDB($id)
    {
        $query = $this->db->prepare('DELETE FROM director WHERE id_director=?');
        $query->execute(array($id));
    }
    function updateDirectorFromDB($id, $nombre, $biografia)
    {
        $query = $this->db->prepare("UPDATE director SET nombre_director= ?, biografia= ? WHERE id_director=?");
        $query->execute(array($nombre, $biografia, $id));
    }
    function getDirector($id)
    {
        $query = $this->db->prepare("SELECT * FROM director WHERE id_director= ?");
        $query->execute(array($id));
        $director = $query->fetchAll(PDO::FETCH_OBJ);
        return $director;
    }
    function getChaptersByDirector($director)
    {
        $query = $this->db->prepare('SELECT a.*, b.* FROM capitulo a RIGHT JOIN director b ON a.id_director = b.id_director WHERE b.nombre_director = ?');
        $query->execute([$director]);
        $chapters = $query->fetchAll(PDO::FETCH_OBJ);
        return $chapters;
    }
}
