<?php
require('../fpdf/fpdf.php');
$pdf=new FPDF();
$pdf->AddPage();
require('header_pdf.php');

$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',11);
$pdf->Text(14,62,"Ouverture d'un Dispositif Pr�visionnel de Secours de Moyenne Envergure (DPS-ME)");


// D�but des cadres
// Position du cadre COA : X = 168 --- Y = 41
$pdf->SetFillColor(237,242,247);
$pdf->SetDrawColor(237,242,247);
$pdf->SetFont('Arial','B',11); 
$pdf->SetXY(173,62);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(255,0,0);
$pdf->Cell(32,5.3,"92-15-COU-080",1,1,"C");
$pdf->SetFont('Arial','',7); 
$pdf->SetTextColor(0,0,0);
$pdf->Text(173, 61, "Certificat Original d'Affiliation");

$pdf->SetLineWidth(0.3) ;
$pdf->SetFont('Arial','B',9);
$pdf->SetTextColor(13,53,148);
$pdf->SetXY(14,65);
$pdf->Cell(50,5,"Organisateur",1,0,"","true");
$pdf->Rect(14, 70, 191, 28) ;

$pdf->SetXY(14,100);
$pdf->Cell(50,5,"Nature de la manifestation",1,0,"","true");
$pdf->Rect(14, 105, 191, 16) ;

$pdf->SetXY(14,123);
$pdf->Cell(50,5,"Grille d'�valuation des risques",1,0,"","true");
$pdf->Rect(14, 128, 191, 30) ;

$pdf->SetXY(14,160);
$pdf->Cell(50,5,"Configuration du DPS",1,0,"","true");
$pdf->Rect(14, 165, 191, 52) ;

$pdf->SetXY(14,219);
$pdf->Cell(50,5,"Justification du DPS",1,0,"","true");
$pdf->Rect(14, 224, 191, 10) ;

$pdf->SetXY(14,236);
$pdf->Cell(50,5,"Cadre r�serv� � l'administration",1,0,"","true");
$pdf->Rect(14, 241, 191, 11) ;
//fin des cadres

//Organisateur
$pdf->SetFont('Arial','B',8);
$pdf->SetTextColor(0,0,0);
$pdf->Text(15, 73, "Nom :");
$pdf->Text(15, 77, "Repr�sent�(e) par :");  
$pdf->Text(15, 81, "Qualit� de :"); 
$pdf->Text(15, 85, "Adresse :"); 
$pdf->Text(15, 89, "T�l�phone :"); 
$pdf->Text(75, 89, "Fax :"); 
$pdf->Text(15, 93, "E-mail :");
$pdf->SetFont('Arial','',8);
$pdf->Text(45, 73, "Association Pass� Pr�sent (A.P.P.)");
$pdf->Text(45, 77, "Mich�le TELLIER");  
$pdf->Text(45, 81, "Organisatrice de la R�volution Fran�aise"); 
$pdf->Text(45, 85, "13 Avenue du Chat blanc sur la grande branche en ch�ne clair - 92345 Cormeilles En Parisis Sur Marne de la Seine"); 
$pdf->Text(45, 89, "+1 783-780-1345"); 
$pdf->Text(85, 89, "01 02 03 04 05"); 
$pdf->Text(45, 93, "directeur-adj-informatique@protectioncivile92.org");
$pdf->Text(15, 97, "Aucun dossier n'a �t� d�pos� en pr�fecture.");

//Nature manifestation
$pdf->SetFont('Arial','B',8); 
$pdf->Text(15, 108, "Nom / nature :");
$pdf->Text(15, 112, "Activit� / descriptif :");
$pdf->Text(15, 116, "Lieux pr�cis :");
$pdf->SetFont('Arial','',8);
$pdf->Text(44, 108, "Combats Kata et karat� : championnats d�partementaux 2015");
$pdf->Text(44, 112, "Sport / Karat�");  
$pdf->Text(44, 116, "13 Avenue du Chat blanc sur la grande branche en ch�ne clair - 92345 Cormeilles En Parisis Sur Marne de la Seine"); 
$pdf->Text(15, 120, "La manifestation se d�roule le 04-10-2015 de 08H00 à 19H00"); 

//RIS
$pdf->SetFont('Arial','B',8); 
$pdf->Text(15, 131, "Acteurs :");
$pdf->Text(74, 131, "Spectateurs :"); 
$pdf->Text(184, 131, "P1 :"); 
$pdf->Text(15, 135, "Activit� du rassemblement :"); 
$pdf->Text(15, 139, "Accessibilit� et environnement :"); 
$pdf->Text(15, 147, "D�lai d'intervention des secours publics :"); 
$pdf->Text(184, 135, "P2 :");
$pdf->Text(184, 139, "E1 :");
$pdf->Text(184, 147, "E2 :");
$pdf->Text(15, 153, "Indice total de risque :");
$pdf->Text(74, 153, "Effectif pond�r� du public :");
$pdf->Text(15, 157, "Type de poste :");
$pdf->Text(184, 153, "RIS :"); 
$pdf->SetFont('Arial','',8); 
$pdf->Text(49, 131, "250000");
$pdf->Text(94, 131, "250000"); 
$pdf->Text(191, 131, "500000");
$pdf->Text(191, 135, "0,40");
$pdf->Text(191, 139, "0,40");
$pdf->Text(191, 147, "0,40");
$pdf->Text(49, 153, "0,80");
$pdf->Text(114, 153, "500000"); 
$pdf->Text(191, 153, "124");
$pdf->Text(49, 157, "Point d'Alerte et de Premiers secours (PAPS)");
$pdf->SetFont('Arial','',7); 
$pdf->Text(74, 135, "Public debout (spectacle avec public dynamique, danse f�ria, spectacle de rue, etc.)"); 
$pdf->Text(74, 139, "Espace naturels : surfaces Sup�rieur ou �gal � 5 ha.");
$pdf->Text(74, 143, "Progression des secours rendue difficile par la pr�sence du public"); 
$pdf->Text(74, 147, "Entre 20 minutes et 30 minutes"); 

//Configuration du DPS
$pdf->SetFont('Arial','',8);
$pdf->Text(15, 168, "Le Dispositif Pr�visionnel de Secours sera activ� du 04-10-2015 � 07H30 au 05-10-2015 � 18H00.");
$pdf->Text(15, 172, "La dur�e du Dispositif Pr�vionnel de Secours est de 34H30.");
$pdf->SetFont('Arial','B',8);
$pdf->Text(15, 176, "Nombre de secouristes :");
$pdf->Text(74, 176, "PSC1 :");
$pdf->Text(124, 176, "PSE1 :");
$pdf->Text(74, 180, "PSE2 :");
$pdf->Text(124, 180, "Chef D'�quipe :");
$pdf->Text(15, 184, "Nombre de VPSP :");
$pdf->Text(74, 184, "Transport :");
$pdf->Text(124, 184, "Poste de soins :");
$pdf->Text(15, 188, "Autre :");
$pdf->Text(74, 188, "V�hicule L�ger :");
$pdf->Text(124, 188, "Tente :");
$pdf->Text(184, 188, "Tente :");
$pdf->Text(15, 192, "Moyens humains / logistiques suppl�mentaires :");
$pdf->Text(15, 200, "Moyens m�dicaux / structures :");
$pdf->Text(15, 204, "M�decins :");
$pdf->Text(54, 204, "Associatifs :");
$pdf->Text(94, 204, "Autre :");
$pdf->Text(124, 204, "Appartenance :");
$pdf->Text(15, 208, "Infirmiers :");
$pdf->Text(54, 208, "Associatifs :");
$pdf->Text(94, 208, "Autre :");
$pdf->Text(124, 208, "Appartenance :");
$pdf->Text(15, 212, "Autres structures sur place :");
$pdf->SetFont('Arial','',8);
$pdf->Text(104, 176, "12");
$pdf->Text(154, 176, "124");
$pdf->Text(104, 180, "784");
$pdf->Text(154, 180, "207");
$pdf->Text(104, 184, "12");
$pdf->Text(154, 184, "124");
$pdf->Text(104, 188, "784");
$pdf->Text(154, 188, "207");
$pdf->Text(194, 188, "Non");
$pdf->Text(15, 196, "Lorem ipsum dolor sit amet...");
$pdf->Text(31, 204, "3");
$pdf->Text(72, 204, "3");
$pdf->Text(104, 204, "3");
$pdf->Text(146, 204, "M�decins Sans Fronti�res");
$pdf->Text(31, 208, "3");
$pdf->Text(72, 208, "3");
$pdf->Text(104, 208, "3");
$pdf->Text(146, 208, "M�decins Sans Fronti�res");
$pdf->Text(55, 212, "Le SAMU est inform� et non-pr�sent sur le poste de secours.");
$pdf->Text(55, 216, "La BSPP n'est ni inform� ni pr�sente sur le poste de secours.");

$pdf->SetFont('Arial','',8);
$pdf->Text(14, 256, "Le Directeur Local des Op�rations");
$pdf->Text(14, 260, "Antenne de Courbevoie, Neuilly, La garenne colombes");
$pdf->Text(14, 264, "Nicolas Lethellier");
$pdf->Text(14, 268, "Le 13-10-2015");


$pdf->Text(120, 256, "Le Directeur D�partemental des Op�rations");
$pdf->Text(120, 260, "Protection Civile des Hauts-de-Seine");
$pdf->Text(120, 264, "Par int�rim : Pascal Mallet");
$pdf->Text(120, 268, "Le 18-10-2015");
$pdf->Image("../img/rod92.png",170,266,30,15);
$pdf->Image("../img/tampon.png",110,268,50,15);

$pdf->Output();
?>