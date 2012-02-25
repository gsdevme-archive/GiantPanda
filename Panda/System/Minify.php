<?php

    namespace Panda\System;

    require_once realpath(dirname(__FILE__)) . '/ThirdParty/MinifyHTML.php';

    use \MinifyHTML;

    class Minify{
        private $_minifyHtml;
        
        public function __construct($html){
            $this->_minifyHtml = new MinifyHTML($html);
        }
        
        public function process(){
            return $this->_minifyHtml->process();
        }
    }
    