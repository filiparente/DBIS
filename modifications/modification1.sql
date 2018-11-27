UPDATE
    person p,
    client
SET
    p.address_street = "1600 Pennsylvania Av",
    p.address_city = "Washington DC",
    p.address_zip = "2000-050"
WHERE
    p.name = "John Smith" AND p.VAT = client.VAT