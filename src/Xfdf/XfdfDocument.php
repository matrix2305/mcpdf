<?php
declare(strict_types=1);
namespace matrix2305\Xfdf;

use DOMDocument;
use DOMElement;

class XfdfDocument
{
    private DOMDocument $xml;
    private DOMElement $fieldsNode;

    /**
     * @throws \DOMException
     */
    public function __construct() {
        $this->xml = new DOMDocument();
        $rootNode = $this->xml->createElement( 'xfdf' );
        $rootNode->setAttribute( 'xmlns', 'http://ns.adobe.com/xfdf/' );
        $rootNode->setAttribute( 'xml:space', 'preserve' );
        $this->xml->appendChild( $rootNode );

        $this->fieldsNode = $this->xml->createElement( 'fields' );
        $rootNode->appendChild( $this->fieldsNode );
    }

    /**
     * @throws \DOMException
     */
    public function addField(string $name, string $value) : void
    {
        $fieldNode = $this->xml->createElement( 'field' );
        $fieldNode->setAttribute( 'name', $name );
        $this->fieldsNode->appendChild( $fieldNode );

        $valueNode = $this->xml->createElement( 'value' );
        $valueNode->appendChild( $this->xml->createTextNode( $value ) );
        $fieldNode->appendChild( $valueNode );
    }

    public function save(string $path) : void
    {
        $this->xml->save($path);
    }
}
