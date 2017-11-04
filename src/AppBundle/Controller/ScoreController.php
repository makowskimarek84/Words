<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ScoreController
 * @package AppBundle\Controller
 */
class ScoreController extends Controller
{

  /**
   * @Route("/score")
   * @Method({"POST"})
   */
  public function postScoreAction(Request $request)
  {
      return new JsonResponse($this->get('score.saver')->save($request->get('nickname')));
  }
  
  /**
   * @Route("/score/{wordId}")
   * @Method({"GET"})
   */
  public function getWordScoreAction($wordId)
  {
      return new JsonResponse($this->get('score.finder')->get($wordId));
  }
  
  /**
   * @Route("/score")
   * @Method({"GET"})
   */
  public function getScoresAction()
  {
      $scores = $this->get('dictionary.finder')->getAllScored();
      return $this->render('AppBundle::game.score.html.twig', array('scores' => $scores));
  }
}
