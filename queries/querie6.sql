SELECT
    AVG(av.count_participation) average_assistants,
    AVG(av.count_procedures) average_procedures,
    AVG(av.count_diagnosis_code) average_diagnosis,
    AVG(av.count_prescription_name) average_prescription
FROM
    (
    SELECT
        t.consult_name av_consult_name,
        t.consult_time av_consult_time,
        COUNT(
            DISTINCT t.procedures_num,
            t.procedures_name,
            t.procedures_date_timestamp
        ) count_procedures,
        COUNT(
            DISTINCT t.diagnosis_code,
            t.diagnosis_name,
            t.diagnosis_VAT_owner,
            t.diagnosis_date_timestamp
        ) count_diagnosis_code,
        COUNT(
            DISTINCT prescription_med,
            pre_lab,
            pre_dosage
        ) count_prescription_name,
        COUNT(
            DISTINCT t.participation_name,
            t.participation_date_timestamp,
            t.participation_VAT_owner,
            t.participation_VAT_assistant
        ) count_participation
    FROM
        (
        SELECT
            c.name consult_name,
            pro.num procedures_num,
            pro.name procedures_name,
            pro.date_timestamp procedures_date_timestamp,
            cd.code diagnosis_code,
            cd.name diagnosis_name,
            cd.VAT_owner diagnosis_VAT_owner,
            cd.date_timestamp diagnosis_date_timestamp,
            pre.name_med prescription_med,
            pre.lab pre_lab,
            pre.dosage pre_dosage,
            c.date_timestamp consult_time,
            par.name participation_name,
            par.VAT_owner participation_VAT_owner,
            par.date_timestamp participation_date_timestamp,
            par.VAT_assistant participation_VAT_assistant
        FROM
            consult c
        LEFT JOIN procedures pro ON
            c.name = pro.name AND c.VAT_owner = pro.VAT_owner AND c.date_timestamp = pro.date_timestamp
        LEFT JOIN consult_diagnosis cd ON
            c.name = cd.name AND c.VAT_owner = cd.VAT_owner AND c.date_timestamp = cd.date_timestamp
        LEFT JOIN prescription pre ON
            c.name = pre.name AND c.VAT_owner = pre.VAT_owner AND c.date_timestamp = pre.date_timestamp
        LEFT JOIN participation par ON
            c.name = par.name AND c.VAT_owner = par.VAT_owner AND c.date_timestamp = par.date_timestamp
        WHERE
            YEAR(c.date_timestamp) = "2017"
    ) t
GROUP BY
    t.consult_name,
    t.consult_time
) av
