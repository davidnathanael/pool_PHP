SELECT nom
FROM distrib
WHERE id_distrib IN (42, 62, 63, 64, 65, 66, 67, 68, 69, 71, 88, 89, 90) 
	OR (LENGTH(nom) - LENGTH(REPLACE(nom, 'y', '')) = 2 
	OR LENGTH(nom) - LENGTH(REPLACE(nom, 'Y', '')) = 2)
LIMIT 2, 5
