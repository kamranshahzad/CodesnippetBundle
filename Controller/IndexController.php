<?php

namespace Kamran\CodesnippetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;

use Kamran\CodesnippetBundle\Entity\Code;
use Kamran\CodesnippetBundle\Form\Type\CodeType;

/**
 * Codesnippets controller.
 *
 * @Route("/snippets")
 */

class IndexController extends Controller
{

    /**
     * @Route("/", name="snippets_index")
     * @Template("KamranCodesnippetBundle:Layout:_index.html.twig")
    */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $codeRep  = $em->getRepository('KamranCodesnippetBundle:Code')->findCodeByTags(2);

        //echo get_class($codeRep);
        
        foreach($codeRep as $obj){
            //echo get_class($obj);
            //echo get_class($obj->getTags());
            //echo $obj->getTitle().'<br/>';
            //echo $obj->getComment().'<br/>';
            /*
            foreach($obj->getTags() as $innerObj){
                //echo get_class($innerObj);
                //echo $innerObj->getName();
            }
            */
        }

        $technologyRep  = $em->getRepository('KamranTechnologyBundle:Technology')->findAll();;
         //$repository->find()
         
        $tagsRep = $em->getRepository('KamranTagsBundle:TechnologyTags')->findBy(array('tool'=>2));
         
        return array(
            'techRep'=>$technologyRep,
            'tagsRep'=>$tagsRep
            );
    }

    /**
     * @Route("/add", name="snippets_add")
     * @Template("KamranCodesnippetBundle:Layout:_index.html.twig")
    */
    public function addAction()
    {
        $entity = new Code();
        $form = $this->createForm(new CodeType(), $entity);
        $request = $this->getRequest();

        if ($request->getMethod() === 'POST'){
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();
                foreach($entity->getSnippets() as $snip) {
                    $snip->setCode($entity);
                    $em->persist($snip);
                }
                $em->flush();
                return $this->redirect($this->generateUrl('snippets_index'));
                //return $this->redirect($this->generateUrl('snippets_edit',array('id'=>$entity->getId())));
            }else{
                foreach ($form->getErrors() as $key => $error) {
                    $errors[] = $error->getMessage();
                }
                echo '<pre>';
                print_r($errors);
                echo '</pre>';
            }
        }

        return array(
            'form' => $form->createView(),
        );
    }




    /**
     * @Route("/edit/{id}", name="snippets_edit")
     * @Template()
     */
    public function editAction($id) {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('KamranCodesnippetBundle:Code')->find($id);

        $form = $this->createForm(new CodeType(), $entity);
        $request = $this->getRequest();

        if ($request->getMethod() === 'POST'){
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->persist($entity);
                //$em->flush();
                foreach($entity->getSnippets() as $snip) {
                    $snip->setCode($entity);
                    $em->persist($snip);
                }
                $em->flush();
            }
        }
        return array(
            'form' => $form->createView(),
            'id' => $id
        );
    }


    /**
     * @Route("/view/{id}", name="snippets_view", options={"expose"=true})
     * @Template()
     */
    public function viewAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('KamranCodesnippetBundle:Code')->find($id);
        $form = $this->createForm(new CodeType(), $entity);
        return array('id'=>$id,'form'=>$form->createView());
    }




}