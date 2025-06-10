<?php
$postId = '';
try {
    libxml_disable_entity_loader(false);
    $xmlfile = file_get_contents('php://input');
    if (!empty($xmlfile)){
        $dom = new DOMDocument();
        $dom -> loadXML($xmlfile, LIBXML_NOENT | LIBXML_DTDLOAD);
        $info = simplexml_import_dom($dom);
        $postId = $info -> postId;
        if ($postId == 1) {
            $postId = 42;
        }
    }
}
catch(Exception $e){}

$result = sprintf($postId);

echo $result;

?>
