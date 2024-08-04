<?php

use Symfony\Component\DomCrawler\Crawler;

$html = <<<'HTML'
<!DOCTYPE html>
<html>
    <body>
        <p class="message">Hello World!</p>
        <p>Hello Crawler!</p>
        <p>Hello Crawler!</p>
        <p>Hello Crawler!</p>
        <p>Hello Crawler!</p>
        <p>Hello Crawler!</p>
    </body>
</html>
HTML;

$crawler = new Crawler($html);

$elements = $crawler->filter('body > p')->siblings();
var_dump($elements);exit;

var_dump($crawler->filter('body > p')->eq(0)->text());
echo "<br/>";

foreach ($elements as $domElement) {
    var_dump($domElement->textContent);
    echo "<br/>";
}