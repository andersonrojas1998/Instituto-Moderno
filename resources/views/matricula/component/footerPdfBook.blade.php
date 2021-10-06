
   <script type="text/php">
    if (isset($pdf)) {

        $rector1="LILIANA VALERA MUÑOZ";
        $cargo1="RECTORA";
        $rector="FREINNER RAMIREZ MORENO";
        $cargo="COORDINADOR GENERAL";
        $line="__________________________";

        $text ="Cra. 25 No. 122-18 Tel: 3798003 Cali. - inmode12@yahoo.es";
        $text1 ="pagina {PAGE_NUM} / {PAGE_COUNT}";        
        $size = 8;
        $font = $fontMetrics->getFont("Verdana");
        $font1 = $fontMetrics->getFont("Century Gothic");
        $width = $fontMetrics->get_text_width($text, $font, $size) / 2;        
       $x1 = ($pdf->get_width() - $width)/2;
        $y2 = $pdf->get_height() - 25 ;
        $pdf->page_text(165, 770, $text, $font1, $size);
        $pdf->page_text(500, 770, $text1, $font, $size);                         
        $pdf->page_text(105, 715, $line, $font1, $size);
        $pdf->page_text(105, 727, $rector1, $font1, $size);
        $pdf->page_text(105, 735, $cargo1, $font1, 6);



        $pdf->page_text(305, 715, $line, $font1, $size);
        $pdf->page_text(305, 727, $rector, $font1, $size);
        $pdf->page_text(305, 735, $cargo, $font1, 6);


        
    }
</script>