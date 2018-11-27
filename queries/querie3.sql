SELECT
    C.name AS animal_name,
    P.name AS owner_name,
    A.species_name,
    A.age
FROM
    consult C,
    person P,
    animal A
WHERE
    C.name = A.name AND C.VAT_owner = P.VAT AND C.weight > 30 AND(
        C.o LIKE '%obese%' OR C.o LIKE '%obesity%'
    )