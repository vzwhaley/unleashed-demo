<?php

namespace App\Service;

use App\Repository\UrlRepository;
use Exception;

class UrlShortener
{
    /** @var UrlRepository */
    private $urlRepo;

    public function __construct(UrlRepository $urlRepo)
    {
        $this->urlRepo = $urlRepo;
    }

    /**
     * Return a shortened URL of 9 random characters
     *
     * @param $url
     * @return string
     * @throws Exception
     */
    public function getShortenedUrl($url): string
    {
        // Initialize an empty string for our shortened URL
        $shortenedUrl = '';

        // If a URL was not supplied, throw an exception
        if (empty($url)) {
            throw new Exception("No URL was supplied.");
        }

        // Check the database to see if we already have a shortened version of this particular URL
        $urlExists = $this->urlRepo->findOneBy(['url' => $url]);

        // If we already have a shortened URL, throw an exception
        if (!empty($urlExists)) {
            throw new Exception("A shortened version already exists for this URL.");
        }

        // If we don't already have a shortened URL, make one and store it in the database
        if (empty($urlExists)) {
            // Create a 9-character, randomized token as a placeholder for our shortened URL
            $token = substr(md5(uniqid(rand(), true)), 0, 9);

            // Get the URL scheme, i.e. http or https
            $urlScheme = parse_url($url, PHP_URL_SCHEME);

            // Create a new shortened URL with the original scheme and the token we just generated
            $shortenedUrl = $urlScheme . '://' . $token;
        }

        return $shortenedUrl;
    }
}