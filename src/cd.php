<?php
    class Cd
    {
        private $title;

        function __construct($title)
        {
            $this->title = $title;
        }

        function getTitle()
        {
            return $this->title;
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
