<?php

namespace Classes;

use Dompdf\Dompdf;

class PDF
{
    public $content;
    public $setPaper;
    public $name;
    public $attachment;

    public function __construct($content, $setPaper, $name, $attachment)
    {
        $this->content = $content;
        $this->setPaper = $setPaper;
        $this->name = $name;
        $this->attachment = $attachment;
    }

    public function render()
    {
        $domPDF = new Dompdf();

        $options = $domPDF->getOptions();
        $options->set(array('isRemoteEnabled' => true));
        $domPDF->setOptions($options);

        $domPDF->loadHtml($this->content);
        $domPDF->setPaper('A4');

        $domPDF->render();
        $domPDF->stream($this->name, array("Attachment" => $this->attachment));
    }
}
