<?php
/*
 * This file is part of the SoureCode package.
 *
 * (c) Jason Schilling <jason@sourecode.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use SoureCode\Component\Form\Storage\SessionWizardStorage;
use SoureCode\Component\Form\Storage\WizardStorageInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $container) {
    $services = $container->services();

    $services->set('soure_code.form.wizard.storage', SessionWizardStorage::class)
        ->args(
            [
                service('request_stack'),
                service('serializer'),
            ]
        );

    $services
        ->alias(WizardStorageInterface::class, 'soure_code.form.wizard.storage')
        ->public();
};
