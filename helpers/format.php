<?php

    class Format extends Database{
        public function FormatDate($date){
            return date('F j, Y, g:i a', strtotime($date));
        }

        public function short($text, $limit = 500){
            $text = $text." ";
            $text = substr($text, 0, $limit);
            $text = substr($text, 0, strrpos($text, " "));
            $text = $text.".....";
            return $text;
        }

        public function validation($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            $data = mysqli_real_escape_string($this->link, $data); 
            return $data;
        }
    }
    
?>