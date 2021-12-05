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

class IntegrationTest extends AbstractFormTestCase
{
    public function testCreateShipment(): void
    {
        $client = static::createClient();
        $client->followRedirects();
        $client->disableReboot();

        $crawler = $client->request('GET', '/shipment/new');

        self::assertResponseIsSuccessful();
        self::assertSelectorExists('form[name="address"]');

        $form = $crawler->selectButton('Submit')->form();

        $form['address[zip]']->setValue('12345');
        $form['address[city]']->setValue('Berlin');
        $form['address[street]']->setValue('Foo');
        $form['address[number]']->setValue('1');

        $crawler = $client->submit($form);

        self::assertResponseIsSuccessful();

        self::assertSelectorExists('form[name="person"]');

        $form = $crawler->selectButton('Submit')->form();

        $form['person[firstname]']->setValue('Foo');
        $form['person[lastname]']->setValue('Bar');

        $client->submit($form);

        self::assertResponseIsSuccessful();
        self::assertResponseFormatSame('json');
        self::assertSame('{"success":true,"data":{"address":{"city":"Berlin","number":"1","street":"Foo","zip":"12345"},"person":{"firstname":"Foo","lastname":"Bar"}}}', $client->getResponse()->getContent());
    }
}
