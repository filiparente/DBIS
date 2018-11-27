CREATE OR REPLACE VIEW dim_date(
    date_timestamp,
    DAY,
    MONTH,
    YEAR
) AS SELECT
    C.date_timestamp,
    DAY(C.date_timestamp),
    MONTH(C.date_timestamp),
    YEAR(C.date_timestamp)
FROM
    consult C