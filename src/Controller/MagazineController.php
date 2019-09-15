<?php
namespace App\Controller;

use App\Entity\Magazines;
use App\Repository\MagazinesRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MagazineController extends AbstractController {

    /**
     * @var MagazinesRepository
     */
    private $repository;

    public function __construct(MagazinesRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/magazines", name="magazine.index")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('magazine/index.html.twig', [
            'current_menu' => 'magazines'
        ]);
    }

    /**
     * @Route("/magazines/{slug}-{id}", name="magazine.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Magazines $magazines
     * @return Response
     */
    public function show(Magazines $magazines, string $slug): Response
    {
        if($magazines->getSlug() !== $slug) {
            return $this->redirectToRoute('magazine.show',[
                'id'=> $magazines->getId(),
                'slug' =>$magazines->getSlug()
            ], 301);
        }
        return $this->render('magazine/show.html.twig', [
            'magazines'=> $magazines,
            'current_menu' => 'magazines'
        ]);
    }
}