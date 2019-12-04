<?php

namespace App\Controller;

use App\Entity\Products;
use App\Form\ProductsType;
use App\Repository\ProductsRepository;
use App\Service\FileUploaderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/products")
 */
class ProductsController extends AbstractController
{
    /**
     * @Route("/", name="products_index", methods={"GET"})
     */
    public function index(ProductsRepository $productsRepository): Response
    {
        return $this->render('admin/products/index.html.twig', [
            'products' => $productsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="products_new", methods={"GET","POST"})
     * @param Request             $request
     * @param FileUploaderService $fileUploader
     * @return RedirectResponse|Response
     */
    public function new(Request $request, FileUploaderService $fileUploader): Response
    {
        $product = new Products();
        $form = $this->createForm(ProductsType::class, $product, ['method' => 'POST']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if($product->getfile()) {
                $file     = $product->getFile();
                $fileName = $fileUploader->upload($file, 'image');
                $product->setImage($fileName);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('products_index');
        }

        return $this->render('admin/products/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="products_show", methods={"GET"})
     * @param Products $product
     * @return Response
     */
    public function show(Products $product): Response
    {
        return $this->render('admin/products/show.html.twig', [
            'product' => $product,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="products_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Products $product
     * @param FileUploaderService $fileUploader
     * @return RedirectResponse|Response
     */
    public function edit(Request $request, Products $product, FileUploaderService $fileUploader): Response
    {
        $form = $this->createForm(ProductsType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $product->getFile();

            if ($file instanceof UploadedFile) {
                $fileName = $fileUploader->upload($file, 'image');
                $product->setImage($fileName);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('products_index');
        }

        return $this->render('admin/products/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="products_delete", methods={"DELETE"})
     * @param Request $request
     * @param Products $product
     * @param FileUploaderService $fileUploader
     * @return Response
     */
    public function delete(Request $request, Products $product, FileUploaderService $fileUploader): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {

            if ($product->getImage() !== null) {

                $fileUploader->removeFile($product->getImage());
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('products_index');
    }
}
