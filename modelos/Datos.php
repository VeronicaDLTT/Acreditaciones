<?php
    class Datos{

        private $TempData='tp';

        public function setTempData($tp){
            $this->TempData = $tp; 
        }

        public function getTempData(){
            return $this->TempData;
        }
        
    }
?> 