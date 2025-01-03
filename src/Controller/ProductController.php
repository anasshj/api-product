<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ProductController extends AbstractController
{
    private HttpClientInterface $client;
    public function __construct(HttpClientInterface $client)
{
        $this->client = $client;
}
    #[Route('/products', name: 'products')]
    public function index()
    {
        $response = $this->client->request('GET', 'http://127.0.0.1:8000/api/products');
        $products = $response->toArray();
        return $this->render('product/index.html.twig', [
            'products' => $products,       
        ]);
    }

    #[Route('/product/new', name: 'new_product')]
    public function newProduct(Request $request, ProductRepository $productRepository): Response
    {
        if ($request->isMethod('POST')) {
            $product = new Product();
            $product->setName($request->request->get('name'));
            $product->setPrice((float)$request->request->get('price'));
            $productRepository->save($product, true);
            return $this->redirectToRoute('products');
        }
        return $this->render('products/new.html.twig');
    }

    #[Route('/product/edit/{id}', name: 'edit_product')]
    public function editProduct(int $id, Request $request, ProductRepository $productRepository): Response
    {
        $product = $productRepository->find($id);
    if (!$product) {
        throw $this->createNotFoundException('Product not found');
    }
    if ($request->isMethod('POST')) {
        $product->setName($request->request->get('name'));
        $product->setPrice((float)$request->request->get('price'));
        $productRepository->save($product, true);
        return $this->redirectToRoute('product');
    }
    return $this->render('products/edit.html.twig', ['product' => $product]);
    }

    #[Route('/products/delete/{id}', name: 'delete_product')]
    public function deleteProduct(int $id, ProductRepository $productRepository): Response
    {
        $product = $productRepository->find($id);
    if ($product) {
        $productRepository->remove($product, true);
    }
    return $this->redirectToRoute('product');
    }
}
