<?php

namespace App\Controller;

use App\Entity\Offer;
use App\Entity\SearchOffer;
use App\Form\OfferType;
use App\Form\SearchOfferType;
use App\Repository\OfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/offer", name="offer_")
 */
class OfferController extends AbstractController
{
    /**
     * @Route("/", name="list")
     */
    public function index(OfferRepository $offerRepository, Request $request): Response
    {
        $searchOffer = new SearchOffer();
        $form = $this->createForm(SearchOfferType::class, $searchOffer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $offers = $offerRepository->findBySearch($searchOffer);
        }

        return $this->render('offer/index.html.twig', [
            'offers' => $offers ?? $offerRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/add", name="add")
     * @IsGranted("ROLE_USER")
     */
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $offer = new Offer();

        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // insertion en bdd
            $entityManager->persist($offer);
            $entityManager->flush();

            $this->addFlash('success', 'L\'offre a bien été crée');
            // redirection
            return $this->redirectToRoute('home');
        }

        return $this->render('offer/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show")
     */
    public function show(Offer $offer): Response
    {
        return $this->render('offer/show.html.twig', [
            'offer' => $offer,
        ]);
    }
}
