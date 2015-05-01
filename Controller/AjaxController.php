<?php

namespace Kamran\CodesnippetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * Codesnippets ajax controller.
 *
 * @Route("/snip_ajax")
 */
class AjaxController extends Controller
{

    /**
     * @Route("/gettechnologytools/{id}", name="snip_ajax_technologytools")
     * @Template()
    */
    public function getTechnologyToolsAction($id){

        $user = array('name'=>'Kamran Shahzad===>'.$id);
        return $this->jsonResponse($user);
    }


    /**
     * @Route("/testing", name="snip_ajax_test")
     * @Method("POST")
     * @Template()
    */
    public function getTestAction($id){

        $user = array('name'=>'Kamran Shahzad===>'.$id);
        return $this->jsonResponse($user);
    }


    /**
     * @Route("/gettagcodes/{tagid}", name="snip_ajax_tagcodes", options={"expose"=true})
     * @Template()
    */
    public function getTagsCodeAction($tagid){

        $em = $this->getDoctrine()->getManager();
        $codeRep  = $em->getRepository('KamranCodesnippetBundle:Code')->findCodeByTags($tagid);
        $data = array();
        foreach($codeRep as $obj){
            $data[] = array('id'=>$obj->getId(),'title'=>$obj->getTitle(),'comment'=>$obj->getComment());
        }
        return $this->jsonResponse($data);
    }








    protected function jsonResponse($object)
    {
        return new JsonResponse($this->getSerializer()->normalize($object, 'json'));
    }
    
    protected function getSerializer()
    {
        return new Serializer(
            array(new GetSetMethodNormalizer()),
            array(new JsonEncoder())
        );
    }

}


