SELECT
    P.name,
    P.address_city,
    P.address_street,
    P.address_zip
FROM
    person P,
    client Cl,
    animal A
WHERE
    A.VAT = Cl.VAT AND Cl.VAT = P.vAT AND P.name NOT IN(
    SELECT
        P.name
    FROM
        animal A
    WHERE
        A.VAT = Cl.VAT AND Cl.VAT = P.VAT AND A.name NOT IN(
        SELECT
            A.name
        FROM
            animal A,
            person P,
            client Cl
        WHERE
            A.VAT = Cl.VAT AND Cl.VAT = P.VAT AND A.species_name LIKE "%bird%"
    )
)