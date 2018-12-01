UPDATE
    indicator I,
    produced_indicator P,
    test_procedure T
SET
    I.reference_value = I.reference_value*1.1
WHERE
    I.unit = "miligrams" AND I.name = P.indicator_name AND P.name = T.name and P.VAT_owner = T.VAT_owner AND P.date_timestamp = T.date_timestamp AND P.num = T.num AND T.type LIKE '%blood%'