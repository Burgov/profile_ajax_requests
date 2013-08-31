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
        $delay = $request->query->get('delay', 1);
        $delay = min(max($delay, 1), 10);
        $error = $request->query->get('error', false);

        sleep($delay);

        if ($error >= 2) {
            throw new \RuntimeException('Something random has gone terribly wrong');
        }

        return new Response('', $error ? 400 : 200);
    }
}
