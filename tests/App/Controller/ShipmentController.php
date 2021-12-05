<?php
/*
 * This file is part of the SoureCode package.
 *
 * (c) Jason Schilling <jason@sourecode.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SoureCode\Bundle\Form\Tests\App\Controller;

use SoureCode\Bundle\Form\Tests\App\Form\Wizard\ShipmentWizard;
use SoureCode\Component\Form\Tests\Mock\Model\Address;
use SoureCode\Component\Form\Tests\Mock\Model\Person;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Jason Schilling <jason@sourecode.dev>
 */
class ShipmentController extends AbstractController
{
    #[Route('/shipment/new', name: 'app_shipment')]
    public function shipment(Request $request, ShipmentWizard $wizard): Response
    {
        $wizard->init();

        $wizard->loadStepData('address', $address = new Address());
        $wizard->loadStepData('person', $person = new Person());

        $form = $wizard->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                if ($wizard->nextStep()) {
                    $form = $wizard->createForm();
                } else {
                    $wizard->clear();

                    return $this->json([
                        'success' => true,
                        'data' => [
                            'address' => $address,
                            'person' => $person,
                        ],
                    ]);
                }
            }
        }

        return $this->render('shipment/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
