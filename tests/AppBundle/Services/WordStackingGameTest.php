<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Exception\WordDoesNotExistException;
use AppBundle\Exception\WordDoesNotSuitPatternException;
use AppBundle\Exception\WordWasWrittenBeforeException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Services\WordStackingGame;
use AppBundle\Services\WordStackingGameplay;
use AppBundle\Entity\Dictionary;

class WordStackingGameTest extends WebTestCase
{
    private $play;
    private $dictionaryFinder;

    public function setUp()
    {
        $this->play = $this->getMockBuilder('AppBundle\Services\WordStackingGameplay')
            ->disableOriginalConstructor()
            ->getMock();
        $this->dictionaryFinder = $this->getMockBuilder('AppBundle\Services\DictionaryFinder')
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testStartWillReturnChallengeWordWhenChallengeIsSet()
    {
        $word = new Dictionary();
        $word->setWord('test');
        $this->dictionaryFinder->expects($this->once())->method('findById')->willReturn($word);
        $this->play->expects($this->once())->method('getChallenge')->willReturn(1);
        $game = new WordStackingGame($this->dictionaryFinder, $this->play);
        $this->assertEquals('test', $game->start());
    }

    public function testStartWillReturnRandomWordWhenChallengeIsNotSet()
    {
        $word = new Dictionary();
        $word->setWord('test');
        $this->dictionaryFinder->expects($this->once())->method('getRandom')->willReturn($word);
        $this->play->expects($this->once())->method('getChallenge')->willReturn(null);
        $game = new WordStackingGame($this->dictionaryFinder, $this->play);
        $this->assertEquals('test', $game->start());
    }

    public function testCheckWillThrowExceptionWhenWordDoesNotExists()
    {
        $this->expectException(WordDoesNotExistException::class);
        $this->dictionaryFinder->expects($this->once())->method('find')->willReturn(null);
        $game = new WordStackingGame($this->dictionaryFinder, $this->play);
        $game->check('test');
    }

    public function testCheckWillThrowExceptionWhenWordWasUseBefore()
    {
        $this->expectException(WordWasWrittenBeforeException::class);
        $this->dictionaryFinder->expects($this->once())->method('find')->willReturn(new Dictionary());
        $this->play->expects($this->once())->method('getBaseWordName')->willReturn('test');
        $this->play->expects($this->once())->method('getWords')->willReturn(['test']);
        $game = new WordStackingGame($this->dictionaryFinder, $this->play);
        $game->check('test');
    }

    public function testCheckWillThrowExceptionWhenWordDoesNotSuitPattern()
    {
        $this->expectException(WordDoesNotSuitPatternException::class);
        $this->dictionaryFinder->expects($this->once())->method('find')->willReturn(new Dictionary());
        $this->play->expects($this->once())->method('getBaseWordName')->willReturn('nono');
        $game = new WordStackingGame($this->dictionaryFinder, $this->play);
        $game->check('test');
    }

    public function testCheckWillReturnWordWhenWordIsCorrect()
    {
        $this->dictionaryFinder->expects($this->once())->method('find')->willReturn(new Dictionary());
        $this->play->expects($this->once())->method('getBaseWordName')->willReturn('tests');
        $game = new WordStackingGame($this->dictionaryFinder, $this->play);
        $this->assertEquals('test', $game->check('test'));
    }
}
