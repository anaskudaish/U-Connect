CREATE SCHEMA adressbuch;
USE adressbuch;


create table nutzer(

                       id int(10) PRIMARY KEY not null auto_increment,
                       email varchar(100) unique not null,
                       passwort varchar(200) not null ,
                       passwort_zurueck int(1) default 0

);

create table temporaeres_passwort(
                                     id int(10)  primary key not null references nutzer(id)
                                         ON DELETE CASCADE,
                                     passwort varchar(200) not null,
                                     ablauf_zeit varchar(80) not null


);



create table nutzer_tags(
                            id int(10) primary key  not null references nutzer(id)
                                ON DELETE CASCADE,
                              tags varchar(800) not null
);

create table kontakte(
                         id int(10) auto_increment primary key not null,
                         nutzer_id int(10) not null references nutzer(id)
                             ON DELETE CASCADE,
                         vorname varchar(80)  not null ,
                         nachname varchar(80) not null ,
                         bildname varchar(200) not null ,
                         erinnerungsinterval varchar(80) not null ,
                         naechsteerinnerung  varchar(80) not null

);

create table telefonnummer_kontakte(

                                       id int(10)  primary key not null references kontakte(id)
                                           ON DELETE CASCADE,
                                       telefonnummer varchar(80) not null
);

create table text_kontakte(
                              id int(10) primary key not null references kontakte(id)
                                  ON DELETE CASCADE,
                           textfeld varchar(800) not null

);

create table adresse_kontakte(

                                 id int(10)  primary key not null references kontakte(id)
                                     ON DELETE CASCADE,
                                 strasse varchar(80) default null,
                                 plz varchar(80) default null,
                                 stadt varchar(80) default null ,
                                 land varchar(80) default null
);

create table socialMedia_Kontakte(
                                     id int(10)  primary key not null references kontakte(id)
                                         ON DELETE CASCADE,
                                     instagram varchar(300) default null,
                                     facebook varchar (300) default null,
                                     twitter varchar(300) default null


);


create table tags_kontakte(
                              id int(10) not null references kontakte(id)
                                  ON DELETE CASCADE,
                              tags varchar(800) not null,
                              primary key (id,tags)

);

create table geburtsdatum_kontakte(
                              id int(10) primary key not null references kontakte(id)
                                  ON DELETE CASCADE,
                              geburtsdatum varchar(80) not null

);

CREATE TABLE beziehungen_kontakte(
                                     id int(10) not null REFERENCES kontakte(id)
                                         ON DELETE CASCADE,
                                     id_beziehung int(10) not null,
                                     Beziehungs_wert int(10),
                                     PRIMARY KEY (id,id_beziehung)
);
