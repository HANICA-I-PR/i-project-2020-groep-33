USE EenmaalAndermaal

/*INSERT INTO tbl_Rubriek 
SELECT CAST(ID AS SMALLINT) AS rubrieknummer,
		LEFT(Name, 50) AS rubrieknaam,
		?
FROM databatch.dbo.Categorieen*/

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

 
INSERT INTO EenmaalAndermaal.dbo.tbl_Gebruiker(gebruikersnaam, postcode, land)
SELECT DISTINCT LEFT(username, 30) AS gebruikersnaam,
    LEFT(Postalcode, 10) AS postcode,
    LEFT(Location, 30) AS land
FROM databatch.dbo.Users



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


CREATE TRIGGER auto_einddatum ON tbl_Voorwerp
INSTEAD OF INSERT 
AS
BEGIN
INSERT INTO EenmaalAndermaal.dbo.tbl_Voorwerp(looptijdEindeDag) 
SELECT looptijdBeginDag FROM inserted 
END

INSERT INTO tbl_Gebruiker(gebruikersnaam, postcode, land) VALUES('Obe', '6512AW', 'Nederland')

INSERT INTO tbl_Voorwerp (titel, beschrijving, startprijs, land, verkoper)  VALUES ( 'titel', 'beschrijving', 10, 'Nederland', 'Obe')
								



INSERT INTO tbl_Voorwerp
SELECT DISTINCT CAST(ID AS INT) AS voorwerpnummer,
LEFT(Items.Titel, 255) AS titel,
LEFT(Items.Beschrijving, 800) AS beschrijving,
CAST(Items.Prijs AS NUMERIC(7,2)) AS startprijs,
LEFT(Items.Locatie, 30) AS land,
LEFT(Items.Verkoper, 30) AS Verkoper
FROM databatch.dbo.Items




