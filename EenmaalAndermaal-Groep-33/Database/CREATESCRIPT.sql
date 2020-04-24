USE EenmaalAndermaal



DROP TABLE tbl_Bestand
DROP TABLE tbl_Bod
DROP TABLE tbl_Voorwerp_in_rubriek
DROP TABLE tbl_Rubriek
DROP TABLE tbl_Feedback
DROP TABLE tbl_Gebruikerstelefoon
DROP TABLE tbl_Voorwerp
DROP TABLE tbl_Verkoper
DROP TABLE tbl_Gebruiker
DROP TABLE tbl_Vraag





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
email                 CHAR(50)		     NOT NULL, 
wachtwoord            CHAR(30)           NOT NULL, 
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
controle_Optie       CHAR(10)			 NOT NULL, --Creditcard of Post
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
betalingswijze			CHAR(9)		NOT NULL, --Bank/Giro, Contant, iDeal, PayPal, Creditcard
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
volgnr                INT			 NOT NULL  IDENTITY(1,1), 
gebruiker             VARCHAR(15)			 NOT NULL,
telefoon              CHAR(15)			     NOT NULL, --https://stackoverflow.com/questions/75105/what-datatype-should-be-used-for-storing-phone-numbers-in-sql-server-2005

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
soort_gebruiker			CHAR(9)			NOT NULL, --koper/verkoper
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

IF OBJECT_ID('dbo.[CK_Verkoper_Gebruiker]') IS NOT NULL ALTER TABLE tbl_Verkoper DROP CONSTRAINT CK_Verkoper_Gebruiker;

IF OBJECT_ID ('dbo.verkoper_is_verkoper') IS NOT NULL  
-- deletes function  
    DROP FUNCTION dbo.verkoper_is_verkoper;  
ELSE

ALTER TABLE  tbl_Verkoper 
ADD CONSTRAINT CK_Verkoper_Gebruiker 
CHECK(dbo.verkoper_is_verkoper(gebruiker) = 1)
go  

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

IF OBJECT_ID('dbo.[CK_voorwerp_filenaam]') IS NOT NULL ALTER TABLE tbl_Bestand DROP CONSTRAINT CK_voorwerp_filenaam;

IF OBJECT_ID ('dbo.bepaalAantal_filenames_perVoorwerp') IS NOT NULL  
-- deletes function  
    DROP FUNCTION dbo.bepaalAantal_filenames_perVoorwerp;  
ELSE



ALTER TABLE tbl_Bestand
ADD CONSTRAINT CK_voorwerp_filenaam CHECK(dbo.bepaalAantal_filenames_perVoorwerp() = 0)
go

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



---------B6--------- gebruikers mogen niet bieden op hun voorwerpen. 

IF OBJECT_ID('dbo.[CK_Bod_Gebruiker]') IS NOT NULL ALTER TABLE tbl_Bod DROP CONSTRAINT CK_Bod_Gebruiker;

IF OBJECT_ID ('dbo.bepaal_Bod') IS NOT NULL  
-- deletes function  
    DROP FUNCTION dbo.bepaal_Bod;  
ELSE


ALTER TABLE tbl_Bod 
add constraint CK_Bod_Gebruiker CHECK ((dbo.bepaal_Bod(voorwerp, gebruiker)) = 0)  

go 
CREATE FUNCTION dbo.bepaal_Bod(@voorwerp INT, @gebruiker CHAR(20))
RETURNS BIT
AS 
BEGIN 
    
RETURN CASE WHEN EXISTS( SELECT voorwerpnummer, koper
            		  FROM tbl_Voorwerp where voorwerpnummer = @voorwerp and  koper = @gebruiker)
    THEN 1 
    ELSE 0
    END
END

go


--------------------------------------------------------------------------------

/*CREATE FUNCTION getRubrieknummer(@rubriek CHAR(24))
RETURNS TINYINT AS
BEGIN

RETURN (SELECT rubrieknummer FROM tbl_Rubriek WHERE rubrieknaam = @rubriek)

END
go*/


-------------------------------AF 1-------------------------------------------

ALTER TABLE tbl_Voorwerp
--DROP CONSTRAINT LooptijdbeginDag_Plus_looptijd
ADD CONSTRAINT LooptijdbeginDag_Plus_looptijd CHECK (dbo.LooptijdbeginDag_Plus_het_aantal_dagen() = 1)

go 


CREATE FUNCTION  LooptijdbeginDag_Plus_het_aantal_dagen() 
RETURNS INT
AS 
BEGIN 
    
RETURN CASE WHEN EXISTS( SELECT *
              FROM  tbl_Voorwerp WHERE DATEDIFF(DAY, looptijdBeginDag, LooptijdEindeDag) = looptijd)
    THEN 1 
    ELSE 0
    END
 
END

go


--------------------------------AF 2-----------------------------------------
ALTER TABLE tbl_Voorwerp
ADD CONSTRAINT LooptijdeindeTijdstip_Is_GelijkAan_LooptijdBeginTijdstip
                                         CHECK( looptijdBeginTijdstip = looptijdEindeTijdstip)




-------------------------------AF 3------------------------------

ALTER TABLE tbl_Voorwerp
ADD CONSTRAINT CK_VeilingGesloten CHECK ( ( getDate() < dbo.CHECK_TIJD(voorwerpnummer)  and veiling_gesloten = 0) OR 
                                     ( getDate() > dbo.CHECK_TIJD(voorwerpnummer)  and veiling_gesloten = 1));  
GO 

CREATE FUNCTION  CHECK_TIJD(@voorwerpnummer INT) 
RETURNS DATE
AS 
BEGIN 
    
RETURN  ( SELECT CAST(LooptijdEindeDag as datetime ) + CAST (looptijdEindeTijdstip as datetime ) 
   FROM  tbl_Voorwerp WHERE voorwerpnummer = @voorwerpnummer ) 
  
END

GO 


/*------------------------------------AF 4--------------------------

ALTER TABLE tbl_Voorwerp 
ADD CONSTRAINT CK_CHECK_KOPER CHECK ( ( koper IS NULL ) OR 
                                 koper IS NOT NULL AND  dbo.geef_GebruikersNaamTerug(koper) = 1) 




GO
CREATE FUNCTION  geef_GebruikersNaamTerug(@gebruiker VARCHAR(15)) 
RETURNS INT
AS 
BEGIN 
    
RETURN CASE WHEN EXISTS( SELECT MAX(bodbedrag) FROM tbl_Bod where gebruiker = @gebruiker) 
    THEN 1 
    ELSE 0
    END
 
END

go




--AF 5--
IF OBJECT_ID('dbo.[CK_verkoopprijs]') IS NOT NULL ALTER TABLE tbl_Voorwerp DROP CONSTRAINT CK_verkoopprijs;
ELSE

ALTER TABLE tbl_Voorwerp 
ADD CONSTRAINT CK_verkoopprijs CHECK((verkoopprijs IS NULL AND koper IS NULL) OR (verkoopprijs IS NOT NULL AND koper IS NOT NULL))*/