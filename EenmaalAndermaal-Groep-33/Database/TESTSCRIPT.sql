USE iproject33 
--USE EenmaalAndermaal

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

INSERT INTO tbl_Vraag VALUES ( 'Wat is de naam van je eerste huisdier?')
INSERT INTO tbl_Vraag VALUES ( 'In welk dorp/stad was je eerste baantje?')
INSERT INTO tbl_Vraag VALUES ( 'Wat is je favoriete film van het laatste decennium?')
INSERT INTO tbl_Vraag VALUES ( 'Wat is de naam van je basisschool?')
INSERT INTO tbl_Vraag VALUES ( 'Wat is je lievelingsgerecht?')
DBCC CHECKIDENT(tbl_Vraag, RESEED, 0)
go


--B1--Gebruiker mag alleen toegevoegd worden aan tabel verkopers wanneer hij in de kolom verkoper 'wel' heeft staan.

--Gebruiker is geen verkoper
INSERT INTO tbl_Gebruiker VALUES
( 'Boris', 'Boris', 'Otte', 'Nijmegen', null,'8776', 'Nijmegen', 'NL', getDate(), 
   'boris@han.nl', 'borisWachtwoord', 2, 'nijmegen', 0)

--gebruiker kan dus niet worden toegevoegd aan tabel verkoper
INSERT INTO tbl_Verkoper VALUES
('Boris', 'ING', 'INGB574756', 'Post', NULL)




--B2 ----------Deze constraint 1 om het volgende te checken: als er iemand voor Credicard heeft gekozen
---- Dan moet hij een creditcardnummer invoeren 
INSERT INTO tbl_Gebruiker VALUES
( 'Mohammad', 'Mohammad', 'Yasin', 'Nijmegen', null,'8776', 'Nijmegen', 'NL', getDate(), 
   'boris@han.nl', 'borisWachtwoord', 2, 'nijmegen', 1)
----test/ insert hieronder lukt niet. 
INSERT INTO tbl_Verkoper VALUES ('Mohammad','AbnAmro','937273282','Creditcard', NULL)

------test/dit lukt wel 

INSERT INTO tbl_Verkoper VALUES ('Mohammad','AbnAmro','937273282','Creditcard', 3434353)


------test/dit lukt wel 
DELETE FROM tbl_Verkoper WHERE gebruiker = 'Mohammad';
INSERT INTO tbl_Verkoper VALUES ('Mohammad','AbnAmro','937273282','Post', null)


------test/dit lukt niet 
DELETE FROM tbl_Verkoper WHERE gebruiker = 'Mohammad';
INSERT INTO tbl_Verkoper VALUES ('Mohammad','AbnAmro','937273282','Post', 34343434)



-- B3---er moet of een creditcardnummer ingevoerd worden of een bankrekeningnummer
-- beide niet invoeren mag niet. beide invoeren mag wel. 

------test-- dit lukt niet
DELETE FROM tbl_Verkoper WHERE gebruiker = 'Mohammad';
INSERT INTO tbl_Verkoper VALUES ('Mohammad','AbnAmro',Null,'post', null)

-----test/ dit lukt wel 
DELETE FROM tbl_Verkoper WHERE gebruiker = 'Mohammad';
INSERT INTO tbl_Verkoper VALUES ('Mohammad','AbnAmro',6643743,'post', NULL)

---test/dit lukt wel
DELETE FROM tbl_Verkoper WHERE gebruiker = 'Mohammad';
INSERT INTO tbl_Verkoper VALUES ('Mohammad','AbnAmro',null,'Creditcard', 78877878)

---test/dit lukt ook wel
DELETE FROM tbl_Verkoper WHERE gebruiker = 'Mohammad';
INSERT INTO tbl_Verkoper VALUES ('Mohammad','AbnAmro',4343434,'Creditcard', 78877878)



--B4 ---er mogen max 4 afbeeldingen voor 1 voorwerp opgeslagen worden.
DELETE FROM tbl_Voorwerp
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
                                /* verkoper*/'Mohammad',
                                /* koper*/NULL,
                                /* looptijdeindDag*/getDate() + 7,
                                /* looptijdeindTijdstip*/CONVERT(TIME(0),GETDATE() + 7),
                                /*veiling gesloten*/0,
                                /*verkoopprijs */NULL)

--Test/ dit lukt niet, want het zijn meer dan 4 foto's
DELETE FROM tbl_Bestand
insert into tbl_Bestand values ('foto1',1),
								('foto2',1),
								('foto3',1),
								('foto4',1),
								('foto5',1),
								('foto6',1)

--B5-- biedingen moeten hoger zijn dan startprijs en hoger dan het hoogste bod met minimale verhoging
INSERT INTO tbl_Gebruiker VALUES ( 'Stan', 'Stan', 'Van Gaal', 'Venray', null,'3432', 'Venlo', 'NL', getDate(), 
   'Stan@han.nl', 'StanWachtwoord', 5, 'spaghetti', 1)

--test/lukt wel, want is hoger dan de verkoopprijs+0.50 cent--
INSERT INTO tbl_Bod VALUES (1, 60.0, 'Stan', '06-05-2020', '15:02:00')

--test/Lukt wel, hoger bod dan het vorige
INSERT INTO tbl_Bod VALUES (1, 70.0, 'Boris', '06-05-2020', '15:02:00')

--test/lukt niet, bod lager dan het hoogste bod
INSERT INTO tbl_Bod VALUES (1, 65.0, 'Stan', '06-05-2020', '15:02:00')

--test/lukt niet, want lager dan de startprijs
INSERT INTO tbl_Bod VALUES (1, 10.0, 'Stan', '06-05-2020', '15:02:00')



---------B6--------- gebruikers mogen niet bieden op hun eigen voorwerpen. 
----test/ Mohammad heeft voorwerp 1 ter verkoop aangeboden hij wil een bod doen op zijn voorwerp.
--- lukt niet---
insert into tbl_Bod values (1, 120.32, 'Mohammad', '01-01-2020', '12:20:01')


---------------------------------test AF1----------------------
--kolom looptijdeindedag heeft de datum van looptijdbegindag  + het aantal dagen van looptijd
--test/ werkt wel: voor het ene voorwerp wat in deze testdata staat klopt de einddatum met de looptijd 
SELECT LooptijdEindeDag, looptijdBeginDag, looptijd FROM tbl_Voorwerp




---------------------------test AF2----------------------------
--kolom looptijdeindetijdstip heeft dezelfde waarde als kolom looptijdbegintijdstip
--test/werkt wel: de onderstaande select geeft voor beide kolommen dezelfde tijd aan
SELECT looptijdBeginTijdstip, looptijdEindeTijdstip FROM tbl_Voorwerp



-------------------------------test AF3-------------------------
--kolom veilinggesloten?  heeft de waarde ‘niet’ als de systeemdatum en –tijd vroeger zijn dan wat kolommen 
--LooptijdeindeDag en LooptijdeindeTijdstip aangeven, en de waarde ‘wel’ als de systeemdatum en –tijd later zijn dan dat. 

SELECT * FROM tbl_Voorwerp

--test/dit werkt niet want de veiling loopt nog
UPDATE tbl_Voorwerp
SET veiling_gesloten = 1, looptijdBeginDag = GETDATE()

--test/ werkt wel, want de veiling is niet gesloten
UPDATE tbl_Voorwerp
SET veiling_gesloten = 0, looptijdBeginDag = GETDATE()



------------------------------------tests- AF 4-----------------------
----------------------WERKT NIET Koper mag niet NULL waarde bevatten als veiling gesloten 1/true waarde heeft. 
UPDATE tbl_Voorwerp 
SET koper = NULL, looptijd = 4, LooptijdEindeDag = '2020-05-04', veiling_gesloten = 1, verkoopprijs = 256.60 WHERE voorwerpnummer = 1;

----------------------WERKT NIET-- Obe is niet de persoon die het hoogste bedrag heeft geboden. 
UPDATE tbl_Voorwerp 
SET koper = 'Obe', looptijd = 4, LooptijdEindeDag = '2020-05-04', veiling_gesloten = 1, verkoopprijs = 256.60 WHERE voorwerpnummer = 1 ;

----------------------------WERKT wel-- Boris is de persoon die het hoogste heeft geboden op voorwerp 1. 
UPDATE tbl_Voorwerp 
SET koper = 'Boris', looptijd = 4, LooptijdEindeDag = '2020-05-04', veiling_gesloten = 1, verkoopprijs = 256.60 WHERE voorwerpnummer = 1 ;



--------WERKT NIET- Niemand heeft een Bod gedaan op voorwerp 2
UPDATE tbl_Voorwerp 
SET koper = 'Boris', looptijd = 4, LooptijdEindeDag = '2020-05-04', veiling_gesloten = 1, verkoopprijs = 256.60 WHERE voorwerpnummer = 2;







--------------------------------------------test AF 5 ------------------------------------------------------------------
---------WERKT NIET verkoopprijs mag geen null waarde bevatten als er op een voorwerp aangeboden is en de veiling gesloten is. 
UPDATE tbl_Voorwerp 
SET koper = 'Mohammad', looptijd = 4, LooptijdEindeDag = '2020-05-04', veiling_gesloten = 1, verkoopprijs = NULL WHERE voorwerpnummer = 15


 --- WERKT NIET -- verkoop prijs moet gelijk zijn aan het hoogste bod op voorwerp 15
UPDATE tbl_Voorwerp 
SET koper = 'Mohammad', looptijd = 4, LooptijdEindeDag = '2020-05-04', veiling_gesloten = 1, verkoopprijs = 223.44 WHERE voorwerpnummer = 15


-----WERKT WEL ---- verkoop prijs is gelijk aan hoogste bod. 
UPDATE tbl_Voorwerp 
SET koper = 'Mohammad', looptijd = 4, LooptijdEindeDag = '2020-05-04', veiling_gesloten = 1, verkoopprijs = 222.00 WHERE voorwerpnummer = 15

