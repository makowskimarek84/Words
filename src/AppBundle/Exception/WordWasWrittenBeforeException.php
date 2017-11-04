<?php
namespace AppBundle\Exception;

class WordWasWrittenBeforeException extends \Exception
{
    protected $message = "Już użyto tego słowa";
}
