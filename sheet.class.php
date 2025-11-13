<?php

    class makeSheet{

        // private $name;
        private $data;
        private $user;
        // private $username;
        // private $chord;
        // private $chords;
        // private $song; // array
        // private $storage = 'music.json';
        // private $stored_songs;

        public function __construct(string $postData){

            $this->data = $postData;

        }



        public function makeJSON () {

            $username = $this->getUserData();
            $chord = $this->data;

            $jsonData = file_get_contents('music.json');
            $pureData = json_decode($jsonData, true);

            $json = [
                "author" => $username,
                "chord" => $chord
            ];

            file_put_contents('music.json', json_encode($json, JSON_PRETTY_PRINT));


            echo $chord . $username;


        }

        private function getUserData () {
            if(isset($_SESSION['username'])){
                
                $user = $_SESSION['username'];
                return $user;

            }
        }

    }

?>