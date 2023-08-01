import {table_search, table_pagination, table_label, configTable} from './table_definitions';
import {html} from "gridjs";

$(function () {

    configTable(['Nombre', 'Dirección', 'Código Postal', 'Acciones'], data => data.results.map(entity => [
        entity.name, entity.address, entity.zipcode, html(entity.edit)
    ]));
});
