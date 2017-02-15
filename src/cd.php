<?php
    class Cd
    {
        private $title;
        private $artist;

        function __construct($title, $artist)
        {
            $this->title = $title;
            $this->artist = $artist;
        }

        function getTitle()
        {
            return $this->title;
        }

        function getArtist()
        {
            return $this->artist;
        }

        function save()
        {
            array_push($_SESSION['list_of_cds'], $this);
        }

        static function getAll()
        {
            return $_SESSION['list_of_cds'];
        }

        static function deleteAll()
        {
            $_SESSION['list_of_cds'] = array();
        }


    }
?>
