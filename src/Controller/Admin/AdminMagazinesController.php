<?php
namespace App\Controller\Admin;

use App\Entity\Magazines;
use App\Form\MagazineType;
use App\Repository\MagazinesRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminMagazinesController extends AbstractController{

    /**
     * @var MagazinesRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(MagazinesRepository $repository, ObjectManager $em) {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route ("/admin", name="admin.magazines.index")
     * @return Response
     */

    public function index() {
        $magazines = $this->repository->findAll();
        return $this->render('admin/magazines/index.html.twig', compact('magazines'));
    }

    /**
     * @Route("/admin/magazines/create", name="admin.magazines.new")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function new (Request $request){
        $magazines = new Magazines();
        $form =$this->createForm(MagazineType::class, $magazines);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($magazines);
            $this->em->flush();
            $this->addFlash('success', 'Bien ajouté avec succés');
            return $this->redirectToRoute('admin.magazines.index');
        }

        return $this->render('admin/magazines/new.html.twig', [
            'magazines' => $magazines,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/admin/magazines/{id}", name="admin.magazines.edit", methods="GET|POST")
     * @param Magazines $magazines
     * @param Request $request
     * @return Response
     */

    public function edit(Magazines $magazines, Request $request){
        $form =$this->createForm(MagazineType::class, $magazines);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Bien modifié avec succés');
            return $this->redirectToRoute('admin.magazines.index');

        }

        return $this->render('admin/magazines/edit.html.twig', [
            'magazines' => $magazines,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/magazines/{id}", name="admin.magazines.delete", methods="DELETE")
     * @param Magazines $magazines
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Magazines $magazines, Request $request) {
        if ($this->isCsrfTokenValid('delete'. $magazines->getId(),$request->get('_token'))) {
            $this->em->remove($magazines);
            $this->em->flush();

            $this->addFlash('sucess', 'Bien supprimé avec succés');
        }
        return $this->redirectToRoute('admin.magazines.index');
    }

}
