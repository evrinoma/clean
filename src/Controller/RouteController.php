<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class RouteController extends AbstractController
{
//region SECTION: Public
    /**
     * титуальная страница
     *
     * @Route("/", name="core_home")
     * @Template("base.html.twig")
     *
     * @return array
     */
    public function home()
    {
        return ['titleHeader' => 'Site Administration', 'pageName' => 'Setup Module Administration'];
    }

    /**
     * титуальная страница
     *
     * @Route("/clear_cache", name="core_clear_cache")
     * @Template("base.html.twig")
     *
     * @return array
     */
    public function clearCache()
    {
        try {
            opcache_reset();
        } catch(Throwable $e)    {
        }

        try {
            apcu_clear_cache();
        } catch(Throwable $e)    {
        }

        return [];
    }

//endregion Public

}