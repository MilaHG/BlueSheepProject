<?php

namespace AppBundle\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PreferenceController extends Controller
{
    /**
     * @Route("preference/list")
     */
    public function listAction()
    {
        return $this->render('AppBundle:Preference:list.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("preference/edit")
     */
    public function editAction()
    {
        return $this->render('AppBundle:Preference:edit.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("preference/add")
     */
    public function addAction()
    {
        return $this->render('AppBundle:Preference:add.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("preference/delete")
     */
    public function deleteAction()
    {
        return $this->render('AppBundle:Preference:delete.html.twig', array(
            // ...
        ));
    }

}
