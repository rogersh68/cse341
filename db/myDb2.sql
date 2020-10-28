CREATE TABLE public.user
(
    userId SERIAL NOT NULL PRIMARY KEY,
    firstName VARCHAR(100) NOT NULL,
    lastName VARCHAR(100) NOT NULL,
    userImg VARCHAR(300) NOT NULL,
    userEmail VARCHAR(100) NOT NULL,
	userPassword VARCHAR(100) NOT NULL,
    creator BOOLEAN NOT NULL,
    creatorDesc VARCHAR(300)
);

CREATE TABLE public.commission
(
    commId SERIAL NOT NULL PRIMARY KEY,
    commDesc VARCHAR(300) NOT NULL,
    accepted BOOLEAN NOT NULL,
    creatorId INT NOT NULL REFERENCES public.user(userId),
    userId INT NOT NULL REFERENCES public.user(userId)
);

CREATE TABLE public.inventory
(
    invId SERIAL NOT NULL PRIMARY KEY,
	invName VARCHAR(100) NOT NULL,
	invDesc VARCHAR(300) NOT NULL,
	invImg VARCHAR(100) NOT NULL,
	creatorId INT NOT NULL REFERENCES public.user(userId),
	userId INT REFERENCES public.user(userId)
);

INSERT INTO public.user (firstName, lastName, userImg, userEmail, userPassword, creator) VALUES ('Hannah', 'Rogers', 'images/profile_placeholder.svg', 'user@site.com', 'password', FALSE);
INSERT INTO public.user (firstName, lastName, userImg, userEmail, userPassword, creator, creatorDesc) VALUES ('Christina', 'Rogers', 'images/profile_placeholder.svg', 'creator@site.com', 'password', TRUE, 'I have always been very crafty. I love to knit and have been doing it as a hobby since I was a kid.');

INSERT INTO public.commission (commDesc, accepted, creatorId, userId) VALUES ('I would love a hand knitted, pink sweater', FALSE, 1, 2);
INSERT INTO public.commission (commDesc, accepted, creatorId, userId) VALUES ('I would like a pair of socks.', TRUE, 1, 2);

INSERT INTO public.inventory (invName, invDesc, invImg, creatorId) VALUES ('Knitted Blanket', 'A warm, hand knitted, gray blanket. Perfect as a gift.', 'images/inv_placeholder.svg', 1);
INSERT INTO public.inventory (invName, invDesc, invImg, creatorId) VALUES ('Knitted Sweater', 'A perfect sweater for the winter. Made with fuzzy white yarn.', 'images/inv_placeholder.svg', 1);
INSERT INTO public.inventory (invName, invDesc, invImg, creatorId, userId) VALUES ('Knitted Mittens', 'A pair of lovely, warm, hand-knitted mittens made with a yellow yarn.', 'images/inv_placeholder.svg', 1, 2);
