<?php

declare(strict_types=1);

namespace App\Tests\Controller\Admin;

use App\Entity\Menu;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

final class MenuControllerTest extends WebTestCase
{
    private const SERVER = [
        'PHP_AUTH_USER' => 'admin',
        'PHP_AUTH_PW' => 'admin',
    ];

    private const TITLE = 'Custom Menu Item';
    private const URL = '/?custom-link';
    private const LOCALE = 'en';
    private const EDITED_TITLE = 'Edited';

    /**
     * This test changes the database contents by creating a new Item.
     */
    public function testAdminNewItem(): void
    {
        $client = static::createClient([], self::SERVER);

        $crawler = $client->request('GET', '/en/admin/menu/new');

        $form = $crawler->selectButton('Save changes')->form([
            'menu[title]' => self::TITLE,
            'menu[url]' => self::URL,
            'menu[locale]' => self::LOCALE,
        ]);
        $client->submit($form);

        $this->assertSame(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
        $item = $client->getContainer()->get('doctrine')
            ->getRepository(Menu::class)->findOneBy([
                'url' => self::URL,
                'locale' => self::LOCALE,
            ]);

        $this->assertNotNull($item);
        $this->assertSame(self::TITLE, $item->getTitle());
        $this->assertSame(self::URL, $item->getUrl());
    }

    /**
     * This test changes the database contents by editing a Menu Item.
     */
    public function testAdminEditItem(): void
    {
        $client = static::createClient([], self::SERVER);

        $item = $client->getContainer()->get('doctrine')
            ->getRepository(Menu::class)
            ->findOneBy([
                'url' => self::URL,
                'locale' => self::LOCALE,
            ])->getId();

        $crawler = $client->request('GET', '/en/admin/menu/'.$item.'/edit');

        $form = $crawler->selectButton('Save changes')->form([
            'menu[title]' => self::EDITED_TITLE,
        ]);

        $client->submit($form);
        $this->assertSame(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        $editedItem = $client->getContainer()->get('doctrine')
            ->getRepository(Menu::class)->findOneBy([
                'id' => $item,
            ]);

        $this->assertSame(self::EDITED_TITLE, $editedItem->getTitle());
    }

    /**
     * This test changes the database contents by sorting Menu Items.
     */
    public function testAdminSortItems()
    {
        $client = static::createClient([], self::SERVER);
        $crawler = $client->request('GET', '/en/admin/menu');
        $token = $crawler->filter('#menu')->attr('data-token');
        $items = $client->getContainer()->get('doctrine')
            ->getRepository(Menu::class)
            ->findItems();

        $itemsArray = array_map(function ($item) {
            return $item->getId();
        }, $items);

        $client->request('POST', '/en/admin/menu/sort', [
            'csrf-token' => $token,
            'items' => array_reverse($itemsArray),
        ]);

        $client->request('POST', '/en/admin/menu/sort', [
            'csrf-token' => $token,
            'items' => $itemsArray,
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            ),
            'the "Content-Type" header is "application/json"'
        );
    }

    /**
     * This test changes the database contents by deleting a test Item.
     */
    public function testAdminDeleteItem(): void
    {
        $client = static::createClient([], self::SERVER);

        $item = $client->getContainer()->get('doctrine')
            ->getRepository(Menu::class)->findOneBy([
                'url' => self::URL,
            ])->getId();

        $crawler = $client->request('GET', '/en/admin/menu');
        $client->submit($crawler->filter('#delete-form-'.$item)->form());
        $this->assertSame(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        $this->assertNull($client->getContainer()->get('doctrine')
            ->getRepository(Menu::class)->findOneBy([
                'url' => self::URL,
            ]));
    }
}
