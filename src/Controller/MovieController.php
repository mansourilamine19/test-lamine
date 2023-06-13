<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;
use App\Service\CurlApi;

class MovieController extends AbstractController
{

    #[Route('/movie', name: 'index_movies')]
    public function listMovies(Request $request): Response
    {
        return $this->render('movie/index.html.twig', [
        ]);

    }

    #[Route('/movie/list', name: 'render_controller_list_movies')]
    public function list(Request $request): Response
    {
        try {
            //pagination
            $page = 1;
            if ($request->get('page') && !empty($request->get('page'))) {
                $page = $request->get('page');
            }
            //Search
            $withGenres = '';
            if ($request->get('with_genres') && !empty($request->get('with_genres'))) {
                $withGenres = $request->get('with_genres');
            }

            //global parametres in .env
            $baseURLExternalApi = $this->getParameter('BASE_URL_EXTERNAL_API');
            $apiKey = $this->getParameter('API_KEY');
            $jwt = $this->getParameter('JWT');
            $baseUrlImages = $this->getParameter('BASE_URL_IMAGES');
            $urlMovies = $baseURLExternalApi . "discover/movie?api_key=" . $apiKey . "&page=" . $page;
            if (!empty($withGenres)) {
                $urlMovies = $urlMovies . "&with_genres=" . $withGenres;
            }

            $urlGenres = $baseURLExternalApi . 'genre/movie/list?language=en';

            $curlApi = new CurlApi();
            $movies = $curlApi->curlGet($urlMovies, $jwt);
            $genres = array();
            if (!$request->isXmlHttpRequest()) {
                $genres = $curlApi->curlGet($urlGenres, $jwt);
            }

            return $this->render('movie/list.html.twig', [
                'movies' => $movies,
                'genres' => $genres,
                'baseUrlImages' => $baseUrlImages,
            ]);
        } catch (Throwable $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    #[Route('/movie/detail', name: 'detail_movie')]
    public function getMovieAjax(Request $request): Response
    {
        try {
            $id = $request->request->get('id');
            //global parametres in .env
            $baseURLExternalApi = $this->getParameter('BASE_URL_EXTERNAL_API');
            $apiKey = $this->getParameter('API_KEY');
            $jwt = $this->getParameter('JWT');
            $baseUrlImages = $this->getParameter('BASE_URL_IMAGES');
            $urlMovie = $baseURLExternalApi . "movie/" . $id . "?api_key=" . $apiKey;
            $curlApi = new CurlApi();
            $movie = $curlApi->curlGet($urlMovie, $jwt);
            //dd($movie);

            return $this->render('movie/show.html.twig', [
                'movie' => $movie,
                'baseUrlImages' => $baseUrlImages,
            ]);

        } catch (Throwable $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
