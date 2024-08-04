<?php

use Symfony\Component\Panther\Client;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Remote\RemoteWebElement;

use Symfony\Component\DomCrawler\Crawler;

$url = 'https://vladivostok.drom.ru/auto/all/?multiselect[]=9_4_15_all&multiselect[]=9_4_16_all&pts=2&damaged=2&whereabouts[]=0';

$client = Client::createFirefoxClient();

$client->request('GET',  $url); // Yes, this website is 100% written in JavaScript

//do {
//
//} while($nextPageLink->count());

$crawler = $client->waitForVisibility('body');

$blocks = $crawler->filter('.css-1nvf6xk.ejck0o60 > div > div');
$nextPageLink = $crawler->filter('a[data-ftid=component_pagination-item-next]');


//var_dump($nextPageLink->count());exit;

$i = 0;
$resultLinks = [];

getLink($blocks->eq(0)->findElements(WebDriverBy::cssSelector('div > a')), $resultLinks);

foreach ($blocks->siblings() as $block) {
    /** @var $block RemoteWebElement */
    getLink($block->findElements(WebDriverBy::cssSelector('div > a')), $resultLinks);
}

$client->request('GET', $nextPageLink->attr('href'));
$crawler = $client->waitForVisibility('body');
$blocks = $crawler->filter('.css-1nvf6xk.ejck0o60 > div > div');
getLink($blocks->eq(0)->findElements(WebDriverBy::cssSelector('div > a')), $resultLinks);

foreach ($blocks->siblings() as $block) {
    /** @var $block RemoteWebElement */
    getLink($block->findElements(WebDriverBy::cssSelector('div > a')), $resultLinks);
}

foreach ($resultLinks as $link) {
    echo ++$i . ' ' . $link . '<br/>';
}

function getLink($data, &$resultLinks) {
    foreach ($data as $link) {
        /** @var $link RemoteWebElement */
        $link = $link->getAttribute('href');
        $resultLinks[] = $link;
        break;
    }
}