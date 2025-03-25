<?php
namespace app\mail;

interface IMailer{

    public function enviar(Mail $m);

}