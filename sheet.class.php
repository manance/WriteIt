<?php

    class makeSheet{

        private $data;
        private $array;

        public function __construct(string $postData){

            $this->data = $postData;
            $username = $this->getUserData();
            $name = $this->getName();
            $chord = [];
            $chord[] = $this->data;

            $this->array = [
                "name" => $name,
                "author" => $username,
                "chord" => $chord
            ];

        }

        public function makeJSON () {
            $sheet = json_decode(file_get_contents('music.json'), true);
            $index = false;
            if($sheet == null){
                $sheet = [];
                $sheet[] = $this->array;
            }else{
                foreach ($sheet as $key => $song){
                    if ($song['name'] == $this->getName()){

                        if(!isset($sheet[$key]['chord']) || !is_array($sheet[$key]['chord'])){
                            $sheet[$key]['chord'] = [];
                        }

                        $sheet[$key]['chord'][] = $this->data;
                        $index = true;
                        break;
                    }
                }
                if(!$index){
                    $sheet[] = $this->array;
                }
            }

            file_put_contents('music.json', json_encode($sheet, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }

        public function deleteChord () {
            $json = json_decode(file_get_contents('music.json'), true);
            if($json != null){
                foreach ($json as $key => $song){
                    if ($song['name'] == $this->getName()){
                        array_pop($json[$key]['chord']);
                        break;
                    }
                }
            }
            
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