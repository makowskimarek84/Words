<?php
namespace AppBundle\Exception;

class WordDoesNotExistException extends \Exception
{
    protected $message = "Słowo nie istnieje";
}
