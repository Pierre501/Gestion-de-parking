-- create database gestion_parking;
-- grant all privileges on database gestion_parking to admin;
-- psql -d gestion_parking -U admin -W

create extension pgcrypto;

create table if not exists administrateur(
	idadministrateur int not null,
	username varchar(100) not null,
	motdepasse varchar(100) not null,
	primary key(idadministrateur)
);
insert into administrateur values(1, 'administrateur@gmail.com', encode(digest('Admin2022','sha1'),'hex'));


create table if not exists utilisateur(
	idutilisateur serial not null,
	nom varchar(100) not null,
	username varchar(100) not null,
	motdepasse varchar(100) not null,
	primary key(idutilisateur)
);
insert into utilisateur values(default, 'RAKOTO Jean','rakoto@gmail.com', encode(digest('0000','sha1'),'hex'));
insert into utilisateur values(default, 'NOMENJANAHARY Jean','nomenjenahary@gmail.com', encode(digest('1111','sha1'),'hex'));


create table if not exists portefeuille(
	idportefeuille serial not null,
	idutilisateur int not null,
	montant decimal(10,2) not null,
	montantdepense decimal(10,2) not null,
	status varchar(20) not null,
	datedepot date not null,
	primary key(idportefeuille),
	foreign key(idutilisateur) references utilisateur(idutilisateur)
);
insert into portefeuille values(default, 1, 0, 0, 'valide', '2022-07-13');
insert into portefeuille values(default, 2, 0, 0, 'valide', '2022-07-13');

create view viewportefeuille as select idutilisateur, sum(montant) as montant, sum(montantdepense) as montantdepense, status, current_date as dateEncours from portefeuille group by idutilisateur, status, dateEncours;


create view viewportefeuillefinal as select idutilisateur, montant, montantdepense, dateEncours, status, (montant-montantdepense) as solde from viewportefeuille;


create view viewsutilisateur as select
	utilisateur.idutilisateur,
	utilisateur.nom,
	utilisateur.username,
	utilisateur.motdepasse,
	viewportefeuillefinal.montant,
	viewportefeuillefinal.status,
	viewportefeuillefinal.montantdepense,
	viewportefeuillefinal.solde,
	viewportefeuillefinal.dateEncours
from utilisateur join viewportefeuillefinal on utilisateur.idutilisateur = viewportefeuillefinal.idutilisateur;


create table if not exists voiture(
	idvoiture serial not null,
	idutilisateur int not null,
	model varchar(100) not null,
	marque varchar(100) not null,
	matricule varchar(30) not null,
	type varchar(100) not null,
	primary key(idvoiture),
	foreign key(idutilisateur) references utilisateur(idutilisateur)
);
insert into voiture values(default, 1, 'Sprinter', 'Mercedes', '1234TBA', 'Legèrs');
insert into voiture values(default, 2, 'Camion', 'Mercedes', '3456TBA', 'Lourds');


create table if not exists parking(
	idparking serial not null,
	nomparking varchar(50) not null,
	lieuparking varchar(100) not null,
	primary key(idparking)
);
insert into parking values(default, 'Parking ITuniversity', 'Andoharanofotsy');


create table if not exists place(
	idplace serial not null,
	idparking int not null,
	numero char(5) not null,
	primary key(idplace),
	foreign key(idparking) references parking(idparking)
);
insert into place values(default, 1, '01');
insert into place values(default, 1, '02');
insert into place values(default, 1, '03');
insert into place values(default, 1, '04');
insert into place values(default, 1, '05');
insert into place values(default, 1, '06');
insert into place values(default, 1, '07');
insert into place values(default, 1, '08');
insert into place values(default, 1, '09');
insert into place values(default, 1, '10');
insert into place values(default, 1, '11');
insert into place values(default, 1, '12');
insert into place values(default, 1, '13');
insert into place values(default, 1, '14');
insert into place values(default, 1, '15');


create table if not exists tarifparking(
	idtarifparking serial not null,
	tarif varchar(20) not null,
	dure time not null,
	montant decimal(10,2) not null,
	primary key(idtarifparking)
);
insert into tarifparking values(default, 'Tarif 1', '00:15:00', 1500);
insert into tarifparking values(default, 'Tarif 2', '00:30:00', 3500);
insert into tarifparking values(default, 'Tarif 3', '01:00:00', 5000);
insert into tarifparking values(default, 'Tarif 4', '01:30:00', 7000);
insert into tarifparking values(default, 'Tarif 5', '02:00:00', 9000);



create table if not exists stationnement(
	idstationnement serial not null,
	idvoiture int not null,
	idplace int not null,
	idtarifparking int not null,
	idparametre int not null,
	datedebut date not null,
	heuredebut time not null,
	datefin date not null,
	heurefin time not null,
	primary key(idstationnement),
	foreign key(idvoiture) references voiture(idvoiture),
	foreign key(idplace) references place(idplace),
	foreign key(idtarifparking) references tarifparking(idtarifparking),
	foreign key(idparametre) references parametre(idparametre)
);
insert into stationnement values(default, 1, 1, 1, 1,'2022-07-14', '07:00:00', '2022-07-14', '07:15:00');


create view viewplacedisponible as select
	place.idplace,
	place.idparking,
	place.numero
from place left join stationnement on place.idplace = stationnement.idplace where stationnement.idplace is null;


create view viewsstationnement as select
	tarifparking.idtarifparking,
	tarifparking.tarif,
	tarifparking.dure,
	tarifparking.montant,
	stationnement.idstationnement,
	stationnement.idvoiture,
	stationnement.datedebut,
	stationnement.heuredebut,
	stationnement.datefin,
	stationnement.heurefin,
	viewsparametre.idparametre,
	viewsparametre.dateparametre,
	viewsparametre.heureparametre,
	viewsparametre.options,
	viewsparametre.dateencours,
	viewsparametre.heureencours
from tarifparking join stationnement on tarifparking.idtarifparking = stationnement.idtarifparking
join viewsparametre on stationnement.idparametre = viewsparametre.idparametre;



create table if not exists voituresortant(
	idvoituresortant serial not null,
	idvoiture int not null,
	datesortant date not null,
	heuresortant time not null,
	primary key(idvoituresortant),
	foreign key(idvoiture) references voiture(idvoiture)
);



create table if not exists amende(
	idamende serial not null,
	idvoiture int not null,
	amande int not null,
	dateamende date not null,
	primary key(idamende),
	foreign key(idvoiture) references voiture(idvoiture)
);


create table if not exists payement(
	idpayement serial not null,
	idutilisateur int not null,
	idtarifparking int not null,
	idplace int not null,
	montant decimal(10,2) not null,
	motif varchar(30) not null,
	datepayement date not null,
	heurepayement time not null,
	primary key(idpayement),
	foreign key(idutilisateur) references utilisateur(idutilisateur),
	foreign key(idtarifparking) references tarifparking(idtarifparking),
	foreign key(idplace) references place(idplace)
);



create table if not exists parametre(
	idparametre int not null,
	dateparametre date not null,
	heureparametre time not null,
	options varchar(50) not null,
	primary key(idparametre)
);
insert into parametre values(1, '2022-07-14', '09:00:00', 'Avance');

create view viewsparametre as select idparametre, dateparametre, options, heureparametre, current_date as dateencours, current_time as heureencours from parametre;


















