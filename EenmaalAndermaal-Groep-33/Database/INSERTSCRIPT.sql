USE EenmaalAndermaal


DELETE FROM tbl_Bestand
DELETE FROM tbl_Bod
DELETE FROM tbl_Voorwerp_in_rubriek
DELETE FROM tbl_Rubriek
DELETE FROM tbl_Feedback
DELETE FROM tbl_Gebruikerstelefoon
DELETE FROM tbl_Voorwerp
DELETE FROM tbl_Verkoper
DELETE FROM tbl_Gebruiker
DELETE FROM tbl_Vraag

go


DBCC CHECKIDENT(tbl_Vraag, RESEED, 0)

INSERT INTO tbl_Vraag VALUES (  'Wat is de naam van je eerste huisdier?')
INSERT INTO tbl_Vraag VALUES ( 'In welk dorp/stad was je eerste baantje?')
INSERT INTO tbl_Vraag VALUES (  'Wat is je favoriete film van het laatste decennium?')
INSERT INTO tbl_Vraag VALUES (  'Wat is de naam van je basisschool?')
INSERT INTO tbl_Vraag VALUES (  'Wat is je lievelingsgerecht?')
go


INSERT INTO tbl_Gebruiker VALUES 
( 'Mohammad', 'Mohammad', 'Yasin', 'Hogeweg', null,'533', 'Venlo', 'NL', getDate(), 'mo@han.nl', 'moWachtwoord', 1, 'ik heb geen huisdier', 1),

('Obe', 'Obe', 'Wullems', 'Nijmegen', null,'533', 'Nijmegen', 'NL', getDate(), 'obe@han.nl', 'obeWachtwoord', 3, 'Django Unchained', 1),

( 'Boris', 'Boris', 'Otte', 'Nijmegen', null,'8776', 'Nijmegen', 'NL', getDate(), 
   'boris@han.nl', 'borisWachtwoord', 2, 'nijmegen', 0),

( 'Aron', 'Aron', 'Maijen', 'Nijmegen', null,'32323', 'Nijmegen', 'NL', getDate(), 
   'Aron@han.nl', 'AronWachtwoord', 4, 'de kleurencirkel', 0),

( 'Stan', 'Stan', 'Van Gaal', 'Venray', null,'3432', 'Venlo', 'NL', getDate(), 
   'Stan@han.nl', 'StanWachtwoord', 5, 'spaghetti', 1)

go




insert into tbl_Gebruikerstelefoon values ( 'Mohammad', 0684723231),
										  ( 'Stan', 0621900621),
										  ( 'Aron', 0672829473),
										  ( 'Obe', 0629892429)

INSERT INTO tbl_Verkoper VALUES ('Stan','AbnAmro','937273282','Post', NULL),
                                ('Mohammad','ING','087734743734','Post', NULL),
								('Obe', 'ING', NULL, 'Creditcard','123442')
				
go


DBCC CHECKIDENT(tbl_Voorwerp, RESEED, 0)
SET IDENTITY_INSERT tbl_Voorwerp ON;



INSERT INTO tbl_Voorwerp VALUES (/* titel*/'Kasper 1 - Kasper wordt een kip',
                                /* beschrijving */'Kasper wordt een kip is deel 1 in de hilarische serie voor jongens én meisjes. Piekeraar Kasper is de nieuwe favoriete antiheld waarmee iedere lezer vriendschap sluit.',
								/* startprijs*/2,
								/* betalingswijze*/'IDEAL',
								/* betalingsinstructie*/NULL,
								/* plaatsnaam*/'Nijmegen',
								/* land*/'Nederland',
								/* looptijd*/ 7,
								/* looptijdBeginDag*/getDate(),
								/* looptijdBeginTijdstip*/CONVERT(TIME(0),GETDATE()), 
								/* verzendkosten*/NULL,
								/* verzendinstructie*/NULL,
								/* verkoper*/'Stan', 
								/* koper*/'Mohammad',
								/* looptijdeindDag*/getDate() + 7,
								/* looptijdeindTijdstip*/CONVERT(TIME(0),GETDATE() + 7),
								/*veiling gesloten*/0,
								/*verkoopprijs */1.5)
							


INSERT INTO tbl_Voorwerp VALUES (/* titel*/ 'De Zeven Zussen 1 - De zeven zussen',
                                /* beschrijving */'Na de plotselinge dood van hun vader komen Maia en haar zussen bij elkaar in hun ouderlijk huis, een prachtig landhuis aan het Meer van Genève',
                                /* startprijs*/12.99,
                                /* betalingswijze*/'IDEAL',
                                /* betalingsinstructie*/NULL,
                                /* plaatsnaam*/'Amsterdam',
                                /* land*/'Nederland',
                                /* looptijd*/7,
                                /* looptijdBeginDag*/getDate(),
                                /* looptijdBeginTijdstip*/CONVERT(TIME(0),GETDATE()),
                                /* verzendkosten*/2.7,
                                /* verzendinstructie*/'Via postnl',
                                /* verkoper*/'Stan',
                                /* koper*/NULL,
                                /* looptijdeindDag*/getDate() + 7,
                                /* looptijdeindTijdstip*/CONVERT(TIME(0),GETDATE() + 7),
                                /*veiling gesloten*/0,
                                /*verkoopprijs */13.00)



INSERT INTO tbl_Voorwerp VALUES (/* titel*/ 'Van klacht naar kans',
                                /* beschrijving */'In "Van klacht naar kans geeft Juriaan Galavazi, een trendsettende huisarts, zijn nieuwe visie op klachten.',
                                /* startprijs*/12.99,
                                /* betalingswijze*/'Contant',
                                /* betalingsinstructie*/NULL,
                                /* plaatsnaam*/'Rotterdam',
                                /* land*/'Nederland',
                                /* looptijd*/7,
                                /* looptijdBeginDag*/getDate(),
                                /* looptijdBeginTijdstip*/CONVERT(TIME(0),GETDATE()),
                                /* verzendkosten*/3.8,
                                /* verzendinstructie*/'Via postnl',
                                /* verkoper*/'Stan',
                                /* koper*/NULL,
                                /* looptijdeindDag*/getDate() + 7,
                                /* looptijdeindTijdstip*/CONVERT(TIME(0),GETDATE() + 7),
                                /*veiling gesloten*/0,
                                /*verkoopprijs */22.00)


INSERT INTO tbl_Voorwerp VALUES (/* titel*/'HP Envy 5030 - All-in-One Printer',
                                /* beschrijving */'Met de HP Envy 5030 kun je eenvoudig printen, kopiëren en scannen',
                                /* startprijs*/10.00,
                                /* betalingswijze*/'IDEAL',
                                /* betalingsinstructie*/'overschrijven',
                                /* plaatsnaam*/'Arnhem',
                                /* land*/'Nederland',
                                /* looptijd*/7,
                                /* looptijdBeginDag*/getDate(),
                                /* looptijdBeginTijdstip*/ CONVERT(TIME(0),GETDATE()) ,
                                /* verzendkosten*/3.8,
                                /* verzendinstructie*/'Via postnl',
                                /* verkoper*/'Stan',
                                /* koper*/NULL,
                                /* looptijdeindDag*/getDate() + 7,
                                /* looptijdeindTijdstip*/CONVERT(TIME(0),GETDATE() + 7),
                                /*veiling gesloten*/0,
                                /*verkoopprijs */70.00)
								
								delete from tbl_Voorwerp
							select * from tbl_Voorwerp

INSERT INTO tbl_Voorwerp VALUES (/* titel*/'Canon PIXMA MG3650S - All-in-One Printer / Zwart',
                                /* beschrijving */'Met de Canon PIXMA MG3650 All-in-One printer print je eenvoudig en snel draadloos via je laptop, desktop, smartphone of tablet.',
                                /* startprijs*/32.00,
                                /* betalingswijze*/'IDEAL',
                                /* betalingsinstructie*/'overschrijven',
                                /* plaatsnaam*/'Roermond',
                                /* land*/'Nederland',
                                /* looptijd*/7,
                                /* looptijdBeginDag*/getDate(),
                                /* looptijdBeginTijdstip*/CONVERT(TIME(0),GETDATE()),
                                /* verzendkosten*/3.8,
                                /* verzendinstructie*/'Via postnl',
                                /* verkoper*/'Stan',
                                /* koper*/NULL,
                                /* looptijdeindDag*/getDate() + 7,
                                /* looptijdeindTijdstip*/CONVERT(TIME(0),GETDATE() + 7),
                                /*veiling gesloten*/0,
                                /*verkoopprijs */129.00)


								
    
SET IDENTITY_INSERT tbl_Voorwerp ON;

INSERT INTO tbl_Voorwerp( voorwerpnummer, titel,beschrijving, startprijs,betalingswijze, 
                          betalingsinstructie, plaatsnaam, land,
						  looptijd, looptijdBeginDag,looptijdBeginTijdstip, verzendkosten,
						   verzendinstructies, verkoper, koper, LooptijdEindeDag
						  ,looptijdEindeTijdstip, veiling_gesloten, verkoopprijs) 
						  VALUES (6,
						  /* titel*/'Nvidia Geforce GTX 970 videokaart',
                                /* beschrijving */'Gebruikte videokaart aangeschaft in 2016. Ik doe hem weg vanwege aakoop van een nieuwe kaart. De videokaart werkt nog uitstekend en heeft altijd in een gesloten kast gezeten.
                                                   Geschikt voor lichte tot mediumzware games en applicaties.',
                                /* startprijs*/ 50.00,
                                /* betalingswijze*/'Bank/Giro',
                                /* betalingsinstructie*/NULL,
                                /* plaatsnaam*/'Nijmegen',
                                /* land*/'Nederland',
                                /* looptijd*/ 7,
                                /* looptijdBeginDag*/getDate(),
                                /* looptijdBeginTijdstip*/CONVERT(TIME(0),GETDATE()),
                                /* verzendkosten*/NULL,
                                /* verzendinstructie*/NULL,
                                /* verkoper*/'Obe',
                                /* koper*/NULL,
                                /* looptijdeindDag*/getDate() + 7,
                                /* looptijdeindTijdstip*/CONVERT(TIME(0),GETDATE() + 7),
                                /*veiling gesloten*/0,
                                /*verkoopprijs */50.00)


INSERT INTO tbl_Voorwerp( voorwerpnummer, titel,beschrijving, startprijs,betalingswijze, 
                          betalingsinstructie, plaatsnaam, land,
						  looptijd, looptijdBeginDag,looptijdBeginTijdstip, verzendkosten,
						   verzendinstructies, verkoper, koper, LooptijdEindeDag
						  ,looptijdEindeTijdstip, veiling_gesloten, verkoopprijs) 
						  VALUES (7,
						  /* titel*/'Epson EcoTank ET-2751 - All-in-One Printer',
                                /* beschrijving */'Inkttank All-in-One printer Printsnelheid kleur: Standaard: tot 25 pagina s per minuut p.p.m Printsnelheid zwart/wit: Standaard: tot 25 pagina s per minuut p.p.m' ,
                                /* startprijs*/ 190.00,
                                /* betalingswijze*/'Bank/Giro',
                                /* betalingsinstructie*/NULL,
                                /* plaatsnaam*/'Nijmegen',
                                /* land*/'Nederland',
                                /* looptijd*/ 7,
                                /* looptijdBeginDag*/getDate(),
                                /* looptijdBeginTijdstip*/CONVERT(TIME(0),GETDATE()),
                                /* verzendkosten*/NULL,
                                /* verzendinstructie*/NULL,
                                /* verkoper*/'Obe',
                                /* koper*/NULL,
                                /* looptijdeindDag*/getDate() + 7,
                                /* looptijdeindTijdstip*/CONVERT(TIME(0),GETDATE() + 7),
                                /*veiling gesloten*/0,
                                /*verkoopprijs */224.00)



INSERT INTO tbl_Voorwerp( voorwerpnummer, titel,beschrijving, startprijs,betalingswijze, 
                          betalingsinstructie, plaatsnaam, land,
						  looptijd, looptijdBeginDag,looptijdBeginTijdstip, verzendkosten,
						   verzendinstructies, verkoper, koper, LooptijdEindeDag
						  ,looptijdEindeTijdstip, veiling_gesloten, verkoopprijs) 
						  VALUES (8,
						  /* titel*/'HP Pavilion Gaming 15-DK0740ND - Gaming Laptop - 15.6 Inch',
                                /* beschrijving */'Dagelijks gebruik: deze laptop is geschikt voor internetten, e-mailen en tekstverwerking.' ,
                                /* startprijs*/ 790.00,
                                /* betalingswijze*/'Contant',
                                /* betalingsinstructie*/NULL,
                                /* plaatsnaam*/'Utrecht',
                                /* land*/'Nederland',
                                /* looptijd*/ 7,
                                /* looptijdBeginDag*/getDate(),
                                /* looptijdBeginTijdstip*/CONVERT(TIME(0),GETDATE()),
                                /* verzendkosten*/NULL,
                                /* verzendinstructie*/NULL,
                                /* verkoper*/'Obe',
                                /* koper*/NULL,
                                /* looptijdeindDag*/getDate() + 7,
                                /* looptijdeindTijdstip*/CONVERT(TIME(0),GETDATE() + 7),
                                /*veiling gesloten*/0,
                                /*verkoopprijs */1000.00)


INSERT INTO tbl_Voorwerp( voorwerpnummer, titel,beschrijving, startprijs,betalingswijze, 
                          betalingsinstructie, plaatsnaam, land,
						  looptijd, looptijdBeginDag,looptijdBeginTijdstip, verzendkosten,
						   verzendinstructies, verkoper, koper, LooptijdEindeDag
						  ,looptijdEindeTijdstip, veiling_gesloten, verkoopprijs) 
						  VALUES (9,
						  /* titel*/'MSI GF63 9SC-045NL - Gaming laptop - 15.6 inch',
                                /* beschrijving */'Gaming: is geschikt voor de meest recente games op hoge instellingen.
                                                   Foto- en videobewerking: de processor en videokaart bieden voldoende snelheid.' ,
                                /* startprijs*/ 990.00,
                                /* betalingswijze*/'Contant',
                                /* betalingsinstructie*/NULL,
                                /* plaatsnaam*/'Den haag',
                                /* land*/'Nederland',
                                /* looptijd*/ 7,
                                /* looptijdBeginDag*/getDate(),
                                /* looptijdBeginTijdstip*/CONVERT(TIME(0),GETDATE()),
                                /* verzendkosten*/NULL,
                                /* verzendinstructie*/NULL,
                                /* verkoper*/'Obe',
                                /* koper*/NULL,
                                /* looptijdeindDag*/getDate() + 7,
                                /* looptijdeindTijdstip*/CONVERT(TIME(0),GETDATE() + 7),
                                /*veiling gesloten*/0,
                                /*verkoopprijs */1200.00)



INSERT INTO tbl_Voorwerp( voorwerpnummer, titel,beschrijving, startprijs,betalingswijze, 
                          betalingsinstructie, plaatsnaam, land,
						  looptijd, looptijdBeginDag,looptijdBeginTijdstip, verzendkosten,
						   verzendinstructies, verkoper, koper, LooptijdEindeDag
						  ,looptijdEindeTijdstip, veiling_gesloten, verkoopprijs) 
						  VALUES (10,
						  /* titel*/'Asus F571GD-BQ257T - Gaming Laptop - 15.6 Inch',
                                /* beschrijving */'Gaming: is geschikt voor de meest recente games op medium instellingen.
                                                  Foto- en videobewerking: de processor en videokaart bieden voldoende snelheid. ' ,
                                /* startprijs*/ 600.00,
                                /* betalingswijze*/'Contant',
                                /* betalingsinstructie*/NULL,
                                /* plaatsnaam*/'Eindhoven',
                                /* land*/'Nederland',
                                /* looptijd*/ 7,
                                /* looptijdBeginDag*/getDate(),
                                /* looptijdBeginTijdstip*/CONVERT(TIME(0),GETDATE()),
                                /* verzendkosten*/NULL,
                                /* verzendinstructie*/NULL,
                                /* verkoper*/'Stan',
                                /* koper*/NULL,
                                /* looptijdeindDag*/getDate() + 7,
                                /* looptijdeindTijdstip*/CONVERT(TIME(0),GETDATE() + 7),
                                /*veiling gesloten*/0,
                                /*verkoopprijs */1200.00)


INSERT INTO tbl_Bestand VALUES	 ('Afbeeldingen/boek1.jpg', 1),
								 ('Afbeeldingen/boek2.jpg', 2),
								 ('Afbeeldingen/boek3.jpg', 3),
								 ('Afbeeldingen/printer1.png', 4),
								 ('Afbeeldingen/printer2.png', 5),
								 ('Afbeeldingen/videokaart.png', 6),
								 ('Afbeeldingen/printer3.png', 7),
								 ('Afbeeldingen/laptop1.jpg', 8),
							     ('Afbeeldingen/laptop2.jpg', 9),
							     ('Afbeeldingen/laptop3.jpg', 10)











































