<?php

namespace App\Controller;

use League\Csv\Writer;
use SplTempFileObject;
use App\Entity\Candidatures;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CandidaturesRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCandidaturesController extends AbstractController
{
    
    /**
     * @Route("/admin/candidatures/list", name="candidatures_list")
     */
    public function candidaturesList(EntityManagerInterface $manager)
    {
        return $this->render('admin_candidatures/candidatures_list.html.twig', 
        [
            'candidatures' => $manager->getRepository(Candidatures::class)->findAll()
        ]);
    }

    /**
     * @Route("/admin/candidature/view", name="candidature_view")
     */
    public function candidaturesView(EntityManagerInterface $manager) 
    {
        return $this->render('admin_candidatures/candidature_delete.html.twig', 
        [
            
        ]);
    }

    /**
     * @Route("/admin/candidature/download-excel/{candidature}", name="candidature_download_excel")
     * @param Candidatures $candidature
     */
    public function candidaturesDownloadExcel(Candidatures $candidature = null, CandidaturesRepository $repo) 
    {
        $candidature = $repo->findCandidatureByField($candidature);
        //dd($candidature);
        #Writer
        $csv = Writer::createFromFileObject(new SplTempFileObject());
        $csv->insertOne(['logementActuel', 'menage', 'situationProFinanciere', 'interetHabitatParticipatif', 'candidat', 'situationProFinanciere']);
        
        foreach($candidature as $cand) 
        {
            $csv->insertOne([
                $cand->getLogementActuel(), $cand->getMenage(), $cand->getSituationProFinancierel(), $cand->getInteretHabitatParticipatif(), $cand->getCandidat(), $cand->getSituationProFinanciere()
            ]);

        }
        
        $csv->output('candidature.csv');
        die;

        // Return a message to the browser saying that the excel was succesfully created
        $this->addFlash('success', 'L\'exportation de la candidature de <strong>'. $candidature->getCandidat()->getPrenom() .'</strong> a réussie avec succès.');

        return $this->redirectToRoute('candidatures_list');
    }

    /**
     * @Route("/admin/candidature/download-pdf", name="candidature_download_pdf")
     */
    public function candidaturesDownloadPdf(EntityManagerInterface $manager) {}

    /**
     * @Route("/admin/candidature/delete/{candidature}", name="candidature_delete")
     * @param Candidatures $candidature
     */
    public function candidaturesDelete(Candidatures $candidature = null, EntityManagerInterface $manager) 
    {
        $candidature = $manager->getRepository(Candidatures::class)->findOneById($candidature);
        //dd($candidature);
        if(null !== $candidature) 
        {
            $manager->remove($candidature);
            $manager->flush();

            $this->addFlash('success', 'La candidature de <strong>'. $candidature->getCandidat(). '</strong> a été supprimée avec succès.');
        }

        return $this->redirectToRoute('candidatures_list');
    }
}
