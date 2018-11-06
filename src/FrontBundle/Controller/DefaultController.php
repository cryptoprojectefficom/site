<?php

namespace FrontBundle\Controller;

use CoreBundle\Entity\Article;
use CoreBundle\Entity\Comment;
use CoreBundle\Entity\User;

use CoreBundle\Form\CommentType;

use Unirest\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
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

        // $date = new \DateTime;
        // $yesterday = $date->modify('-1 days')->format('Y-m-d\TH:i:s\Z');

        // $headers = array('Accept' => 'application/json', 'X-CoinAPI-Key' => '044A1C06-AFE6-4EF3-9223-0363770C3E25');
                
        // $responseValYest = Request::get('https://rest.coinapi.io/v1/exchangerate/BTC/EUR?time='.$yesterday,$headers);
        // $responseNow = Request::get('https://rest.coinapi.io/v1/exchangerate/BTC/EUR',$headers);


        // $valLast = round($responseValYest->body->rate, 2);
        // $newVal = round($responseNow->body->rate, 2);
        // $rateChange = (($newVal - $valLast) / $newVal)*100;

        return $this->render('@Front/Default/bitcoin.html.twig', ['BTCInfo' => null, 'BTCRate' => null]);
     }

     
    /**
     * @Route("/litecoin", name="default_litecoin")
     */

    public function show_litecoin(){
        // $date = new \DateTime;
        // $yesterday = $date->modify('-1 days')->format('Y-m-d\TH:i:s\Z');

        // $headers = array('Accept' => 'application/json', 'X-CoinAPI-Key' => '044A1C06-AFE6-4EF3-9223-0363770C3E25');
                
        // $responseValYest = Request::get('https://rest.coinapi.io/v1/exchangerate/LTC/EUR?time='.$yesterday,$headers);
        // $responseNow = Request::get('https://rest.coinapi.io/v1/exchangerate/LTC/EUR',$headers);


        // $valLast = round($responseValYest->body->rate, 2);
        // $newVal = round($responseNow->body->rate, 2);
        // $rateChange = (($newVal - $valLast) / $newVal)*100;


        return $this->render('@Front/Default/litecoin.html.twig', ['LTCInfo' => null, 'LTCRate' => null]);
     }

     
    /**
     * @Route("/ethereum", name="default_ethereum")
     */

    public function show_ethereum(){

        //$date = new \DateTime;
        //$yesterday = $date->modify('-1 days')->format('Y-m-d\TH:i:s\Z');

        //$headers = array('Accept' => 'application/json', 'X-CoinAPI-Key' => '044A1C06-AFE6-4EF3-9223-0363770C3E25');
                
        //$responseValYest = Request::get('https://rest.coinapi.io/v1/exchangerate/ETH/EUR?time='.$yesterday,$headers);
        //$responseNow = Request::get('https://rest.coinapi.io/v1/exchangerate/ETH/EUR',$headers);


        //$valLast = round($responseValYest->body->rate, 2);
        //$newVal = round($responseNow->body->rate, 2);
        //$rateChange = (($newVal - $valLast) / $newVal)*100;

        return $this->render('@Front/Default/ethereum.html.twig', ['ETHInfo' => null, 'ETHRate' => null]);
     }

     /**
      * @Route("/blockchain", name="default_blockchain")
      */

      public function show_blockchain(){
      
        return $this->render('@Front/Default/blockchain.html.twig');
      
    }

    /**
     * @Route("/histoire_crypto", name="default_histoire_crypto")
     * 
     */

     public function show_hist_crypto(){
         
        return $this->render('@Front/Default/histoire_crypto.html.twig');
     }

     /**
      * @Route("/crypto_eco", name="default_crypto_eco")
      *
      */

      public function show_crypto_eco(){
          
          return $this->render('@Front/Default/crypto_eco.html.twig');
      }

}
