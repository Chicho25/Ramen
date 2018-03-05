select * from items
select * from inventory_adjustment
select * from requisition
select * from requisition_detail
select * from employee
select * from location

select
inventory_adjustment.date as fecha,
inventory_adjustment.reason as motivo,
location.description as localidad,
inventory_adjustment.reference as referencia,
items.description as nombre_item,
inventory_adjustment.qty as cantidad_ingresada,
inventory_adjustment.qty_in_hand as cantidad_actual,
inventory_adjustment.qty_new as nueva_cantidad,
1 as tipo,
'-' as nombre,
'-' as apellido
from
inventory_adjustment inner join items on items.id = inventory_adjustment.id_item
					 inner join location on location.id = inventory_adjustment.id_warehouse


select
requisition.request_date as fecha,
requisition.notes as motivo,
location.description as localidad,
requisition.department as referencia,
requisition_detail.stock,
requisition_detail.qty as catidad_solicitada,
(requisition_detail.stock - requisition_detail.qty) as restante
0 as tipo,
employee.firstname as nombre,
employee.lastname as apellido
from requisition inner join location on location.id = requisition.id_warehouse
				 inner join employee on employee.id = requisition.request_by
                 inner join requisition_detail on requisition.id_req = requisition_detail.id
