CREATE DATABASE EenmaalAndermaal

USE EenmaalAndermaal


CREATE TABLE tbl_Vraag ( 
vraagnummer            SMALLINT        NOT NULL IDENTITY(1,1), 
tekst_vraag            CHAR(30)        NOT NULL, 

CONSTRAINT PK_VRAAG PRIMARY KEY (vraagnummer)
) 
go 


CREATE TABLE tbl_Gebruiker ( 
gebruikersnaam        CHAR(20)			 NOT NULL, 
voornaam			  VARCHAR(30)        NOT NULL, 
achternaam            VARCHAR(30)        NOT NULL, 
adresregel1           VARCHAR(50)        NOT NULL, 
adresregel2           VARCHAR(50)        NULL,
postcode		      CHAR(6)            NOT NULL,
plaatsnaam            VARCHAR(85)        NOT NULL,
land				  VARCHAR(30)        NOT NULL, 
geboorteDag           DATE				 NOT NULL, 
mailbox               CHAR(30)		     NOT NULL, 
wachtwoord            CHAR(30)           NOT NULL, 
vraag                 SMALLINT           NOT NULL, 
antwoord_text         VARCHAR(30)        NOT NULL, 
verkoper			  BIT                NOT NULL,

CONSTRAINT PK_GEBRUIKER PRIMARY KEY (gebruikersnaam),
CONSTRAINT FK_GEBRUIKER_VRAAG FOREIGN KEY (vraag) REFERENCES tbl_Vraag(vraagnummer), 
) 
go   


CREATE TABLE tbl_Verkoper( 
gebruiker            CHAR(20)        NOT NULL, 
bank				 CHAR(15)        NULL, 
bankrekening		 CHAR(34)        NULL,
controle_Optie       CHAR(10)        NOT NULL, 
creditcard           CHAR(19)        NULL,

CONSTRAINT PK_VERKOPER PRIMARY KEY (gebruiker),
CONSTRAINT FK_VERKOPER_GEBRUIKER FOREIGN KEY (gebruiker) REFERENCES tbl_Gebruiker(gebruikersnaam),
) 
go 


CREATE TABLE tbl_Voorwerp (
voorwerpnummer			INT				NOT NULL IDENTITY(1,1),
titel					VARCHAR(30)		NOT NULL,
beschrijving			VARCHAR(500)	NOT NULL,
startprijs				NUMERIC(7,2)	NOT NULL,
betalingswijze			VARCHAR(25)		NOT NULL,
betalingsinstructie		VARCHAR(50)		NULL,
plaatsnaam				VARCHAR(85)		NOT NULL,
land					VARCHAR(30)		NOT NULL,
looptijd				SMALLINT		NOT NULL,
looptijdBeginDag		DATE			NOT NULL,
looptijdBeginTijdstip	TIME			NOT NULL,
verzendkosten			NUMERIC(3,2)	NULL,
verzendinstructies		VARCHAR(30)		NULL,
verkoper				CHAR(20)		NOT NULL,
koper					CHAR(20)		NULL,
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
volgnr                SMALLINT			 NOT NULL  IDENTITY(1,1), 
gebruiker             CHAR(20)			 NOT NULL,
telefoon              INT			     NOT NULL, 

CONSTRAINT PK_GEBRUIKERSTELEFOON PRIMARY KEY (volgnr, gebruiker), 
CONSTRAINT FK_GEBRUIKERSTELEFOON_GEBRUIKER FOREIGN KEY (gebruiker) REFERENCES tbl_Gebruiker(gebruikersnaam)
)
go


CREATE TABLE tbl_Bod (
voorwerp			    INT				NOT NULL,
bodbedrag			    NUMERIC(7,2)	NOT NULL,
gebruiker				CHAR(20)		NOT NULL,
boddag					DATE			NOT NULL,
bodtijdstip				TIME			NOT NULL,

CONSTRAINT PK_BOD PRIMARY KEY (voorwerp, bodbedrag),
CONSTRAINT FK_BOD_GEBRUIKER FOREIGN KEY (gebruiker) REFERENCES tbl_Gebruiker (gebruikersnaam),
CONSTRAINT FK_BOD_VOORWERP FOREIGN KEY (voorwerp) REFERENCES tbl_Voorwerp (voorwerpnummer)
)
go


CREATE TABLE tbl_Bestand (
filenaam				CHAR(13)		NOT NULL,
voorwerp				INT				NOT NULL,

CONSTRAINT PK_BESTAND PRIMARY KEY (filenaam),
CONSTRAINT FK_BESTAND_VOORWERP FOREIGN KEY (voorwerp) REFERENCES tbl_Voorwerp (voorwerpnummer)
)
go


CREATE TABLE tbl_Feedback (
voorwerp				INT				NOT NULL,
soort_gebruiker			CHAR(9)			NOT NULL,
feedbacksoort			CHAR(8)			NOT NULL,
dag						DATE			NOT NULL,
Tijdstip				TIME			NOT NULL,
commentaar				VARCHAR(250)	NULL,

CONSTRAINT PK_FEEDBACK PRIMARY KEY (voorwerp, soort_gebruiker),
CONSTRAINT FK_FEEDBACK_VOORWERP FOREIGN KEY (voorwerp) REFERENCES tbl_Voorwerp (voorwerpnummer)
)
go


CREATE TABLE tbl_Rubriek( 
rubrieknummer			TINYINT			 NOT NULL  IDENTITY(1,1), 
rubrieknaam			    CHAR(24)         NOT NULL, 
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
