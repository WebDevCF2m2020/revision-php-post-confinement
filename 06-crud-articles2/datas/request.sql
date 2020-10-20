# for connection
SELECT u.idusers, u.thename, d.iddroit, d.droit_name
	FROM users u
    INNER JOIN droit d 
		ON d.iddroit = u.droit_iddroit
    WHERE u.thename='Christiane' AND u.thepwd='Christiane';
# récupération de tous les utilisateurs pour insérer/ mettre à jour dans la partie admin   
SELECT idusers, thename FROM users ORDER BY thename ASC;