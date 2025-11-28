<?php

    class makeSheet{

        private $data;
        private $array;

        public function __construct(string $postData){

            $this->data = $postData;
            $username = $this->getUserData();
            $name = $this->getName();
            $date = $this->getDate();
            $chord = [];
            $chord[] = $this->data;

            $this->array = [
                "name" => $name,
                "author" => $username,
                "date" => $date,
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
                    if ($song['name'] == $this->getName() && $song['author'] == $this->getUserData()){
                        if(!isset($sheet[$key]['chord']) || !is_array($sheet[$key]['chord'])){
                            $sheet[$key]['chord'] = [];
                        }
                            $sheet[$key]['chord'][] = $this->data;
                            $index = true;
                            if(count($sheet[$key]['chord']) % 10 == 0 && count($sheet[$key]['chord']) != 0){
                                $sheet[$key]['chord'][] = "♪";
                            }
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
                    if ($song['name'] == $this->getName() && $song['author'] == $this->getUserData()){
                        array_pop($json[$key]['chord']);
                        break;
                    }
                }
            }
            file_put_contents('music.json', json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
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

        private function getDate () {
            return date("Y-m-d");
        }

        public function deleteSong (){
            $songs = json_decode(file_get_contents('music.json'), true);
            if($songs != null){
                foreach($songs as $i => $sheet_song){
                    if($sheet_song['name'] == $this->getName() && $sheet_song['author'] == $this->getUserData()){
                        unset($songs[$i]);
                        break;
                    }
                }
            }
            file_put_contents('music.json', json_encode($songs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
    }

?>