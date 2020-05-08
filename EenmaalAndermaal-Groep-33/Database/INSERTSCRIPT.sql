--USE EenmaalAndermaal
USE iproject33

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




INSERT INTO tbl_Vraag VALUES ( 'Wat is de naam van je eerste huisdier?')
INSERT INTO tbl_Vraag VALUES ( 'In welk dorp/stad was je eerste baantje?')
INSERT INTO tbl_Vraag VALUES ( 'Wat is je favoriete film van het laatste decennium?')
INSERT INTO tbl_Vraag VALUES ( 'Wat is de naam van je basisschool?')
INSERT INTO tbl_Vraag VALUES ( 'Wat is je lievelingsgerecht?')
DBCC CHECKIDENT(tbl_Vraag, RESEED, 0)
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




INSERT INTO tbl_Gebruikerstelefoon VALUES ( 'Mohammad', 0684723231),
										  ( 'Stan', 0621900621),
										  ( 'Aron', 0672829473),
										  ( 'Obe', 0629892429)

INSERT INTO tbl_Verkoper VALUES ('Stan','AbnAmro','937273282','Post', NULL),
                                ('Mohammad','ING','087734743734','Post', NULL),
								('Obe', 'ING', NULL, 'Creditcard','123442')
				
go
--hoofdrubrieken
INSERT INTO tbl_Rubriek VALUES  ('Boeken', NULL, 1),
								('Muziek, Film en Games', NULL, 2),
								('Computer en Elektronica', NULL, 3),
								('Dier', NULL, 4),
								('Koken en Tafelen', NULL, 5),
								('Huishouden', NULL, 6),
								('Klussen', NULL, 7),
								('Tuin', NULL, 8),
								('Mooi en Gezond', NULL, 9),
								('Damesmode', NULL, 10),
								('Herenmode', NULL, 11),
								('Speelgoed en Hobby', NULL, 12),
								('Wonen', NULL, 13),
								('Kantoor en School', NULL, 14),
								('Baby en Kind', NULL, 15),
								('Sport, Outdoor en Reizen', NULL, 16),
								('Drank en Koffie', NULL, 17),
								('Auto en Motor', NULL, 18)

--subrubrieken
INSERT INTO tbl_Rubriek VALUES  ('Boeken', 1, 1),
							    ('Nederlandstalige boeken', 1, 2),
								('Engelstalige boeken', 1, 3),
								('E-books', 1, 4),
								('E-readers', 1, 5),
								('Luisterboeken', 1, 6),
								('Studieboeken', 1, 7),

								('Muziek', 2, 1),
								('DVD', 2, 2),
								('Blu-Ray', 2, 3),
								('TV-series', 2, 4),
								('Games', 2, 5),
								('Consoles en accessoires', 2, 6),

								('Computer', 3, 1),
								('Telefonie', 3, 2),
								('Tablets', 3, 3),
								('Huishoudelijke apparaten', 3, 4),
								('Keukenapparaten', 3, 5),
								('Camera''s', 3, 6),
								('Wearables', 3, 7),
								('Navigatie', 3, 8),
								('Televisies', 3, 9),
								('Audio en Hifi', 3, 10),
								('Persoonlijke verzorging', 3, 11),
								('Printers', 3, 12),
								('Computeronderdelen', 3, 13),

								('Dier', 4, 1),
								('Hond', 4, 2),
								('Katten', 4, 3),
								('Paard en Ruiter', 4, 4),
								('Knaagdieren', 4, 5),
								('Vissen', 4, 6),
								('Reptielen', 4, 7),
								('Vogels', 4, 8),

								('Koken en Taferelen', 5, 1),
								('Barbecues', 5, 2),
								('Pannen', 5, 3),

								('Huishouden', 6, 1),
								('Prullenbakken', 6, 2),

								('Klussen', 7, 1),
								('Elektrisch gereedschap', 7, 2),
								('Sanitair', 7, 3),

								('Tuin', 8, 1),
								('Tuinmeubelen', 8, 2),
								('Tuingereedschap', 8, 3),
								('Loungesets', 8, 4),

								('Mooi en Gezond', 9, 1),
								('Make-up', 9, 2),
								('Parfum', 9, 3),
								('Verzorging', 9, 4),
								('Gezondheid', 9, 5),

								('Damesmode', 10, 1),
								('Dameskleding', 10, 2),
								('Dames schoenen', 10, 3),
								('Lingerie', 10, 4),
								('Dames accessoires', 10, 5),
								('Dames sieraden en horloges', 10, 6),

								('Herenmode', 11, 1),
								('Herenkleding', 11, 2),
								('Heren schoenen', 11, 3),
								('Heren ondergoed', 11, 4),
								('Heren accessoires', 11, 5),
								('Heren sieraden en horloges', 11, 6),

								('Speelgoed', 12, 1),
								('Hobby en Creatief', 12, 2),
								('Buitenspeelgoed', 12, 3),
								('Verkleedkleding', 12, 4),

								('Wonen', 13, 1),
								('Meubels', 13, 2),
								('Beddengoed', 13, 3),
								('Verlichting', 13, 4),
								('Woonaccessoires', 13, 5),

								('Kantoor en School', 14, 1),
								('Kantoorspullen', 14, 2),
								('Schoolspullen', 14, 3),

								('Babykleding', 15, 1),
								('Babyartikelen', 15, 2),
								('Kinderkleding', 15, 3),
								('Jongenskleding', 15, 4),
								('Meisjeskleding', 15, 5),

								('Sport', 16, 1),
								('Sportkleding', 16, 2),
								('Kamperen en Outdoor', 16, 3),
								('Reisbagage', 16, 4),

								('Drank', 17, 1),
								('Wijn', 17, 2),
								('Bier', 17, 3),
								('Sterke drank', 17, 4),
								('Koffie', 17, 5),

								('Auto en Motor', 18, 1),
								('Auto-accessoires', 18, 2),
								('Auto-onderhoud', 18, 3),
								('Auto-onderdelen', 18, 4),
								('Motoraccessoires', 18, 5),
								('Motorkleding', 18, 6),
								('Motoronderhoud en -onderdelen', 18, 7)
DBCC CHECKIDENT(tbl_Rubriek, RESEED, 0)
go
--1--
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
								/* koper*/NULL,
								/* looptijdeindDag*/getDate() + 7,
								/* looptijdeindTijdstip*/CONVERT(TIME(0),GETDATE() + 7),
								/*veiling gesloten*/0,
								/*verkoopprijs */NULL)
							
INSERT INTO tbl_Voorwerp_in_rubriek VALUES (1, (SELECT rubrieknummer FROM tbl_Rubriek WHERE rubriek =  1 AND volgnr = 2))

--2--
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
                                /*verkoopprijs */NULL)

INSERT INTO tbl_Voorwerp_in_rubriek VALUES (2, (SELECT rubrieknummer FROM tbl_Rubriek WHERE rubriek =  1 AND volgnr = 2))

--3--
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
                                /*verkoopprijs */NULL)

INSERT INTO tbl_Voorwerp_in_rubriek VALUES (3, (SELECT rubrieknummer FROM tbl_Rubriek WHERE rubriek =  1 AND volgnr = 2))

--4--
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
                                /*verkoopprijs */NULL)

INSERT INTO tbl_Voorwerp_in_rubriek VALUES (4, (SELECT rubrieknummer FROM tbl_Rubriek WHERE rubriek =  3 AND volgnr = 12))

--5--
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
                                /*verkoopprijs */NULL)

INSERT INTO tbl_Voorwerp_in_rubriek VALUES (5, (SELECT rubrieknummer FROM tbl_Rubriek WHERE rubriek =  3 AND volgnr = 12))								
    
--6--
INSERT INTO tbl_Voorwerp VALUES (
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
                                /*verkoopprijs */NULL)

INSERT INTO tbl_Voorwerp_in_rubriek VALUES (6, (SELECT rubrieknummer FROM tbl_Rubriek WHERE rubriek =  3 AND volgnr = 13))

--7--
INSERT INTO tbl_Voorwerp VALUES (
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
                                /*verkoopprijs */NULL)

INSERT INTO tbl_Voorwerp_in_rubriek VALUES (7, (SELECT rubrieknummer FROM tbl_Rubriek WHERE rubriek =  3 AND volgnr = 12))

--8--
INSERT INTO tbl_Voorwerp  VALUES (
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
                                /*verkoopprijs */NULL)

INSERT INTO tbl_Voorwerp_in_rubriek VALUES (8, (SELECT rubrieknummer FROM tbl_Rubriek WHERE rubriek =  3 AND volgnr = 1))

--9--
INSERT INTO tbl_Voorwerp  VALUES (
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
                                /*verkoopprijs */NULL)

INSERT INTO tbl_Voorwerp_in_rubriek VALUES (9, (SELECT rubrieknummer FROM tbl_Rubriek WHERE rubriek =  3 AND volgnr = 1))

--10--
INSERT INTO tbl_Voorwerp VALUES (
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
                                /*verkoopprijs */NULL)

INSERT INTO tbl_Voorwerp_in_rubriek VALUES (10, (SELECT rubrieknummer FROM tbl_Rubriek WHERE rubriek =  3 AND volgnr = 1))

--11--
INSERT INTO tbl_Voorwerp VALUES (/* titel*/'Hot Wheels Cadeauset met 10 Auto"s',
                                /* beschrijving */'Deze sets bevatten 10 coole Hot Wheels auto"s in één verpakking. Elke set is anders samengesteld en bevat altijd één unieke auto',
								/* startprijs*/19.4,
								/* betalingswijze*/'Giro',
								/* betalingsinstructie*/'overmaken',
								/* plaatsnaam*/'Groningen',
								/* land*/'Nederland',
								/* looptijd*/ 7,
								/* looptijdBeginDag*/getDate(),
								/* looptijdBeginTijdstip*/CONVERT(TIME(0),GETDATE()), 
								/* verzendkosten*/5.3,
								/* verzendinstructie*/'Via postnl',
								/* verkoper*/'Stan', 
								/* koper*/NULL,
								/* looptijdeindDag*/getDate() + 7,
								/* looptijdeindTijdstip*/CONVERT(TIME(0),GETDATE() + 7),
								/*veiling gesloten*/0,
								/*verkoopprijs */NULL)

INSERT INTO tbl_Voorwerp_in_rubriek VALUES (11, (SELECT rubrieknummer FROM tbl_Rubriek WHERE rubriek =  12 AND volgnr = 1))

--12--
INSERT INTO tbl_Voorwerp VALUES (/* titel*/'Hot Wheels Kurkentrekker Crash - Racebaan',
                                /* beschrijving */'Bij deze stuntset van Hot Wheels draait alles om experimenteren en de concurrentie te snel af zijn. ',
								/* startprijs*/15.4,
								/* betalingswijze*/'PayPal',
								/* betalingsinstructie*/'overmaken',
								/* plaatsnaam*/'Friesland',
								/* land*/'Nederland',
								/* looptijd*/ 7,
								/* looptijdBeginDag*/getDate(),
								/* looptijdBeginTijdstip*/CONVERT(TIME(0),GETDATE()), 
								/* verzendkosten*/5.3,
								/* verzendinstructie*/'Alleen ophalen',
								/* verkoper*/'Stan', 
								/* koper*/NULL,
								/* looptijdeindDag*/getDate() + 7,
								/* looptijdeindTijdstip*/CONVERT(TIME(0),GETDATE() + 7),
								/*veiling gesloten*/0,
								/*verkoopprijs */NULL)

INSERT INTO tbl_Voorwerp_in_rubriek VALUES (12, (SELECT rubrieknummer FROM tbl_Rubriek WHERE rubriek =  12 AND volgnr = 1))

--13--
INSERT INTO tbl_Voorwerp VALUES (/* titel*/'Hot Wheels Track Builder Looping Challenge - Racebaan',
                                /* beschrijving */'Hot Wheels Track Builder - Looping Challenge Set',
								/* startprijs*/17.4,
								/* betalingswijze*/'ING',
								/* betalingsinstructie*/'overmaken',
								/* plaatsnaam*/'Maastricht',
								/* land*/'Nederland',
								/* looptijd*/ 7,
								/* looptijdBeginDag*/getDate(),
								/* looptijdBeginTijdstip*/CONVERT(TIME(0),GETDATE()), 
								/* verzendkosten*/5.3,
								/* verzendinstructie*/'Verzenden via Postnl',
								/* verkoper*/'Stan', 
								/* koper*/NULL ,
								/* looptijdeindDag*/getDate() + 7,
								/* looptijdeindTijdstip*/CONVERT(TIME(0),GETDATE() + 7),
								/*veiling gesloten*/0,
								/*verkoopprijs */NULL)

INSERT INTO tbl_Voorwerp_in_rubriek VALUES (13, (SELECT rubrieknummer FROM tbl_Rubriek WHERE rubriek =  12 AND volgnr = 1))

--14--
INSERT INTO tbl_Voorwerp VALUES (/* titel*/'Hot Wheels Track Builder Rechte Baandelenset met Auto - Racebaan',
                                /* beschrijving */'De Hot Wheels Track Builder Rechte Baandelenset met Auto is een super lange baan van wel ruim 5 meter lang!',
								/* startprijs*/20.4,
								/* betalingswijze*/'Contant',
								/* betalingsinstructie*/NULL,
								/* plaatsnaam*/'Arnhem',
								/* land*/'Nederland',
								/* looptijd*/ 7,
								/* looptijdBeginDag*/getDate(),
								/* looptijdBeginTijdstip*/CONVERT(TIME(0),GETDATE()), 
								/* verzendkosten*/5.3,
								/* verzendinstructie*/'Alleen ophalen',
								/* verkoper*/'Stan', 
								/* koper*/NULL,
								/* looptijdeindDag*/getDate() + 7,
								/* looptijdeindTijdstip*/CONVERT(TIME(0),GETDATE() + 7),
								/*veiling gesloten*/0,
								/*verkoopprijs */NULL)

INSERT INTO tbl_Voorwerp_in_rubriek VALUES (14, (SELECT rubrieknummer FROM tbl_Rubriek WHERE rubriek =  12 AND volgnr = 1))

--15--
INSERT INTO tbl_Voorwerp VALUES (/* titel*/'PAW Patrol Reddings Voertuigen Chase, Zuma en Ryder',
                                /* beschrijving */'PAW Patrol Rescue Racers 3-pack met 3 voertuigen inclusief Chase, Zuma en Ryder. De figuren zitten vast aan voertuigen.',
								/* startprijs*/5.4,
								/* betalingswijze*/'Contant',
								/* betalingsinstructie*/NULL,
								/* plaatsnaam*/'Arnhem',
								/* land*/'Nederland',
								/* looptijd*/ 7,
								/* looptijdBeginDag*/getDate(),
								/* looptijdBeginTijdstip*/CONVERT(TIME(0),GETDATE()), 
								/* verzendkosten*/5.3,
								/* verzendinstructie*/'Alleen ophalen',
								/* verkoper*/'Stan', 
								/* koper*/NULL,
								/* looptijdeindDag*/getDate() + 7,
								/* looptijdeindTijdstip*/CONVERT(TIME(0),GETDATE() + 7),
								/*veiling gesloten*/0,
								/*verkoopprijs */NULL)

INSERT INTO tbl_Voorwerp_in_rubriek VALUES (15, (SELECT rubrieknummer FROM tbl_Rubriek WHERE rubriek =  12 AND volgnr = 1))

--16--
INSERT INTO tbl_Voorwerp VALUES (
						  /* titel*/'LEGO Star Wars UCS Millennium Falcon - 75192',
                                /* beschrijving */'De ultieme LEGO® Star Wars Millennium Falcon is geland! Het supersnelle Corelliaanse schip 
													van Han Solo bestaat uit maar liefst 7500 onderdelen en zit boordevol coole details en leuke kenmerken.
													Bewonder de geraffineerde details van de romp, de radarschotel, de vierdubbele laserkanonnen aan de boven- 
													en onderkant, de 7 landingspoten, de laadklep die omlaag kan en het verborgen blasterkanon. In de cockpit met 
													afneembare koepel is plaats voor maximaal 4 minifiguren. ' ,
                                /* startprijs*/ 779.00,
                                /* betalingswijze*/'Bank/Giro',
                                /* betalingsinstructie*/NULL,
                                /* plaatsnaam*/'Amsterdam',
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
                                /*verkoopprijs */NULL)

INSERT INTO tbl_Voorwerp_in_rubriek VALUES (16, (SELECT rubrieknummer FROM tbl_Rubriek WHERE rubriek =  12 AND volgnr = 2))

--17--
INSERT INTO tbl_Voorwerp VALUES (
						  /* titel*/'LEGO Star Wars Death Star - 10188',
                                /* beschrijving */'Beleef actie en avontuur van de Star Wars films met de Death Star. Dit gedetailleerde strijdstation 
													beschikt over een ongelooflijke waaier van minifigure schaal scènes en accessoires van Episodes IV en VI op vijf dekken.' ,
                                /* startprijs*/ 474.95,
                                /* betalingswijze*/'Bank/Giro',
                                /* betalingsinstructie*/NULL,
                                /* plaatsnaam*/'Amsterdam',
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
                                /*verkoopprijs */NULL)

INSERT INTO tbl_Voorwerp_in_rubriek VALUES (17, (SELECT rubrieknummer FROM tbl_Rubriek WHERE rubriek =  12 AND volgnr = 2))

--18--
INSERT INTO tbl_Voorwerp VALUES (
						  /* titel*/'LEGO Star Wars Super Star Destroyer - 10221',
                                /* beschrijving */'De Super Star Destroyer Executor is er eindelijk! Dit fantastische schip deed dienst als commandopost
													tijdens de slag om Endor en was het persoonlijke vlaggenschip van Darth Vader in de klassieke Star Wars films.
													De Executor, met zijn dolk-achtige vorm, is een van de grootste en machtigste schepen in het Star Wars universum. 
													Met meer dan 3000 stukjes, een lengte van bijna 124,5 cm en een gewicht van 3,5 kg boezemt elk aspect van dit fantastische LEGO® Star Wars™ model ontzag in.
													Inclusief DarthVader, Admiral Piett, Dengar, Bossk en IG-88 minifigures.' ,
                                /* startprijs*/1047.49 ,
                                /* betalingswijze*/'Bank/Giro',
                                /* betalingsinstructie*/NULL,
                                /* plaatsnaam*/'Amsterdam',
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
                                /*verkoopprijs */NULL)

INSERT INTO tbl_Voorwerp_in_rubriek VALUES (18, (SELECT rubrieknummer FROM tbl_Rubriek WHERE rubriek =  12 AND volgnr = 2))

--19--
INSERT INTO tbl_Voorwerp VALUES (
						  /* titel*/'De Huisdiersuper Hondenzwembad - 120 x 30 cm - Blauw',
                                /* beschrijving */'Dit hondenzwembad is zeer geschikt voor de middelgrote en grotere hondenrassen en 
													zorgt voor een heerlijke verkoeling tijdens de warme zomermaanden. Het zwembad kan makkelijk in - 
													en uitgevouwen worden en is binnen mum van tijd te vullen met lekker koel water.' ,
                                /* startprijs*/ 49.99,
                                /* betalingswijze*/'Bank/Giro',
                                /* betalingsinstructie*/NULL,
                                /* plaatsnaam*/'Amsterdam',
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
                                /*verkoopprijs */NULL)

INSERT INTO tbl_Voorwerp_in_rubriek VALUES (19, (SELECT rubrieknummer FROM tbl_Rubriek WHERE rubriek =  4 AND volgnr = 2))

--20--
INSERT INTO tbl_Voorwerp VALUES (
						  /* titel*/'Kong Extreme - Hondenspeelgoed - Zwart - L',
                                /* beschrijving */'De extra sterke Zwarte Kongs zijn speciaal gemaakt voor hardnekkige kauwers.
													Deze Kong is beschikbaar in vijf maten. Wordt wereldwijd gebruikt door politie, drugs en militaire K-9 teams, 
													verdedigingshonden en competitietrainers en vele anderen. Gebruik onder supervisie van het baasje is sterk aangeraden bij sterke kauwers!' ,
                                /* startprijs*/ 10.52,
                                /* betalingswijze*/'Bank/Giro',
                                /* betalingsinstructie*/NULL,
                                /* plaatsnaam*/'Amsterdam',
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
                                /*verkoopprijs */NULL)

INSERT INTO tbl_Voorwerp_in_rubriek VALUES (20, (SELECT rubrieknummer FROM tbl_Rubriek WHERE rubriek =  4 AND volgnr = 2))


DBCC CHECKIDENT(tbl_Voorwerp, RESEED, 0)


INSERT INTO tbl_Bestand VALUES	 ('Afbeeldingen/boek1.jpg', 1),
								 ('Afbeeldingen/boek2.jpg', 2),
								 ('Afbeeldingen/boek3.jpg', 3),
								 ('Afbeeldingen/printer1.png', 4),
								 ('Afbeeldingen/printer2.png', 5),
								 ('Afbeeldingen/videokaart.png', 6),
								 ('Afbeeldingen/printer3.png', 7),
								 ('Afbeeldingen/laptop1.jpg', 8),
							     ('Afbeeldingen/laptop2.jpg', 9),
							     ('Afbeeldingen/laptop3.jpg', 10),
								
								 ('Afbeeldingen/speelgoed1.jpg', 11),
								 ('Afbeeldingen/speelgoed2.jpg',12),
								 ('Afbeeldingen/speelgoed3.jpg', 13),
								 ('Afbeeldingen/speelgoed4.jpg', 14),
								 ('Afbeeldingen/speelgoed5.jpg', 15),
								 ('Afbeeldingen/LegoMF.jpg', 16),
								 ('Afbeeldingen/legoDS.jpg', 17),
								 ('Afbeeldingen/legoSD.jpg', 18),
								 ('Afbeeldingen/hondenzwembad.jpg', 19),
								 ('Afbeeldingen/hondenspeelgoed.jpg', 20)




































