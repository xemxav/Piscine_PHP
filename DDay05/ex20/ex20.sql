SELECT film.id_genre AS id_genre, genre.name AS name_genre, distrib.id_distrib AS id_distrib, distrib.name AS name_distrib, film.title AS title_film FROM film
LEFT JOIN genre on film.id_genre = genre.id_genre
LEFT JOIN distrib on film.id_distrib = distrib.id_distrib
WHERE film.id_genre BETWEEN 4 and 8;