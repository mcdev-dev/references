<?php

namespace App\Controller;

use App\Entity\RefLogements;
use App\Form\RefLogementsType;
use App\Repository\RefLogementsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReferencesController extends AbstractController
{
    /**
     * @Route("/admin/references/view-all", name="references_view_all")
     */
    public function index(RefLogementsRepository $refLogementsRepository)
    {
        $photos = null;
        $references = $refLogementsRepository->findAll();
        return $this->render('references/references_list.html.twig', 
        [
            'references' => $references,
            'photos' => $photos
        ]);
    }

    /**
     * @Route("/admin/references/add", name="references_add")
     */
    public function referencesAdd(Request $request, EntityManagerInterface $manager) 
    {
        $reference = new RefLogements;
        $form = $this->createForm(RefLogementsType::class, $reference);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) 
        {
            $manager->persist($reference);
            $manager->flush();

            $this->addFlash('success', 'L\'article <strong>' . $reference->getTitre() . '</strong>, a été ajouté avec succès.');

            return $this->redirectToRoute('references_view_all');
        }
        
        return $this->render('references/crud_references.html.twig', 
        [
            'referenceForm' => $form->createView(),
            'action' => 'Ajouter',
        ]);
    }

    /**
     * @Route("/admin/references/update/{id}", name="references_update")
     *
     */
    public function referencesUpdate($id, Request $request, EntityManagerInterface $manager, RefLogementsRepository $refLogementsRepository)
    {
        $reference = $refLogementsRepository->find($id);
        $form = $this->createForm(RefLogementsType::class, $reference);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            foreach ($reference->getImages() as $image) {
                $image->setRefLogements($reference);
                $manager->persist($image);
            }
            foreach ($reference->getContenuReference() as $contenuReference){
                $contenuReference->setReference($reference);
                $manager->persist($contenuReference);
            }
            $manager->persist($reference);
            $manager->flush();

            $this->addFlash('success', 'L\'article <strong>' . $reference->getTitre() . ',</strong> a été mis à jour avec sucès.');

            return $this->redirectToRoute('references_view_all');
        }

        return $this->render('references/crud_references.html.twig',
        [
            'action' => 'Modifier',
            'id' => $id,
            'reference' => $reference,
            'referenceForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/references/delete/{id<\d+>}", name="references_delete")
     */
    public function referencesDelete($id, EntityManagerInterface $manager) 
    {
        $reference = $manager->getRepository(RefLogements::class)->find($id);

        if(null !== $reference) 
        {
            $manager->remove($reference);
            $manager->flush();

            $this->addFlash('success', 'L\'article <strong>' . $reference->getTitre() . ',</strong> a été supprimé avec sucès.');

            return $this->redirectToRoute('references_view_all');
        }

        return $this->reidrectToRoute('references_view_all');
    }

    /**
     * @param RefLogementsRepository $refLogementsRepository
     * @return Response
     * @Route("/references/liste", name="reference_liste")
     */
    public function referenceShow(RefLogementsRepository $refLogementsRepository)
    {

        $references = $refLogementsRepository->findAll();
        return $this->render('references/references_show_list.html.twig',
            [
                'references' => $references
            ]
    );
    }

    /**
     * @Route("reference/{id<\d+>}", name="reference_info")
     * @param RefLogementsRepository $refLogementsRepository
     * @return Response
     */
    public function referenceInfo($id, RefLogementsRepository $refLogementsRepository)
    {
        $reference = $refLogementsRepository->find($id);
        return $this->render('references/reference_info.html.twig',
            [
                'reference' => $reference
            ]
        );
    }

}
