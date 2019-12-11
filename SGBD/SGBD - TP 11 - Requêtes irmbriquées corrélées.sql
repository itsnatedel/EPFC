-- TP 11 --
-- TABLE SPJ --

-- Requêtes imbriquées avec EXISTS -- 

1. On souhaite obtenir les noms de fournisseurs de Londres qui ont effectué au moins une livraison dont la quantité de pièces est supérieur à 500 unités (Smith).
SELECT s.SNAME FROM s
WHERE EXISTS ( SELECT *
               FROM spj
               WHERE spj.ID_S=s.ID_S
               AND spj.QTY>500)
AND s.CITY="London"

2. On souhaite connaître les noms de projets pour lesquels on a fourni au total plus de 1000 pièces (Display, Console, RAID et Tape). 
SELECT j.JNAME FROM j
WHERE EXISTS ( SELECT *
               FROM spj
               WHERE spj.ID_J=j.ID_J
               GROUP BY spj.ID_J
               HAVING SUM(spj.QTY)>1000)
			  
			  
-- Union --

3. On souhaite obtenir toutes les villes pour lesquelles au moins un fournisseur, une pièce ou un projet est situé (London, Paris, Athens, Rome, Oslo). 
SELECT s.CITY FROM s
UNION
SELECT j.CITY FROM j
UNION 
SELECT p.CITY FROM p


-- Différences --

4. Quels sont les identifiants de fournisseurs qui ne livrent aucune pièce bleue ? (S1 et S4)
SELECT s.ID_S FROM s
WHERE NOT EXISTS ( SELECT *
                   FROM spj
                   JOIN p ON p.ID_P=spj.ID_P
                   WHERE spj.ID_S=s.ID_S
                   AND p.COLOR="Blue")
				   
5. On souhaite connaître le nombre de livraisons de moins de 350 unités pour l’ensemble des fournisseurs qui n’ont jamais fourni à Paris (8).
SELECT  COUNT(*) FROM spj
WHERE NOT EXISTS ( SELECT *
				   FROM s, spj spj2
                   JOIN j ON spj2.ID_J=j.ID_J
                   WHERE spj.ID_S=spj2.ID_S
                   AND j.CITY="Paris")
AND spj.QTY<350

6. On souhaite connaître les fournisseurs qui n’ont jamais fourni plus de 650 pièces identiques au total de toutes leurs livraisons. (C’est à dire ceux dont aucune pièce de leur stock n’a baissé de 650 unités) (S3 et S4). 
SELECT s.ID_S FROM s
WHERE NOT EXISTS ( SELECT * 
                   FROM spj
                   WHERE spj.ID_S=s.ID_S
                   AND spj.QTY > 650)

				   
-- INTERSECTIONS -- 

7. On souhaite connaître les fournisseurs qui ont fait au minimum 4 livraisons représentant au moins trois pièces différentes (S5). 
SELECT s.ID_S FROM s
WHERE EXISTS ( SELECT *
               FROM spj
               JOIN p ON spj.ID_P=p.ID_P
               WHERE spj.ID_S=s.ID_S
               GROUP BY spj.ID_S
               HAVING COUNT(*)>=4 AND COUNT(DISTINCT p.ID_P)>=3)

8. On souhaite les fournisseurs qui fournissent au moins dans trois villes différentes et dont les pièces qu’ils fournissent proviennent d’au moins deux villes différentes (S2 et S5).  
 SELECT s.ID_S FROM s
WHERE EXISTS ( SELECT * 
               FROM spj
               JOIN j ON spj.ID_J=j.ID_J
               JOIN p ON spj.ID_P=p.ID_P
               WHERE spj.ID_S=s.ID_S
               GROUP BY spj.ID_S
               HAVING COUNT(DISTINCT j.CITY)>=3 AND COUNT(DISTINCT p.CITY)>=2)
