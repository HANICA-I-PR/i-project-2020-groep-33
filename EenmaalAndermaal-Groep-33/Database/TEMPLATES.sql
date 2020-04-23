USE EenmaalAndermaal

INSERT INTO tbl_Voorwerp VALUES (/* titel*/					,
                                /* beschrijving */			,
                                /* startprijs*/				,
                                /* betalingswijze*/			,
                                /* betalingsinstructie*/	,
                                /* plaatsnaam*/				,
                                /* land*/					,
                                /* looptijd*/				,
                                /* looptijdBeginDag*/getDate(),
                                /* looptijdBeginTijdstip*/CONVERT(TIME(0),GETDATE()),
                                /* verzendkosten*/			,
                                /* verzendinstructie*/		,
                                /* verkoper*/				,
                                /* koper*/					,
                                /* looptijdeindDag*/		,
                                /* looptijdeindTijdstip*/	,
                                /* veiling gesloten*/		,
                                /* verkoopprijs */			)

INSERT INTO tbl_Gebruiker VALUES (/* gebruikersnaam*/		,
								 /* voornaam*/				,
								 /* achternaam*/			,
								 /* adresregel 1*/			,
								 /* adresregel 2*/			,
								 /* postcode*/				,
								 /* plaatsnaam*/			,
								 /* land*/					,	
								 /* geboorteDag*/			,
								 /* e-mail*/				,
								 /* wachtwoord*/			,
								 /* vraag*/					,
								 /* antwoordtekst*/			,
								 /* verkoper?(1=wel, 0=niet)*/)

INSERT INTO tbl_Gebruikerstelefoon VALUES (/*gebruikersnaam*/	,
										  /*telefoon*/			)

INSERT INTO tbl_Rubriek VALUES (/*rubrieknaam*/				,
								/*rubriek (bovenliggende)*/	,
								/*volgnummer*/ getRubrieknummer(rubriek))

