SELECT DISTINCT
    A.name AS animal_name,
    PO.name AS owner_name,
    A.species_name,
    A.age
FROM
    animal A,
    person PO,
    person PV,
    consult C
WHERE
    C.VAT_vet = PV.VAT AND PV.name = "John Smith" AND C.name = A.name AND C.VAT_owner = A.VAT AND C.VAT_owner = PO.VAT