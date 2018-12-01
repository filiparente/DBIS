CREATE OR REPLACE VIEW dim_animal(
    animal_name,
    animal_vat,
    species,
    age
) AS SELECT
    A.name,
    A.VAT,
    A.species_name,
    A.age
FROM
    animal A