SELECT
    P.name,
    P.VAT,
    P.address_city,
    P.address_street,
    P.address_zip
FROM
    person P,
    client Cl
WHERE
    P.VAT = Cl.VAT AND Cl.VAT NOT IN(
SELECT
    VAT
FROM
    animal
)