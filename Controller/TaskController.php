<?php

namespace Kamran\CodesnippetBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;



/**
 * Codesnippets controller.
 *
 * @Route("/tasks")
 */
class TaskController extends Controller {

    /**
     * @Route("/create", name="task_create")
     * @Template()
     */
    public function createAction() {
        $em = $this->getDoctrine()->getManager();
        
        $task = new \Kamran\CodesnippetBundle\Entity\Task();
        
        $form = $this->createForm(new \Kamran\CodesnippetBundle\Form\TaskType(), $task);
        $request = $this->getRequest();
        if($this->getRequest()->getMethod()=='POST') {
            $form->handleRequest($request);
            echo('<pre>');
            var_dump($form->getData());
            echo('</pre>');
            //if($form->isValid()) {
                $em->persist($task);
                foreach($task->getTags() as $tag) {
                    $em->persist($tag);
                }

                $em->flush();
            //} else {
               // var_dump($form->getErrors());
            //}
        }
        
        return array('form' => $form->createView());
    }
    
    /**
     * @Route("/edit/{id}", name="task_edit")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();
        $task = $em->getRepository('KamranCodesnippetBundle:Task')->find($id);
        
        $form = $this->createForm(new \Kamran\CodesnippetBundle\Form\TaskType(), $task);
        $request = $this->getRequest();

        if($this->getRequest()->getMethod()=='POST') {

            var_dump(count($task->getTags()));
            $form->handleRequest($request);
            var_dump(count($task->getTags()));
            if($form->isValid()) {
                $task->setTags($task->getTags());
                $em->persist($task);
                foreach($task->getTags() as $tag) {
                    $em->persist($tag);
                }
                
                $em->flush();
                
//                return $this->redirect($this->generateUrl('task_create'));
            } else {
                var_dump($form->getErrors());
            }
        }
        
        return array('form' => $form->createView(), 'id' => $id);
    }
}
