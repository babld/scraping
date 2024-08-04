<?php

use Symfony\Component\Panther\Client;

$url1 = 'https://vladivostok.drom.ru/auto/all/?multiselect[]=9_4_15_all&multiselect[]=9_4_16_all';
$urlTest = 'https://alfacrm.pro';

$client = Client::createFirefoxClient();

$client->request('GET',  $url1); // Yes, this website is 100% written in JavaScript
$client->clickLink('Getting started');

// Wait for an element to be present in the DOM (even if hidden)
//$crawler = $client->waitFor('#installing-the-framework');
// Alternatively, wait for an element to be visible
$crawler = $client->waitForVisibility('#installing-the-framework');

echo $crawler->filter('#installing-the-framework')->text();