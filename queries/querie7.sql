SELECT
    T.SN AS sub_species_of_dog,
    T.most_common_disease AS most_common_disease
FROM
    (
    SELECT
        A.species_name AS SN,
        D.code AS most_common_code,
        COUNT(D.code) AS occurrence,
        D.name as most_common_disease
    FROM
        diagnosis_code D,
        generalization_species GS,
        consult_diagnosis CD,
        animal A
    WHERE
        CD.name = A.name AND CD.code = D.code AND A.species_name = GS.name1 AND GS.name2 LIKE '%dog%'
    GROUP BY
        A.species_name,
        D.code
) T
WHERE NOT EXISTS
    (
    SELECT
        occurrence
    FROM
        (
        SELECT
            A.species_name AS SN,
            D.code AS most_common_code,
            COUNT(D.code) AS occurrence,
            D.name AS most_common_disease
        FROM
            diagnosis_code D,
            generalization_species GS,
            consult_diagnosis CD,
            animal A
        WHERE
            CD.name = A.name AND CD.code = D.code AND A.species_name = GS.name1 AND GS.name2 LIKE '%dog%'
        GROUP BY
            A.species_name,
            D.code
    ) T2
WHERE
    T2.occurrence > T.occurrence AND T2.SN = T.SN
)
GROUP BY
    T.SN