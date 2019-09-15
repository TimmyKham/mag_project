<?php

namespace App\Controller;

use App\Repository\MagazinesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HomeController extends AbstractController {

    private $twig;

    public function __construct($twig){
        $this->twig = $twig;
    }

    /**
     * @Route("/", name="home")
     * @param MagazinesRepository $repository
     * @return Response
     */
    public function index(MagazinesRepository $repository) : Response {
        $magazines = $repository->findLatest();
        return $this->render('pages/home.html.twig',[
                'magazines'=> $magazines
            ]);
    }
}