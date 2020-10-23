CREATE DATABASE IF NOT EXISTS produccionweb; 
USE produccionnweb; 

CREATE TABLE users(
id 					int(255) auto_increment not null, 
name 				varchar(50) not null, 
surname 			varchar(100), 
role				varchar(20), 
email 				varchar(255),
password 			varchar(255) not null, 
description 		text, 
image 				varchar(255), 
created_at  		datetime DEFAULT NULL, 
updated_at 			datetime DEFAULT NULL, 
remember_token 		varchar(255), 
CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb; 


CREATE TABLE ordenesVenta(
	id 				int(255), auto_increment not null, 
	DocNum			int(255) not null, 
	Canceled		char(1), 
	CardCode 		varchar(15), 
	CardName 		varchar(100),
	VatSum			numeric(19,6), 
	DiscPrcnt		numeric(19,6), 
	DiscSum 		numeric(19,6), 
	DocTotal		numeric(19,6), 
	Comments		varchar(254), 
	SlpCode			int, 
	created_at 		datetime DEFAULT NULL, 
	updated_at  	datetime DEFAULT NULL, 
	UserSign		int, 
	U_Almacen 		varchar(10), 
	U_Paciente  	varchar(150), 
	U_Expediente 	varchar(15)

)ENGINE=InnoDb