<?php
/**
 * Created by PhpStorm.
 * User: Eynsteyn
 * Date: 05.04.2019
 * Time: 13:15
 */

namespace App\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MainController
 *
 * @Route("admin")
 * @package App\Controller
 */
class MainController extends AbstractController
{
    /**
     * @Route("/index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->render('main/index.html.twig');
    }
}
