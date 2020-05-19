USE EenmaalAndermaal

-------------------------------------------------------INSERT van tabel Categorieen---------------------------------------------
ALTER TABLE tbl_Rubriek
DROP CONSTRAINT IF EXISTS df_volgnr
go
ALTER TABLE tbl_Rubriek
ADD CONSTRAINT df_volgnr DEFAULT '0' FOR volgnr;
go


SET IDENTITY_INSERT tbl_Rubriek ON

INSERT INTO tbl_Rubriek(rubrieknummer, rubrieknaam, rubriek)
SELECT DISTINCT CAST(ID AS INT) AS rubrieknummer,
    LEFT(Name, 50) AS rubrieknaam,
    CAST(Parent AS INT) AS rubriek
FROM databatch.dbo.Categorieen



------------------------------------------------------INSERT van tabel Users----------------------------------------------------
go
ALTER TABLE tbl_Gebruiker
DROP CONSTRAINT IF EXISTS df_voornaam
go
ALTER TABLE tbl_Gebruiker
ADD CONSTRAINT df_voornaam DEFAULT 'onbekend' FOR voornaam;


go
ALTER TABLE tbl_Gebruiker
DROP CONSTRAINT IF EXISTS df_achternaam
go
ALTER TABLE tbl_Gebruiker
ADD CONSTRAINT df_achternaam DEFAULT 'onbekend' FOR achternaam;


go
ALTER TABLE tbl_Gebruiker
DROP CONSTRAINT IF EXISTS df_adresregel1
go
ALTER TABLE tbl_Gebruiker
ADD CONSTRAINT df_adresregel1 DEFAULT 'onbekend' FOR adresregel1;


go
ALTER TABLE tbl_Gebruiker
DROP CONSTRAINT IF EXISTS df_adresregel2
go
ALTER TABLE tbl_Gebruiker
ADD CONSTRAINT df_adresregel2 DEFAULT 'onbekend' FOR adresregel2;


go
ALTER TABLE tbl_Gebruiker
DROP CONSTRAINT IF EXISTS df_plaatsnaam
go
ALTER TABLE tbl_Gebruiker
ADD CONSTRAINT df_plaatsnaam DEFAULT 'onbekend' FOR plaatsnaam;


go
ALTER TABLE tbl_Gebruiker
DROP CONSTRAINT IF EXISTS df_geboortedag
go
ALTER TABLE tbl_Gebruiker
ADD CONSTRAINT df_geboortedag DEFAULT '2020-01-01' FOR geboortedag;


go
ALTER TABLE tbl_Gebruiker
DROP CONSTRAINT IF EXISTS df_email
go
ALTER TABLE tbl_Gebruiker
ADD CONSTRAINT df_email DEFAULT 'onbekend' FOR email;


go
ALTER TABLE tbl_Gebruiker
DROP CONSTRAINT IF EXISTS df_wachtwoord
go
ALTER TABLE tbl_Gebruiker
ADD CONSTRAINT df_wachtwoord DEFAULT 'onbekend' FOR wachtwoord;


go
ALTER TABLE tbl_Gebruiker
DROP CONSTRAINT IF EXISTS df_vraag
go
ALTER TABLE tbl_Gebruiker
ADD CONSTRAINT df_vraag DEFAULT '1' FOR vraag;


go
ALTER TABLE tbl_Gebruiker
DROP CONSTRAINT IF EXISTS df_antwoord_text
go
ALTER TABLE tbl_Gebruiker
ADD CONSTRAINT df_antwoord_text DEFAULT 'onbekend' FOR antwoord_text;

INSERT INTO tbl_Vraag VALUES ('placeholder');



INSERT INTO EenmaalAndermaal.dbo.tbl_Gebruiker(gebruikersnaam, postcode, land, verkoper)
SELECT DISTINCT LEFT(username, 30) AS gebruikersnaam,
    LEFT(Postalcode, 10) AS postcode,
    LEFT(Location, 30) AS land,
	1
FROM databatch.dbo.Users

----------------------------------------------------------INSERT in tabel verkoper-------------------------------------------------------------
go
ALTER TABLE tbl_Verkoper
DROP CONSTRAINT IF EXISTS df_bank
go
ALTER TABLE tbl_Verkoper
ADD CONSTRAINT df_bank DEFAULT 'onbekend' FOR bank
go


ALTER TABLE tbl_Verkoper
DROP CONSTRAINT IF EXISTS df_bankrekening
go
ALTER TABLE tbl_Verkoper
ADD CONSTRAINT df_bankrekening DEFAULT 'onbekend' FOR bankrekening
go


ALTER TABLE tbl_Verkoper
DROP CONSTRAINT IF EXISTS df_controle_optie
go
ALTER TABLE tbl_Verkoper
ADD CONSTRAINT df_controle_optie DEFAULT 'creditcard' FOR controle_Optie
go


ALTER TABLE tbl_Verkoper
DROP CONSTRAINT IF EXISTS df_creditcard
go
ALTER TABLE tbl_Verkoper
ADD CONSTRAINT df_creditcard DEFAULT 'onbekend' FOR creditcard
go


INSERT INTO tbl_Verkoper (gebruiker) 
SELECT gebruikersnaam FROM tbl_Gebruiker AS gebruiker


-------------------------------------------------------------INSERT van tabel Items------------------------------------------------------------

go
ALTER TABLE tbl_Voorwerp
DROP CONSTRAINT IF EXISTS df_betalingswijze;
go
ALTER TABLE tbl_Voorwerp
ADD CONSTRAINT df_betalingswijze DEFAULT 'onbekend' FOR betalingswijze;
go

ALTER TABLE tbl_Voorwerp
DROP CONSTRAINT IF EXISTS df_plaatsnaamvoorwerp;
go
ALTER TABLE tbl_Voorwerp
ADD CONSTRAINT df_plaatsnaamvoorwerp DEFAULT 'onbekend' FOR plaatsnaam;
go

ALTER TABLE tbl_Voorwerp
DROP CONSTRAINT IF EXISTS df_startprijs;
go
ALTER TABLE tbl_Voorwerp
ADD CONSTRAINT df_startprijs DEFAULT 0.0 FOR startprijs;
go



/*
DROP TRIGGER IF EXISTS auto_einddatum
go
CREATE TRIGGER auto_einddatum ON tbl_Voorwerp
INSTEAD OF INSERT 
AS
BEGIN

INSERT INTO EenmaalAndermaal.dbo.tbl_Voorwerp	(titel, beschrijving, startprijs, betalingswijze, betalingsinstructie,
												plaatsnaam, land, looptijd, looptijdBeginDag, looptijdBeginTijdstip, 
												verzendkosten, verzendinstructies, verkoper, koper, LooptijdEindeDag, 
												looptijdEindeTijdstip, veiling_gesloten, verkoopprijs)
										
												SELECT	titel, beschrijving, startprijs, betalingswijze, betalingsinstructie,
														plaatsnaam, land, looptijd, looptijdBeginDag, looptijdBeginTijdstip, 
														verzendkosten, verzendinstructies, verkoper, koper, DATEADD(day, looptijd,looptijdBeginDag), 
														looptijdEindeTijdstip, veiling_gesloten, verkoopprijs
												FROM inserted

END
go
*/


SET IDENTITY_INSERT tbl_Rubriek OFF
SET IDENTITY_INSERT tbl_Voorwerp ON

INSERT INTO tbl_Voorwerp(voorwerpnummer, titel, beschrijving, startprijs, land, looptijd, LooptijdEindeDag, verkoper)
SELECT CAST(ID AS BIGINT) AS voorwerpnummer,
LEFT(Items.Titel, 255) AS titel,
LEFT(Items.Beschrijving, 800) AS beschrijving,
CAST(Items.Prijs AS NUMERIC(7,2)) AS startprijs,
LEFT(Items.Locatie, 30) AS land,
7 AS looptijd,
getdate()+7 AS looptijdEindeDag,
LEFT(Items.Verkoper, 30) AS Verkoper
FROM databatch.dbo.Items


 
 -----------------------------------------------------INSERT van tabel illustraties---------------------------------------------

INSERT INTO tbl_bestand(voorwerp, filenaam)
SELECT CAST(ItemID AS BIGINT) AS voorwerp,
    LEFT(IllustratieFile, 50) AS filenaam
FROM databatch.dbo.Illustraties


/*
CREATE FUNCTION get_4_illustraties_per_item()
RETURNS @newIllustraties TABLE (itemID BIGINT, illustratieFile VARCHAR(50))
AS

DECLARE @i INT = 0;
DECLARE @rowcount INT = (SELECT COUNT(*) AS count FROM databatch.dbo.Illustraties);


WHILE @i < @rowcount
BEGIN
   {
   INSERT INTO @newIllustraties VALUES SELECT TOP 4(illustratieFile), itemID FROM databatch.dbo.Illustraties 
   }
   SET @i = @i + 1;
*/


