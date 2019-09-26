<?php
namespace App\Controller;

use App\Entity\Magazines;
use App\Repository\MagazinesRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @param PaginationInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $magazines = $paginator ->paginate(
            $this->repository->findAllVisibleQuery(),
            $request->query->getInt('page', 1),
            12
        );
        return $this->render('magazine/index.html.twig', [
            'current_menu' => 'magazines',
            'magazines' => $magazines
        ]);
    }

    /**
     * @Route("/magazines/{slug}-{id}", name="magazine.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Magazines $magazines
     * @param string $slug
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