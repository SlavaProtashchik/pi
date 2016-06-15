<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DefaultController extends Controller
{
    /**
     * @return RedirectResponse
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->redirect('/admin');
    }
}
