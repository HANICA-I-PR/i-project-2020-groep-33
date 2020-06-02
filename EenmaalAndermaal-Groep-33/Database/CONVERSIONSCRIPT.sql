USE iproject33
--USE EenmaalAndermaal

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
FROM Categorieen

SET IDENTITY_INSERT tbl_rubriek OFF


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



INSERT INTO tbl_Gebruiker(gebruikersnaam, postcode, land, verkoper)
SELECT DISTINCT LEFT(username, 30) AS gebruikersnaam,
    LEFT(Postalcode, 10) AS postcode,
    LEFT(Location, 30) AS land,
	1
FROM Users

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
DROP FUNCTION IF EXISTS stripHTML
go
CREATE FUNCTION stripHTML
--by Patrick Honorez --- www.idevlop.com
--inspired by http://stackoverflow.com/questions/457701/best-way-to-strip-html-tags-from-a-string-in-sql-server/39253602#39253602
(
@HTMLText varchar(MAX)
)
RETURNS varchar(MAX)
AS
BEGIN
DECLARE @Start  int
DECLARE @End    int
DECLARE @Length int

set @HTMLText = replace(@htmlText, '<br>',CHAR(13) + CHAR(10))
set @HTMLText = replace(@htmlText, '<br/>',CHAR(13) + CHAR(10))
set @HTMLText = replace(@htmlText, '<br />',CHAR(13) + CHAR(10))
set @HTMLText = replace(@htmlText, '<li>','- ')
set @HTMLText = replace(@htmlText, '</li>',CHAR(13) + CHAR(10))

set @HTMLText = replace(@htmlText, '&rsquo;' collate Latin1_General_CS_AS, ''''  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&quot;' collate Latin1_General_CS_AS, '"'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&amp;' collate Latin1_General_CS_AS, '&'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&euro;' collate Latin1_General_CS_AS, '€'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&lt;' collate Latin1_General_CS_AS, '<'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&gt;' collate Latin1_General_CS_AS, '>'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&oelig;' collate Latin1_General_CS_AS, 'oe'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&nbsp;' collate Latin1_General_CS_AS, ' '  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&copy;' collate Latin1_General_CS_AS, '©'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&laquo;' collate Latin1_General_CS_AS, '«'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&reg;' collate Latin1_General_CS_AS, '®'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&plusmn;' collate Latin1_General_CS_AS, '±'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&sup2;' collate Latin1_General_CS_AS, '²'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&sup3;' collate Latin1_General_CS_AS, '³'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&micro;' collate Latin1_General_CS_AS, 'µ'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&middot;' collate Latin1_General_CS_AS, '·'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&ordm;' collate Latin1_General_CS_AS, 'º'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&raquo;' collate Latin1_General_CS_AS, '»'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&frac14;' collate Latin1_General_CS_AS, '¼'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&frac12;' collate Latin1_General_CS_AS, '½'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&frac34;' collate Latin1_General_CS_AS, '¾'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&Aelig' collate Latin1_General_CS_AS, 'Æ'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&Ccedil;' collate Latin1_General_CS_AS, 'Ç'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&Egrave;' collate Latin1_General_CS_AS, 'È'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&Eacute;' collate Latin1_General_CS_AS, 'É'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&Ecirc;' collate Latin1_General_CS_AS, 'Ê'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&Ouml;' collate Latin1_General_CS_AS, 'Ö'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&agrave;' collate Latin1_General_CS_AS, 'à'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&acirc;' collate Latin1_General_CS_AS, 'â'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&auml;' collate Latin1_General_CS_AS, 'ä'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&aelig;' collate Latin1_General_CS_AS, 'æ'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&ccedil;' collate Latin1_General_CS_AS, 'ç'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&egrave;' collate Latin1_General_CS_AS, 'è'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&eacute;' collate Latin1_General_CS_AS, 'é'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&ecirc;' collate Latin1_General_CS_AS, 'ê'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&euml;' collate Latin1_General_CS_AS, 'ë'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&icirc;' collate Latin1_General_CS_AS, 'î'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&ocirc;' collate Latin1_General_CS_AS, 'ô'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&ouml;' collate Latin1_General_CS_AS, 'ö'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&divide;' collate Latin1_General_CS_AS, '÷'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&oslash;' collate Latin1_General_CS_AS, 'ø'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&ugrave;' collate Latin1_General_CS_AS, 'ù'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&uacute;' collate Latin1_General_CS_AS, 'ú'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&ucirc;' collate Latin1_General_CS_AS, 'û'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&uuml;' collate Latin1_General_CS_AS, 'ü'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&quot;' collate Latin1_General_CS_AS, '"'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&amp;' collate Latin1_General_CS_AS, '&'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&lsaquo;' collate Latin1_General_CS_AS, '<'  collate Latin1_General_CS_AS)
set @HTMLText = replace(@htmlText, '&rsaquo;' collate Latin1_General_CS_AS, '>'  collate Latin1_General_CS_AS)


-- Remove anything between <STYLE> tags
SET @Start = CHARINDEX('<STYLE', @HTMLText)
SET @End = CHARINDEX('</STYLE>', @HTMLText, CHARINDEX('<', @HTMLText)) + 7
SET @Length = (@End - @Start) + 1

WHILE (@Start > 0 AND @End > 0 AND @Length > 0) BEGIN
SET @HTMLText = STUFF(@HTMLText, @Start, @Length, '')
SET @Start = CHARINDEX('<STYLE', @HTMLText)
SET @End = CHARINDEX('</STYLE>', @HTMLText, CHARINDEX('</STYLE>', @HTMLText)) + 7
SET @Length = (@End - @Start) + 1
END

-- Remove anything between <SCRIPT> tags
SET @Start = CHARINDEX('<SCRIPT', @HTMLText)
SET @End = CHARINDEX('</SCRIPT>', @HTMLText, CHARINDEX('<', @HTMLText)) + 7
SET @Length = (@End - @Start) + 1

WHILE (@Start > 0 AND @End > 0 AND @Length > 0) BEGIN
SET @HTMLText = STUFF(@HTMLText, @Start, @Length, '')
SET @Start = CHARINDEX('<SCRIPT', @HTMLText)
SET @End = CHARINDEX('</SCRIPT>', @HTMLText, CHARINDEX('</SCRIPT>', @HTMLText)) + 7
SET @Length = (@End - @Start) + 1
END

-- Remove anything between <whatever> tags
SET @Start = CHARINDEX('<', @HTMLText)
SET @End = CHARINDEX('>', @HTMLText, CHARINDEX('<', @HTMLText))
SET @Length = (@End - @Start) + 1

WHILE (@Start > 0 AND @End > 0 AND @Length > 0) BEGIN
SET @HTMLText = STUFF(@HTMLText, @Start, @Length, '')
SET @Start = CHARINDEX('<', @HTMLText)
SET @End = CHARINDEX('>', @HTMLText, CHARINDEX('<', @HTMLText))
SET @Length = (@End - @Start) + 1
END

RETURN LTRIM(RTRIM(@HTMLText))

END
GO




SET IDENTITY_INSERT tbl_Voorwerp ON

INSERT INTO tbl_Voorwerp(voorwerpnummer, titel, beschrijving, startprijs, land, looptijd, LooptijdEindeDag, verkoper)
SELECT CAST(ID AS BIGINT) AS voorwerpnummer,
LEFT(Items.Titel, 255) AS titel,
dbo.stripHTML(LEFT(Items.Beschrijving, 2000)) AS beschrijving,
CAST(Items.Prijs AS NUMERIC(7,2)) AS startprijs,
LEFT(Items.Locatie, 30) AS land,
7 AS looptijd,
getdate()+7 AS looptijdEindeDag,
LEFT(Items.Verkoper, 30) AS Verkoper
FROM Items

SET IDENTITY_INSERT tbl_Voorwerp OFF
 
 -----------------------------------------------------INSERT van tabel illustraties---------------------------------------------
ALTER TABLE tbl_bestand DROP CONSTRAINT CK_voorwerp_filenaam
INSERT INTO tbl_bestand(voorwerp, filenaam)
SELECT CAST(ItemID AS BIGINT) AS voorwerp,
    'http://iproject33.icasites.nl/pics/'+LEFT(IllustratieFile, 75) AS filenaam
FROM Illustraties


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


