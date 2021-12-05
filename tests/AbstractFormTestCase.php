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

use Nyholm\BundleTest\TestKernel;
use SoureCode\Bundle\Form\SoureCodeFormBundle;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * @author Jason Schilling <jason@sourecode.dev>
 */
abstract class AbstractFormTestCase extends WebTestCase
{
    protected static function createKernel(array $options = []): KernelInterface
    {
        /**
         * @var TestKernel $kernel
         */
        $kernel = parent::createKernel($options);
        $kernel->addTestBundle(SoureCodeFormBundle::class);
        $kernel->addTestBundle(TwigBundle::class);
        $kernel->addTestConfig(__DIR__.'/config.yaml');
        $kernel->setTestProjectDir(__DIR__.'/App');
        $kernel->addTestRoutingFile(__DIR__.'/routing.yaml');
        $kernel->handleOptions($options);

        return $kernel;
    }

    protected static function getKernelClass(): string
    {
        return TestKernel::class;
    }
}
