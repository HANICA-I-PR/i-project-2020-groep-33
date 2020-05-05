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
   'boris@han.nl', 'borisWachtwoord', 2, 'nijmegen', 0)
----test/ insert hieronder lukt niet. 
INSERT INTO tbl_Verkoper VALUES ('Mohammad','AbnAmro','937273282','Creditcard', NULL)

------test/dit lukt wel 

INSERT INTO tbl_Verkoper VALUES ('Mohammad','AbnAmro','937273282','Creditcard', 3434353)


------test/dit lukt wel 
INSERT INTO tbl_Verkoper VALUES ('Mohammad','AbnAmro','937273282','Post', null)
DELETE FROM tbl_Verkoper WHERE gebruiker = 'Mohammad';

------test/dit lukt niet 
INSERT INTO tbl_Verkoper VALUES ('Mohammad','AbnAmro','937273282','Post', 34343434)



-- B3---er moet of een creditcardnummer ingevoerd worden of een bankrekeningnummer
-- beide niet invoeren mag niet. beide invoeren mag wel. 

------test-- dit lukt niet
INSERT INTO tbl_Verkoper VALUES ('Stan','AbnAmro',Null,'post', null)

-----test/ dit lukt wel 
INSERT INTO tbl_Verkoper VALUES ('Stan','AbnAmro',6643743,'post', null)

---test/dit lukt wel
INSERT INTO tbl_Verkoper VALUES ('Stan','AbnAmro',null,'Creditcard', 78877878)

---test/dit lukt ook wel
INSERT INTO tbl_Verkoper VALUES ('Stan','AbnAmro',4343434,'Creditcard', 78877878)



--B4 ---er mogen max 4 afbeeldingen voor 1 voorwerp opgeslagen worden.

insert into tbl_Bestand values ('foto1',1),
								('foto2',1),
								('foto3',1),
								('foto4',1),
								('foto5',1),
								('foto6',1)



---------B6--------- gebruikers mogen niet bieden op hun voorwerpen. 
----test/ Mohammad heeft voorwerp 1 ter verkoop aangeboden hij wil een bod doen op zijn voorwerp.
--- lukt niet---
insert into tbl_Bod values (1, 12.32, 'Mohammad', '01-01-2020', '12:20:01')

----test/ Obe heeft voorwerp 2 ter verkoop aangeboden en hij wil een bod doen op zijn voorwerp.
--- lukt niet---
insert into tbl_Bod values (2, 12.32, 'Obe', '01-01-2020', '12:20:01') 


----test/ Mohammad een bod doen op het voorwerp van Obe en Obe mag ook een bod doen op het voorwerp 
-- van Mohammad.
--- lukt wel---
insert into tbl_Bod values (2, 12.32, 'Mohammad', '01-01-2020', '12:20:01')
insert into tbl_Bod values (1, 12.32, 'Obe', '01-01-2020', '12:20:01')




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







--------------------------------------------test A5 ------------------------------------------------------------------
---------WERKT NIET verkoopprijs mag geen null waarde bevatten als er op een voorwerp aangeboden is en de veiling gesloten is. 
UPDATE tbl_Voorwerp 
SET koper = 'Mohammad', looptijd = 4, LooptijdEindeDag = '2020-05-04', veiling_gesloten = 1, verkoopprijs = NULL WHERE voorwerpnummer = 15


 --- WERKT NIET -- verkoop prijs moet gelijk zijn aan het hoogste bod op voorwerp 15
UPDATE tbl_Voorwerp 
SET koper = 'Mohammad', looptijd = 4, LooptijdEindeDag = '2020-05-04', veiling_gesloten = 1, verkoopprijs = 223.44 WHERE voorwerpnummer = 15


-----WERKT WEL ---- verkoop prijs is gelijk aan hoogste bod. 
UPDATE tbl_Voorwerp 
SET koper = 'Mohammad', looptijd = 4, LooptijdEindeDag = '2020-05-04', veiling_gesloten = 1, verkoopprijs = 222.00 WHERE voorwerpnummer = 15

