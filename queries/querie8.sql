SELECT DISTINCT
    P.name
FROM
    person P,
    client Cl,
    assistant A,
    veterinary V
WHERE
    (
        Cl.VAT = A.VAT OR Cl.VAT = V.VAT
    ) AND Cl.VAT = P.VAT