<?php declare(strict_types=1);

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use AppBundle\Form\ContactType;
use eZ\Publish\Core\MVC\Symfony\View\ContentView;
use eZ\Bundle\EzPublishCoreBundle\Controller;

/**
 * Class ContactController.
 */
class ContactController extends Controller
{
    public function fullViewAction(ContentView $view)
    {
//die;
//        $contact = new Contact();
//        $form = $this->createForm(ContactType::class, $contact, array(
//            "action" => $this->generateUrl("create_contact"),
//            "csrf_protection" => false
//        ));

        $view->addParameters([
           // 'form' => $form->createView(),
        ]);
        return $view;
    }
}