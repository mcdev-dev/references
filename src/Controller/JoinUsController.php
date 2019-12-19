<?php

namespace App\Controller;

use App\Entity\JoinUs;
use App\Form\JoinUsType;
use App\Repository\JoinUsRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class JoinUsController extends AbstractController
{
    /**
     * @Route("/join-us/liste", name="join_us_list")
     */
    public function candidatureListeAction(JoinUsRepository $repo)
    {
        return $this->render('join_us/join_us_list.html.twig', [
            'candidatures' => $repo->findAll(),
        ]);
    }

    /**
     * @Route("/rejoignez-nous/", name="join_us_add")
     * Route de la page Rejoignez-nous
     */
    public function candidatureAddAction(Request $request, ObjectManager $manager) 
    {
        $candidat = new JoinUs;
        $form = $this->createForm(JoinUsType::class, $candidat);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) 
        {
            $manager->persist($candidat);
            $manager->flush();

            $this->addFlash('success', $candidat->getPrenom() . ', merci de nous avoir rejoint.');
            return $this->redirectToRoute('home');
        }

        return $this->render('join_us/nous_rejoindre.html.twig', 
        [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/join-us/apercue/{id}", name="candidature_view")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function candidatureViewAction($id, JoinUs $candidature) 
    {
        return $this->render('join_us/candidature.html.twig', 
        [
            'candidature' => $candidature
        ]);
    }

    /**
     * @Route("/join-us/delete/{id}", name="candidature_delete")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function candidatureDeleteAction($id, JoinUsRepository $repo,  ObjectManager $manager) 
    {
        $manager->remove($repo->find($id));
        $manager->flush();
        $this->addFlash('success', '<strong>La candidature n° ' . $id . '</strong> vient d\'être supprimée avec succès.');
        return $this->redirectToRoute('join_us_list');
    }

}
