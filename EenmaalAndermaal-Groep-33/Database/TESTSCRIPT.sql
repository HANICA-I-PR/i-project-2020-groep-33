USE EenmaalAndermaal



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

----test/ insert hieronder lukt niet. 
INSERT INTO tbl_Verkoper VALUES ('Stan','AbnAmro','937273282','Creditcard', NULL)

------test/dit lukt wel 
INSERT INTO tbl_Verkoper VALUES ('Stan','AbnAmro','937273282','Creditcard', 3434353)

------test/dit lukt wel 
INSERT INTO tbl_Verkoper VALUES ('Stan','AbnAmro','937273282','Post', null)

------test/dit lukt niet 
INSERT INTO tbl_Verkoper VALUES ('Stan','AbnAmro','937273282','Post', 34343434)



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

--AF 5-- voorwerp kan geen verkoopprijs hebben zonder koper en moet wel een verkoopprijs hebben met koper
--lukt wel--
INSERT INTO tbl_Voorwerp VALUES ('test', 'test', 2.00, 'Contant', NULL, 'Nijmegen', 'NL', 7, getdate(), CONVERT(TIME(0), getdate()), NULL, NULL, 'Obe', NULL,
									DATEADD(day, 7, getdate()), CONVERT(time(0), getdate()), 0, NULL)
--lukt niet--
INSERT INTO tbl_Voorwerp VALUES ('test', 'test', 2.00, 'Contant', NULL, 'Nijmegen', 'NL', 7, getdate(), CONVERT(TIME(0), getdate()), NULL, NULL, 'Obe', 'Stan',
									DATEADD(day, 7, getdate()), CONVERT(time(0), getdate()), 0, NULL)