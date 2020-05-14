USE EenmaalAndermaal

/*INSERT INTO tbl_Rubriek 
SELECT CAST(ID AS SMALLINT) AS rubrieknummer,
		LEFT(Name, 50) AS rubrieknaam,
		?
FROM databatch.dbo.Categorieen*/


ALTER TABLE tbl_Gebruiker
ADD CONSTRAINT df_voornaam DEFAULT 'onbekend' FOR voornaam;

ALTER TABLE tbl_Gebruiker
ADD CONSTRAINT df_achternaam DEFAULT 'onbekend' FOR achternaam;

ALTER TABLE tbl_Gebruiker
ADD CONSTRAINT df_adresregel1 DEFAULT 'onbekend' FOR adresregel1;

ALTER TABLE tbl_Gebruiker
ADD CONSTRAINT df_adresregel2 DEFAULT 'onbekend' FOR adresregel2;

ALTER TABLE tbl_Gebruiker
ADD CONSTRAINT df_plaatsnaam DEFAULT 'onbekend' FOR plaatsnaam;

ALTER TABLE tbl_Gebruiker
ADD CONSTRAINT df_geboortedag DEFAULT '2020-01-01' FOR geboortedag;

ALTER TABLE tbl_Gebruiker
ADD CONSTRAINT df_email DEFAULT 'onbekend' FOR email;

ALTER TABLE tbl_Gebruiker
ADD CONSTRAINT df_wachtwoord DEFAULT 'onbekend' FOR wachwoord;

ALTER TABLE tbl_Gebruiker
ADD CONSTRAINT df_vraag DEFAULT '1' FOR vraag;

ALTER TABLE tbl_Gebruiker
ADD CONSTRAINT df_antwoord_text DEFAULT 'onbekend' FOR antwoord_text;

ALTER TABLE tbl_Gebruiker
ADD CONSTRAINT df_verkoper DEFAULT 'onbekend' FOR verkoper;

 
INSERT INTO EenmaalAndermaal.dbo.tbl_Gebruiker(gebruikersnaam, postcode, land)
SELECT LEFT(username, 30) AS gebruikersnaam,
    LEFT(Postalcode, 10) AS postcode,
    LEFT(Location, 30) AS land
FROM databatch.dbo.Users

 










ALTER TABLE tbl_Voorwerp
ADD CONSTRAINT df_betalingswijze DEFAULT 'onbekend' FOR betalingswijze;
ALTER TABLE tbl_Voorwerp
ADD CONSTRAINT df_plaatsnaam DEFAULT 'onbekend' FOR plaatsnaam;
ALTER TABLE tbl_Voorwerp
ADD CONSTRAINT df_startprijs DEFAULT 0.0 FOR startprijs;


INSERT INTO tbl_Voorwerp
SELECT CAST(ID AS INT) AS voorwerpnummer,
LEFT(Items.Titel, 255) AS titel,
LEFT(Items.Beschrijving, 800) AS beschrijving,
CAST(Items.Prijs AS NUMERIC(7,2)) AS startprijs,
LEFT(Items.Locatie, 30) AS land,
LEFT(Items.Verkoper, 30) AS Verkoper
FROM databatch.dbo.Items