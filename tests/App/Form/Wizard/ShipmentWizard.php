<?php
/*
 * This file is part of the SoureCode package.
 *
 * (c) Jason Schilling <jason@sourecode.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SoureCode\Bundle\Form\Tests\App\Form\Wizard;

use SoureCode\Component\Form\Tests\Mock\Form\AddressType;
use SoureCode\Component\Form\Tests\Mock\Form\PersonType;
use SoureCode\Component\Form\Tests\Mock\Model\Address;
use SoureCode\Component\Form\Tests\Mock\Model\Person;
use SoureCode\Component\Form\Wizard;

/**
 * @author Jason Schilling <jason@sourecode.dev>
 */
class ShipmentWizard extends Wizard
{
    protected function configureSteps(): void
    {
        $this->addStep('address', AddressType::class, [])->setData(new Address());
        $this->addStep('person', PersonType::class, [])->setData(new Person());
    }
}
