<?php

	require("fpdf/fpdf.php");

	$fpdf = new FPDF("p",'mm','A4');
	$fpdf->addPage();

	$fpdf->Cell(189,40,'',0,1);
	// Set font to Arial bold
	$fpdf->SetFont('Arial','B',14);

	//Cell width , height,border.text
	$fpdf->Cell(130,5,'Customer Information',0,0);
	$fpdf->Cell(50,5,'Invoice Details',0,1);
	$fpdf->SetFont('Arial','',12 );


	$fpdf->Cell(130,5,'Customer Name : Ahmed & Son"s',0,0);
	$fpdf->Cell(50,5,'Invoice # : 0000220120',0,1);

	$fpdf->Cell(130,5,'Address : Lyari',0,0);
	$fpdf->Cell(50,5,'Input By : Huzaifa',0,1);

	$fpdf->Cell(130,5,'Remarks : Testing Purpose',0,0);
	$fpdf->Cell(50,5,'Date : 22/08/2019',0,1);

	$fpdf->Cell(130,5,'Total Items : 10',0,0);
	$fpdf->Cell(50,5,'No of pcs : 10',0,1);


	$fpdf->Cell(130,5,'Rupees : Five Thousand',0,0);
	$fpdf->Cell(50,5,'Net Amount : 5000',0,1);


	$fpdf->Cell(189,10,'',0,1);
	// Invoice content

	$fpdf->SetFont('Arial','B',12 );
	$fpdf->Cell(150,10,'Description Of Goods',1,0,'C');
	$fpdf->Cell(30,10,'Quantity',1,1,'C');

	$fpdf->SetFont('Arial','',12 );

	
	// Centered text in a framed 20*10 mm cell and line break
	$fpdf->Cell(150,8,'Edge 1 Prime Series',1,0,'L');
	 $fpdf->Cell(30,8,'2',1,1,'C');

	 $fpdf->Cell(150,8,'Edge 2 Prime Series',1,0,'L');
	 $fpdf->Cell(30,8,'2',1,1,'C');

	$fpdf->Cell(150,8,'Edge 3 Prime Series',1,0,'L');
	$fpdf->Cell(30,8,'2',1,1,'C');

	$fpdf->Cell(150,8,'Edge 4 Prime Series',1,0,'L');
	$fpdf->Cell(30,8,'2',1,1,'C');

	//spacing of bottom 
	$fpdf->Cell(189,10,'',0,1);

	$fpdf->SetFont('Arial','B',12);

	//Cell width , height,border.text // Total Items
	$fpdf->Cell(40,10,'TOTAL # OF ITEMS:',0,0);
	$fpdf->Cell(10);
	$fpdf->Cell(10,10,'5',1,0,'C');

	// Quantity Total
	$fpdf->Cell(90);
	$fpdf->Cell(30,10,'20',1,1,'C');

	//spacing of bottom 
	$fpdf->Cell(189,5,'',0,1);

	$fpdf->Cell(50, 10, ' ', 'B', 0, 'L');
	$fpdf->Cell(20);
	$fpdf->Cell(50, 10, ' ', 'B', 0, 'L');
	$fpdf->Cell(20);
	$fpdf->Cell(50, 10, ' ', 'B', 1, 'L');

	$fpdf->SetFont('Arial','B',10);
	$fpdf->Cell(50,10,'Delivered By',0,0,'C');
	 $fpdf->Cell(20);

	 $fpdf->Cell(50,10,'Godown Check',0,0,'C');
	 $fpdf->Cell(20);

	 $fpdf->Cell(50,10,'Received By',0,1,'C');

	$fpdf->output();


?>