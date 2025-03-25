<?php
namespace app\mail;

class Mail{

    public function __construct(
        public $from,
        public $to,
        public $subject,
        public $body
    
    ){}
}


