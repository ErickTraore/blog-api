<?php

namespace App\Controller;

use App\Entity\Article;
use App\Controller\ArticleController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Serializer;
use Doctrine\ORM\Mapping\ClassMetadataFactory;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactoryInterface;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Mapping\Loader\YamlFileLoader;
use Symfony\Component\Serializer\Mapping\Loader\XmlFileLoader;
// use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/articles/{id}", name="article_show")
     */
    public function showAction()
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $article = new Article();
        $article
            ->setTitle('Mon premier article')
            ->setContent('Le contenu de mon article.')
        ;
        // $data = $this->get('jms_serializer')->serialize($article, 'json');
        $data = $serializer->serialize($article, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }


    /**
     * @Route("/articles", name="article_create")
     * @Method({"POST"})
     */
//     public function create()
//         {
//             $encoders = [new XmlEncoder(), new JsonEncoder()];
//             $normalizers = [new ObjectNormalizer()];
//             $serializer = new Serializer($normalizers, $encoders);
    

//             $data = $request->getContent();
//             $article = $this->get('serializer')->deserialize($data, 'Article', 'json');
            
//             $em =$this->getDoctrine()->getManager();
//             $em->persist($article);
//             $em->flush();
// var_dump($article);
//             return new Response('', Response::HTTP_CREATED);
//         }




//         $data = <<<EOF
//             <article>
//                 <title>Mon vrai premier article</title>
//                 <content>Le contenu de mon premier vrai article</content>
//                 <sportsperson>false</sportsperson>
//             </article>
//             EOF;

// $classMetadataFactory = new ClassMetadataFactory ( $loader );
// $normalizer = new ObjectNormalizer ( $classMetadataFactory );
// $serializer = new Serializer ([ $normalizer ]);

//             $article = $serializer->deserialize($data, Article::class, 'xml', [
//                 AbstractNormalizer :: ALLOW_EXTRA_ATTRIBUTES => false ,
//             ]);
//             // $jsonContent = $serializer->serialize($article, 'json');
            
//             var_dump($article);
//             $response = new Response($article);
//             $response->headers->set('Content-Type', 'application/json');
//             return $response;
}