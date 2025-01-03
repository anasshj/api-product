<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api/products', name: 'api_products', methods: ['GET'])]
    public function getProducts(ProductRepository $productRepository): JsonResponse
    {
        $products = $productRepository->findAll();
        $data = [];
        foreach ($products as $product) {
            $data[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'price' => $product->getPrice(),
            ];
        }
        return new JsonResponse($data);
    }

    #[Route('/api/products', name: 'api_create_product', methods: ['POST'])]
    public function createProduct(Request $request, ProductRepository $productRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if (empty($data['name']) || empty($data['price'])) {
            return new JsonResponse(['error' => 'Invalid data'], JsonResponse::HTTP_BAD_REQUEST);
        }

        $product = new Product();
        $product->setName($data['name']);
        $product->setPrice((float)$data['price']);
        $productRepository->save($product, true);

        return new JsonResponse(['status' => 'Product created'], JsonResponse::HTTP_CREATED);
    }

    #[Route('/api/products/{id}', name: 'api_update_product', methods: ['PUT'])]
    public function updateProduct(int $id, Request $request, ProductRepository $productRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $product = $productRepository->find($id);

        if (!$product) {
            return new JsonResponse(['error' => 'Product not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        if (!empty($data['name'])) {
            $product->setName($data['name']);
        }
        if (!empty($data['price'])) {
            $product->setPrice((float)$data['price']);
        }

        $productRepository->save($product, true);
        return new JsonResponse(['status' => 'Product updated']);
    }

    #[Route('/api/products/{id}', name: 'api_delete_product', methods: ['DELETE'])]
    public function deleteProduct(int $id, ProductRepository $productRepository): JsonResponse
    {
        $product = $productRepository->find($id);

        if (!$product) {
            return new JsonResponse(['error' => 'Product not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        $productRepository->remove($product, true);
        return new JsonResponse(['status' => 'Product deleted']);
    }
}
