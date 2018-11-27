SELECT
    D.code AS diagnostic_code,
    D.name AS diagnosis,
    COUNT(DISTINCT P.name_med) AS n_distinct_medication
FROM
    prescription P,
    diagnosis_code D
WHERE
    P.code = D.code
GROUP BY
    P.code
ORDER BY
    COUNT(DISTINCT P.name_med) ASC