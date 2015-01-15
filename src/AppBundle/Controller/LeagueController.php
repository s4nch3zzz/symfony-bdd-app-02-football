<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\League;
use AppBundle\Form\LeagueType;

/**
 * League controller.
 *
 * @Route("/admin/league")
 */
class LeagueController extends Controller
{

    /**
     * Lists all League entities.
     *
     * @Route("/", name="admin_league")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:League')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new League entity.
     *
     * @Route("/", name="admin_league_create")
     * @Method("POST")
     * @Template("AppBundle:League:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new League();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_league_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a League entity.
     *
     * @param League $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(League $entity)
    {
        $form = $this->createForm(new LeagueType(), $entity, array(
            'action' => $this->generateUrl('admin_league_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new League entity.
     *
     * @Route("/new", name="admin_league_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new League();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a League entity.
     *
     * @Route("/{id}", name="admin_league_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:League')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find League entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing League entity.
     *
     * @Route("/{id}/edit", name="admin_league_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:League')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find League entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a League entity.
    *
    * @param League $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(League $entity)
    {
        $form = $this->createForm(new LeagueType(), $entity, array(
            'action' => $this->generateUrl('admin_league_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing League entity.
     *
     * @Route("/{id}", name="admin_league_update")
     * @Method("PUT")
     * @Template("AppBundle:League:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:League')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find League entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_league_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a League entity.
     *
     * @Route("/{id}", name="admin_league_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:League')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find League entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_league'));
    }

    /**
     * Creates a form to delete a League entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_league_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
