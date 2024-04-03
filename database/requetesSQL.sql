-- a :  Informations d’un film (id_film) : titre, année, durée (au format HH:MM) et réalisateur
-- SELECT title, releaseYear, SEC_TO_TIME((duration)*60), firstname, surname
-- FROM movie
-- INNER JOIN person ON movie.idMovie = person.idPerson




-- b : Liste des films dont la durée excède 2h15 classés par durée (du + long au + court)
-- SELECT title, releaseYear, SEC_TO_TIME((duration)*60) AS duration
-- FROM movie
-- WHERE duration >= 135
-- ORDER BY duration DESC



-- c :  Liste des films d’un réalisateur (en précisant l’année de sortie)
-- SELECT firstname, surname, title, releaseYear
-- FROM director
-- INNER JOIN person ON director.idPerson = person.idPerson
-- INNER JOIN movie ON director.idDirector = movie.idDirector



-- d : Nombre de films par genre (classés dans l’ordre décroissant)
-- SELECT typeName, COUNT(movie_theme.idTheme) AS NbMovieByTheme
-- FROM theme
-- INNER JOIN movie_theme ON theme.idTheme = movie_theme.idTheme
-- GROUP BY theme.idTheme
-- ORDER BY NbMovieByTheme DESC



-- e : Nombre de films par réalisateur (classés dans l’ordre décroissant)
-- SELECT firstname, surname, COUNT(movie.idDirector) AS NbMovie
-- FROM director
-- INNER JOIN movie ON director.idDirector = movie.idDirector
-- INNER JOIN person ON director.idPerson = person.idPerson
-- GROUP BY director.idDirector
-- ORDER BY NbMovie DESC


-- f : Casting d’un film en particulier (id_film) : nom, prénom des acteurs + sexe
-- SELECT movie.title, CONCAT(person.firstname, " ",person.surname) AS Actors, person.sex
-- FROM play
-- INNER JOIN movie ON play.idMovie = movie.idMovie
-- INNER JOIN actor ON play.idActor = actor.idActor
-- INNER JOIN person ON actor.idPerson = person.idPerson
-- WHERE play.idMovie = 3



-- g : Films tournés par un acteur en particulier (id_acteur) avec leur rôle et l’année de sortie (du film le plus récent au plus ancien)
-- SELECT movie.title, movie.releaseYear, CONCAT(person.firstname, " ",person.surname) AS Acteur, role.roleName
-- FROM play
-- INNER JOIN movie ON play.idMovie = movie.idMovie
-- INNER JOIN role ON play.idRole = role.idRole
-- INNER JOIN actor ON play.idActor = actor.idActor
-- INNER JOIN person ON actor.idPerson = person.idPerson
-- WHERE actor.idActor = 3
-- ORDER BY releaseYear DESC


-- h : Liste des personnes qui sont à la fois acteurs et réalisateurs
-- SELECT CONCAT (person.firstname, " ",person.surname) AS Person
-- FROM person
-- INNER JOIN actor ON person.idPerson = actor.idPerson
-- INNER JOIN director ON person.idPerson = director.idPerson


-- i : Liste des films qui ont moins de 5 ans (classés du plus récent au plus ancien)
-- SELECT movie.title, movie.releaseYear
-- FROM movie
-- WHERE releaseYear > YEAR(CURDATE()) - 5
-- ORDER BY releaseYear DESC


-- j : Nombre d’hommes et de femmes parmi les acteurs
-- SELECT person.sex, COUNT(actor.idPerson) AS Actors
-- FROM person
-- INNER JOIN actor ON person.idPerson = actor.idPerson
-- GROUP BY sex


-- k : Liste des acteurs ayant plus de 50 ans (âge révolu et non révolu)
-- SELECT person.firstname, person.surname, person.birthdate
-- FROM person
-- WHERE TIMESTAMPDIFF(YEAR, person.birthdate, CURDATE()) > 50


-- l :  Acteurs ayant joué dans 3 films ou plus
-- SELECT CONCAT(person.firstname, " ",person.surname) AS Actors, COUNT(play.idMovie) AS NbMovies
-- FROM movie
-- INNER JOIN play ON movie.idMovie = play.idMovie
-- INNER JOIN actor ON play.idActor = actor.idActor
-- INNER JOIN person ON actor.idPerson = person.idPerson
-- GROUP BY play.idActor
-- HAVING NbMovies >= 3