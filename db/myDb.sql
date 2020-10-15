CREATE TABLE public.user 
(
	userId SERIAL NOT NULL PRIMARY KEY,
	name VARCHAR(100) NOT NULL,
	email VARCHAR(100) NOT NULL,
	password VARCHAR(100) NOT NULL
);

CREATE TABLE public.creator
(
	creatorId SERIAL NOT NULL PRIMARY KEY,
	creatorDesc VARCHAR(300),
	userId INT NOT NULL REFERENCES public.user(userId)
);

CREATE TABLE public.commission
(
	commissionId SERIAL NOT NULL PRIMARY KEY,
	commissionDesc VARCHAR(300) NOT NULL,
	creatorId INT NOT NULL REFERENCES public.creator(creatorId),
	userId INT NOT NULL REFERENCES public.user(userId)
);

CREATE TABLE public.inventory
(
	inventoryId SERIAL NOT NULL PRIMARY KEY,
	inventoryName VARCHAR(100) NOT NULL,
	inventoryDesc VARCHAR(300) NOT NULL,
	inventoryImg VARCHAR(300) NOT NULL,
	creatorId INT NOT NULL REFERENCES public.creator(creatorId),
	userId INT REFERENCES public.user(userId)
);