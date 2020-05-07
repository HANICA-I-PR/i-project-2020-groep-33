

USE iproject33
--USE EenmaalAndermaal



DROP TABLE IF EXISTS tbl_Bestand
DROP TABLE IF EXISTS tbl_Bod
DROP TABLE IF EXISTS tbl_Voorwerp_in_rubriek
DROP TABLE IF EXISTS tbl_Rubriek
DROP TABLE IF EXISTS tbl_Feedback
DROP TABLE IF EXISTS tbl_Gebruikerstelefoon
DROP TABLE IF EXISTS tbl_Voorwerp
DROP TABLE IF EXISTS tbl_Verkoper
DROP TABLE IF EXISTS tbl_Gebruiker
DROP TABLE IF EXISTS tbl_Vraag





CREATE TABLE tbl_Vraag ( 
vraagnummer            SMALLINT        NOT NULL IDENTITY(1,1), 
tekst_vraag            VARCHAR(100)        NOT NULL, 

CONSTRAINT PK_VRAAG PRIMARY KEY (vraagnummer)
) 
go 


CREATE TABLE tbl_Gebruiker ( 
gebruikersnaam        VARCHAR(15)		 NOT NULL, 
voornaam			  VARCHAR(50)        NOT NULL, --https://www.nrc.nl/nieuws/2010/12/03/en-de-langste-voornaam-is-11976809-a1115518
achternaam            VARCHAR(58)        NOT NULL, --https://nl.wikipedia.org/wiki/Lijst_van_langste_achternamen_van_Nederland
adresregel1           VARCHAR(55)        NOT NULL, --https://www.ad.nl/arnhem/dit-is-de-langste-straatnaam-van-nederland~a949de59/?referrer=https://www.google.com/
adresregel2           VARCHAR(55)        NULL,
postcode		      VARCHAR(10)        NOT NULL, --https://nl.wikipedia.org/wiki/Postcode
plaatsnaam            VARCHAR(28)        NOT NULL, --https://www.allesopeenrij.nl/cultuur-2/hollanders/langste-plaatsnamen-nederland/
land				  VARCHAR(30)        NOT NULL, --https://nl.wikipedia.org/wiki/Lijst_van_landen_in_2020
geboorteDag           DATE				 NOT NULL, 
email                 VARCHAR(50)		     NOT NULL, 
wachtwoord            CHAR(40)           NOT NULL, 
vraag                 SMALLINT           NOT NULL, 
antwoord_text         VARCHAR(30)        NOT NULL, 
verkoper			  BIT                NOT NULL DEFAULT 0,

CONSTRAINT PK_GEBRUIKER PRIMARY KEY (gebruikersnaam),
CONSTRAINT FK_GEBRUIKER_VRAAG FOREIGN KEY (vraag) REFERENCES tbl_Vraag(vraagnummer), 
) 
go   


CREATE TABLE tbl_Verkoper( 
gebruiker            VARCHAR(15)		 NOT NULL, 
bank				 VARCHAR(35)		 NULL, --https://nl.wikipedia.org/wiki/Lijst_van_Nederlandse_banken
bankrekening		 CHAR(34)			 NULL, --https://nl.wikipedia.org/wiki/International_Bank_Account_Number
controle_Optie       VARCHAR(10)			 NOT NULL, --Creditcard of Post
creditcard           CHAR(16)			 NULL, --https://www.creditcard.nl/faq/creditcardnummer

CONSTRAINT PK_VERKOPER PRIMARY KEY (gebruiker),
CONSTRAINT FK_VERKOPER_GEBRUIKER FOREIGN KEY (gebruiker) REFERENCES tbl_Gebruiker(gebruikersnaam),
) 
go 


CREATE TABLE tbl_Voorwerp (
voorwerpnummer			INT				NOT NULL IDENTITY(1,1) ,
titel					VARCHAR(255)	NOT NULL,
beschrijving			VARCHAR(800)	NOT NULL,
startprijs				NUMERIC(7,2)	NOT NULL, --7 cijfers voor de komma, maximaal bedrag is dan 9.999.999,99 euro
betalingswijze			VARCHAR(10)		NOT NULL, --Bank/Giro, Contant, iDeal, PayPal, Creditcard
betalingsinstructie		VARCHAR(50)		NULL,
plaatsnaam				VARCHAR(28)		NOT NULL,
land					VARCHAR(30)		NOT NULL,
looptijd				TINYINT		    NOT NULL DEFAULT 7,
looptijdBeginDag		DATE			NOT NULL,
looptijdBeginTijdstip	TIME			NOT NULL,
verzendkosten			NUMERIC(3,2)	NULL, --maximaal 999,99 verzendkosten
verzendinstructies		VARCHAR(30)		NULL, 
verkoper				VARCHAR(15)		NOT NULL,
koper					VARCHAR(15)		NULL,
LooptijdEindeDag		DATE			NOT NULL,
looptijdEindeTijdstip	TIME			NOT NULL,
veiling_gesloten		BIT				NOT NULL,
verkoopprijs			NUMERIC(7,2)	NULL,

CONSTRAINT PK_VOORWERP PRIMARY KEY (voorwerpnummer),
CONSTRAINT FK_VOORWERP_VERKOPER FOREIGN KEY (verkoper) REFERENCES tbl_Verkoper (gebruiker),
CONSTRAINT FK_VOORWERP_GEBRUIKER FOREIGN KEY (koper) REFERENCES tbl_Gebruiker (gebruikersnaam)
)
go


CREATE TABLE tbl_Gebruikerstelefoon ( 
volgnr                INT			 NOT NULL  IDENTITY(0,1), 
gebruiker             VARCHAR(15)			 NOT NULL,
telefoon              VARCHAR(15)			     NOT NULL, --https://stackoverflow.com/questions/75105/what-datatype-should-be-used-for-storing-phone-numbers-in-sql-server-2005

CONSTRAINT PK_GEBRUIKERSTELEFOON PRIMARY KEY (volgnr, gebruiker), 
CONSTRAINT FK_GEBRUIKERSTELEFOON_GEBRUIKER FOREIGN KEY (gebruiker) REFERENCES tbl_Gebruiker(gebruikersnaam)
)
go


CREATE TABLE tbl_Bod (
voorwerp			    INT				NOT NULL,
bodbedrag			    NUMERIC(7,2)	NOT NULL,
gebruiker				VARCHAR(15)		NOT NULL,
boddag					DATE			NOT NULL,
bodtijdstip				TIME			NOT NULL,

CONSTRAINT PK_BOD PRIMARY KEY (voorwerp, bodbedrag),
CONSTRAINT FK_BOD_GEBRUIKER FOREIGN KEY (gebruiker) REFERENCES tbl_Gebruiker (gebruikersnaam),
CONSTRAINT FK_BOD_VOORWERP FOREIGN KEY (voorwerp) REFERENCES tbl_Voorwerp (voorwerpnummer)
)
go


CREATE TABLE tbl_Bestand (
filenaam				VARCHAR(50)		NOT NULL,
voorwerp				INT				NOT NULL,

CONSTRAINT PK_BESTAND PRIMARY KEY (filenaam),
CONSTRAINT FK_BESTAND_VOORWERP FOREIGN KEY (voorwerp) REFERENCES tbl_Voorwerp (voorwerpnummer)
)
go


CREATE TABLE tbl_Feedback (
voorwerp				INT				NOT NULL,
soort_gebruiker			VARCHAR(9)			NOT NULL, --koper/verkoper
feedbacksoort			CHAR(8)			NOT NULL, --negatief/neutraal/positief
dag						DATE			NOT NULL,
tijdstip				TIME			NOT NULL,
commentaar				VARCHAR(280)	NULL, --https://www.ad.nl/binnenland/twitter-maximale-lengte-tweet-definitief-naar-280-tekens~af9256df/

CONSTRAINT PK_FEEDBACK PRIMARY KEY (voorwerp, soort_gebruiker),
CONSTRAINT FK_FEEDBACK_VOORWERP FOREIGN KEY (voorwerp) REFERENCES tbl_Voorwerp (voorwerpnummer)
)
go


CREATE TABLE tbl_Rubriek( 
rubrieknummer			TINYINT			 NOT NULL  IDENTITY(1,1), 
rubrieknaam			    VARCHAR(50)      NOT NULL, 
rubriek                 TINYINT          NULL,
volgnr                  TINYINT          NOT NULL, 

CONSTRAINT PK_RUBRIEK PRIMARY KEY (rubrieknummer), 
CONSTRAINT FK_RUBRIEK_RUBRIEK FOREIGN KEY (rubriek) REFERENCES tbl_Rubriek(rubrieknummer)
) 
go
 
 
 
CREATE TABLE tbl_Voorwerp_in_rubriek( 
voorwerp					INT            NOT NULL, 
rubriek_op_laagste_niveau   TINYINT        NOT NULL, 

CONSTRAINT PK_VOORWERPINRUBRIEK PRIMARY KEY (voorwerp, rubriek_op_laagste_niveau),
CONSTRAINT FK_VOORWERPINRUBRIEK_VOORWERP FOREIGN KEY (voorwerp) REFERENCES tbl_Voorwerp(voorwerpnummer),
CONSTRAINT FK_VOORWERPINRUBRIEK_RUBRIEK FOREIGN KEY (rubriek_op_laagste_niveau) REFERENCES tbl_Rubriek(rubrieknummer)
)
go


--------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 
 --CHECKS EN CONSTRAINTS--
 
-------B1-------- 

DROP FUNCTION IF EXISTS dbo.verkoper_is_verkoper;

GO 

CREATE FUNCTION dbo.verkoper_is_verkoper (@gebruiker CHAR(20))
RETURNS BIT
AS 
BEGIN 
    
RETURN CASE WHEN EXISTS( SELECT gebruikersnaam FROM tbl_Gebruiker WHERE gebruikersnaam=@gebruiker AND verkoper = 1)
    THEN 1 
    ELSE 0
    END
END
go 



ALTER TABLE  tbl_Verkoper 
ADD CONSTRAINT CK_Verkoper_Gebruiker 
CHECK(dbo.verkoper_is_verkoper(gebruiker) = 1)
go  




--------B2--------- 
----------Deze constraint 1 om het volgende te checken: als er iemand voor Credicard heeft gekozen
---- Dan moet hij een creditcardnummer invoeren 

alter table tbl_Verkoper 
add Constraint CK_controleOptie_Creditcard
check ((creditcard IS NOT NULL and controle_Optie = 'Creditcard') 
          OR (creditcard IS NULL and controle_Optie != 'Creditcard'))
go



  
---------B3---------
---er moet of een creditcardnummer ingevoerd worden of een bankrekeningnummer
-- beide niet invoeren mag niet. beide invoeren mag wel. 
alter table tbl_Verkoper
add constraint CK_Bankrekening_Creditcard 
check (( bankrekening IS NOT NULL and creditcard IS NULL) or 
      ( bankrekening IS NULL and creditcard IS NOT NULL) or 
	  ( bankrekening IS NOT NULL and creditcard IS NOT NULL))
go




-------B4-------- er mogen max 4 afbeeldingen voor 1 voorwerp opgeslagen worden. 
/*ALTER TABLE tbl_Bestand DROP CONSTRAINT CK_voorwerp_filenaam
DROP FUNCTION dbo.bepaalAantal_filenames_perVoorwerp*/

DROP FUNCTION IF EXISTS dbo.bepaalAantal_filenames_perVoorwerp;

GO 
CREATE FUNCTION dbo.bepaalAantal_filenames_perVoorwerp()
RETURNS BIT
AS 
BEGIN 
    
RETURN CASE WHEN EXISTS( SELECT count(filenaam)
                      FROM tbl_Bestand  GROUP BY  Voorwerp HAVING COUNT(filenaam) > 4)
    THEN 1
    ELSE 0
    END
 
END
go



ALTER TABLE tbl_Bestand
ADD CONSTRAINT CK_voorwerp_filenaam CHECK(dbo.bepaalAantal_filenames_perVoorwerp() = 0)
go


----------B5--------- Nieuw bod moet hoger zijn, en minimale verhoging per bedrag moet kloppen volgens Appendix B, proces 3.1
ALTER TABLE tbl_Bod DROP CONSTRAINT IF EXISTS CK_hoger_bod


--functie voor returnen van hoogste bod
DROP FUNCTION IF EXISTS dbo.geef_hoogste_bod;
go
CREATE FUNCTION geef_hoogste_bod (@bodbedrag NUMERIC(7,2), @voorwerp INT)
RETURNS NUMERIC(7,2)
AS
BEGIN
RETURN (SELECT MAX(bodbedrag) AS hoogstebod
		FROM tbl_Bod 
		WHERE voorwerp = @voorwerp AND bodbedrag != @bodbedrag
		GROUP BY voorwerp)
END
go




--De eerste functie controleert of een eerste bod hoger is dan de startprijs
DROP FUNCTION IF EXISTS dbo.bod_is_hoger;
go
CREATE FUNCTION dbo.bod_is_hoger(@bodbedrag NUMERIC(7,2), @voorwerp INT)
RETURNS BIT
AS
BEGIN

	DECLARE @minBedrag numeric(7, 2)

	IF 
		((SELECT COUNT(*) AS aantal FROM tbl_bod WHERE voorwerp = @voorwerp) = 1)
	BEGIN
		SET @minBedrag = (SELECT startprijs FROM tbl_Voorwerp WHERE voorwerpnummer = @voorwerp)--.. select startbedrag from tbl_voorwerp
	END
	ELSE
	BEGIN
		SET @minBedrag = dbo.geef_hoogste_bod(@bodbedrag, @voorwerp)--  .. selecteer het hoogste bedrag tot nu toe
	END

	-- pas verhogingen toe
	DECLARE @verhoogdBedrag numeric(5,2)
	IF (@minBedrag > 1.0 AND @minBedrag < 50) 
	BEGIN
		SET @verhoogdBedrag = 0.49
	END
	ELSE IF (@minBedrag >= 50 AND @minBedrag < 500)
	BEGIN
		SET @verhoogdBedrag = 0.99
	END
	ELSE IF (@minBedrag >= 500 AND @minBedrag < 1000)
	BEGIN
		SET @verhoogdBedrag = 4.99
	END
	ELSE IF (@minBedrag >=1000 AND @minBedrag <5000)
	BEGIN
		SET @verhoogdBedrag = 9.99
	END
	ELSE IF (@minBedrag >= 5000)
	BEGIN
		SET @verhoogdBedrag = 49.99
	END


	SET @minBedrag = @minBedrag + @verhoogdBedrag

	-- ..check of bod goed is


RETURN CASE WHEN (@bodbedrag > @minBedrag)
				 THEN 1
				 ELSE 0
				 END
END
go



ALTER TABLE tbl_Bod 
ADD CONSTRAINT CK_hoger_bod CHECK (dbo.bod_is_hoger(bodbedrag, voorwerp) = 1)
go




---------B6--------- gebruikers mogen niet bieden op hun voorwerpen. 
DROP FUNCTION dbo.bepaal_Bod; 

GO 

CREATE FUNCTION dbo.bepaal_Bod(@voorwerp INT, @gebruiker CHAR(20))
RETURNS BIT
AS 
BEGIN 
    
RETURN CASE WHEN EXISTS( SELECT voorwerpnummer, koper
            		  FROM tbl_Voorwerp where voorwerpnummer = @voorwerp and  verkoper = @gebruiker)
    THEN 1 
    ELSE 0
    END
END

go

ALTER TABLE tbl_Bod 
add constraint CK_Bod_Gebruiker CHECK ((dbo.bepaal_Bod(voorwerp, gebruiker)) = 0)  

go 



--------------------------------------------------------------------------------

/*CREATE FUNCTION getRubrieknummer(@rubriek CHAR(24))
RETURNS TINYINT AS
BEGIN

RETURN (SELECT rubrieknummer FROM tbl_Rubriek WHERE rubrieknaam = @rubriek)

END
go*/


-------------------------------AF 1-------------------------------------------
DROP FUNCTION  LooptijdbeginDag_Plus_het_aantal_dagen; 

GO 
CREATE FUNCTION  LooptijdbeginDag_Plus_het_aantal_dagen() 
RETURNS BIT
AS 
BEGIN 
    
RETURN CASE WHEN EXISTS( SELECT *
              FROM  tbl_Voorwerp WHERE DATEDIFF(DAY, looptijdBeginDag, LooptijdEindeDag) = looptijd)
    THEN 1 
    ELSE 0
    END
 
END

go



ALTER TABLE tbl_Voorwerp
ADD CONSTRAINT CK_LooptijdBeginDag_plus_looptijd CHECK (dbo.LooptijdbeginDag_Plus_het_aantal_dagen() = 1)

go 




--------------------------------AF 2-----------------------------------------

ALTER TABLE tbl_Voorwerp
ADD CONSTRAINT CK_LooptijdeindeTijdstip_Is_GelijkAan_LooptijdBeginTijdstip
                                         CHECK( looptijdBeginTijdstip = looptijdEindeTijdstip)




-------------------------------AF 3------------------------------
DROP FUNCTION  CHECK_TIJD; 

GO 

CREATE FUNCTION  CHECK_TIJD(@voorwerpnummer INT) 
RETURNS DATE
AS 
BEGIN 
    
RETURN  ( SELECT CAST(LooptijdEindeDag as datetime ) + CAST (looptijdEindeTijdstip as datetime ) 
   FROM  tbl_Voorwerp WHERE voorwerpnummer = @voorwerpnummer ) 
  
END

GO 


ALTER TABLE tbl_Voorwerp
ADD CONSTRAINT CK_VeilingGesloten CHECK ( ( getDate() < dbo.CHECK_TIJD(voorwerpnummer)  and veiling_gesloten = 0) OR 
                                     ( getDate() > dbo.CHECK_TIJD(voorwerpnummer)  and veiling_gesloten = 1));  
GO 




------------------------------------AF 4--------------------------

DROP FUNCTION IF EXISTS dbo.bod_op_eenVoorwerp
DROP FUNCTION IF EXISTS dbo.controleer_koper

GO 

CREATE FUNCTION bod_op_eenVoorwerp (@voorwerp INT) 
RETURNS BIT 
BEGIN 
RETURN CASE WHEN EXISTS ( SELECT * FROM tbl_Bod WHERE voorwerp = @voorwerp) 
  THEN 1 
  ELSE 0 
   END 
END 

GO 

CREATE FUNCTION controleer_koper (@voorwerp INT) 
RETURNS BIT
BEGIN 
RETURN CASE WHEN EXISTS (SELECT koper FROM tbl_Voorwerp WHERE koper IN (  
        SELECT gebruiker FROM tbl_Bod WHERE bodbedrag  IN (SELECT MAX(bodbedrag) FROM tbl_Bod WHERE voorwerp = @voorwerp) AND 
		   voorwerp = @voorwerp) AND 
		 voorwerpnummer = @voorwerp)
		THEN 1 
		ELSE 0 
		END 
END 


GO 

ALTER TABLE tbl_Voorwerp 
ADD CONSTRAINT CK_koper_is_deKoper CHECK 
( ( koper IS NULL AND veiling_gesloten = 0) 

OR ( dbo.controleer_koper(voorwerpnummer) = 1 AND veiling_gesloten = 1 AND dbo.bod_op_eenVoorwerp(voorwerpnummer) = 1))

GO 




--------------------------------------------------AF 5--------------------------------
DROP FUNCTION IF EXISTS controleer_eindbedrag


GO 

CREATE FUNCTION controleer_eindbedrag (@voorwerp INT) 
RETURNS BIT
BEGIN 
RETURN CASE WHEN EXISTS (SELECT verkoopprijs FROM tbl_Voorwerp WHERE verkoopprijs IN (  
        SELECT bodbedrag FROM tbl_Bod WHERE bodbedrag  IN (SELECT MAX(bodbedrag) FROM tbl_Bod WHERE voorwerp = @voorwerp) AND 
		   voorwerp = @voorwerp) AND 
		 voorwerpnummer = @voorwerp)
		THEN 1 
		ELSE 0 
		END 
END 

GO 

GO 

ALTER TABLE tbl_Voorwerp 
ADD CONSTRAINT CK_verkoopPrijs_Veiling CHECK ( (verkoopprijs IS NULL AND veiling_gesloten = 0) 
                                         
OR ( dbo.controleer_eindbedrag(voorwerpnummer) = 1 AND veiling_gesloten = 1 AND dbo.bod_op_eenVoorwerp(voorwerpnummer) = 1))

GO 

