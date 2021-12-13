<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Article;
use AppBundle\Entity\Category;
use Cocur\Slugify\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{

    /**
     * @var \Faker\Generator
     */
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $categoryNames = [
            'PHP',
            'Laravel',
            'Symfony',
            'MySQL',
            'MongoDB',
            'API',
            'TailwindCSS'
        ];

        $slugify = new Slugify();

        $categories = [];

        foreach ($categoryNames as $name){
            $category = new Category();
            $category->setName($name);
            $category->setSlug($slugify->slugify($name));

            $manager->persist($category);
            $categories[]=$category;
        }

        $manager->flush();

        // Articles

        for($i=0; $i<20; $i++){
            $article = new Article();

            $title = $this->faker->sentences(2, true);
            $category = $this->faker->randomElement($categories);

            $article->setTitle($title);
            $article->setSlug($slugify->slugify($title));
            $article->setContent($this->faker->realText(600));
            $article->setStatus(Article::STATUS_PUBLISH);
            $article->setPublishedAt($this->faker->dateTimeBetween('-1 years'));
            $article->setCategory($category);

            $manager->persist($article);
        }

        $manager->flush();
    }
}