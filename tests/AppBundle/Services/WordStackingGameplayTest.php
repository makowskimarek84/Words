<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Services\WordStackingGameplay;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Entity\Dictionary;

class WordStackingGameplayTest extends WebTestCase
{
    private $session;
    private $dictionaryFinder;

    public function setUp()
    {
        $this->session = new Session(new MockArraySessionStorage());
        $this->dictionaryFinder = $this->getMockBuilder('AppBundle\Services\DictionaryFinder')
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testSetBaseWordWillStoreData()
    {
        $word = new Dictionary();
        $word->setWord('test');
        $this->dictionaryFinder->expects($this->once())->method('findById')->willReturn($word);
        $gameplay = new WordStackingGameplay($this->dictionaryFinder, $this->session);
        $gameplay->setBaseWord($word);
        $this->assertEquals($word, $gameplay->getBaseWord());
    }

    public function testSetChallengeWillStoreData()
    {
        $id = 1;
        $gameplay = new WordStackingGameplay($this->dictionaryFinder, $this->session);
        $gameplay->setChallenge($id);
        $this->assertEquals($id, $gameplay->getChallenge());
    }

    public function testAddWordWillStoreData()
    {
        $word = 'test';
        $gameplay = new WordStackingGameplay($this->dictionaryFinder, $this->session);
        $gameplay->addWord($word);
        $this->assertContains($word, $gameplay->getWords());
    }

    public function testClearWillClearStoredData()
    {
        $gameplay = new WordStackingGameplay($this->dictionaryFinder, $this->session);
        $gameplay->setBaseWord(new Dictionary());
        $gameplay->addWord('test');
        $gameplay->setChallenge(1);
        $gameplay->clear();
        $this->assertCount(0, $this->session->all());
    }
}
