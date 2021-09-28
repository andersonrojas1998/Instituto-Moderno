
   <script type="text/php">
    if (isset($pdf)) {
        $rector="Representante de la Familia";
        $rep="Representante de la Institución";
        $st="Estudiante";
        
        $line="_______________________";
        $line2="__________________________";
        $line3="________________________";

        $text ="Cra. 25 No. 122-18 Tel: 3798003 Cali. - inmode12@yahoo.es";
        $text1 ="pagina {PAGE_NUM} / {PAGE_COUNT}";        
        $size = 9;
        $font = $fontMetrics->getFont("Verdana");
        $font1 = $fontMetrics->getFont("Century Gothic");
        $width = $fontMetrics->get_text_width($text, $font, $size) / 2;        
       $x1 = ($pdf->get_width() - $width)/2;
        $y2 = $pdf->get_height() - 25 ;
        $pdf->page_text(165, 770, $text, $font1, $size);
        $pdf->page_text(500, 770, $text1, $font, $size);                         

        $pdf->page_text(35, 715, $line, $font1, $size);
        $pdf->page_text(35, 727, $rector, $font, $size);
                
        $pdf->page_text(220, 715, $line2, $font1, $size);
        $pdf->page_text(220, 727, $rep, $font1, $size);

        $pdf->page_text(420, 715, $line3, $font1, $size);
        $pdf->page_text(420, 727, $st, $font1, $size);
    }
</script>