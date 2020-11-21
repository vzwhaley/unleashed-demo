<?php

namespace App\Controller;

use App\Repository\UrlRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api", name="api")
 */
class ApiController extends AbstractController
{
    private $urlRepo;

    public function __construct(UrlRepository $urlRepo)
    {
        $this->urlRepo = $urlRepo;
    }

    /**
     * CRUD method for creating/adding a new URL
     *
     * @Route("/add-url", name="add_url, methods={"POST"})
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function addUrl(Request $request): JsonResponse
    {
        // TODO Add repository method for adding new URL

        return new JsonResponse(['status' => 'New URL created!'], Response::HTTP_CREATED);
    }

    /**
     * CRUD method for reading/getting the URL data
     *
     * @Route("/url/{id}", name="get_url", methods={"GET"})
     *
     * @param string $id
     * @return JsonResponse
     */
    public function getUrl($id): JsonResponse
    {
        $url = $this->urlRepo->findOneBy(['id' => $id]);

        $urlData = [
            'id' => $url->getId(),
            'url' => $url->getUrl(),
            'shortUrl' => $url->getShortUrl(),
            'token' => $url->getToken(),
            'visits' => $url->getVisits(),
            'createdAt' => $url->getCreatedAt(),
        ];

        return new JsonResponse($urlData, Response::HTTP_OK);
    }

    /**
     * CRUD method for updating an existing URL
     *
     * @Route("/url/{id}", name="update_url, methods={"PUT"})
     *
     * @param string $id
     * @return JsonResponse
     */
    public function updateUrl($id): JsonResponse
    {
        // TODO Add repository method for updating an existing URL

        return new JsonResponse([], Response::HTTP_OK);
    }

    /**
     * CRUD method for deleting an existing URL
     *
     * @Route("/url/{id}", name="delete_url, methods={"DELETE"})
     */
    public function deleteUrl(Request $request): JsonResponse
    {
        // TODO Add repository method for deleting an existing URL

        return new JsonResponse(['status' => 'URL deleted!'], Response::HTTP_NO_CONTENT);
    }
}
