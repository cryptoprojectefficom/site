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
}
