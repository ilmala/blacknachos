<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\Category;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends Controller
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * Get list of all articles
     *
     * @Route("/api/articles", methods={"GET"})
     */
    public function listAction(Request $request)
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBySlug(
                $categorySlug = $request->query->get('category')
            );

        if ($categorySlug && !$category) {
            return $this->json(
                ["message" => "Category '$categorySlug' not found."],
                404
            );
        }

        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(
                $category ? ['category' => $category] : [],
                ['publishedAt' => 'DESC']
            );

        $json = $this->serializer->serialize(
            ['articles' => $articles],
            'json'
        );

        return new Response(
            $json,
            200,
            ['content-type' => 'application/json']
        );
    }

    /**
     * Get article detail
     *
     * @Route("/api/articles/{slug}", methods={"GET"})
     */
    public function showAction($slug)
    {

        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneBySlug($slug);

        if (!$articles) {
            return $this->json(
                ["message" => "Article '$slug' not found."],
                404
            );
        }

        $json = $this->serializer->serialize(
            ['article' => $articles],
            'json'
        );

        return new Response(
            $json,
            200,
            ['content-type' => 'application/json']
        );
    }
}
