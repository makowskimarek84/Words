<?php
namespace AppBundle\Exception;

class WordDoesNotSuitPatternException extends \Exception
{
    protected $message = "Słowo nie składa się z liter wzorca";
}
