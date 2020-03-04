<?php

namespace App\Controller;

use App\Events;
use App\Entity\Menage;
use App\Entity\Categorie;
use App\Entity\Candidatures;
use App\Entity\LogementActuel;
use App\Form\CandidaturesType;
use App\Entity\SituationProFinanciere;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\InteretHabitatParticipatif;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CandidaturesController extends AbstractController
{
    /**
     * @Route("/user/candidatures", name="user_candidatures")
     */
    public function userCandidature(EntityManagerInterface $manager)
    {
        $candidatures = $manager->getRepository(Candidatures::class)->findBy([ 'candidat' => $this->getUser()->getPrenom().' '.$this->getUser()->getNom() ]);

        return $this->render('user/user_candidatures.html.twig', 
        [
            'candidatures' => $candidatures,
        ]);
    }

    /**
     * @Route("/user/candidature/questionnaire", name="questionnaire_candidature")
     */
    public function candidatureQuestionnaire(Request $request, EntityManagerInterface $manager, ValidatorInterface $validator, EventDispatcherInterface $eventDispatcher) 
    {
        $candidature_exist = $manager ->getRepository(Candidatures::class)
                                      ->findOneBy([ 'candidat' => $this->getUser()->getPrenom().' '.$this->getUser()->getNom() ]);
        $titleProject = 'Candidature au projet Saint-Ferjeux';
        
        $candidature = new Candidatures;
        $categorie = new Categorie;
        $logementActuel = new LogementActuel;
        $menage = new Menage;
        $situationProFinanciere = new SituationProFinanciere;
        $interetHabitatParticipatif = new InteretHabitatParticipatif;
        
        $register = $request->get('enregistrer') !== null;
        $form = $register ? $this->createForm(CandidaturesType::class, $candidature, ['validation_groups' => false]) : $this->createForm(CandidaturesType::class, $candidature);

        //$errors = $validator->validate($candidature);

        $form->handleRequest($request);
        
        if($form->isSubmitted()) 
        {
            if($form->isValid()) 
            {
                $otherStatutOccupation = $request->get('other_statut_occupation');
                $statutEmploiAc = $request->get('other_acquereur_statut_emploi');
                $statutEmploiCoAc = $request->get('other_co_acquereur_statut_emploi');
                $apportPersonnel = $request->get('other_apport_perso');
    
                if(null !== $otherStatutOccupation) 
                {
                    $form->get('logementActuel')->getData()->setStatutOccupation($otherStatutOccupation);
                }
                if(null !== $statutEmploiAc) 
                {
                    $form->get('situationProFinanciere')->getData()->setAcquereurStatutEmploi($statutEmploiAc);
                }
                if(null !== $statutEmploiCoAc) 
                {
                    $form->get('situationProFinanciere')->getData()->setCoAcquereurStatutEmploi($statutEmploiCoAc);
                }
                if(null !== $apportPersonnel) 
                {
                    $form->get('situationProFinanciere')->getData()->setApportPersonnel($apportPersonnel);
                }
    
                //dd(count($errors)); die;
                $candidature->setTitre('Bascule-pelouse, Saint-Ferjeux');
    
                if($register) 
                {
                    if(null !== $candidature_exist) 
                    {
                        $this->addFlash('errors', '<strong>Désolé !</strong> Vous avez déjà candidater pour ce projet.');
            
                        return $this->redirectToRoute('user_candidatures'); 
                    } 
                    else 
                    {
                        $candidature->setValider(false);
                        $candidature->setStatut(0);//Persistance
                        $candidature->setCandidat($this->getUser()->getPrenom().' '.$this->getUser()->getNom());
                        $candidature->setVille('Saint-Ferjeux');
                        $candidature->setPromoteur('Néolia');
                        $candidature->setPromoteurLogo('neolia');
                        $candidature->setCategorie($categorie->setTitle('habitat-participatif'));
                
                        $manager->persist($candidature);
                        $manager->flush();
                        $this->addFlash('success', '<strong>'. $this->getUser()->getPrenom() .',</strong> votre candidature a été enregistrée avec succès.');
                        return $this->redirectToRoute('user_candidatures');
                    }
    
                } 
                else 
                {
                    if(null !== $candidature_exist) 
                    {
                        $this->addFlash('errors', '<strong>Désolé !</strong> Vous avez déjà candidater pour ce projet.');
            
                        return $this->redirectToRoute('user_candidatures'); 
                    }
                    else 
                    {
                        //Persistance
                        $candidature->setStatut(1);
                        $candidature->setCandidat($this->getUser()->getPrenom().' '.$this->getUser()->getNom());
                        $candidature->setVille('Saint-Ferjeux');
                        $candidature->setPromoteur('Néolia');
                        $candidature->setPromoteurLogo('neolia');
                        $candidature->setCategorie($categorie->setTitle('habitat-participatif'));
            
                        $manager->persist($candidature);
                        $manager->flush();
                        
                        $this->addFlash('success', '<strong>'. $this->getUser()->getPrenom() .',</strong> votre candidature a été soumise avec succès.');

                        //On déclenche l'eventDispatcher
                        $event = new GenericEvent($this->getUser());
                        $eventDispatcher->dispatch(Events::USER_NOTIFY_POST_CANDIDATURE, $event);
    
                        return $this->redirectToRoute('user_candidatures');
                    }
                    
                }
            } 
            else 
            {
                $this->addFlash('errors', '<strong>'. $this->getUser()->getPrenom() .',</strong> impossible de soumettre votre candidature. Veuillez remplir les champs obligatoires.');
            }
            
        }

        return $this->render('candidatures/questionnaire.html.twig', 
        [
            'projectName' => $titleProject,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("user/candidature/temporary", name="candidature_temporary")
     */
    public function candidatureTemporary(Request $request, EntityManagerInterface $manager, ValidatorInterface $validator, EventDispatcherInterface $eventDispatcher) 
    {
        $titleProject = 'Candidature du projet Saint-Ferjeux';
        $candidature = $manager ->getRepository(Candidatures::class)
                                ->findOneBy([ 'candidat' => $this->getUser()->getPrenom().' '.$this->getUser()->getNom() ]);
                                
        $register = $request->get('enregistrer') !== null;
        $form = $register ? $this->createForm(CandidaturesType::class, $candidature, ['validation_groups' => false]) : $this->createForm(CandidaturesType::class, $candidature);
        //** */
        $o_statut_occupation = $form->get('logementActuel')
                               ->getData()->getStatutOccupation();
        $o_acquereur_statut_emploi = $form->get('situationProFinanciere')
                                     ->getData()->getAcquereurStatutEmploi();
        $o_coacquereur_statut_emploi = $form->get('situationProFinanciere')
                                       ->getData()->getCoAcquereurStatutEmploi();
        $o_apport_personnel = $form->get('situationProFinanciere')
                              ->getData()->getApportPersonnel();
        
        //dd($statut_occupation);
        $form->handleRequest($request);
        
        if($form->isSubmitted()) 
        {
            $otherStatutOccupation = $request->get('other_statut_occupation');
            $statutEmploiAc = $request->get('other_acquereur_statut_emploi');
            $statutEmploiCoAc = $request->get('other_co_acquereur_statut_emploi');
            $apportPersonnel = $request->get('other_apport_perso');

            if(null !== $otherStatutOccupation) 
            {
                $form->get('logementActuel')->getData()->setStatutOccupation($otherStatutOccupation);
            }
            if(null !== $statutEmploiAc) 
            {
                $form->get('situationProFinanciere')->getData()->setAcquereurStatutEmploi($statutEmploiAc);
            }
            if(null !== $statutEmploiCoAc) 
            {
                $form->get('situationProFinanciere')->getData()->setCoAcquereurStatutEmploi($statutEmploiCoAc);
            }
            if(null !== $apportPersonnel) 
            {
                $form->get('situationProFinanciere')->getData()->setApportPersonnel($apportPersonnel);
            }
            
            if($register) 
            {
                //hydrater les champs "autre";
                if($form->get('logementActuel')->getData()->getStatutOccupation() === null) $form->get('logementActuel')->getData()->setStatutOccupation($o_statut_occupation);
                
                if($form->get('situationProFinanciere')->getData()->getAcquereurStatutEmploi() === null) $form->get('situationProFinanciere')->getData()->setAcquereurStatutEmploi($o_acquereur_statut_emploi);

                if($form->get('situationProFinanciere')->getData()->getCoAcquereurStatutEmploi() === null) $form->get('situationProFinanciere')->getData()->setCoAcquereurStatutEmploi($o_coacquereur_statut_emploi);

                if($form->get('situationProFinanciere')->getData()->getApportPersonnel() === null) $form->get('situationProFinanciere')->getData()->setApportPersonnel($o_apport_personnel);

                $candidature->setValider(false);
                $candidature->setStatut(0);//Persistance
        
                $manager->persist($candidature);
                $manager->flush();
                $this->addFlash('success', '<strong>'. $this->getUser()->getPrenom() .',</strong> votre candidature a été enregistrée avec succès.');
                return $this->redirectToRoute('user_candidatures');

            } 
            if($form->isValid()) 
            {
                //Persistance
                $candidature->setStatut(1);

                $manager->persist($candidature);
                $manager->flush();
                
                //On déclenche l'eventDispatcher
                $event = new GenericEvent($this->getUser());
                $eventDispatcher->dispatch(Events::USER_NOTIFY_POST_CANDIDATURE, $event);
                
                $this->addFlash('success', '<strong>'. $this->getUser()->getPrenom() .',</strong> votre candidature a été soumise avec succès.');
                return $this->redirectToRoute('user_candidatures');
                
            } 
            else 
            {
                //dd($o_statut_occupation);
                $this->addFlash('errors', '<strong>'. $this->getUser()->getPrenom() .',</strong> impossible de soumettre votre candidature. Veuillez remplir les champs obligatoires.');
            }
            
        }

        return $this->render('candidatures/questionnaire.html.twig', 
        [
            'projectName' => $titleProject,
            'form' => $form->createView(),
        ]);
    }

}