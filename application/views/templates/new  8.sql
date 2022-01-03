SELECT c.id,c.date_creation,c.matricule, s.libele as 
statut,c.nom,c.prenom,c.sexe,c.date_naiss,c.phone,c.email,c.address,corp.libele as corps,c.grade,c.indice,
c.autre_corps,c.autre_grade,c.autre_indice,c.domaine,c.autre_domaine,
c.lacalite_service,c.nbr_enfant,c.cin,c.date_prise_service,sm.libele as situation_maternel,
dep.libele as departement, dir.libele as direction,
serv.libele as service, c.autre_division, r.libele as region, d.libele as 
district, prov.libele as province, pay.libele as 
pays,c.date_maj,c.date_last_modif,
soa.typecode as soa_code, soa.code as soa_libele
FROM candidat as c LEFT JOIN region as r on c.region_id = r.id LEFT JOIN 
district as d on c.district_id = d.id LEFT JOIN situation_mat as sm on 
c.sit_mat = sm.id  
LEFT JOIN statut as s on c.statut = s.id LEFT JOIN departement as dep on 
c.departement= dep.id LEFT JOIN direction as dir on c.direction= dir.id
LEFT JOIN service as serv on c.service = serv.id LEFT JOIN province as prov 
on c.province_id = prov.id LEFT JOIN pays as pay on c.pays_id = pay.id
LEFT JOIN corps as corp on c.corps = corp.id 
LEFT JOIN service_has_soa as ss on c.service = ss.service_id
LEFT JOIN soa on ss.soa_id = soa.id
GROUP BY id