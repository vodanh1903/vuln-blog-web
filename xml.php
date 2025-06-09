<?php

libxml_disable_entity_loader(false);
$xmlfile = file_get_contents('php://input');
$dom = new DOMDocument();
$dom -> loadXML($xmlfile, LIBXML_NOENT | LIBXML_DTDLOAD);
$info = simplexml_import_dom($dom);
$name = $info -> name;

$result = sprintf("<result><msg>Hello %s!</msg></result>", $name);

echo $result;

?>