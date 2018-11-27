delete P from person P, client Cl where P.name = "John Smith" and P.VAT = Cl.VAT
/*We used on delete cascade command in every create table with a foreign key including a VAT number
NOTE: The VAT number of customer John Smith (both client and doctor) is 129.*/