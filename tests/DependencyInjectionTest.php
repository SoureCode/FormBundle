<?php
/*
 * This file is part of the SoureCode package.
 *
 * (c) Jason Schilling <jason@sourecode.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SoureCode\Bundle\Form\Tests;

use SoureCode\Component\Form\Storage\WizardStorageInterface;

/**
 * @author Jason Schilling <jason@sourecode.dev>
 */
class DependencyInjectionTest extends AbstractFormTestCase
{
    public function testServicesRegistered(): void
    {
        // Arrange
        self::bootKernel();
        $container = self::getContainer();

        // Assert
        self::assertTrue($container->has(WizardStorageInterface::class));
    }
}
