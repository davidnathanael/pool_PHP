SELECT COUNT(*) AS 'films'
FROM historique_membre
WHERE DATE(date) BETWEEN '2006-10-30' AND '2007-07-27' OR DATE_FORMAT(DATE(date),'%m-%d') = '12-24'