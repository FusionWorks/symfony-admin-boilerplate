<?php

namespace App\Controller;

use App\Entity\Seller;
use App\Form\SellerType;
use App\Repository\SellerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/seller")
 */
class SellerController extends AbstractController
{
    /**
     * @Route("/", name="seller_index", methods={"GET"})
     * @param SellerRepository $sellerRepository
     * @return Response
     */
    public function index(SellerRepository $sellerRepository): Response
    {
        return $this->render('admin/seller/index.html.twig', [
            'sellers' => $sellerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="seller_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $seller = new Seller();
        $form = $this->createForm(SellerType::class, $seller);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($seller);
            $entityManager->flush();

            return $this->redirectToRoute('seller_index');
        }

        return $this->render('admin/seller/new.html.twig', [
            'seller' => $seller,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="seller_show", methods={"GET"})
     * @param Seller $seller
     * @return Response
     */
    public function show(Seller $seller): Response
    {
        return $this->render('admin/seller/show.html.twig', [
            'seller' => $seller,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="seller_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Seller $seller
     * @return Response
     */
    public function edit(Request $request, Seller $seller): Response
    {
        $form = $this->createForm(SellerType::class, $seller);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('seller_index');
        }

        return $this->render('admin/seller/edit.html.twig', [
            'seller' => $seller,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="seller_delete", methods={"DELETE"})
     * @param Request $request
     * @param Seller $seller
     * @return Response
     */
    public function delete(Request $request, Seller $seller): Response
    {
        if ($this->isCsrfTokenValid('delete'.$seller->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($seller);
            $entityManager->flush();
        }

        return $this->redirectToRoute('seller_index');
    }
}
