<?php

    class makeSheet{

        private $data;
        private $array;

        public function __construct(string $postData){

            $this->data = $postData;
            $username = $this->getUserData();
            $name = $this->getName();
            $chord = [];
            array_push($chord, $this->data);

            $this->array = [
                "name" => $name,
                "author" => $username,
                "chord" => $chord
            ];

        }

        public function makeJSON () {
            $data = json_decode(file_get_contents('music.json'), true);
            if ($data != null){
                $list = $data;
                $list[] = $this->array;
            } else {
                $list = [];
                $list[] = $this->array;
            }
            file_put_contents('music.json', json_encode($list, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }

        public function updateJSON () {

            //Finish this function later

            $data = json_decode(file_get_contents('music.json'), true);
            foreach($data as $x){
                if($x['name'] == $this->getName()){
                    echo $x['name'];
                    $x['chord'][] = $this->data;
                }
            }
            file_put_contents('music.json', json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        }

        private function getUserData () {
            if(isset($_SESSION['username'])){
                
                $user = $_SESSION['username'];
                return $user;

            }
        }

        private function getName () {
            if (isset($_SESSION['sheet_name'])){

                $name = $_SESSION['sheet_name'];
                return $name;

            }
        }
    }

?>