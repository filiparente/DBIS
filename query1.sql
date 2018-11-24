select distinct (a.name, c.VAT_client, c.VAT_owner)
from animal a, consult c, person p
where a.name="Ash" and c.name="Ash" and p.name like "%Stevens%" and c.VAT_owner=p.VAT or (c.VAT_client="102" and c.name="Ash" and a.name="Ash")

select distinct (a.name, pClient.name, pOwner.name)
from animal a, consult c, person pClient, person pOwner
where a.name="Ash" and c.name="Ash" and pOwner.name like "%Stevens%" and c.VAT_owner=pOwner.VAT or (c.VAT_client="102" and c.name="Ash" and a.name="Ash" c.VAT_client=pClient)

select * from animal a
left join person p on a.name=$ and a.VAT=p.VAT and p.name=$