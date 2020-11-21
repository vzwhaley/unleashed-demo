<?php

namespace App\Controller;

use App\Entity\Url;
use App\Form\UrlType;
use App\Repository\UrlRepository;
use App\Service\UrlShortener;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UrlController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param Request $request
     * @param UrlShortener $urlShortener
     * @return Response
     */
    public function index(Request $request, UrlShortener $urlShortener): Response
    {
        $em = $this->getDoctrine()->getManager();

        $url = new Url();
        $url->setCreatedAt(new \DateTime());

        $form = $this->createForm(UrlType::class, $url);
        $params = [
            'controller_name' => 'DefaultController',
            'form' => $form->createView()
        ];

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $urlFormData = $form->getData();

            $shortenedUrl = $urlShortener->getShortenedUrl($urlFormData->getUrl());
            $token = parse_url($shortenedUrl, PHP_URL_HOST);

            $url->setShortUrl($shortenedUrl);
            $url->setToken($token);
            $url->setVisits(0);
            $em->persist($url);
            $em->flush();

            return $this->redirectToRoute('load_url_stats', [
                'shortenedUrl' => $token,
            ]);
        } else {
            $params['controller_name'] = 'DefaultController';
            $params['errors'] = $form->getErrors(true);
            $params['form'] = $form->createView();
        }

        return $this->render('default/index.html.twig', $params);
    }

    /**
     * @Route("/stats", name="load_stats")
     * @param Request $request
     * @param UrlRepository $urlRepo
     * @return Response
     */
    public function loadStats(Request $request, UrlRepository $urlRepo): Response
    {
        $urlDetails = $urlRepo->findAll();

        return $this->render('default/url-stats.html.twig', [
            'controller_name' => 'DefaultController',
            'url_details'=> $urlDetails
        ]);
    }

    /**
     * @Route("/view/{shortenedUrl}", name="load_url_stats")
     * @param $shortenedUrl
     * @param Request $request
     * @param UrlRepository $urlRepo
     * @return Response
     */
    public function loadUrlStats($shortenedUrl, Request $request, UrlRepository $urlRepo): Response
    {
        $urlDetails = $urlRepo->findOneBy(['token' => $shortenedUrl]);

        return $this->render('default/url.html.twig', [
            'controller_name' => 'DefaultController',
            'url_details'=> $urlDetails
        ]);
    }

    /**
     * @Route("/{shortenedUrl}", name="load_url")
     * @param $shortenedUrl
     * @param Request $request
     * @param UrlRepository $urlRepo
     * @return Response
     */
    public function loadUrl($shortenedUrl, Request $request, UrlRepository $urlRepo): Response
    {
        $url = $urlRepo->findOneBy(['token' => $shortenedUrl]);

        $newUrlVisits = $url->getVisits() + 1;

        $url->setVisits($newUrlVisits);

        $em = $this->getDoctrine()->getManager();
        $em->persist($url);
        $em->flush();

        return new RedirectResponse($url->getUrl());
    }
}
