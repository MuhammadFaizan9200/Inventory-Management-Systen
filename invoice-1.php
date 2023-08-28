<?php

	require("fpdf/fpdf.php");

	$fpdf = new FPDF("p",'mm','A4');
	$fpdf->addPage();

	$fpdf->Cell(189,40,'',0,1);
	// Set font to Arial bold
	$fpdf->SetFont('Arial','B',14);

	//Cell width , height,border.text
	$fpdf->Cell(130,5,'Customer Information',0,0);
	$fpdf->Cell(50,5,'Invoice No',0,1);
	$fpdf->SetFont('Arial','',12 );


	$fpdf->Cell(130,5,'Customer Name : Ahmed & Son"s',0,0);
	$fpdf->Cell(50,5,'Inputed By: 0000220120',0,1);

	$fpdf->Cell(130,5,'Address : Lyari',0,0);
	$fpdf->Cell(50,5,'Input By : Huzaifa',0,1);

	$fpdf->Cell(130,5,'Remarks : Testing Purpose',0,0);
	$fpdf->Cell(50,5,'Date : 22/08/2019',0,1);

	$fpdf->Cell(189,10,'',0,1);
	// Invoice content

	$fpdf->SetFont('Arial','B',12 );
	$fpdf->Cell(60,10,'Description Of Goods',1,0,'C');
	$fpdf->Cell(30,10,'Quantity',1,0,'C');
	$fpdf->Cell(30,10,'List Price',1,0,'C');
	$fpdf->Cell(20,10,'Disc %',1,0,'C');
	$fpdf->Cell(20,10,'Rate',1,0,'C');
	$fpdf->Cell(30,10,'Amount',1,1,'C');


	$fpdf->SetFont('Arial','',12 );

	
	// Centered text in a framed 20*10 mm cell and line break
	$fpdf->Cell(60,8,'Edge 1 Prime Series',1,0,'L');
	$fpdf->Cell(30,8,'2',1,0,'C');
	$fpdf->Cell(30,8,'2',1,0,'C');
	$fpdf->Cell(20,8,'2',1,0,'C');
 	$fpdf->Cell(20,8,'2',1,0,'C');
  	$fpdf->Cell(30,8,'2',1,1,'C');

  	$fpdf->Cell(60,8,'Edge 1 Prime Series',1,0,'L');
	$fpdf->Cell(30,8,'2',1,0,'C');
	$fpdf->Cell(30,8,'2',1,0,'C');
	$fpdf->Cell(20,8,'2',1,0,'C');
 	$fpdf->Cell(20,8,'2',1,0,'C');
  	$fpdf->Cell(30,8,'2',1,1,'C');

  	$fpdf->Cell(60,8,'Edge 1 Prime Series',1,0,'L');
	$fpdf->Cell(30,8,'2',1,0,'C');
	$fpdf->Cell(30,8,'2',1,0,'C');
	$fpdf->Cell(20,8,'2',1,0,'C');
 	$fpdf->Cell(20,8,'2',1,0,'C');
  	$fpdf->Cell(30,8,'2',1,1,'C');

  	$fpdf->Cell(60,8,'Edge 1 Prime Series',1,0,'L');
	$fpdf->Cell(30,8,'2',1,0,'C');
	$fpdf->Cell(30,8,'2',1,0,'C');
	$fpdf->Cell(20,8,'2',1,0,'C');
 	$fpdf->Cell(20,8,'2',1,0,'C');
  	$fpdf->Cell(30,8,'2',1,0,'C');



	
	  	
	//spacing of bottom 
	$fpdf->Cell(189,15,'',0,1);

	$fpdf->SetFont('Arial','B',11);

	//Cell width , height,border.text // Total Items
	$fpdf->Cell(35,10,'TOTAL # OF ITEMS:',0,0);
	$fpdf->Cell(5);
	$fpdf->Cell(20,10,'5',1,0,'C');

	// Quantity Total
	$fpdf->Cell(30);
	$fpdf->Cell(30,10,'20',1,0,'C');


	$fpdf->Cell(10);
	$fpdf->Cell(35,10,'Gross Amount:',0,0);
	$fpdf->Cell(-5);
	$fpdf->Cell(30,10,'5',1,0,'C');




	//spacing of bottom 
	$fpdf->Cell(189,15,'',0,1);
		// $fpdf->Cell(20);

	// $fpdf->Cell(50, 10, ' ', 'B', 0, 'L');
	// $fpdf->Cell(20);
	// $fpdf->Cell(50, 10, ' ', 'B', 0, 'L');
	// $fpdf->Cell(20);
	// $fpdf->Cell(50, 10, ' ', 'B', 1, 'L');

	$fpdf->SetFont('Arial','B',10);
	$fpdf->Cell(25,10,'Delivered By: ',0,0,'L');
	$fpdf->Cell(30, 10, ' ', 'B', 0, 'L');
	 $fpdf->Cell(5);


	 $fpdf->Cell(30,10,'Previous Balance: ',0,0,'C');
	 $fpdf->Cell(5);
	 $fpdf->Cell(25,10,'5',1,0,'C');
	 $fpdf->Cell(10);

	 $fpdf->Cell(30,10,'Discount Amount: ',0,0,'C');
	 $fpdf->Cell(5);
	 $fpdf->Cell(25,10,'5',1,1,'C');


	 //spacing of bottom 
	$fpdf->Cell(189,2,'',0,1);


	$fpdf->Cell(25,10,'Check By: ',0,0,'L');
	$fpdf->Cell(30, 10, ' ', 'B', 0, 'L');
	 $fpdf->Cell(5); 

	 $fpdf->Cell(30,10,'Total Receivable: ',0,0,'C');
	 $fpdf->Cell(5);
	 $fpdf->Cell(25,10,'5',1,0,'C');
	 $fpdf->Cell(10);

	 $fpdf->Cell(30,10,'Net Amount: ',0,0,'C');
	 $fpdf->Cell(5);
	 $fpdf->Cell(25,10,'5',1,1,'C');



	 // $fpdf->Cell(50,10,'Received By',0,1,'C');

	$fpdf->output();


?>