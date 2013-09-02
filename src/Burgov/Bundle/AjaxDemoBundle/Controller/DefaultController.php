<?php

namespace Burgov\Bundle\AjaxDemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction()
    {
        return $this->render('BurgovAjaxDemoBundle:Default:index.html.twig');
    }

    /**
     * @Route("/ajax", name="ajax")
     */
    public function ajaxAction(Request $request) {
        $duration = $request->query->get('duration', 1);
        $duration = min(max($duration, 0), 10);
        $error = $request->query->get('error', false);

        if ($duration > 0) {
            sleep($duration);
        }

        if ($error >= 2) {
            throw new \RuntimeException('Something random has gone terribly wrong');
        }

        return new Response('', $error ? 400 : 200);
    }
}
