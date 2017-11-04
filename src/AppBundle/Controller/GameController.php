<?php
declare(strict_types=1);

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class GameController extends Controller
{

  /**
   * @Route("/game/check/{word}", name="word")
   */
    public function getCheckWordAction(string $word)
    {
        return new JsonResponse($this->get('game')->check($word));
    }
  
  
  /**
   * @Route("/game/random/", name="word_random")
   */
  public function getRandomWordAction()
  {
      return new JsonResponse($this->get('game')->start());
  }

  /**
   * @Route("/challenge/{word_id}", name="game_challenge")
   */
  public function challengeAction(int $word_id)
  {
      $this->get('gameplay')->setChallenge($word_id);
      return $this->render('AppBundle::game.html.twig');
  }
  
  /**
   * @Route("", name="game")
   */
  public function indexAction()
  {
      return $this->render('AppBundle::game.html.twig');
  }
}
