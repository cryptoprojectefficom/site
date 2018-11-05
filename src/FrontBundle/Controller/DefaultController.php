<?php

namespace FrontBundle\Controller;

use CoreBundle\Entity\Article;
use CoreBundle\Entity\Comment;
use CoreBundle\Entity\User;

use CoreBundle\Form\CommentType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $output = [];
        $category = $em->getRepository('CoreBundle:Category')->findAll();
        foreach ($category as $value) {
            $output[]=$em->getRepository('CoreBundle:Article')->getArticleWithCategoriesLimit($value->getId());
        }

        $lastArticle = $em->getRepository('CoreBundle:Article')->findBy( array() ,array('date' => 'desc'), 4, 0);

        return $this->render('@Front/Default/index.html.twig', ['lastArticle' => $lastArticle, 'articles' => $output]);
    }

    /**
     * @Route("/bitcoin", name="default_bitcoin")
     */

     public function show_bitcoin(){

        return $this->render('@Front/Default/bitcoin.html.twig');
     }

     
    /**
     * @Route("/litecoin", name="default_litecoin")
     */

    public function show_litecoin(){

        return $this->render('@Front/Default/litecoin.html.twig');
     }

     
    /**
     * @Route("/ethereum", name="default_ethereum")
     */

    public function show_ethereum(){

        return $this->render('@Front/Default/ethereum.html.twig');
     }

     /**
      * @Route("/blockchain", name="default_blockchain")
      */

      public function show_blockchain(){
      
        return $this->render('@Front/Default/blockchain.html.twig');
      
    }
}
