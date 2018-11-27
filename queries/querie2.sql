SELECT
    name,
    reference_value
FROM
    indicator
WHERE
    reference_value > 100 AND unit = "miligrams"
ORDER BY
    reference_value
DESC